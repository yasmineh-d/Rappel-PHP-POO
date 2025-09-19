<?php
declare(strict_types=1);

class Article {
    public function __construct(
        public int $id,
        public string $title,
        public ?string $excerpt = null,
        public int $views = 0,       // valeur par défaut
    ) {}

    public function slug(): string {
        $s = strtolower($this->title);
        $s = preg_replace('/[^a-z0-9]+/i', '-', $s);
        return trim($s, '-');
    }
}

$a = new Article(id: 2, title: 'PHP 8 en pratique', views: 300); // arguments nommés
var_dump($a);
echo "<br>";
echo $a->slug();
