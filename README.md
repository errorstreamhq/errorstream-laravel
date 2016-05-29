# errorstream-laravel
Laravel integration with [Errorstream](https://errorstream.com/).

#Installation Instructions

First, run the following command on the terminal to download and install the package 
```bash
composer require errorstream/errorstream-laravel 
```

Next, register the service provider in the config/app.php file.
```php
'providers' => [
     // ...
     ErrorStream\ErrorStream\ErrorStreamServiceProvider::class,
]
```

Then hook into the App/Exceptions/Handler.php file to send errors to our service.
```php
public function report(Exception $e)
{
     if ($this->shouldReport($e)) {
           app('errorstream')->reportException($e);
     }
     parent::report($e);
}
```

Finally, add the following two configuration entries into .env. You can find your API key and project token on the project settings page for the project you wish to integrate.
```bash
ERROR_STREAM_API_TOKEN=YOUR_API_TOKEN
ERROR_STREAM_PROJECT_TOKEN=YOUR_PROJECT_TOKEN
```
