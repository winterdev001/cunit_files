#Multi-functional implementation

## Issue recommended version
** When submitting an assignment, please submit it in the following version. ** **
```
PHP 8.1.1
Laravel 8.0
```

## Purpose of various function addition series assignments

Series assignments are for determining if you have achieved the goals of the series.

** Goal of various function addition series **
--The following functions can be additionally implemented in the application.
  --Email sending / receiving function by Mailer
  --File upload function by File Storage
  --Asynchronous processing function by Laravel Queues

## Advance preparation

Clone the application for the issue from the [Issue Repository] (https://github.com/diveintocode-corp/cdp_web_rails_functions_task) and execute the following command.
```
$ composer install
$ npm install or yarn  //use either npm or yarn depending on which package manager you're using
$ copy .env.example .env
$ php artisan key:generate
$ php artisan migrate
$php artisan serve
```

Please access [http: // localhost: 8000 / users / create] and confirm that the user registration screen is displayed.

## Problem

Only the login function is implemented in this application.
Follow steps 1 to 3 below to add the function.

### Procedure list

** 1. Add a function so that profile images can also be registered when registering as a user (implementation of File Strage) **

  [! [Image from Gyazo] (https://i.gyazo.com/73d9d09dd40857bfc731decfcb4d8137.png)] (https://gyazo.com/73d9d09dd40857bfc731decfcb4d8137)

  --Use `profile_image` as the column name used to associate with the image.
  --After registering as a user without selecting a profile image, move to the user details screen without causing an error.
  --On the user details screen, display the profile image (there is no specification regarding the image size to be displayed).


** 2. When registering as a user, send an email to that user (implementation of Mail) **

  --Set the `env` file with `mailtrap` so that you can confirm receipt of mail.
  --Specify `admin@example.com` as the sender.
  --Display "Registration completed" in the title of the email.
  --As shown below, display "Registration completed" on the Subject, and display the text "User registrant name +" and "User registration completed." In the text.

  [! [Image from Gyazo] (https://i.gyazo.com/c9a1bc51ab618fdf001e49044485e7bf.png)] (https://gyazo.com/c9a1bc51ab618fdf001e49044485e7bf)

** 3. Send emails asynchronously (implementation of Laravel Queues) **

  --Use `Laravel Horizon`.
  --Sending an email using the `delay` method.

## Pass requirements

1. You are using File Strage
2. `profile_image` is used in the column name used for the association
3. When you select a profile image and register as a user, you will be taken to the details screen and the profile image will be displayed.
4. When registering as a user without selecting a profile image, transition to the details screen without causing an error.
5. When you register as a user, use Mail to send an email to that user.
6. The email has been sent with the content specified in step 2 (only the HTML template is required).
7. Implement Laravel Queues and send mail asynchronously using `delay` method
8. The mail reception confirmation function using `mailtrap` is implemented.
9. Asynchronous processing using `Laravel Horizon` is implemented

## Submission method

Please submit the URL of the repository from the [Submission page] (https://diver.diveintocode.jp/submissions/new).