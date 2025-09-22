<?php
declare(strict_types=1);

$data = ['title' => 'Hello JSON', 'tags' => ['php','json']];

$json = json_encode(
  $data,
  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE
);
// $json est une chaîne (ou false si erreur SANS JSON_THROW_ON_ERROR)

$again = json_decode($json, true, 512, JSON_THROW_ON_ERROR); // tableau associatif
