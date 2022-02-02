
# What is File Storage?

## Goal
-** Implement image upload function using File Storage **

## What is File Storage?
[File Storage] (https://laravel.com/docs/8.x/filesystem "doc") is a function for file upload.
You can easily implement file uploads to cloud storage services (SFTP, and Amazon S3,Google’s Cloud etc.).

This text describes the file upload function using images.

## Overview of File Storage

With Laravel the configuration file is located at `config/filesystems.php` . From this file configuration of any other filesystem 'disks' can be done. Each disk represents a particular storage driver and storage location.

In Laravel applications `local` driver interacts with files stored locally on the server running the Laravel application while the `s3` driver is used to write to Amazon's S3 cloud storage service.

### Local Driver
As defined in [File Storage] (https://laravel.com/docs/8.x/filesystem "doc") documentation, when using `local` driver all the operations are relative to the `root` directory defined in your `filesystems` configuration file. By default this value is set to the `storage/app` diectory. So the following method would be writen to `storage/app/example.txt` : 

```php
use Illuminate\Support\Facades\Storage;

Storage::disk('local')->put('example.txt', 'Contents');
```

### Public Disk

For the `public` Disk , it can be found in application's `filesystems` configuration file and it is fo the management of the files that are going to be publicly accessible. 
By default, the `public` disk uses the `local` driver and stores its files in `storage/app/public`.

To make all the stored files accessible  from the web a symbolic link from `public/storage` to storage/app/public must be created.

To create the symbolic link, you may use the `storage:link` Artisan command:

```
$ php artisan storage:link
```

### Specify upload destination
Laravel provides the support for Amazon S3 out of the box, but we have to install a dependency package with the help of the command below:

```
$ composer require league/flysystem-aws-s3-v3 ~1.0
```

The file upload destination is described in the following configuration file.

[config / filesystems.php]

```php
# omit

  'public' => [
      'driver' => 'local',
      'root' => storage_path('app/public'),
      'url' => env('APP_URL').'/storage',
      'visibility' => 'public',
  ],
  's3' => [
      'driver' => 's3',
      'key' => env('AWS_ACCESS_KEY_ID'),
      'secret' => env('AWS_SECRET_ACCESS_KEY'),
      'region' => env('AWS_DEFAULT_REGION'),
      'bucket' => env('AWS_BUCKET'),
      'url' => env('AWS_URL'),
      'endpoint' => env('AWS_ENDPOINT'),
      'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
  ],
# omit
```
Add the above enviornment variables in your `.env` file to use the Amazon S3 storage

`local` means that the file will be uploaded in the local environment and will be uploaded under the `app/public` directory.

### File resizing, gem for processing

[`Intervention Image`] (https://github.com/Intervention/image" doc ") is a library for converting files, which allows you to size and process images.

### About validation
File Storage does not have a validation function, but we can use the basic controller / model validation.

```php
  $validation = $request->validate([
        'photo' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048'
    ]);
    $file      = $validation['photo']; // get the validated file
```

### About deleting files
The `delete` method accepts a single filename or an array of files to delete:

```php
  use Illuminate\Support\Facades\Storage;

  Storage::delete('file.jpg');  
```

## Implement image upload function with File Storage

Now let's actually implement the image upload function using File Storage.

### 1. Laravel application creation

Run the following command to create a Laravel application.

```
$ laravel new active_storage_sample
$ cd active_storage_sample
```

### 2. Model Configuration and migration

Install Active Storage and perform the migration.

```
$ php artisan make:model user --all
$ php artisan make:model attachment -all
$ php artisan  migrate
$php artisan storage:link
```

### 3. Association

Associates so that one file can be attached to one record.
To do this, use the [`eloquent_relationships`] (https://laravel.com/docs/8.x/eloquent-relationships" doc ") .

[app / models / user.rb]

```php
#omit
  public function user()
  {
      return $this->hasOne(Attachment::class);
  }

```

As mentioned above, you can assign one file by using `hasOne(model_class)`.
Conversely, if you want to assign multiple files, use the [`eloquent_relationships`] (https://laravel.com/docs/8.x/eloquent-relationships" doc ").

Now you have an app to select and upload files.
Start the server with `php artisan serve`, access the following URL, and try uploading the file.

`http: // localhost: 8000 / users / new`

### 4. Confirmation of created data

The file created in step 3 is stored in the following location.

**Destination**

By default, it is supposed to be stored under the `storage/app` directory as described above.

example

```php
use Illuminate\Support\Facades\Storage;

$disk = Storage::build(['driver' => 'local','root' => '/path/to/root',]);
```

## Check the data registered in the database

Let's check how the uploaded file was saved in the laravels console.

```
$ php artisan tinker

User::first()
=> App\Models\User {#4513
     id: 1,
     name: "Dianna Baumbach Sr.",
     email: "pacocha.marina@example.org",
     email_verified_at: "2022-01-05 19:40:34",
     #password: "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
     #remember_token: "Ch8BKL7eby",
     attachment_id: 1,
     created_at: "2022-01-05 19:40:34",
     updated_at: "2022-01-05 19:40:34",
   }

Attachment::first()
=> App\Models\Attachment {#4514
     id: 1,
     image: "avatar.jpg",
     created_at: "2022-01-05 20:41:34",
     updated_at: "2022-01-05 20:41:34",
   }

```

The contents confirmed on the above console are summarized in a table format as follows.

[App/ Models/ User]

| Column name | Value |
|-|-|
| id | 1 |
| name | "Dianna Baumbach Sr." |
| email | "pacocha.marina@example.org" |
| email_verified_at | "2022-01-05 19:40:34" |
| password | ""$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi"" |
| remember_token | "Ch8BKL7eby" |
| attachment_id | 1 |
| create_at | "2022-01-05 19:40:34" |
| updated_at | "2022-01-05 19:40:34" |

[App/ Models/ Attachment]

| Column name | Value |
|-|-|
| id | 1 |
| image | "avatar.jpg" |
| create_at | "2022-01-05 20:41:34" |
| create_at | "2022-01-05 20:41:34" |

This section describes the contents of the `App/ Models/ User` association.
Since we used the `User` model this time, the following information is set in` App/ Models/ Attachment`.

| Column name | Value | Description |
|-|-|-|
| id | "User" | Model name is set |
| attachment_id | 1 | The id of the attachment table is set |

From the values ​​of `user id` and` attachment`, you can see that the information that the `id` of the` users` table is "1" is set.

## summary

** File Storage is a file upload function that can be uploaded to a cloud storage service. ** **