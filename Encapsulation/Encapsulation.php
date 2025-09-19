<?php
declare(strict_types=1); 
// Active le mode strict des types. Toute incompatibilité de type lancera une erreur.

class User {
    private string $name;          
    // Propriété privée $name : accessible uniquement à l’intérieur de la classe.
    
    protected array $roles = [];   
    // Propriété protégée $roles : accessible dans cette classe et ses sous-classes, pas depuis l’extérieur.
    
    public function __construct(string $name) { 
        $this->setName($name); 
    }
    // Constructeur : appelé lors de la création de l’objet. 
    // Initialise le nom via la méthode setName() pour appliquer la validation.

    public function name(): string { 
        return $this->name; 
    }
    // Méthode publique pour accéder au nom (getter). 
    // Permet de récupérer $name de façon sécurisée depuis l’extérieur.

    public function setName(string $name): void {
        $name = trim($name); 
        // Supprime les espaces inutiles au début et à la fin du nom.
        
        if ($name === '') throw new InvalidArgumentException("Nom requis.");
        // Lance une exception si le nom est vide.
        
        $this->name = $name; 
        // Assigne le nom à la propriété privée.
    }

    public function addRole(string $role): void {
        if ($role === '') throw new InvalidArgumentException("Role vide.");
        // Lance une exception si le rôle est vide.
        
        $this->roles[] = $role; 
        // Ajoute le rôle à la liste des rôles de l’utilisateur.
    }

    public function roles(): array { 
        return $this->roles; 
    }
    // Méthode publique pour récupérer tous les rôles (getter).
    // Nécessaire car $roles est protégé et inaccessible directement depuis l’extérieur.
}

// Création d’un objet User avec le nom "Amina"
$u = new User('Amina'); 

// Ajoute le rôle "author" à cet utilisateur
$u->addRole('author'); 

// $u->name = 'X';         // ❌ Erreur : propriété privée, impossible d’y accéder directement
// echo $u->roles[0];      // ❌ Erreur : propriété protégée, inaccessible depuis l’extérieur

echo $u->name();           
// ✅ OK : récupère le nom via la méthode publique name()
