# This is my package laravel-credithub
## under development

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ivanaquino/laravel-credithub.svg?style=flat-square)](https://packagist.org/packages/ivanaquino/laravel-credithub)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ivanaquino/laravel-credithub/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ivanaquino/laravel-credithub/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ivanaquino/laravel-credithub/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ivanaquino/laravel-credithub/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ivanaquino/laravel-credithub.svg?style=flat-square)](https://packagist.org/packages/ivanaquino/laravel-credithub)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-credithub.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-credithub)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require ivanaquino/laravel-credithub
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="credithub-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="credithub-config"
```

This is the contents of the published config file:

```php
return [
    'type_field' => 'string',
];
```

## Usage

You have to implement HasCredits contract in your model and use CreditTransactional trait.

```php
// ...
use IvanAquino\LaravelCredithub\Contracts\HasCredits;
use IvanAquino\LaravelCredithub\Traits\CreditTransactional;

class User extends Model implements HasCredits
{
    use CreditTransactional;
}
// ...
```

Now you can use the following methods:

```php
$user = User::find(1);
# Add credits
$user->addCredits(100);
$user->addCredits(100, 'Bonus');
$user->addCredits(100, 'Bonus', ['my_custom_field' => 'my_custom_value']);
# Subtract credits
$user->subtractCredits(100);
$user->subtractCredits(100, 'Withdraw');
$user->subtractCredits(100, 'Withdraw', ['my_custom_field' => 'my_custom_value']);
# Transfer credits
$user->transferCreditsTo(100, $anotherUser);
$user->transferCreditsTo(100, $anotherUser, 'Transfer');
$user->transferCreditsTo(100, $anotherUser, 'Transfer', ['my_custom_field' => 'my_custom_value']);

# Get credits
$user->credit_balance; // integer
$user->has_credits; // true or false
```

You can cast type field of CreditTransaction model to whatever type you want, example:

```php
return [
    'type_field' => \App\Enums\CreditTransactionType::class,
];
```

```php
use \App\Enums\CreditTransactionType;

$user = User::find(1);
# Add credits
$user->addCredits(100, CreditTransactionType::BONUS);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ivan Aquino](https://github.com/IvanAquino)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
