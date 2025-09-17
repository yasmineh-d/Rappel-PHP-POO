<?php
// On active le mode strict de PHP pour un code plus fiable
declare(strict_types=1);

// Fonction qui transforme un titre en URL-friendly "slug"
function slugify(string $title): string {
    $slug = strtolower($title);  // Convert to lowercase
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug); // Remplacer les caractères non alphanumériques par un trait d'union
    return trim($slug, '-');  // Couper les traits d'union de début et de fin
}

// Notre liste d'articles
$articles = [
    ['id'=>1,'title'=>'Intro Laravel','category'=>'php','views'=>120,'author'=>'Amina','published'=>true],
    ['id'=>2,'title'=>'PHP 8 en pratique','category'=>'php','views'=>300,'author'=>'Yassine','published'=>true],
    ['id'=>3,'title'=>'Composer & Autoload','category'=>'php','views'=>90,'author'=>'Amina','published'=>false],
];


// On prend seulement les articles qui sont publiés (published = true)
// array_values kat 3awd t'rteb les index (0, 1, 2...) dyal tableau jdid.
$published = array_values(array_filter($articles, fn($a) => $a['published'] ?? false));

// On transforme la liste des articles publiés pour ajouter un slug
$normalized = array_map(
  fn($a) => [
    'id'       => $a['id'],
    'slug'     => slugify($a['title']),
    'views'    => $a['views'],
    'author'   => $a['author'],
    'category' => $a['category'],
  ],
  $published
);

// On classe les articles du plus vu au moins vu
usort($normalized, fn($x, $y) => $y['views'] <=> $x['views']);

// array_reduce kat "reduce" (kat 9less) wa7d tableau l 9ima wa7da (f had l'cas, tableau dyal résumé).
// On calcule des statistiques sur les articles publiés (nombre, total vues...)
$summary = array_reduce(
  $published,
  function(array $acc, array $a): array {
      $acc['count']      = ($acc['count'] ?? 0) + 1;
      $acc['views_sum']  = ($acc['views_sum'] ?? 0) + $a['views'];
      $cat = $a['category'];
      $acc['by_category'][$cat] = ($acc['by_category'][$cat] ?? 0) + 1;
      return $acc;
  },
  ['count'=>0, 'views_sum'=>0, 'by_category'=>[]]
);

// On affiche la liste des articles classés
print_r($normalized);

// On affiche les statistiques
print_r($summary);