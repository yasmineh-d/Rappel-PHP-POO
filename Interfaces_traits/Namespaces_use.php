<?php
declare(strict_types=1);

namespace App\Domain;

class Article {
    public string $title = "Mon premier article";
    public int $views = 10;

    public function getInfo(): string {
        return "Titre: {$this->title}, Vues: {$this->views}";
    }
}

// -------------- Fichier consommateur --------------

namespace App;

use App\Domain\Article;

$a = new Article();

// Afficher avec var_dump :
var_dump($a);

// Afficher avec print_r :
print_r($a);

// Afficher via méthode de la classe :
echo $a->getInfo();
