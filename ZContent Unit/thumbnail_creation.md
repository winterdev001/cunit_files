# Thumbnail creation and image display

## Goal
-** Display uploaded images **
-** Upload destination can be set **

## About creating thumbnails

So far, we have implemented image upload using the file upload function.
However, if it is left as it is, it is not immediately clear what kind of image the uploaded file looks like.
This text describes how to create and display thumbnail images so that you can see what the image looks like at a glance.

### Difference in thumbnail generation by file uploader

Thumbnail generation timing differs depending on the file uploader.

| File uploader name | Thumbnail generation timing |
|-|-|
| File Storage | powerful filesystem abstraction |
| Glide | image manipulation library with an HTTP based API |
| Intervention Image | simple to create, edit, and compose images |

## Create thumbnails using Intervention Image

[`Intervention Image`] (https://image.intervention.io/v2, "doc") provides an easier and expressive way to create, edit, and compose images and supports currently the two most common image processing libraries GD Library and Imagick.
 
    --Generates the URL without touching the filesystem.
    --Rendered thumbnails are stored and subsequent requests are directly served from your nginx/apache.
    --The URL is signed to prevent malicious parameters.

This time, I will introduce the procedure to use Intervention Image.

### 1. Install Intervention Image

Install Intervention Image.

```
$ composer require intervention/image
```

### 2. Enable Intervention Image

Find the providers in `config/ app.php` file and register the ImageServiceProvider like below

[config/ app.php]

```php
# omit

'providers' => [
        // ...
        'Intervention\Image\ImageServiceProvider',
    ]

# omit
```
Also locate the aliases in `config/ app.php` file and register the aliases

```php
# omit
'aliases' => [
        // ...
        'Image' => 'Intervention\Image\Facades\Image',
    ]
# omit
```
However if you want to use Imagick instead as by default Intervention Image use PHP'S GD library you can run the following artisan command 

```
$ php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
```

### 3. Specify the display size of the image

After the installation is complete, use `img tag` on the details screen to display the image.
The size of the image to be displayed can be resized using `resize()` method.
This time, we will describe to display an image with a vertical and horizontal size of 100px.

[app / Http / controllers / ImageController.php]

```php
#omit
  $thumbnailImage->resize(150,150);
#omit
```
[app/ views/ users/ show.blade.php]

```php
// Original image 
<img src="/images/{{$image->filename}}" />

// thumbnail
<img src="/thumbnail/{{$image->filename}}"  />

```



After completing the specification, access the details screen and check if the image is displayed.
Please enter the appropriate id in the "id value" of the following URL to access and check.

`http: // localhost: 8000 / users /" id value "/ show`

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/f27f98a08789166c854975db7bdc42bd.png)] (https://diveintocode.gyazo.com/f27f98a08789166c854975db7bdc42bd)

### The URL of the image is a browsing URL with an expiration date

The access path of the uploaded image has the following features.
--The URL that the user can see is the domain of the application server (in the case of Amazon S3 etc.)
--When a request arrives, laravel creates a time-limited URL for the file (expiration time is 5 minutes by default).
--Since the URL of the file changes every time, even if the URL is published on SNS etc., the damage can be reduced.

## packages that provides upload function

In addition to Active Storage, we will introduce a typical gem that has an upload function.

** [`Glide`] (https://glide.thephpleague.com/ "doc") **
  ――Adjust, resize and add effects to images using a simple HTTP based API..
  --Manipulated images are automatically cached and served with far-future expires headers.
  --Supports both the GD library and the Imagick PHP extension.
  -[Validation function available] (https://laravel.com/docs/8.x/validation#rule-image)

** [`Intervention Image`] (https://github.com/Intervention/image) **
  --it is possible to use the URL to manipulate images dynamically.
  --the manipulated version of the an image will be stored in the cache and will be loaded directly without resource-intensive GD operation.
  ――providing an easier and expressive way to create, edit, and compose images    
  -[Validation function available] (https://laravel.com/docs/8.x/validation#rule-image)

## summary
-** Use Intervention Image to process the file to be uploaded and create thumbnails. ** **