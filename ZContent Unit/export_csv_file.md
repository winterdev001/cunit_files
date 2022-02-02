#Export CSV file

## Goal
-** Implement CSV file export function **

## What is CSV?

CSV is an abbreviation of "Comma-Separated Values", and as the name implies, it is a data format structured by separating data with commas.

Excel, Google Spreadsheet, etc. are software that makes it easier to handle CSV format data.

Suppose you create a sheet in Google Sheets that manages book titles and authors.
In CSV, it is expressed as follows. The first line is the header line.

`` ```
title, author
book0, author1
book1, author2
`` ```

Many people touch CSV format data through Excel and Google spreadsheets, but CSV can also be handled programmatically.
Outputting CSV data is called exporting, and inputting (importing) CSV data with software such as a spreadsheet is called importing.

This text will allow you to export the CSV file.

## Advance preparation

First, create a Laravel application and complete the migration of the `Book` model.

```
$ laravel new csv_download_example
$ cd csv_download_example
$ php artisan make:model book --all
```
From your migration file located in `database/migration` add the title and author column before the migration like below:

```php
#omit
public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->timestamps();
        });
```

Migrate changes to for table `books` to the database

```
$ php artisan migrate
```

In this text, let's learn how to output book data as CSV.

### Create Book information
Create the information of `Book` to be output by` laravel console`.

First create factory data in which we will use to feed data into database

[Database/Factories/BookFactory.php]

```php
#omit
public function definition()
    {
        return [
            'title'=>$this->faker->title(),
            'author'=>$this->faker->name()
        ];
    }
```
Then run the following command to open laravel console and create book information

```
php artisan tinker
>>Book::factory()->count(3)->create()
exit
```
### We will use the CSV third party package so prepare it.
To generate CSV files we will use a popular package [Laravel-Excel plugin](https://github.com/SpartnerNL/Laravel-Excel). It provides am easy way to import and export excel files.

For installation we will use composer package manager:

```
composer require maatwebsite/excel  
```
And from your file `app.php` located at directory `config` add the following aliases and service provider

```php
#omit
'providers' => [  
    ....  
    Maatwebsite\Excel\ExcelServiceProvider::class,  
],  
'aliases' => [  
    ....  
    'Excel' => Maatwebsite\Excel\Facades\Excel::class,  
],  

```
Execute the vendor, publish command, and publish the config.

```
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### Add an implementation to generate CSV 
The [maatwebsite](https://docs.laravel-excel.com/3.1/exports/ "doc") module provides an essential method to construct an export class.

```
php artisan make:export BooksExport --model=Book
```
Your export file which created under `app/Exports/UsersExport.php` should look like :

```php
<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;

class BooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }
}

```

The above code `Book::all()` will return all records saved in table `books` through model `Book`.

## CSV file export function implementation
Next we will create a function to implement the real CSV file exporting under `app/Http/Controllers/BookController.php`.

[app/ Http/ Controllers/ BookController.php]

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Models\Book;
use App\Exports\BooksExport; //add the export file
use Maatwebsite\Excel\Facades\Excel; //add excel export facades


class BookController extends Controller 
{
    ....

    public function export() 
    {
        return Excel::download(new BooksExport, 'books.csv');
    }

    ....
}
```
The following two points are required.
1. Implementation of routing and functions for CSV download
2. Write a download link in the view to make it easier for users to download

### Implementation of routing and functionality for CSV downloads
Implement the route from which `books.csv` will be accessed.

[routes / web.php]

```php
#omit
Route::get('file-export', [BookController::class, 'export'])->name('file-export');
```

After implementing so far, you can download CSV data by accessing `http: //localhost:8000/file-export`.

`Laravel-Excel plugin` will automatically set `Content-Type` of the response when downloading CSV to` Content-Type' => 'text/csv`.
Let's check with Chrome's verification tool.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3e3d286e8207ddd5a60166289d1ee3ee.png)] (https://diveintocode.gyazo.com/3e3d286e8207ddd5a60166289d1ee3ee)

### Write a download link in the view
Add a download link to the index page to make it easier for users to download.

[resources / views / books / index.blade.php]

```php
<a class="btn btn-success" href="{{ route('file-export') }}">download</a>
```

Now you can get the CSV file just by clicking the download link.

## summary
-** CSV data is a format that represents the structure of the data separated by commas. ** **
-** In order to handle CSV data with Laravel, we can rely on third party library such as [maatwebsite](https://docs.laravel-excel.com/3.1/exports/ "doc"). ** **