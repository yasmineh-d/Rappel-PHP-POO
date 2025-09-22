<?php
declare(strict_types=1);

$path = 'storage/demo.txt';

$ok = @file_put_contents($path, "Bonjour\n", LOCK_EX);
if ($ok === false) { throw new RuntimeException("Écriture impossible: $path"); }

$txt = @file_get_contents($path);
if ($txt === false) { throw new RuntimeException("Lecture impossible: $path"); }

echo $txt; // Bonjour
