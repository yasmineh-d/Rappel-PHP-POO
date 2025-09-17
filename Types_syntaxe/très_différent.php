<?php
$val = 0;

// coalescence nulle — ne bascule que si NULL ou non défini
$a = $val ?? 42;   // => 0

// opérateur ternaire raccourci (truthy/falsy)
$b = $val ?: 42;   // => 42 (car 0 est falsy)
echo $a; // affiche 0
echo "<br>";
echo $b; // affiche 42