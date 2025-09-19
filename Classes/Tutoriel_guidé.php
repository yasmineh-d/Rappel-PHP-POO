<?php
declare(strict_types=1); // Typage strict

// Données brutes
$raw = [
  ['id'=>1,'title'=>'Intro Laravel','excerpt'=>null,'views'=>120],
  ['id'=>2,'title'=>'PHP 8 en pratique','excerpt'=>'Tour des nouveautés','views'=>300],
  ['id'=>3,'title'=>'Composer & Autoload','excerpt'=>null,'views'=>90],
];

// Classe Article
class Article {
    public function __construct(
        public int $id,
        public string $title,
        public ?string $excerpt = null,
        public int $views = 0,
    ) {}

    public function slug(): string {
        $s = strtolower($this->title);
        $s = preg_replace('/[^a-z0-9]+/i', '-', $s);
        return trim($s, '-');
    }

    public function toArray(): array {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'excerpt' => $this->excerpt,
            'views'   => $this->views,
            'slug'    => $this->slug(),
        ];
    }
}

// Factory pour créer un Article à partir d'un tableau
class ArticleFactory {
    public static function fromArray(array $a): Article {
        $id      = (int)($a['id'] ?? 0);
        $title   = trim((string)($a['title'] ?? 'Sans titre'));
        $excerpt = $a['excerpt'] ?? null;
        $views   = (int)($a['views'] ?? 0);

        return new Article($id, $title, $excerpt, $views);
    }
}

// Créer tous les objets Article via la factory
$articles = array_map(fn($a) => ArticleFactory::fromArray($a), $raw);

// Mini-rapport simple
echo "<pre>";
foreach ($articles as $art) {
    $data = $art->toArray();
    echo "- {$data['title']} ({$data['views']} vues) — slug: {$data['slug']}\n";
}
echo "</pre>";

// Affichage complet des objets
echo "<pre>";
print_r($articles);
echo "</pre>";

// Affichage du premier article sous forme de tableau
echo "<pre>";
print_r($articles[0]->toArray());
echo "</pre>";
