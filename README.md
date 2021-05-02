# A Laravel package to easily truncate database tables when running seeder files

[![Latest Version on Packagist](https://img.shields.io/packagist/v/io-digital/truncate-tables.svg?style=flat-square)](https://packagist.org/packages/io-digital/truncate-tables)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/io-digital/truncate-tables/run-tests?label=tests)](https://github.com/io-digital/truncate-tables/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/io-digital/truncate-tables/Check%20&%20fix%20styling?label=code%20style)](https://github.com/io-digital/truncate-tables/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/io-digital/truncate-tables.svg?style=flat-square)](https://packagist.org/packages/io-digital/truncate-tables)

## Installation

You can install the package via composer:

```bash
composer require io-digital/truncate-tables
```

## Usage

Inside of the `run()` function in `database/seeders/DatabaseSeeder.php`, the following can be added to the run function:

```php
use IoDigital\TruncateTable\TruncateTable;

TruncateTable::fromArrays([
'users',
'posts'
])->clean();

// or to add seeders as well

TruncateTable::fromArrays([
'users',
'posts',
], [
UserTableSeeder::class,
PostTableSeeder::class,
])->cleanAndSeed();

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Credits

- [Gareth Nicholson](https://github.com/io-digital)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
