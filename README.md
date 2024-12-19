# Lucide PHP

A modern PHP package for integrating [Lucide icons](https://lucide.dev) into your PHP projects.

## Installation

You can install the package via composer:

```bash
composer require tim-oetting/lucide-php
```

## Requirements

- PHP 8.0 or higher

## Usage

### Basic Usage

```php
use TimOetting\LucidePhp\Lucide;

// Using the static icon method
echo Lucide::icon('github');

// Using magic method (alternative syntax)
echo Lucide::github();
```

### Customizing Icons

The package provides a fluent interface to customize your icons:

```php
// Add CSS classes
echo Lucide::github()->withClass('w-6 h-6 text-gray-500');

// Set custom size
echo Lucide::github()->withSize(24);

// Add custom attributes
echo Lucide::github()->withAttributes([
    'class' => 'icon',
    'stroke-width' => '1.5',
    'aria-hidden' => 'true'
]);

// Chain methods
echo Lucide::github()
    ->withSize(32)
    ->withClass('text-blue-500')
    ->withAttributes(['stroke-width' => '1.5']);
```

### Error Handling

The package will throw an `IconNotFoundException` if the requested icon doesn't exist:

```php
try {
    echo Lucide::nonexistentIcon();
} catch (TimOetting\LucidePhp\IconNotFoundException $e) {
    // Handle the error
}
```

## How It Works

The package loads SVG icons from the icons directory and allows you to manipulate them with various attributes. All icons are rendered as inline SVG, making them easy to style with CSS.

## Features

- 🚀 Simple and intuitive API
- ⚡️ Fluent interface for icon customization
- 🎨 Full support for custom attributes
- 🔒 Secure SVG rendering with proper HTML escaping
- 💪 Type-safe with PHP 8.0 features
- 🎯 Zero dependencies

## License

The MIT License (MIT). Please see the [License File](LICENSE.md) for more information.

## Credits

- [Tim Oetting](https://github.com/tim-oetting)
- [Lucide Icons](https://lucide.dev)
