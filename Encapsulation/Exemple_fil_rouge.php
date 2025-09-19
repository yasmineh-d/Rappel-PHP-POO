<?php
declare(strict_types=1); 
// Active le mode strict des types. Toute erreur de type déclenchera une exception.

class Article {
    public readonly int $id;          
    // Propriété immuable après construction, accessible publiquement.

    private string $title;            
    // Propriété privée : le titre est encapsulé, accessible seulement depuis la classe.

    private string $slug;             
    // Propriété privée : dérivée du titre via slugify().

    private array $tags = [];         
    // Propriété privée : tableau de tags associé à l’article.

    private static int $count = 0;    
    // Propriété statique partagée par tous les objets Article, comptabilise les instances.

    public function __construct(int $id, string $title, array $tags = []) {
        if ($id <= 0) throw new InvalidArgumentException("id > 0 requis.");
        // Vérifie que l’id est positif.

        $this->id = $id;                 
        // Assigne l’id (readonly, assignable seulement ici).

        $this->setTitle($title);         
        // Utilise le setter pour valider le titre et générer le slug.

        $this->tags = $tags;             
        // Initialise les tags si fournis.

        self::$count++;                  
        // Incrémente le compteur d’articles créés.
    }

    /** Usine avec LSB : retournera la sous-classe correcte si appelée depuis elle */
    public static function fromTitle(int $id, string $title): static {
        return new static($id, $title);
        // Permet de créer un objet de la classe actuelle ou de la sous-classe.
    }

    /** Getters (API publique minimale) */
    public function title(): string { return $this->title; }
    public function slug(): string { return $this->slug; }
    public function tags(): array { return $this->tags; }
    // Permettent d’accéder aux propriétés privées depuis l’extérieur.

    /** Setter encapsulant validation + mise à jour du slug */
    public function setTitle(string $title): void {
        $title = trim($title);
        if ($title === '') throw new InvalidArgumentException("Titre requis.");
        $this->title = $title;
        $this->slug  = static::slugify($title);
        // Met à jour le titre et le slug automatiquement.
    }

    public function addTag(string $tag): void {
        $t = trim($tag);
        if ($t === '') throw new InvalidArgumentException("Tag vide.");
        $this->tags[] = $t;
        // Ajoute un tag après validation.
    }

    public static function count(): int { return self::$count; }
    // Retourne le nombre total d’articles créés.

    /** Protégé : surcharge possible côté sous-classe */
    protected static function slugify(string $value): string {
        $s = strtolower($value);
        $s = preg_replace('/[^a-z0-9]+/i', '-', $s) ?? '';
        return trim($s, '-');
        // Transforme un titre en slug URL-friendly.
    }
}

/** Sous-classe : spécialisation via `protected` et LSB */
class FeaturedArticle extends Article {
    protected static function slugify(string $value): string {
        return 'featured-' . parent::slugify($value);
        // Surcharge slugify pour ajouter le préfixe 'featured-'.
    }
}

// Démo
$a = Article::fromTitle(1, 'Encapsulation & visibilité en PHP');
// Crée un Article avec id=1 et titre donné.

$b = FeaturedArticle::fromTitle(2, 'Lire moins, comprendre plus');
// Crée un FeaturedArticle avec id=2 et titre donné.

$b->addTag('best');
// Ajoute un tag à l’article $b.

echo $a->slug() . PHP_EOL; 
// Affiche : "encapsulation-visibilite-en-php"

echo $b->slug() . PHP_EOL; 
// Affiche : "featured-lire-moins-comprendre-plus"

echo Article::count() . PHP_EOL; 
// Affiche : 2 (nombre total d’articles créés)
