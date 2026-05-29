# Laravel ERP

** ... **

## Features


## Installation

You can install the package via composer:

```bash
composer require smc-dev/smc-erp
```

- Laravel Version: 9.X
- PHP Version: 8.X

## Usage

### Class Diagram

## Docs

### Models
#### Organizations
- Organization
- OrganizationType
- OrganizationDivision
#### Routing
- Route
- RouteStop
- RouteLocationDeliveryFrequency
#### Shared
- Attachment
- Address
- Location
- Tag
- TaggedItem


### Publish Vendor Files (config, migrations, seeder)

```bash
php artisan vendor:publish --provider="ERP\Api\ERPServiceProvider"
```

If you are updating the package, you may need to run the above command to publish the vendor files. 

But please take a backup of the config file. 
Also run the migration command to add new columns to the existing tables.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email durgaharish5@gmail.com instead of using the issue tracker.

## Credits

- [Tory Chadwick](https://github.com/alexchadwick)
- [All Contributors](../../contributors)

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).