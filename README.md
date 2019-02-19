# Laravel-setting
**Global key-value store in the database**

## Installation
You can install the package via composer:
```php
composer require archerzdip/laravel-settings
```
or
```php
// composer.json
"archerzdip/laravel-settings":"dev-master"
// composer update
composer update
```
### Publish, migrate
By running `php artisan vendor:publish --provider="ArcherZdip\Setting\SettingsServiceProvider"` in your project all files for this package will be published. For this package, it's only a migration. Run `php artisan migrate` to migrate the table. There will now be an options table in your database.

## Usage
**With the setting() helper, we can get and set settings:**
```php
// Get setting object
setting();

// Get setting value
setting('key','default');

// Set setting value
setting_set(string $key, $valve, $type = null, $description = null);

// Check the setting exists
setting_exists(string $key);

// Remove the setting value
setting_remove(string $key);

```

**If you want to check if an setting exists, you can use the facade:**

```php
use Setting;
$check = Setting::exists('someKey');
```

## Console
It is also possible to set setting within the console:
```php
php artisan setting:set {someKey} {someValue}
```
And it is also possible to get setting within the console:
```php
php artisan setting:get {someKey}
```

## Testing
```php
$ composer test
```
