
# Manyo employee training task Step 2

## Handling of this issue
This issue is being used as an issue for DIVE INTO CODE with the official permission of [Manyo Co., Ltd.] (https://everyleaf.com/). The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

## About license

The copyright is as follows (It is a commercial use contrary to the license, but in our case, it can be used as an issue because it has been individually licensed by Manyo Co., Ltd.).

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)] (https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)

[https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja] (https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja)

Original GitHub URL: [everyleaf / el-training] (https://github.com/everyleaf/el-training)

## Before tackling step 2

Be sure to check the following items before working on Step 2.

1. Did you merge the pull request created in step 1 into the `master` branch?
2. Did you run the `git pull origin master` command on the local` master` branch to pull the changes from the remote repository into the local repository?
3. Did you create and move a new `step2` branch from your local master branch?

## Contents of step 2

In step 2, you will be asked to do the following:

1. Internationalization of applications
2. Set the time zone
3. Sort the task list in order of creation date and time
4. Add System Spec
5. Create initial data
6. Add pagination
7. Reflect the changes on Heroku and submit the initial data

## Application internationalization

Here, please use  Laravel [`Localization`] (https://laravel.com/docs/8.x/localization) mechanism to convert the characters on the screen to the official language of your country. increase.
Please internationalize the characters to be displayed according to the instructions below.

** Global navigation **

| Target | Before internationalization | After internationalization |
|-|-|-|
| Link to task list screen | Tasks Index | Task list |
| Link to task registration screen | New Task | Register task |

** Task list screen **

| Target | Before internationalization | After internationalization |
|-|-|-|
Screen title | Tasks Index | Task list page |
| Table Header | Title, Content, Created_at | Title, Content, Creation Date |
| Link to task details screen | Show | Details |
| Link to task edit screen | Edit | Edit |
| Link to delete task | Destroy | Delete |
| Confirmation dialog when deleting a task | Are you sure? | Are you sure you want to delete it? |

** Task registration screen **

| Elements | Before Internationalization | After Internationalization |
|-|-|-|
| Screen title | New Task | Task registration page |
| Title Form Label | Title | Title |
| Content form label | Content | Content |
| Button to register a task | Create Task | Register |
| Link to return to task list screen | Back | Back |

** Task details screen **

| Target | Before internationalization | After internationalization |
|-|-|-|
| Screen title | Show Task | Task detail page |
| Name item | Title | Title |
| Content Items | Content | Description |
| Creation date and time items | Created_at | Creation date and time |
| Link to task edit screen | Edit | Edit |
| Link to return to task list screen | Back | Back |

** Task edit screen **

| Elements | Before Internationalization | After Internationalization |
|-|-|-|
| Screen title | Edit Task | Task edit page |
| Title Form Label | Title | Title |
| Content form label | Content | Content |
| Button to update task | Update Task | Update |
| Link to return to task details screen | Back | Back |

** Validation message **

| Elements | Before Internationalization | After Internationalization |
|-|-|-|
| Validation message if no title is entered | Title can't be blank | Please enter a title |
| Validation message if no content is entered | Content can't be blank | Please enter the content |

** Flash message **

| Elements | Before Internationalization | After Internationalization |
|-|-|-|
| Flash message when task registration is successful | Task was successfully created. | Task registered |
| Flash message when task update is successful | Task was successfully updated. | Task was updated |
| Flash message when a task is deleted | Task was successfully destroyed. | The task was deleted |

### Internationalization Tips
How to set the default language to another language is described in [this text] (https://diver.diveintocode.jp/curriculums/793). Change the settings according to your official language.
In Japan, create a locale file (dictionary file) called `messages.php` in the` resources/lang/ja` directory and describe it as follows.

[resources / lang /ja/ models.php]
```php
// resources/lang/ja/messages.php
return [
    'task' => 'task',
    'title' => 'title'
];
```

Characters such as "task" and "title" defined in the locale file can be displayed by writing code in the view as shown below.

```html
{{ __('messages.task') }}
{{ __('messages.title') }}
```

Find out and set your own ways to internationalize links and error messages.

## Set the time zone

1. Set the creation date and time displayed on the task list screen to the time in your area.
2. Set the time for reading and writing data in the database to the time in your area.

By setting the time zone, the notation changes from `UTC` to` +0900` as shown below.

[Before setting]

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/45bd620780f1da41ea64a9c30c0e13f0.png)] (https://diveintocode.gyazo.com/45bd620780f1da41ea64a9c30c0e13f0)

[After setting]

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/417de9c5cda702873b28c036d8ea8407.png)] (https://diveintocode.gyazo.com/417de9c5cda702873b28c036d8ea8407)

If you can afford it, use the [`strtotime`] (https://laravel.com/docs/8.x/validation#rule-after) method to format it as follows. Let's look.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/bb9defbd7acef8a9a89b9a7889428a1a.png)] (https://diveintocode.gyazo.com/bb9defbd7acef8a9a89b9a7889428a1a)

By completing the above settings, the creation date and time of the task created after the setting will be registered in the time of the area where you live.

## Change the order of tasks

--Display tasks in descending order of creation date and time on the task list screen

## Add test items to System Spec

Write a test that meets the following five requirements.

1. Modify or add test items in `tests / Unit / TaskTest.php` as shown below to complete the test.
[tests / Unit / TaskTest.ph]
```diff
  # omit
  class TaskTest extends TestCase
  {

--public function test_A_list_of_registered_tasks_is_displayed(){
++public function test_The_list_of_created_tasks_is_displayed_in_descending_order_of_creation_date_and_time(){
++//   If you create a new task, New task appears at the top
++}

  }
  
```

1. Prepare at least 3 test data with different creation dates and times, referring to the following example, and use them in the "list display function" test.

    | Title | Creation date |
    |-|-|
    | first_task | 2025-02-18 |
    | second_task | 2025-02-17 |
    | third_task | 2025-02-16 |

1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in step 1 to make all tests successful.

### Test Code Tip 1

As shown below, you can get the elements that meet the conditions as an array by using the `all` method. In this case, all the contents of the `tr` tag in the` tbody` tag are acquired. Check out articles on the web to see how to use the `all` method that can be used with PHPUnit.

```php
 task_list = all ('body tr')
```
You can test the order of tasks by getting the tasks displayed on the list screen as an array and extracting specific elements from the array using an index.

### Test Code Tip 2

PHPUnit provides a way of saving cache data which enables to boost code testing. To get this working add `cacheResult="true"` to your `phpunit.xml` configuration. This tells PHPUnit always to remember which tests previously failed.

```php
#<?xml version="1.0" encoding="UTF-8"?>
<phpunit cacheResult="true"
         backupGlobals="false"
         ...>
```

Whenver you run the test PHPUnit will remember which tests are failing and using the following options we can re-run only those that failed.

```
$ ./vendor/bin/phpunit --order-by=defects --stop-on-defect
```

Also we can add the cache file `.phpunit.result.cache` to the files to  be ignored from `.gitignore` while changes made to our project are being committed to your repository.

 [.gitingore]

 ```
 #omit
 .phpunit.result.cache

 ```

## Create initial data

--Using seed data, it is possible to input task data for 50 cases.

For how to use seed data, please refer to the text of [Database:Seeding]] (https://laravel.com/docs/8.x/seeding). There is no need to use faker.

## Implement pagination

--Using `paginate` method, implement pagination on the task list screen and display 10 tasks per page.

## Reflect your changes on Heroku and populate your initial data

1. Apply the changes in the `step2` branch to Heroku's` master` branch using the following command:

    ```
    $ git push heroku step2: master
    ```

2. Input seed data to Heroku using the following command

    ```
    $ heroku run php artisan db:seed
    ```

## Pass requirements
1. The assignment has been submitted with the pull request raised (not merged)
1. Use `i18n` to internationalize text and links as required
1. Set the creation date and time displayed on the task list screen to the time in your area.
1. Set the time for reading and writing data in the database to the time in your area.
1. Display tasks in descending order of creation date and time on the task list screen.
1. Using `paginate` method, implement pagination on the task list screen and display 10 tasks per page.
1. To be able to input 50 task data using seed data
1. Seed data has been input to Heroku
1. Heroku's master branch reflects the content of step 2.
### Test requirements
1. Modify or add test items in `tests / Unit / TaskTest.php` to complete the test.
1. Prepare at least 3 test data with different creation dates and times .
1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in step 1 to make all tests successful.

## Get mentor reviews

When receiving a review, be sure to check the following four items.

1. If you have completed step 2, please raise a pull request and let us know in the comments that step 2 has been completed by referring to the following.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/344d270e142b2046f1fda6932ce4afcc.png)] (https://diveintocode.gyazo.com/344d270e142b2046f1fda6932ce4afcc)

2. Be sure to submit the assignment with a pull request, and be careful not to perform a merge. When you raise a pull request, you will see a button called "Merge pull request", but ** instruct the mentor to proceed to the next step, then click this button ** to merge.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/a49d80a2871fb7634ae3a881d6858f94.png)] (https://diveintocode.gyazo.com/a49d80a2871fb7634ae3a881d6858f94)

3. If the mentor returns a comment requesting correction, please respond accordingly. ** Once the fix is ​​complete, reflect the fix in the `step2` branch on GitHub and the` master` branch on Heroku, and submit a review request again in the comments. ** **
4. You can take the next step while waiting for the review. In this case, be careful to create the branch only from master, not the grandchild branch. Also, consider advancing texts and assignments other than the Manyo assignment so that the branch operation is not complicated.