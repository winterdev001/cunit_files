
# Take advantage of Action Mailer

## Goal
-** Laravel will be able to implement sending and receiving emails **

## Send an email

Mail allows you to specify when to send an email (synchronous, asynchronous).

### synchronous sending
Send in sync. In other words, you will have to wait until the transmission is completed on the spot.

### delayed message queueing
Send asynchronously. In other words, you can specify the transmission timing.
For asynchronous transmission, Queueing Mail is used [Queueing Mail] (https://laravel.com/docs/8.x/mail#sending-mail).

example:
Send in 5 minutes
```
later(now()->addMinutes(5))
```

I will send it tomorrow
```
later(Carbon::tomorrow)
```

### Precautions when using later
The default setting up the queue driver is to utilize the laravel process thread pool to provide an asynchronous processing queue.
This means that restarting a lravel process will destroy the jobs in the queue.
If you want to make sure that emails are sent, you need to take measures such as making the database queue driver persistent with Redis and preventing undelivered emails and double-delivered emails.

## Mail settings

### Example of sending an email using SendGrid
[SendGrid] (https://sendgrid.com/) is one of the cloud mail sending services and is a mail delivery service used all over the world.
You don't have to build an SMTP server yourself, you can deliver emails just by creating an account on the Internet.

Since it can be used for free up to a certain amount, this time we will describe the implementation using SMTP of SendGrid. Of course, it is also possible to use SMTP other than SendGrid.

The `user_name` and `password` set when sending an email are confidential information, so save them in `.env`. file

```
# omit
MAIL_USERNAME =  sendgrid_user_name
MAIL_PASSWORD =  sendgrid_password

# omit
```

### Editing the configuration file

Add the code to each file.

[.env]

```php
# omit
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.sendgrid.com
  MAIL_PORT=587
  MAIL_USERNAME=apikey
  MAIL_PASSWORD=sendgrid_api_key
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS=admin.example.com
  MAIL_FROM_NAME="Admin"
}
```

[config / mail.php]

```php
'default' => env('MAIL_MAILER', 'smtp'),

```

In actual operation, sender domain authentication settings such as SPF and DKIM are required separately so that they are not treated as junk mail.

SPF (Sender Policy Framework) uses an IP address as authentication information.
Check if the sender is spoofed by comparing the source IP address published by the sender with the IP address of the actual source server.

DKIM (Domainkeys Identified Mail) authenticates using digital signatures.
You can eliminate malicious senders with digital signature authentication that allows you to check whether the email you received is "unaltered email sent by a legitimate sender".

### An example of sending an email using mailtrap

Mailtrap is a tool that allows you to check the contents of the email sent on your browser.
By setting `mailtrap` in the development environment, you can check whether the email has actually arrived.

The setting and confirmation method are as follows.

1. .env file configuration

Fill in your credentials in the` .env file ` and save.
Since `mailtrap` is used only in the development environment, it is defined to be applied only in the development environment by enclosing it in the `mail configurations` block from `.env file`.

[.env file]

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= //your username
MAIL_PASSWORD= // your password
MAIL_FROM_ADDRESS=admin@example.com
MAIL_FROM_NAME=admin
```

2. Set up routing

In the routes file `routes/web.php`, set the routing to send the mail  when accessing `/send-mail`.

[routes / web.php]

```php
# omit
Route::get('/send-mail', function () {

    Mail::to('newuser@example.com')->send(new UserMailer());

});
```

3. Send the email

After starting the server with `php artisan serve`, let's actually send an email and check if the email arrives in the email outbox.

Access the following URL and register as a user.
`http: // localhost:3000/users/new`

After registering as a user, login to your mailtrap account and check that the email has arrived.

## Support for i18n in the body of the email
Make the email title compatible with i18n.

In `config / app.php`, set the default locale to Japanese (`ja`).

[config / app.php]

```php
# omit
return[
    // Application Locale Configuration
    'locale'=>'ja',

    // Application Fallback Locale
    'fallback_locale'=>'ja'
];
```

Next, create a localization file to display Japanese and insert the process of replacing the subject of the email with the translated text.

The subject of the `mail` method is constructed in the form `key =>'value' `.

```php
'key' => 'value',
```

I will write it in a json file.

[resources / lang / ja.json]

```php
  'welcome'=>'Registration Completed'
```

The title of the email was able to correspond to i18n.
After starting the server with `php artisan serve`, let's actually send an email and check if "Registration completed" is displayed in the title of the email outbox from mailtrap.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ee8e8eafa9645d56b1887203e6f8b69d.png)] (https://diveintocode.gyazo.com/ee8e8eafa9645d56b1887203e6f8b69d)

## Mail test

In the Mail test, we want it to work in test mode without actually sending the email.

[test / Unit / MailerTest.php]

```php
namespace Tests\Unit;

class MailerTest extends TestCase
{
    //   UserMailer welcome method
    public function test_mail_is_added_to_the_outbound_queue(){
      Queue::fake();
      Queue::assertPushedOn('queue-name', MyTestMailer::class,1);
     }

    public funtion test_The_email_information_sent_is_as_intended(){
        Mail::fake();
        Mail::assertSent(MyTestMailer::class, function ($mail){
            $this->assertTrue($mail->hasTo('test@example.com'));
            $this->assertTrue($mail->hasFrom('admin@gmail.com'));
            $this->assertTrue($mail->hasSubject('Registration complete'));
        });     
    }
 }
```

Run the test with `php artisan test` to see if there are any errors.
Since the test code was written in `MailerTest.php` this time, RSpec execution is limited to` MailerTest.php`.

```
$ php artisan test tests/Unit/MailerTest.php

# omit

  Tests:  7 passed
  Time:   0.40s
```

I was able to confirm Mail in the test environment.
For more information on testing, see "[Laravel Testing Guide] (https://laravel.com/docs/8.x/mocking" doc ")" in the Laravel Doc.

## summary
-** Mail can send emails using an external service. ** **
-** Since the user name and password information of the external service is confidential information, be careful when handling it by saving it in .env file. ** **
-** Since the email is actually sent, it is necessary to confirm in the test mode in advance. ** **