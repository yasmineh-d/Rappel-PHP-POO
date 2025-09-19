<?php
class ArticleId {
  public function __construct(public readonly int $value) {
    if ($value <= 0) throw new InvalidArgumentException("Id > 0 requis.");
  }
}

$id = new ArticleId(10);
// $id->value = 12; // ❌ Fatal Error: Cannot modify readonly property
