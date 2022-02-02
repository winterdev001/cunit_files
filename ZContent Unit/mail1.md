
## What is Mail?

## Goal.
- **Understand the movement of instance variables between Mail and views**.

## What is Mail?
The Mail is a class that allows you to send emails in Laravel. You can send mail by configuring it in the same way as controllers and views.
It is paired with [Swift Mailer](https://github.com/swiftmailer/swiftmailer "doc") which enables sendig emails.

This text describes the preparation for the email sending function and how Mail works.

## Prep.

### 1. Create a Laravel application

Run the following command to create a Laravel application.

```
$ laravel new mailApp
$ cd mailApp
``` 

### 2. Setup Testing File

Generate PhpUnit test file.

```
$ php artisan make:test MailerTest --unit
```


### 3. Configure the contents of the Laravel application

Run the following command to configure the contents of the Laravel application.

```
$ php artisan make:model user --all
$ php artisan migrate
```

### 4. Generate the Mail Class

Use the following command will create a new mailable class in app/Mail directory.

```
$ php artisan make:mail UserMailer
```

Now, the application is ready.

## Mail body configuration

Let's configure the mailer itself.
Mail are similar to Laravel controllers in that they use views to structure the contents of the mail.
Here is how we will add a method named `welcome` so that we can send emails to the email address passed by the caller.

[app/Mail/UserMailer.php].

```php
class UserMailer extends Mailable {
  
    public $user;
    
    public function __construct()
    {
        $this->user = $user;
    }
    public function build()
    {
        return $this->from('admin@gmail.com')
        ->to('test@example.com')
        ->subject('Registration complete')
                    ->view('UserMailer.welcome')
                    ->with(['name'=>$this->user->name]);
    }
} 
```

As in the controller case, all instance variables defined in the mailer method can be used in the view without modification.

## Caller

This time, we will use the controller side as the caller of the mail to send an email when the user registration is completed.
We will write the code to send an email in the process when the registration is completed in the `create` function.
Confirmation of the sending will be performed in the next text, so this text is limited to setting up the sending process.

[app/Http/Controllers/UsersController.php].

```php
# Omit
use App\Mail\UserMailer;
use Illuminate\Support\Facades\Mail;


class UsersController extends Controller
{
  protected function create(Request $request)
    {
        $user =  User::create([
            'name' => $request['name'],
            'email' => $request['email'],
        ]);

        Mail::to($request['email'])->send(new UserMailer($user));

        return $user;

    }
}

# omit
```
The `mail` method is the actual mail message.
Here, we pass the ``to header` and pass user's data to the view.

The next step is to set the `from` address, which will be the sender of the mail.
All mail body classes inherit from `config/mail.php`, so you can set the default `from` address and so on.

[config/mail.php].

```php
return [
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'admin@example.com'),
        'name' => env('MAIL_FROM_NAME', 'mailer'),
    ],
];
```

## Views
Creates a mail in `multipart/alternative` format if there are two types of templates, HTML and text.
Instance variables are passed from the mail itself.

[app/resources/views/Usermailer/welcome.blade.php].

```php
<p>{{$user['name']}}</p>.
<p>You have successfully registered.</p>
``` 
[app/resources/views/Usermailer/welcome.blade.php].

```php
{{$user['name']}}
User registration has been completed.
```

## Preview.
Let's start the server with `php artisan serve` and access it with the following URL to check the preview screen.

http://localhost:8000/Usermailer/welcome

! [](https://user-images.githubusercontent.com/24643743/91064431-35196500-e66a-11ea-8f5f-f0c550cb5102.png)

## Summary.
- **Laravel can use Mail class to send emails in the same way as controllers and views. **.


