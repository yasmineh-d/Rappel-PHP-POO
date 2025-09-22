<?php
// php tool.php -v --input=data.json --limit=5
$short = 'v';                         // -v (bool)
$long  = ['input:', 'limit::', 'help', 'dry-run']; 
// 'input:'   => valeur REQUISE
// 'limit::'  => valeur OPTIONNELLE
// booléens   => présents => true

$opts = getopt($short, $long);

$verbose = array_key_exists('v', $opts);
$input   = $opts['input']  ?? null;
$limit   = isset($opts['limit']) ? (int)$opts['limit'] : null;
$help    = array_key_exists('help', $opts);
$dryRun  = array_key_exists('dry-run', $opts);
