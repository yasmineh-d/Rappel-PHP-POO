<?php
declare(strict_types=1);

// Kanbdayw b wahed Array smitha $articles.
// Fiha collection dyal les articles, kol wahd 3ndo id, title, category, etc.
$articles = [
  ['id'=>1,'title'=>'Intro Laravel','category'=>'php','views'=>120,'author'=>'Amina','published'=>true,  'tags'=>['php','laravel']],
  ['id'=>2,'title'=>'PHP 8 en pratique','category'=>'php','views'=>300,'author'=>'Yassine','published'=>true,  'tags'=>['php']],
  ['id'=>3,'title'=>'Composer & Autoload','category'=>'outils','views'=>90,'author'=>'Amina','published'=>false, 'tags'=>['composer','php']],
  ['id'=>4,'title'=>'Validation FormRequest','category'=>'laravel','views'=>210,'author'=>'Sara','published'=>true,  'tags'=>['laravel','validation']],
];

// Had l-function smitha slugify kat7awl title l wahed format monassib l URL.
// par exemple "Intro Laravel" katwelli "intro-laravel".
function slugify(string $title): string {
    $slug = strtolower($title); // Katerred kolchi harf sghir (lowercase)
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug); // Katbeddel ayi 7aja men ghir horof o ar9am b tiré "-"
    return trim($slug, '-'); // Kat7eyed ayi tiré "-" f lewel o f lekher
}


// Hna kanfiltriw l-array dyal $articles.
// Kanakhdo ghir les articles li 3ndhom 'published' kat sawi true.
// array_filter katbqa dir loop o katchof chkon li ghadi ydoz f lcondition (dakchi li west l arrow function).
// array_values kat3awd t9ad les index dyal l-array jdid (bach ybdaw men 0, 1, 2...).
$published = array_values(
  array_filter($articles, fn(array $a) => $a['published'] ?? false)
);


// Hna kanqado wahed version "light" (khafifa) dyal les articles li published.
// Kanakhdo ghir l-id, title, views o kanzido 7ta slug jdid li kanseyboh b function slugify.
// array_map katbqa dir loop 3la kol article f $published o kat appliqué 3lih dakchi li f arrow function.
$light = array_map(
  fn(array $a) => [
    'id'    => $a['id'],
    'title' => $a['title'],
    'slug'  => slugify($a['title']),
    'views' => $a['views'],
  ],
  $published
);


// Hna kanakhdo l-array $light o kanrtboh 3la 7ssab 3adad l-views.
$top = $light;
// usort katrtbet array 3la 7ssab condition li kan3tiwha.
// Hna glna liha rtbet men lkbir lsghir dyal l-views ($b['views'] <=> $a['views']).
usort($top, fn($a, $b) => $b['views'] <=> $a['views']);
// array_slice katzwl wahed partie men l-array, hna glna liha tatekhod ghir 3 lawlin (men index 0 l-index 2).
$top3 = array_slice($top, 0, 3);


// Hna kan7esbo ch7al men article kteb kol author.
// array_reduce katجمع (reduce) l-array l wahed l9ima we7da (fhad l7ala, array jdid).
// $acc howa l-accumulator (dakchi li kaytjem3 fih resultat), o $a howa l-article li waslin lih f loop.
// Kol author kanzido lih +1 f array $acc.
$byAuthor = array_reduce(
  $published,
  function(array $acc, array $a): array {
      $author = $a['author'];
      $acc[$author] = ($acc[$author] ?? 0) + 1;
      return $acc;
  },
  [] // Kanbdaw b array khawi
);


// Hna kanjem3o ga3 les tags dyal les articles li published f array we7ed.
// array_map katakhod ghir l-key 'tags' men kol article.
// array_merge(...$arrays) katjem3 bezzaf dyal les arrays f wahed.
$allTags = array_merge(...array_map(fn($a) => $a['tags'], $published));


// Hna kan7esbo kol tag ch7al men merra kayt3awed.
// Bnafs tariqa dyal byAuthor, kansta3mlo array_reduce.
// Kol tag kanلقawh, kanzido lih +1 f l-accumulator $acc.
$tagFreq = array_reduce(
  $allTags,
  function(array $acc, string $tag): array {
      $acc[$tag] = ($acc[$tag] ?? 0) + 1;
      return $acc;
  },
  [] // Kanbdaw b array khawi
);


// F lekher, kan affichiw natija f l'écran.

echo "Top 3 (views):\n";
foreach ($top3 as $a) {
  echo "- {$a['title']} ({$a['views']} vues) — {$a['slug']}\n";
}

echo "\nPar auteur:\n";
foreach ($byAuthor as $author => $count) {
  echo "- $author: $count article(s)\n";
}

echo "\nTags:\n";
foreach ($tagFreq as $tag => $count) {
  echo "- $tag: $count\n";
}