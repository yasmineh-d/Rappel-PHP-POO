<?php
declare(strict_types=1);

$nums = [1,2,3,4,5];

$squared = array_map(fn(int $n) => $n*$n, $nums);              // [1,4,9,16,25]
$even    = array_filter($nums, fn(int $n) => $n % 2 === 0);    // [2,4]
$total   = array_reduce($nums, fn(int $acc, int $n) => $acc + $n, 0); // 15

// Affichage
echo "Squared: ";
print_r($squared);

echo "Even: ";
print_r(array_values($even));  // reindex if needed

echo "Total: $total\n";