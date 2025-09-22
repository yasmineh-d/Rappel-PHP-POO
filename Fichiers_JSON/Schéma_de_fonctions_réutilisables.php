<?php
declare(strict_types=1);

/** @return array<mixed> */
function loadJson(string $path): array {
  $raw = @file_get_contents($path);
  if ($raw === false) {
    throw new RuntimeException("Fichier introuvable ou illisible: $path");
  }
  try {
    /** @var array<mixed> $data */
    $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
    return $data;
  } catch (JsonException $e) {
    throw new RuntimeException("JSON invalide dans $path", previous: $e);
  }
}

/** @param array<mixed> $data */
function saveJson(string $path, array $data): void {
  $dir = dirname($path);
  if (!is_dir($dir)) { mkdir($dir, 0777, true); }

  try {
    $json = json_encode(
      $data,
      JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE
    );
    if ($json === false) {
      throw new RuntimeException("Échec d'encodage JSON (retour false).");
    }
  } catch (Throwable $e) {
    throw new RuntimeException("Encodage JSON impossible", previous: $e);
  }

  $ok = @file_put_contents($path, $json . PHP_EOL, LOCK_EX);
  if ($ok === false) {
    throw new RuntimeException("Écriture impossible: $path");
  }
}
