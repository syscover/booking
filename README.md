# Booking for Laravel 5.2

[![Total Downloads](https://poser.pugx.org/syscover/booking/downloads)](https://packagist.org/packages/syscover/booking)

## Installation

**1 - After install Laravel framework, insert on file composer.json, inside require object this value**
```
"syscover/booking": "~1.0"
```

and execute on console:
```
composer install
```

**2 - Register service provider, on file config/app.php add to providers array**

```
Syscover\Booking\BookingServiceProvider::class,

```

**3 - execute on console:**
```
composer update
```

**4 - Optimized class loader**

```
php artisan optimize

```

**5 - Run seed database**

```
php artisan db:seed --class="BookingTableSeeder"
```