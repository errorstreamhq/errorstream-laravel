# errorstream-laravel
Laravel integration with [Errorstream](https://www.errorstream.com/).

#Installation Instructions

First, run the following command on the terminal to download and install the package 
```text
composer require errorstream/errorstream-laravel 3.*
```

Next, register the service provider in the config/app.php file.
```php
'providers' => [
     // ...
     ErrorStream\ErrorStream\ErrorStreamServiceProvider::class,
]
```
Then add the Facade to the aliases array in the config/app.php file.
```php
'aliases' => [
    // ...
    'ErrorStream' => ErrorStream\ErrorStream\Facades\ErrorStream::class,
]
```

Then hook into the App/Exceptions/Handler.php file to send errors to our service.
```php
public function report(Exception $e)
{
     if ($this->shouldReport($e)) {
           ErrorStream::reportException($e);
     }
     parent::report($e);
}
```

Add the following two configuration entries into .env. You can find your API key and project token on the project settings page for the project you wish to integrate.
```bash
ERROR_STREAM_API_TOKEN=YOUR_API_TOKEN
ERROR_STREAM_PROJECT_TOKEN=YOUR_PROJECT_TOKEN
```

Finally, Add the errorstream config entries in your config/services.php
```php
'errorstream' => [
    'api_token'     => env('ERROR_STREAM_API_TOKEN'),
    'project_token' => env('ERROR_STREAM_PROJECT_TOKEN'),
],
```

#Tagging
Anywhere within your application you can append tags on to the reports that you generate and send to errorstream.com. Tags are great for grouping code together. You can make a call to add a tag anywhere by calling addTag(). A great place to do this would be to extend your Handler class modifications. For example:
```php
public function report(Exception $e)
{
     if ($this->shouldReport($e)) {
          ErrorStream::addTag('v1.0.2');
          ErrorStream::reportException($e);
     }
     parent::report($e);
}
```


#Adding Context
Sometimes you'll need additional information in order to diagnose issues. Context is great for adding more information to errors. Maybe you want to send a build number, user id, or anything else. You can use this in anywhere in your laravel application

```php
ErrorStream::addContext('some more details about variables that are set');
```
