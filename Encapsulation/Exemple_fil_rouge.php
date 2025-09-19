<?php
declare(strict_types=1); 
// Active le mode strict pour les types.
// Cela oblige PHP à respecter strictement les types pour les paramètres et les retours de fonctions.

interface Logger {
  // Déclare une interface Logger.
  // Une interface définit un "contrat" : toutes les classes qui l'implémentent doivent définir la méthode info().
  public function info(string $msg): void;
}

class StdoutLogger implements Logger {
  // Classe qui implémente Logger et affiche les messages dans la console
  public function info(string $msg): void { 
      echo "[INFO] $msg" . PHP_EOL; 
      // Affiche le message précédé de [INFO] et ajoute un saut de ligne
  }
}

class NullLogger implements Logger {
  // Classe qui implémente Logger mais ne fait rien avec les messages (utile pour désactiver la journalisation)
  public function info(string $msg): void { 
      /* no-op : "no operation", ne fait rien */ 
  }
}

function run(Logger $logger): void {
  // Fonction qui prend un Logger en paramètre
  $logger->info("Démarrage…");
  // Appelle la méthode info() du Logger fourni, sans se soucier de son implémentation
}

// Appel de la fonction run avec un logger qui affiche les messages
run(new StdoutLogger());  // respecte le contrat Logger