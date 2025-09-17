<?php
declare(strict_types=1);

function riskyDivide(int $a, int $b): float {
  if ($b === 0) { // si la condition etegale 0 la condition va afficher un erreur
    throw new InvalidArgumentException('Division par zéro interdite.');
  }
  return $a / $b;// Si $b n'est pas égal à zéro, la fonction effectue la division et retourne le résultat.
}

try { //Essayez d'exécuter ce code à l'intérieur. Si tout se passe bien, vous pouvez continuer votre service normalement. Mais si quelque chose se passe mal, n'arrêtez pas tout le programme, arrêtez simplement ce que vous êtes en train d'exécuter et transmettez-le au plan B, qui est le bloc catch.
  echo riskyDivide(10, 0);
} catch (InvalidArgumentException $e) { //catch (InvalidArgumentException $e) { ... }
//Si une exception InvalidArgumentException se produit dans un bloc try, elle est interceptée par ce bloc catch.
//$e : Variable contenant l'objet d'erreur avec tous ses détails.
// Le code contenu dans ce bloc affiche un message d'avertissement [WARN] suivi du message spécifié lors de l'apparition de l'erreur ($e->getMessage()).
  echo "[WARN] " . $e->getMessage() . PHP_EOL;
} finally { //Le bloc finally contient du code qui s'exécute systématiquement, qu'une erreur se produise ou non et qu'elle soit détectée ou non.
//Ce bloc est généralement utilisé pour les tâches qui doivent être exécutées en toutes circonstances, comme la fermeture d'une connexion à une base de données ou la libération de ressources.
  echo "Toujours exécuté (libération de ressources, etc.)." . PHP_EOL;
}
