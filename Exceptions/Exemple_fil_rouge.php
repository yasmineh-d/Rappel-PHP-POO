<?php
declare(strict_types=1);

function validateArticle(array $a): void {
  if (!isset($a['title']) || !is_string($a['title']) || $a['title'] === '') {
    throw new DomainException("Article invalide: 'title' requis.");
  }
  if (!isset($a['slug']) || !is_string($a['slug']) || $a['slug'] === '') {
    throw new DomainException("Article invalide: 'slug' requis.");
  }
}

function loadJson(string $path): array {
  $raw = @file_get_contents($path);
  if ($raw === false) {
    throw new RuntimeException("Fichier introuvable ou illisible: $path");
  }

  try {
    /** @var array $data */
    $data = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
  } catch (JsonException $je) {
    throw new RuntimeException("JSON invalide: $path", previous: $je);
  }

  if (!is_array($data)) {
    throw new UnexpectedValueException("Le JSON doit contenir un tableau racine.");
  }
  return $data;
}

function main(array $argv): int {
  $path = $argv[1] ?? 'storage/seeds/articles.input.json';

  $articles = loadJson($path);

  // 👇 Dump le tableau brut pour debug
  var_dump($articles);

  foreach ($articles as $i => $a) {
    validateArticle($a);
  }

  echo "[OK] $path: " . count($articles) . " article(s) valides." . PHP_EOL;
  return 0;
}

try {
  exit(main($argv));
} catch (Throwable $e) {
  fwrite(STDERR, "[ERR] " . $e->getMessage() . PHP_EOL);
  if ($e->getPrevious()) {
    fwrite(STDERR, "Cause: " . get_class($e->getPrevious()) . " — " . $e->getPrevious()->getMessage() . PHP_EOL);
  }
  exit(1);
}
