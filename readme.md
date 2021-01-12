# ApartmentModule

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Create Apartments

## Installation

Via Composer

``` bash
$ composer require zdrojowa/apartment-module
```

## Usage

- Add module ApartmentModule in config/selene.php

``` bash
'modules' => [
    ApartmentModule::class,
],

'menu-order' => [
    'ApartmentModule',
],

'crm-apartment' => [
    'url' => url,
    'building' => building's number
],
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/zdrojowa/apartment-module.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zdrojowa/apartment-module.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zdrojowa/apartment-module/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/zdrojowa/apartment-module
[link-downloads]: https://packagist.org/packages/zdrojowa/apartment-module
[link-travis]: https://travis-ci.org/zdrojowa/apartment-module
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/zdrojowa
[link-contributors]: ../../contributors
