<?php

namespace TimOetting\LucidePhp;

class Lucide
{
  public static function icon(string $name, array $attributes = []): Icon
  {
    return new Icon($name, $attributes);
  }

  public static function __callStatic(string $name, array $arguments): Icon
  {
    $attributes = $arguments[0] ?? [];
    $iconName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $name));
    return new Icon($iconName, $attributes);
  }
}
