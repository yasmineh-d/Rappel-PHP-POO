<?php
class Base {
  public static function who(): string { return 'Base'; }
  public static function make(): static { return new static(); } // LSB
  public function type(): string { return static::who(); }       // LSB
}

class Child extends Base {
  public static function who(): string { return 'Child'; }
}

echo (new Child())->type();            // "Child"
var_dump(Child::make() instanceof Child); // true
