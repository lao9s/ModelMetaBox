# Laravel EloquentModel Meta Box

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]

Add additional columns (meta boxes) to EloquentModel without add columns to the migration file

## Installation

Via Composer

``` bash
$ composer require lao9s/modelmetabox
```

## Usage

Use the ModelMetaBox trait on the model you intend to track

    use lao9s\ModelMetaBox\Traits\ModelMetaBoxTrait;
    
    class Article extends Model
    {
        use ModelMetaBoxTrait;
    
        ...
    }

Publish config file.
    
    php artisan vendor:publish --tag=ModelMetaBoxConfig
    
Migrate

    php artisan migrate    
    
Change config file:

       // Override the delete method in the model to delete meta boxes before the model is deleted.
       'override_the_delete_method' => true,

Here are some code examples:

    // Add/Update meta box to the article
    $article->addMetaBox('author', 'Dima Botezatu');
    
    // Support array data. Object or array data will be automatically converted to json. 
    // If you have another type of data, you can manually convert it into json by adding the third true parameter
    $article->addMetaBox('images', ['image1.jpg', 'image2.jpg', 'image3.jpg']);
    
    // Get meta box by specific key. $withValue parameter will return only value not the model object
    $article->getMetaBox('author', $withValue = false)
    
    // Also the meta box model have any methods: getValue, getKey or isJson
    // Working only if you get metabox object model
    $author = $article->getMetaBox('author')
    $author->getValue();
    $author->getKey();
    $author->isJson();
    
    // Get all meta boxes. $withValue parameter will return only values not the models object
    $article->getAllMetaBoxes($withValue = false)
    
    // Remove meta box
    $article->removeMetaBox('author');
    
    // Remove all meta boxes
    $article->removeAllMetaBoxes();
    
## Credits

- [Dima Botezatu][link-author]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lao9s/modelmetabox.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lao9s/modelmetabox.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/lao9s/modelmetabox/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/lao9s/modelmetabox
[link-downloads]: https://packagist.org/packages/lao9s/modelmetabox
[link-travis]: https://travis-ci.org/lao9s/modelmetabox
[link-author]: https://github.com/lao9s
