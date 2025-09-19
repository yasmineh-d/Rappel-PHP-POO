<?php

trait Slugify {
    protected function slugify(string $value): string {
        $s = strtolower($value);
        $s = preg_replace('/[^a-z0-9]+/i', '-', $s) ?? '';
        return trim($s, '-');
    }
}

class Article {
    use Slugify;

    public function makeSlug(string $title): string {
        return $this->slugify($title);
    }
}

// Création d'un article
$article = new Article();

// Génération d'un slug
$slug = $article->makeSlug("Hello World! PHP & Traits 123");

// Affichage du résultat avec var_dump
var_dump($slug);
