# Laravision visiteur system

[![Version](https://img.shields.io/packagist/v/laravision/visiteur.svg)](https://packagist.org/packages/laravision/visiteur)
[![License](https://poser.pugx.org/laravision/visiteur/license.svg)](https://packagist.org/packages/laravision/visiteur)
[![Total Downloads](https://img.shields.io/packagist/dt/laravision/visiteur.svg)](https://packagist.org/packages/laravision/visiteur)


This package expects that you are using Laravel 5.1 or above.

[![Laravision Crud](https://s25.postimg.org/tn2hf59r3/visiteur.png)](https://github.com/laravision/crud/)

## Install

In order to install Laravel 5 Laravision Visiteur :

1) You will need to import the laravision/visiteur package via composer:

```shell
composer require laravision/visiteur
```
2) Add the service provider to your `config/app.php` file within the `providers` key:

```php
// ...
'providers' => [
    /*
     * Package Service Providers...
     */

    Laravision\Crud\VisiteurServiceProvider::class,
],
// ...
```
3) Add the aliases to your `config/app.php` file within the `aliases` key:

```php
// ...  

'aliases' => [ 

    /*
     * Package Class Aliases...
     */
        'Visiteur' => Laravision\Visiteur\VisiteurFacade::class,

    ],
// ...
```

## Usage

- Run the script in your middleware : 

```php
Visiteur::run();
```



## License

Laravision Visiteur is free and open-sourced software distributed under the terms of the [MIT license](http://opensource.org/licenses/MIT).

## Note 

Please report any issue you find in the issues page.  
Pull requests are welcome.


