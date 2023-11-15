# Inteliment - Filament OpenAI Assistant Integration

![Inteliment](https://user-images.githubusercontent.com/77644584/282675849-872f76c6-9247-4180-9af7-140fb9c53c33.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chrisreedio/inteliment.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/inteliment)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/inteliment/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/chrisreedio/inteliment/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/chrisreedio/inteliment/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/chrisreedio/inteliment/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/chrisreedio/inteliment.svg?style=flat-square)](https://packagist.org/packages/chrisreedio/inteliment)


Inteliment is a Filament plugin providing an interface for OpenAI's API within Laravel projects.

It offers straightforward tools to interact with AI services, facilitating the implementation of AI features like Assistants, text generation, or data analysis. 

## Installation

You can install the package via composer:

```bash
composer require chrisreedio/inteliment
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="inteliment-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="inteliment-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="inteliment-views"
```

This is the contents of the published config file:

```php
return [
];
```

### Panel Configuration

Include this plugin in your panel configuration:

```php
$panel
	->plugins([
		// ... Other Plugins
        \ChrisReedIO\Inteliment\IntelimentPlugin::make(),        
	])
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Chris Reed](https://github.com/chrisreedio)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
