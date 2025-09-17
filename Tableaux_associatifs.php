<?php
$article = [
  'title'     => 'Intro Laravel',
  'excerpt'   => null,
  'views'     => 120,
  'published' => true,
];

// Ajouter un auteur
$article['author'] = 'Amina';

// Vérifier si la clé "views" existe
$hasViews = array_key_exists('views', $article);

echo $article['title'];   // affiche Intro Laravel
echo "<br>";
echo $article['author'];  // affiche Amina
echo "<br>";
var_dump($hasViews);      // bool(true)
