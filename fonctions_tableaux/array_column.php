<?php
declare(strict_types=1);

$articles = [
  ['id'=>1,'title'=>'Intro Laravel','views'=>120,'author'=>'Amina','published'=>true],
  ['id'=>2,'title'=>'PHP 8 en pratique','views'=>300,'author'=>'Yassine','published'=>true],
  ['id'=>3,'title'=>'Composer & Autoload','views'=>90,'author'=>'Amina','published'=>false],
];

$titles = array_column($articles, 'title'); // ['Intro Laravel', 'PHP 8 en pratique', 'Composer & Autoload']

// Tri décroissant par "views"
usort($articles, fn($a, $b) => $b['views'] <=> $a['views']);

// Vérifs clés/valeurs
$hasViewsKey = array_key_exists('views', $articles[0]); // true
$isPublished = $articles[0]['published'] ?? false;       // coalescence (vu en 3.0.1)

print_r($titles);
print_r($articles);
var_dump($hasViewsKey);
var_dump($isPublished);
