<?php
declare(strict_types=1);

class Category {
    // Propriétés "readonly" : 
    // - initialisées seulement dans le constructeur
    // - impossibles à modifier après
    public function __construct(
        public readonly string $name,        // Obligatoire
        public readonly ?string $color = null, // Optionnel (peut être null)
    ) {}
}

$cat = new Category('php', '#8892BF'); // Création d'un objet Category
// $cat->name = 'autre'; // ❌ Interdit : Erreur car "readonly"
var_dump($cat);
