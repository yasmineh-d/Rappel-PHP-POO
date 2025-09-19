<?php
declare(strict_types=1);

interface Logger {
  public function info(string $msg): void;
}

class StdoutLogger implements Logger {
  public function info(string $msg): void { echo "[INFO] $msg" . PHP_EOL; }
}

class NullLogger implements Logger {
  public function info(string $msg): void { /* no-op */ }
}

function run(Logger $logger): void {
  $logger->info("Démarrage…");
}

run(new StdoutLogger());  // respecte le contrat Logger
