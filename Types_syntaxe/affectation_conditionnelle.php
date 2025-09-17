<?php
$config = ['env' => 'local', 'per_page' => null];

$config['per_page'] ??= 10;  // devient 10 car la clé existe mais vaut null
$config['cache']    ??= false; // ajoutée car non définie

print_r($config);