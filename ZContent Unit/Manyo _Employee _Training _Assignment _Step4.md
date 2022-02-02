

# Manyo Employee Training Assignment Step 4

## Handling of this assignment
This assignment has been used as a DIVE INTO CODE assignment with official permission from [Manyo Corporation](https://everyleaf.com/). The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

## About the license

The copyright is as follows (although this constitutes commercial use in violation of the license, in our case we have obtained individual permission from Manyo Corporation, so we can use it as an assignment).

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)](https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)

[https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja](https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja)

URL of the original GitHub: [everyleaf/el-training](https://github.com/everyleaf/el-training)

## Before working on Step 4

Before tackling Step 4, make sure to check the following items: 1.

Make sure you have merged the pull request you created in step 3 into your `master` branch. 2.
Have you run the `git pull origin master` command on your local `master` branch to import the changes from the remote repository into your local repository? 3.
Created and moved a new `step4` branch from your local `master` branch.

## The contents of step 4

In Step 4, you will be working on the following tasks: 1.

1. implement the login and logout functions
2. associate a user with a task
4. implement the administrator function
Add test items 5.
Modify initial data 6.
7. Herokuに変更内容を反映する

## ログイン・ログアウト機能を実装する

以下の要件を満たすようログイン・ログアウト機能を実装してください。

### 開発要件
1. ユーザのテーブル名は`users`とすること
1. 以下の要件を満たす`users`テーブルを作成すること

    |カラムの意味|カラム名|データ型|データベースの制約|
    |--|--|--|--|
    |名前|name|string|・NotNull制約|
    |メールアドレス|email|string|・NotNull制約<br>・ユニーク制約|
    |パスワード|password_digest|string|・NotNull制約|
    |管理者権限|admin|boolean|・NotNull制約|

1. タスクとの関連付けで使用する`user_id`に対してインデックスを貼ること

### 画面遷移要件

- 以下の画面遷移図通りに遷移させること

    [! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/c2c1b24728e1bb93f40c97ac0a6cbec7.png)](https://diveintocode.gyazo.com/c2c1b24728e1bb93f40c97ac0a6cbec7)

- 以下の通りにパスのプレフィックスが生成されていること

    |プレフィックス|アクセス先|
    |--|--|
    |new_session|ログイン画面|
    |new_user|アカウント登録画面|
    |user|アカウント詳細画面|
    |edit_user|アカウント編集画面|

### 画面設計要件

**グローバルナビゲーション**

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/b1a6cc4b2f4e37ab338a5a530155f00c.png)](https://diveintocode.gyazo.com/b1a6cc4b2f4e37ab338a5a530155f00c)

- Using the above as a reference, create a global navigation that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||--
    |link to the account registration screen|account registration|sign-up|
    |link to the login screen|login|sign-in|
    |link to account details screen|account details|my-account|
    |link to logout|logout|sign-out|

**Account Registration Screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/7c883a3d6bccb1849976c2272fe4441a.png)](https://diveintocode.gyazo.com/7c883a3d6bccb1849976c2272fe4441a)

- Using the above as a reference, create an account registration screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--|||--
    |title of the screen|account registration page||
    |name form label|name|||
    |email form label|email address|||
    |password form label|password|||
    |confirmation password form label|password (confirmation)||
    |Register Account button|Register|create-user|

**Account edit screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/0e7941db9a2cde7e1a16a9cb425138ec.png)](https://diveintocode.gyazo.com/0e7941db9a2cde7e1a16a9cb425138ec)

- Using the above as a reference, create an account editing screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||--
    |title of the screen|account editing page||
    |name form label|name|||
    |email form label|email address|||
    |password form label|password|||
    |confirmation password form label|password (confirmation)||
    |Update account button|Update account|update-user||
    |Link to return to list screen|back|back|

**Account details screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/1fe278efbad4909b1e66a95adc8453e4.png)](https://diveintocode.gyazo.com/1fe278efbad4909b1e66a95adc8453e4)

- Using the above as a reference, create an account detail screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||--
    |title of the screen|account detail page||
    |Name field|Name|||
    |mail address field|mail address|||
    |link to the account edit page|edit-user||
    |Link to return to list screen|back|back|

**Login screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/6c399047b218e97ce645a714a2d56ce2.png)](https://diveintocode.gyazo.com/6c399047b218e97ce645a714a2d56ce2)

- Using the above as a reference, create a login screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||--
    |title of the screen|login page||
    |mail address form label|mail address|||
    |password form label|password||
    |button to login|login|create-session|

### Functional Requirements

1. to display validation message when validation fails in account registration or editing, as per the following conditions.

    |condition|validation message to be displayed|
    |--|||.
    |If name is not entered, please enter a name||--|
    |if email address is not entered|please enter email address|
    |if email address is already in use|email address is already in use|
    |If your password is less than 6 characters, please enter your password.
    |If your password is less than 6 characters long|Please enter a password with at least 6 characters long|
    |Password and password (confirmation) do not match|Password (confirmation) and password entry do not match| 1.

1. flash message to be displayed as per the following conditions

    |conditions|flash message to be displayed|
    |--||.
    |Successful account registration|Account has been registered|
    |Succeeded in updating the account|Updated the account|
    |If login succeeded|Logged in|.
    |If login failed|Your email address or password is incorrect|
    |Logged out|Logged out| 1.

1. if you access any screen other than the login screen and account registration screen without logging in, you will be redirected to the login page and a flash message "Please log in" will be displayed
If a user accesses the Login screen or the Account Registration screen while logged in, the user will be redirected to the Task List screen and will receive a flash message saying 'Please log out.
If a user tries to access another user's Task Details screen or Task Edit screen, the user will be redirected to the Task List screen and will receive a flash message stating that the user does not have permission to access the screen. 6.
Add a setting to make email addresses case-insensitive. 2.
When deleting a user, all Tasks associated with that user should be deleted. 3.
To allow users and tasks to form an association so that only tasks created by the user are displayed in the task list.

### Hints for Implementing the Login and Logout Functions 1
For implementing the login and logout functions, refer to the text from [Login System 1 [About Creating Applications for Login System]](https://diver.diveintocode.jp/curriculums/483) to [Login System 13 [About Logout]]( https://diver.diveintocode.jp/curriculums/495), refer to the following texts.

### Hints for Implementing Login and Logout Functions 2
For information on how to determine whether a user is logged in or not, refer to [Login System 11 [About User Login by Temporary Session]](https://diver.diveintocode.jp/curriculums/493).

### Tips for Implementing Login and Logout Functions3
For more information on how to implement the login/logout function, please refer to [Login System 11 [About User Login by Temporary Session]](https://diver.diveintocode.jp/curriculums/493).

### Hint to show only tasks created by you.

If you want to show only the tasks you created, get the tasks of the user who is logged in using an association like `auth()->user->tasks` instead of `Task->all()`.

## Implement the administrator function

Next, let's implement the administrator function.
In this application, the administrator function is a function that allows a user with administrator privileges to CRUD all users including himself.
Please implement the administrator function to meet the following requirements.

### Development Requirements

- Do not use any framework or `adminArchitect` framework the admin screen.

### Screen transition requirements.

- Create 4 new screens and make them transition according to the following screen transition diagram.

    [! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/929f58b19e04396f87f139152f0c98cb.png)](https://diveintocode.gyazo.com/929f58b19e04396f87f139152f0c98cb)

- The path prefix should be generated as follows (hints on how to prefix the path with `admin` are given below)

    |prefix|access|
    |--|--|
    |admin_users|user list screen|
    |new_admin_user|User Registration Screen|
    |admin_user|user details screen|
    |edit_admin_user|user edit screen|

### Screen Design Requirements

**Global navigation**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/ffe012c27d913cfc511ac16da279297b.png)](https://diveintocode.gyazo.com/ffe012c27d913cfc511ac16da279297b)

- Using the above as a reference, create a global navigation that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||--
    |link to the user list screen|user list|users-index|
    |link to add a user|add-user|
    |link to account registration screen|register account|sign-up|
    |Link to login screen|login|sign-in|
    |link to account details screen|account details|my-account|
    |link to logout|logout|sign-out|

**User list screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/6c3be8ecaf9c7880de8bd8109c39c2bd.png)](https://diveintocode.gyazo.com/6c3be8ecaf9c7880de8bd8109c39c2bd)

1. referring to the above, create a user list screen that meets the following requirements.

    |target|characters to be displayed|class attribute of HTML to be given to the target|.
    |--|--||||||||| screen title
    |title of the screen|User List Page||.
    |Table Header|Name, Email Address, Admin Rights, Number of Tasks||
    |link to user detail screen|detail|show-user|||
    |link to edit user screen|edit-user||
    |link to user edit screen|edit-user| |link to delete user|delete|destroy-user| 2.

2. to display the number of tasks created by each user
If a user has administrative privileges, the screen should show "Yes"; if not, the screen should show "No".

**User Registration Screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/2fad6fa7a6c40d9bbefb08999c54f900.png)](https://diveintocode.gyazo.com/2fad6fa7a6c40d9bbefb08999c54f900)

- Using the above as a reference, create a user registration screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--|||||||||||||||||||||||||||||||||
    |Title of the screen|User Registration Page||
    |name form label|name|||
    |email form label|email address|||
    |password form label|password|||
    |confirmation password form label|password (confirmation)||
    |Administrative Privileges checkbox label|Administrative Privileges||
    |Register User button|Register|create-user|
    |back link to user list screen|back|back|

**User detail screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/5f8f16b76492880d38320d8788c2165a.png)](https://diveintocode.gyazo.com/5f8f16b76492880d38320d8788c2165a)

1. refer to the above and create a user list screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--||||||||||||||||||||||||||||||||||
    |Screen title|User details page||
    |Name field|Name|||
    |mail address field|mail address|||
    |Administrative Privileges item|Administrative Privileges||
    |Table Header|Title, Content, Creation Date, End Date, Priority, Status||
    |Link back to User List screen|back|| 1.

If the user has administrative privileges, "Yes" should be displayed; if not, "No" should be displayed. 2.
2. display a list of Tasks created by users with their titles, contents, creation date/time, due date/time, priority, and status.

**User Edit Screen**.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/f82fef8211a550491db57e585cc37575.png)](https://diveintocode.gyazo.com/f82fef8211a550491db57e585cc37575)

- Using the above as a reference, create a user edit screen that meets the following requirements

    |target|characters to be displayed|id attribute of HTML to be given to the target|.
    |--|--|||||||||||||||||||||||||||||
    |Title of the screen|User edit page||
    |name form label|name|||
    |email form label|email address|||
    |password form label|password|||
    |confirmation password form label|password (confirmation)||
    |Administrative Rights checkbox label|Administrative Rights|||
    |Update user button|Update user|update-user||
    |back link to user list screen|back||.

### Functional Requirements 1.

1. to display validation message when validation fails in user registration or editing, as per the following conditions.

    |condition|validation message to be displayed|
    |--|||.
    |If name is not entered, please enter a name||--||
    |if email address is not entered|please enter email address|
    |if email address is already in use|email address is already in use|
    |If your password is less than 6 characters, please enter your password.
    |Password is less than 6 characters long|Please enter a password with at least 6 characters long|
    |Password does not match|Password (Confirmation) and password entry do not match| 1.

1. flash message to be displayed as per the following conditions

    |conditions|flash message to be displayed|
    |--||.
    |Succeeded in registering a user|Registered a user|
    |Succeeded in updating user|Updated user|
    |If user was deleted|User was deleted| 1.

When a user clicks on a link to delete a user, the confirmation dialog should say "Are you sure you want to delete the user? in the confirmation dialog when clicking a link to delete a user. 1.
User registration screen and edit screen should be able to add/remove administrative privileges. 1.
When a general user accesses the administration screen (any of the four newly created screens), the user will be redirected to the task list screen and an error message stating "Only administrator can access" will be displayed. 1.
If there is only one administrator and the user tries to delete the user, the model callback will be used to control the deletion and display the **error message** "Cannot delete because there are zero administrators.
If there is only one administrator and you try to update the user to remove the administrator privileges, use the model's callback to control the update and display the **error message** "Cannot change privileges because there are zero administrators.

### Hints for Implementing the Admin Feature 1

You can handle the routing for administrators and general users separately by prefixing the URL of the admin screen with `/admin` and generating the following routing.

- `/users/new` (registration screen for general users)
- `/admin/users/new` (registration page for administrators)

In order to branch the routing in this way, let's use the `namespace` mechanism to configure the routing.
For example, suppose you define a route using `namespace` as shown below.

```php
    Route::resource('users',UsersController::class);
    Route::namespace('Admin')->group(function () {
        // Controllers Within The "App\Http\Controllers\Admin" Namespace
        Route::resource('users',UsersController::class);
    });
```

Then the following routing will be generated.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/529f68aa210ccfe97635df193a7e1fb0.png)](https://diveintocode.gyazo.com/529f68aa210ccfe97635df193a7e1fb0)

This makes it possible to branch the routing such that when `/users/new` is accessed, the user will be redirected to the registration screen for general users, and when `admin/users/new` is accessed, the user will be redirected to the registration screen for administrators.

### Hints for implementing administrator functions 2

If you set up routing using `namespace`, you need to make the directory structure of controllers and views adapted to this routing.
You can create a controller that adapts to the `admin/users` routing by running the following command.

```
$ php artisan make:controller admin/UsersController
```
 $ php artisan make:controller admin/UsersController
This will create a controller with the following directory structure and the class name `UsersController.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/c2c81474b6c5db471c3e50f7935a65c2.png)](https://diveintocode.gyazo.com/c2c81474b6c5db471c3e50f7935a65c2)


[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/33e65c4eaae35c1f1487c9c7dd758e04.png)](https://diveintocode.gyazo.com/33e65c4eaae35c1f1487c9c7dd758e04)

As a result, when the routing `admin/users` is accessed, the controller for `admin/users` will be called and the views under `admin/users` will be displayed.

### Hints for implementing a feature that allows only admin users to access the admin panel.

Define a method using `Auth::user()->isAdmin()`. This will allow you to determine whether the logged in user is an administrator or not, since `true` will be returned if the logged in user is an administrator and `false` if the logged in user is a regular user.

### Hints about callbacks

You can read more about callbacks in the text of [Callbacks 1 [An overview of callbacks]](https://diver.diveintocode.jp/curriculums/637) and in the Rails guide [Active Record callbacks](https:// railsguides.jp/active_record_callbacks.html).
You can also refer to the [Rails guide errors[:base]](https://railsguides.jp/active_record_validations.html#errors-base) to learn how to add error messages using callbacks. For more information on how to add error messages using callbacks, see [Rails Guide errors[:base]]().

## N+1 problem

- Incorporate a mechanism to avoid the N+1 problem when displaying the user list screen.

## Hints for the N+1 problem

For more information on the N+1 problem, refer to the text in [How to use queries 9 [Notes on queries and the N+1 problem]](https://client.diveintocode.jp/curriculums/791).

## Add test items for Model.

Create a `UserTest.php` file under the `tests/Feature` directory and write tests that satisfy the following three requirements: 1.

1. add the following test items and complete the test code

    [tests/Feature/UserTest.php].
    ```php
    namespace Tests\Unit;
    use Tests\TestCase;

    class UserTest extends TestCase
    {
      //Validation testing
        public function test_If_the_users_name_is_empty() {
          
        }

        public function test_If_the_users_email_address_is_empty(){

        }
        
        public function test_Users_password_is_empty(){
          
        }

        public function If_the_users_email_address_has_already_been_used(){
          
        }

        public function If_the_users_password_is_less_than_6_characters(){
          
        }

        public function If_the_users_name_has_a_value_the_email_address_is_an_unused_value(){ 

        }

        public function the_password_is_more_than_6_characters(){

        }
    }
    ``` 
    1.

Tests must be written to verify that the code is correct. 1.
The tests implemented in steps 1 to 3 should be modified as necessary, and all tests should succeed.

## Add test items for System .

Create a `UserTest.php` file under the `tests/Feature` directory, and write tests that satisfy the following three requirements:1.

1. add the following test items to complete the test

    [tests/Feature/UserTest.php].
    ```php
    namespace Tests\Unit;
    use Tests\TestCase;

    class UserTest extends TestCase 
    {
      //registration function
        public function test_When_a_user_is_registered(){
          //if yes Go to the task list screen          
        }

        public function test_If_the_user_moves_to_the_task_list_screen_withou_logging_in(){
          //if yes Moves to the login screen and displays the message "Please login
        }

      //Login function
        public function test_When_you_login_as_a_registered_user(){
          //if yes Moves to the task list screen and displays the message "You are logged in
          //if yes You can access your detail screen
          //if yes When you access someone else's detail screen, you will be redirected to the task list screen
          //if yes When you log out, you will be redirected to the login screen and the message "You are logged out" will be displayed
        }

      //Admin function
        public function test_When_an_administrator_logs_in(){
          //if yes can access the user list screen
          
          //if yes Can register administrators
          
          //if yes Can access the user details screen
          
          //if yes Can edit other users from user edit screen
          
          //if yes Delete a user
          
        }

        public function test_When_an_ordinary_user_accesses_the_user_list_screen(){
          //if yes Goes to task list screen and displays error message "Only administrator can access
        }
    }
    ```
    1.

Tests must be written to verify that the code is correct. 1.
The tests implemented in steps 1 to 3 should also be modified accordingly and all tests should succeed.

### Test Code Tip 1

The tests implemented in Step 3 are all in a state of failure due to the fact that we have associated a task with a user and controlled that the user cannot move to the task page without logging in.
Therefore, we need to create test data for users and add a process to make them login.
In the `tests/Feature/UserTest.php` file, let's create test data for regular users and admin users.

Also, refer to the following code and use `before` to execute the process of logging in before each test is executed.

[tests/Feature/UserTest.php].
```php
  public function tests(){
  # Create the test data for the user
  $user = factory(User::class)->create();
  # Write the code to make the user login
  } 
```
## Modify the initial data

1. to be able to use seed data to submit 1 data each for general users and administrators
1. use seed data to submit 50 tasks associated with general users and 50 tasks associated with administrators.

## Reflect the changes in Heroku 1.

1. reflect the changes in the `step4` branch to the Heroku `master` branch using the following command.

    ```
    $ git push heroku step4:master
    ```
    If an error occurs due to existing data, use the following command to reset the data on Heroku, and then push to the Heroku `master` branch again.
    ```
    $ heroku pg:reset
    $ heroku run php artisan migrate
    ``` 
2. submit the initial data to Heroku using the following command
    ```
    $ heroku run php artisan db:seed
    ```

## Passing requirements.
### Development Requirements.

1.The table name of users should be `users`. 1.
The `users` table should be created as per the requirements. 1.
Do not use any framework or `adminArchitect` framework the admin screen. 1.
1. index on `user_id` which is used to associate with tasks.
Use `seed data` to submit one data for general users and one data for administrators. 1.
1. to be able to submit 50 tasks for each of general users and administrators using seed data. 1. to be able to submit 50 tasks for each of general users and administrators using seed data.
1. seed data has been submitted to Heroku.
Heroku's master branch should reflect the contents of step 4. 1.
Incorporate a mechanism to avoid the N+1 problem when displaying the user list screen.

### Screen design requirements. 1.

1. id attribute and class attribute of HTML must be assigned as per requirement. 1.
Display text, links, and buttons on each screen as per requirements. 1.
The number of Tasks created by each user should be displayed in the User List screen. 1.
The User List screen should display the number of Tasks created by each user. 1.
Display "Yes" if the user has administrative privileges and "No" if the user does not have administrative privileges in the User Details screen. 1.
To display a list of Tasks created by the user on the User Details screen with their titles, contents, creation date and time, due date, priority, and status.

### Screen Transition Requirements 1.

1. transition according to the screen transition diagram. 1.
1. path prefix must be generated as follows.

    |Prefix|access destination
    |--|--||new_session
    |new_session|login screen| |new_user|account registration screen
    |new_session|login screen| |new_user|account registration screen| |user|account details screen|
    |user|account details screen|
    |edit_user|account edit screen|
    |new_user|login screen| |user|account details screen| |edit_user|edit account screen| |admin_users|user list screen|
    |new_admin_user|user registration screen|
    |edit_user|account edit screen| |admin_users|user list screen| |new_admin_user|user registration screen| |admin_user|user details screen| |edit_user|user details screen
    |edit_admin_user|user edit screen|

### Functional Requirements 1.

When a user is clicked on a link to delete a user, a confirmation dialog should be displayed saying "Are you sure you want to delete the user? in the confirmation dialog when clicking a link to delete a user. 1.
When the validation fails for registering or editing an account, or registering or editing a user, the validation message should be displayed according to the following conditions.

    |conditions|validation message to be displayed|--|--|.
    |--|||
    |If name is not entered, please enter a name||--|
    |if email address is not entered|please enter email address|
    |if email address is already in use|email address is already in use|
    |If your password is less than 6 characters, please enter your password.
    |If your password is less than 6 characters long|Please enter a password with at least 6 characters long|
    |Password and password (confirmation) do not match|Password (confirmation) and password entry do not match| 1.

1. flash message to be displayed as per the following conditions

    |conditions|flash message to be displayed|
    |--||.
    |Successful account registration|Account has been registered|
    |Succeeded in updating the account|Updated the account|
    |If login succeeded|Logged in|.
    |If login failed|Your email address or password is incorrect|
    |Logged out|Logged out|
    |Succeeded in registering user|Registered user|
    |Succeeded in updating a user|Updated a user|
    |If you deleted a user|You have deleted a user| 1.

1. to add a setting to make email addresses case-insensitive
If a user accesses a page other than the login screen or account registration screen without logging in, the user should be redirected to the login page and a flash message "Please login" should be displayed. 1.
If a user accesses the Login screen or the Account Registration screen while logged in, the user will be redirected to the Task List screen and will receive a flash message saying 'Please log out.
If a user tries to access another user's Task Details screen or Task Edit screen, the screen will switch to the Task List screen and a flash message will be displayed saying, "You do not have permission to access these screens.
When a user is deleted, all Tasks associated with that user will be deleted.
To create an association between a user and a task so that only the tasks created by the user will be displayed in the task list screen
Ability to add/remove administrative privileges in the user registration screen and edit screen. 1.
When a general user accesses the administration screen (any of the four newly created screens), the user will be redirected to the task list screen and an error message will be displayed saying "Only administrator can access.
If there is only one administrator and the user tries to delete the user, the model callback will be used to control the deletion and display the **error message** "Cannot delete because there are zero administrators.
If there is only one administrator and the user tries to update to remove the administrator privileges, the model callback will be used to control the update and display an **error message** saying "Cannot change privileges because there are zero administrators.

### Test Requirements
- **Model Test** 1.
1. complete the added tests 1.
The tests must be written to verify that the code is correct. 1.
The tests implemented in steps 1-3 must be modified as appropriate and all tests must be successful.
- **System Test** 1.
Complete the added tests. 1.
The tests should be written to verify that the code is correct. 1.
The tests implemented in steps 1-3 should be modified as appropriate and all tests should be successful.

## Obtain a mentor's review

When receiving a review, be sure to check the following four items. 1.

1. if you have completed Step 4, please raise a pull request and let us know in the comments that you have completed Step 4 referring to the following.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/344d270e142b2046f1fda6932ce4afcc.png)](https://diveintocode.gyazo.com/344d270e142b2046f1fda6932ce4afcc)

Be sure to submit the issue with a pull request, and be very careful not to perform a merge. When you submit a pull request, you will see a button that says "Merge pull request", **click on this button after you have been instructed by your mentor to proceed to the next step** to merge.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/a49d80a2871fb7634ae3a881d6858f94.png)](https://diveintocode.gyazo.com/a49d80a2871fb7634ae3a881d6858f94) 3.

If you receive a comment from your mentor requesting modifications, please respond to it. **When you have completed the modification, please reflect the modification in the `step4` branch on GitHub and the `master` branch on Heroku, and submit a review request again from the comments. ** 4.
While you are waiting for the review, you can continue with the next step. In this case, be careful to create branches from master only, and not grandchild branches. Also, consider proceeding with texts and issues other than the Manyara issue to avoid complicating branch operations.


