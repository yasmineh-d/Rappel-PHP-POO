<?php
try {
  // ...
} catch (JsonException|InvalidArgumentException $e) {
  // traitement commun (ex. message + journalisation)
} catch (Exception $e) {
  // filet de sécurité pour autres exceptions
}
