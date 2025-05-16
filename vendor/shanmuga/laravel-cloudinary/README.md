# Cloudinary API Wrapper for Laravel 5,6 and 7.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shanmuga/cloudinary.svg?style=flat-square)](https://packagist.org/packages/shanmuga/laravel-cloudinary)
[![Build Status](https://img.shields.io/travis/shanmuga/cloudinary/master.svg?style=flat-square)](https://travis-ci.org/shanmuga/laravel-cloudinary)
[![Quality Score](https://img.shields.io/scrutinizer/g/shanmuga/cloudinary.svg?style=flat-square)](https://scrutinizer-ci.com/g/shanmuga/laravel-cloudinary)
[![Total Downloads](https://img.shields.io/packagist/dt/shanmuga/cloudinary.svg?style=flat-square)](https://packagist.org/packages/shanmuga/laravel-cloudinary)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

> *This Package is the fork of unmaintained package https://github.com/jrm2k6/cloudder*

## Installation

You can install the package via composer:

```bash
composer require shanmuga/laravel-cloudinary
```

## Configuration

Modify your `.env` file to add the following information from [Cloudinary](http://www.cloudinary.com)

### Required


```
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret_key
CLOUDINARY_CLOUD_NAME=your_cloud_name
```
### Optional

```
CLOUDINARY_BASE_URL
CLOUDINARY_SECURE_URL
CLOUDINARY_API_BASE_URL
```
Laravel 5.5+ uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.
If you don't use auto-discovery follow the next steps:

Add the following in config/app.php:

```php
'providers' => array(
  Shanmuga\LaravelCloudinary\CloudinaryServiceProvider::class,
);

'aliases' => array(
  'LaravelCloudinary' => Shanmuga\LaravelCloudinary\Facades\CloudinaryFacade::class,
);
```

Run `php artisan vendor:publish --tag="LaravelCloudinary"`

### Usage


## upload()

```php
LaravelCloudinary::upload($filename, $publicId, array $options, array $tags);
```

with:

* `$filename`: path to the image you want to upload
* `$publicId`: the id you want your picture to have on Cloudinary, leave it null to have Cloudinary generate a random id.
* `$options`: options for your uploaded image, check the [Cloudinary documentation](http://cloudinary.com/documentation/php_image_upload#all_upload_options) to know more
* `$tags`: tags for your image

returns the `CloudinaryWrapper`.

## uploadVideo()

```php
LaravelCloudinary::uploadVideo($filename, $publicId, array $options, array $tags);
```

with:

* `$filename`: path to the video you want to upload
* `$publicId`: the id you want your video to have on Cloudinary, leave it null to have Cloudinary generate a random id.
* `$options`: options for your uploaded video, check the Cloudinary documentation to know more
* `$tags`: tags for your image

returns the `CloudinaryWrapper`.

## getPublicId()

```php
LaravelCloudinary::getPublicId()
```

returns the `public id` of the last uploaded resource.

## getResult()

```php
LaravelCloudinary::getResult()
```

returns the result of the last uploaded resource.

## show() + secureShow()

```php
LaravelCloudinary::show($publicId, array $options)
LaravelCloudinary::secureShow($publicId, array $options)
```

with:

* `$publicId`: public id of the resource to display
* `$options`: options for your uploaded resource, check the Cloudinary documentation to know more

returns the `url` of the picture on Cloudinary (https url if secureShow is used).

## showPrivateUrl()

```php
LaravelCloudinary::showPrivateUrl($publicId, $format, array $options)
```

with:

* `$publicId`: public id of the resource to display
* `$format`: format of the resource your want to display ('png', 'jpg'...)
* `$options`: options for your uploaded resource, check the Cloudinary documentation to know more

returns the `private url` of the picture on Cloudinary, expiring by default after an hour.

## rename()

```php
LaravelCloudinary::rename($publicId, $toPublicId, array $options)
```

with:

* `$publicId`: publicId of the resource to rename
* `$toPublicId`: new public id of the resource
* `$options`: options for your uploaded resource, check the cloudinary documentation to know more

renames the original picture with the `$toPublicId` id parameter.

## destroyImage() + delete()

```php
LaravelCloudinary::destroyImage($publicId, array $options)
LaravelCloudinary::delete($publicId, array $options)
```

with:

* `$publicId`: publicId of the resource to remove
* `$options`: options for the image to delete, check the cloudinary documentation to know more

removes image from Cloudinary.

## destroyImages()

```php
LaravelCloudinary::destroyImages(array $publicIds, array $options)
```

with:

* `$publicIds`: array of ids, identifying the pictures to remove
* `$options`: options for the images to delete, check the cloudinary documentation to know more

removes images from Cloudinary.

## addTag()

```php
LaravelCloudinary::addTag($tag, $publicIds, array $options)
```

with:

* `$tag`: tag to apply
* `$publicIds`: images to apply tag to
* `$options`: options for your uploaded resource, check the cloudinary documentation to know more

## removeTag()

```php
LaravelCloudinary::removeTag($tag, $publicIds, array $options)
```

with:

* `$tag`: tag to remove
* `$publicIds`: images to remove tag from
* `$options`: options for your uploaded image, check the Cloudinary documentation to know more

## createArchive()

```php
LaravelCloudinary::createArchive(array $options, $archiveName, $mode)
```

with:

* `$options`: options for your archive, like name, tag/prefix/public ids to select images
* `$archiveName`: name you want to give to your archive
* `$mode`: 'create' or 'download' ('create' will create an archive and returns a JSON response with the properties of the archive, 'download' will return the zip file for download)

creates a zip file on Cloudinary.

## downloadArchiveUrl()

```php
LaravelCloudinary::downloadArchiveUrl(array $options, $archiveName)
```

with:

* `$options`: options for your archive, like name, tag/prefix/public ids to select images
* `$archiveName`: name you want to give to your archive

returns a `download url` for the newly created archive on Cloudinary.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email shanmugarajan.33@gmail.com instead of using the issue tracker.

## Credits

- [Shanmuga](https://github.com/shanmuga3)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
