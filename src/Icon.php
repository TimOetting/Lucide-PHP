<?php

namespace TimOetting\LucidePhp;

class Icon
{
  private string $svg;
  private const DEFAULT_SIZE = 24;
  private bool $absoluteStrokeWidth = false;

  public function __construct(
    private string $name,
    private array $attributes = []
  ) {
    $this->loadSvg();
  }

  private function loadSvg(): void
  {
    $path = dirname(__DIR__) . "/icons/{$this->name}.svg";

    if (!file_exists($path)) {
      throw new IconNotFoundException("Icon '{$this->name}' not found");
    }

    $this->svg = file_get_contents($path);
  }

  public function withClass(string $class): self
  {
    $clone = clone $this;
    $clone->attributes['class'] = $class;
    return $clone;
  }

  public function withSize(int $size): self
  {
    $clone = clone $this;
    $clone->attributes['width'] = $size;
    $clone->attributes['height'] = $size;

    if ($clone->absoluteStrokeWidth) {
      $sizeRatio = self::DEFAULT_SIZE / $size;
      $clone->attributes['stroke-width'] = (string)($clone->attributes['stroke-width'] * $sizeRatio);
    }

    return $clone;
  }

  public function withAbsoluteStrokeWidth(bool $absolute = true): self
  {
    $clone = clone $this;
    $clone->absoluteStrokeWidth = $absolute;

    if ($absolute && isset($clone->attributes['width'])) {
      $size = (int)$clone->attributes['width'];
      $sizeRatio = self::DEFAULT_SIZE / $size;
      $clone->attributes['stroke-width'] = (string)($clone->attributes['stroke-width'] * $sizeRatio);
    }

    return $clone;
  }

  public function withAttributes(array $attributes): self
  {
    $clone = clone $this;
    $clone->attributes = array_merge($clone->attributes, $attributes);
    return $clone;
  }

  public function toHtml(): string
  {
    $svg = $this->svg;
    $dom = new \DOMDocument();
    $dom->loadXML($svg);
    $svgElement = $dom->getElementsByTagName('svg')->item(0);

    foreach ($this->attributes as $key => $value) {
      $svgElement->setAttribute($key, $value);
    }

    return $dom->saveXML($svgElement);
  }

  public function __toString(): string
  {
    return $this->toHtml();
  }
}
