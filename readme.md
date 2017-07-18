# Laravision Uploader

[![Version](https://img.shields.io/packagist/v/laravision/uploader.svg)](https://packagist.org/packages/laravision/uploader)
[![License](https://poser.pugx.org/laravision/uploader/license.svg)](https://packagist.org/packages/laravision/uploader)
[![Total Downloads](https://img.shields.io/packagist/dt/laravision/uploader.svg)](https://packagist.org/packages/laravision/uploader)


This package expects that you are using Laravel 5.1 or above.

[![Laravision Uploader](https://s25.postimg.org/5zk44axb3/uploader.png))](https://github.com/laravision/Uploader)

## Install

In order to install Laravel 5 Laravision Uploader :

1) You will need to import the laravision/uploader package via composer:

```shell
composer require laravision/uploader
```
2) Add the service provider to your `config/app.php` file within the `providers` key:

```php
// ...
'providers' => [
    /*
     * Package Service Providers...
     */

    Laravision\Uploader\UploaderServiceProvider::class,
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
        'Uploader' => Laravision\Uploader\UploaderFacade::class,

    ],
// ...
```

## Usage

- Upload file named picture : 

```php
	public function store(Request $img){   
		//...
		
		$uploader = Uploader::run($img->file('picture')); 
		
		//...
	}
```



## License

Laravision Visiteur is free and open-sourced software distributed under the terms of the [MIT license](http://opensource.org/licenses/MIT).

## Note 

Please report any issue you find in the issues page.  
Pull requests are welcome.


