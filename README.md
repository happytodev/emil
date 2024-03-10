# Emil is a static site generator based on Laravel.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/happytodev/emil.svg?style=flat-square)](https://packagist.org/packages/happytodev/emil)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/happytodev/emil/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/happytodev/emil/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/happytodev/emil/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/happytodev/emil/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/happytodev/emil.svg?style=flat-square)](https://packagist.org/packages/happytodev/emil)

Emil is a static site generator made with Laravel. Use simply markdown files, Blade templating, TailwindCss to build your website.

## Support us

You can support Emil by [sponsoring it](https://github.com/sponsors/happytodev).


## Installation

### Prerequisites

Emil needs a fresh Laravel installation : 

```bash
laravel new youramazingwebsite
```

You can install the package via composer:

```bash
composer require happytodev/emil
```

Launch the install : 


```bash
php artisan emil:install
```

```bash
npm install && npm run dev
```

## Usage

You can build you content in the `content` folder.

You can modify the appearence of your website by modifying `resources/views` folder.

## Generate static content

Use this command : 

```bash
php artisan emil:generate
```

## Emil development server

You can see your modification in live by using the integrate Emil server.

```bash
php artisan emil:serve
```

In the background, Emil launch Browser-Sync and watches all files in `content` and `resources/views` folders.

On every detected change, it generates in `_html` folder : 
- css/main.css file
- all html files

and of course, refresh the view in the browser.


## Deployment

When your are satisfied, just push the content of `_html` folder on your server and voilà !


## Testing

To be documented

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Frédéric Blanc](https://github.com/happytodev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
