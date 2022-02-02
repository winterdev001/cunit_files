# Manyo employee training task Step 1

## Handling of this issue
This issue is being used as an issue for DIVE INTO CODE with the official permission of [Manyo Co., Ltd.] (https://everyleaf.com/). The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

## About license

The copyright is as follows (It is a commercial use contrary to the license, but in our case, it can be used as an issue because it has been individually licensed by Manyo Co., Ltd.).

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)] (https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)

[https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja] (https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja)

Original GitHub URL: [everyleaf / el-training] (https://github.com/everyleaf/el-training)

## Goal of this task

In this task, you will develop an application for task management. The functions required for this application can be broadly classified into the following four categories. Also, please write the test code for the implemented function.

1. Task CRUD function
2. User CRUD function
3. Administrator function
4. CRUD function for labels attached to tasks

## Important: Flow from development to submission of assignments

This task has task requirements for each step, and consists of 5 steps in total (1 step is treated for each text).
You need to create a new branch for each step and submit your assignment with a pull request raised.
Here, we will explain how to submit an assignment using Step 1 as an example.

1. Create a new `step1` branch from your local master branch and move it
1. Develop in the `step1` branch
1. Commit every time you add a feature
1. When you're done with step 1, use the `git push origin step1` command to push to the` step1` branch of the remote repository.
1. Create a pull request on GitHub
1. Submit the Github URL and Heroku URL from the [Assignment Submission Page] (https://diver.diveintocode.jp/submissions/new) and ask the mentor for a review.
1. Merge the pull request into the `master` branch of the remote repository after being instructed by the mentor to proceed to the next step.
1. Locally move from the `step1` branch to the` master` branch
1. Run the `git pull origin master` command to pull the code from the` master` branch of the remote repository into the local `master` branch.

After that, create a new branch for each step and submit the assignment in the same procedure.
For pull requests, please see the text in [GitHub Flow (please read before mofmof's technical interview assignment)] (https://diver.diveintocode.jp/curriculums/1300).

## Contents of step 1

In step 1, you will be asked to do the following:

1. Create a repository on GitHub
2. Create a Laravel project
3. Implement the CRUD function of the task
4. Write a test
5. Deploy to Heroku
6. Make GitHub and Heroku work together

## Create a repository on GitHub

First, create a new GitHub repository (repository name is arbitrary).

## Create a Laravel project

1. Create an application that meets the following requirements.

    | PHP version | Laravel | Database to use |
    |-|-|-|
    | 8.1.1 | 8.0 series | PostgreSQL |

    If you want to create an application by specifying the Rails version and database, execute the command as follows.
    ```
    $ composer create-project laravel/laravel="8.1.*" appName
    ```
    
    To set the database to postgresql open your “.env” file in the project folder and update the database information accordingly
    ```
    DB_CONNECTION=pgsql
    DB_HOST=<your_database_IP_address>
    DB_PORT=5432
    DB_DATABASE=<db_name>
    DB_USERNAME=<username>
    DB_PASSWORD=<password>
    ```

    ** If you do not meet the above requirements, you will be asked to change the version or database, so please be careful to meet these requirements. ** **

2. Commit at this point and push to the GitHub repository you created.

3. Create a `step1` branch locally and move it.

## Set so that unnecessary files are not generated

Add `--prefer-dist` to the project creation command so that unnecessary files are not generated when you execute` composer create-project laravel/laravel my-new-project`.

```php
composer create-project laravel/laravel my-new-project --prefer-dist
```

By making this setting, you can control not to generate unnecessary assets, helpers, test files, etc. when you execute the `create-project laravel/laravel my-new-project` command.

## Implement CRUD functionality for tasks

From here, we will implement CRUD functions for managing tasks.
First, let's implement a simple function that allows you to register only the title and content of the task.
Please proceed with development to meet the following requirements.

## Development requirements

1. The task table name should be `tasks`
1. Create a `tasks` table that meets the following requirements

    | Column Meaning | Column Name | Data Type | Database Constraints |
    |-|-|-|-|
    | Title | title | string | ・ Not Null constraint |
    | Content | content | text | ・ Not Null constraint |

    Database constraints are validations that you set on your database to prevent invalid values ​​from being registered. In addition to the validation defined in the model, setting the validation in the database has the effect of increasing the security.
    You can set validation in your database so that empty values ​​are not saved in the `title` column by creating a migration file similar to the one below and performing the migration.

    first install the following package 

    ```
    $ composer require doctrine/dbal
    ```
    ```php
        public function up()
        {
            Schema::create('tasks', function (Blueprint $table) {
                $table->string('title')->nullable(false)->change();
            });
        }
    ```

## Screen transition requirements

1. Make a transition according to the screen transition diagram below.

    [! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/91b667fd7ea8cce7b086f5f8907f2f45.png)] (https://diveintocode.gyazo.com/91b667fd7ea8cce7b086f5f8907f2f45)

1. The path prefix is ​​generated as follows

    | Prefix | Access |
    |-|-|
    | root | task list screen |
    | tasks | task list screen |
    | new_task | task registration screen |
    | task | task details screen |
    | edit_task | task edit screen |

    You can check the path prefix with the `php artisan route:list` command.

    [! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/ad247326068b089e5121163ce32d61a0.png)] (https://diveintocode.gyazo.com/ad247326068b089e5121163ce32d61a0)

## Screen design requirements

Internationalization of design and characters will be dealt with in another step.
Here, let's implement only the function without applying the design as shown below.

### Global navigation

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/6fd543ba31348ee2d71c554cf8b67194.png)] (https://diveintocode.gyazo.com/6fd543ba31348ee2d71c554cf8b67194)

--Refer to the above, create a global navigation that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Link to task list screen | Tasks Index | tasks-index |
    | Link to task registration screen | New Task | new-task |

### Task list screen

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/d3c396815b6c955f24a1f1e93b63da40.png)] (https://diveintocode.gyazo.com/d3c396815b6c955f24a1f1e93b63da40)

1. Refer to the above and create a task list screen that meets the following requirements.

    | Target | Character to be displayed | HTML class attribute given to the target |
    |-|-|-|
    | Screen title | Tasks Index Page ||
    | Table Headers | Title, Content, Created_at ||
    | Link to task details screen | Show | show-task |
    | Link to task edit screen | Edit | edit-task |
    | Link to delete a task | Destroy | destroy-task |

1. Display the title and contents of the task and the creation date and time in a list.

### Task registration screen

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/228715d5cc790ac847ec6a98ca4b3ca2.png)] (https://diveintocode.gyazo.com/228715d5cc790ac847ec6a98ca4b3ca2)

--Refer to the above, create a task registration screen that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Screen title | New Task Page ||
    | Title form label | Title ||
    | Content form label | Content ||
    | Button to register a task | Create Task | create-task |
    | Link to return to task list screen | Back | back |

### Task details screen

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/09eecd3bbf8a39144768f96ab02eca9e.png)] (https://diveintocode.gyazo.com/09eecd3bbf8a39144768f96ab02eca9e)

1. Refer to the above and create a user list screen that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Screen title | Show Task Page ||
    | Title item | Title ||
    | Content items | Content |||
    | Created date and time items | Created_at |||
    | Link to task edit screen | Edit | edit-task |
    | Link to return to task list screen | Back | back |

1. Display the title and content of the task, and the date and time of creation.

### Task edit screen

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/083c746cd690553021858c5b6900ed95.png)] (https://diveintocode.gyazo.com/083c746cd690553021858c5b6900ed95)

--Refer to the above, create a user edit screen that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Screen title | Edit Task Page ||
    | Title form label | Title ||
    | Content form label | Content ||
    | Button to register task | Update Task | update-user |
    | Link to return to task list screen | Back | back |

## Functional requirements
1. If validation fails when registering or editing a task, display the validation message according to the following conditions.

    | Conditions | Validation message |
    |-|-|
    | If no title is entered | Title can't be blank |
    | If no content is entered | Content can't be blank |

1. Display the flash message according to the following conditions

    | Condition | Flash message to display |
    |-|-|
    | Task was successfully created. |
    | Task was successfully updated. |
    | If the task is deleted | Task was successfully destroyed. |

1. When you click the link to delete the task, the text "Are you sure?" Is displayed in the confirmation dialog.

## Create a test

In this task, we will create System Test and Feature Test using PHPUnit. System Test is described below.
First, let's configure the settings for using PHPUnit.

### Introduce PHPUnit

** 1. Test configuration for database**

Open `phpunit.xml` which is located in the root folder of your project and make sure to add following properties in the environment variables at the end of the file.

```php
    <env name="APP_ENV" value="testing"/>
    <env name="DB_CONNECTION" value="pgsql"/>
    <env name="DB_DATABASE" value=":memory"/>
```

** 2. Create a System Unit Test file **

Execute the following command. Then, the files required for PHPUnit will be generated.
```
$ php artisan make:test TaskTest --unit
```
Of the generated files, `tests / Unit / TaskTest.pgp` describes the overall tests detail will be witten from here.

### For Vagrant

When using PHPUnit with Vagrant, you may need to install additional `chromedriver`. However laravel provide a way of running your test in browser by default only you have to install the packages called `Laravel Dusk` that enables it in your project and with Dusk the automation comes natively through its use of ChromeDriver and Facebook Php-webdriver.as it appears in laravel documentation [chromedriver] (https://laravel.com/docs/8.x/dusk#managing-chromedriver-installations, "doc").


1. Installation of `laravel/dusk`

    ```
    $  composer require laravel/dusk
    ```
    Next is to register `DuskServiceProvider` inside `app\Providers\AppServiceProvider.php` 

    ```php
        use Laravel\Dusk\DuskServiceProvider;// Importing DuskServiceProvider class
        class AppServiceProvider extends ServiceProvider
        {
            public function register()
            {
                if ($this->app->environment('local', 'testing')) {
                    $this->app->register(DuskServiceProvider::class);
                }
            }
        }
    ```
2. Installation of Dusk and Chromedriver 

    ```php
    #Install the latest version of ChromeDriver for your OS...
    php artisan dusk:chrome-driver

    # Install a given version of ChromeDriver for your OS...
    php artisan dusk:chrome-driver 86

    # Install a given version of ChromeDriver for all supported OSs...
    php artisan dusk:chrome-driver --all

    # Install the version of ChromeDriver that matches the detected version of Chrome / Chromium for your OS...
    php artisan dusk:chrome-driver --detect
    ```
The above command will create a `Browser` directory inside the test folder of your project and adds some basic example test.

## Create a Feature Test

From here, we will write the Feature Test. The items to be tested are as follows.

1. Validation fails if the task title is empty
2. Validation fails if the task description is empty
3. If the task title and description have values, they will be registered.

First, let's create a file for the Feature Test. The following command will generate a `tests / Feature / TaskTest.php` file for Feature Test and a `database/factories/TaskFactory.php` file for Laravel Factory (Laravel Factory will be discussed below). ).

```
$ php artisan make:test TaskTest 
```
```
$php artisan make:factory TaskFactory
```

[tests / Feature / TaskTest.php]

```php
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function test_if_the_task_title_is_empty_string(){
        // tests goes here
    }

    public function test_If_the_task_description_is_an_empty_string(){
        // tests goes here
    }

    public function test_if_the_task_title_and_description_have_values(){
        // tests goes here
    }
}
  
```

To execute the Feature Test described in `tests / Feature / TaskTest.php`, execute the following command.

```
$ php artisan test tests/Feature/TaskTest.php
```

If the following screen is displayed, there is no problem.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/0e1577523604d92b396dc000ccb598b5.png)] (https://diveintocode.gyazo.com/0e1577523604d92b396dc000ccb598b5)

Next, write tests for each item in the template.
Here, we will introduce the code that serves as a sample only for the items of "Validation test", "When the task title is empty string", and "Validation error occurred".

[tests / Feature / TaskTest.php]
```php
    public function test_if_the_task_title_is_empty_string(){
        $task = Tasks::make(['title'=>'']);
        $this->assertTrue($task->title === "");
    }
```

With this as a hint, let's create the remaining two tests while examining them by yourself, and let's make all the tests successful.

If all the tests you create are successful, you will see the following results:

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/c9744affcb52c5e228a4f1cf80baf962.png)] (https://diveintocode.gyazo.com/c9744affcb52c5e228a4f1cf80baf962)

Also, if any of the tests fail, you will see a result similar to the following:

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/1dfcd946303e6fcbff720c674f102a8a.png)] (https://diveintocode.gyazo.com/1dfcd946303e6fcbff720c674f102a8a)

If the test fails, modify the Feature Test so that all tests pass.

### Feature Test requirements

1. Successful test of "Validation error occurs if task title is empty string"
1. Successful test of "Validation error occurs if task description is empty string"
1. Successful test of "If the task title and description have values, you can register the task"
1. Have a test written that can verify that the code is correct

## Create a System Unit Test

From here, we will write the System Unit Test.
System Unit Test is a test function for executing E2E (end-to-end) tests.
The E2E test is a test to confirm that the "start to end (from the user's arrival at the page to the purpose and departure)" of the website or application is working as expected.
* In Rails applications, this is a test that confirms the process from opening the browser to closing it (using the function and returning the result of use), and this test is collectively called System Unit Test. Write the test code itself in a directory called `tests/Unit`. 

Now let's actually write the System Unit Test. The items to be tested are as follows.

1. When you register a task, the registered task will be displayed.
2. A list of registered tasks is displayed on the list screen.
3. When you move to any task details screen, the contents of that task are displayed.

The basic format of System Unit Test is similar to that of Model Spec.

[tests / Unit / TaskTest.php]
```php
use Tests\TestCase;

class TaskTest extends TestCase
{

  public function test_The_registered_task_is_displayed(){
    //   if yes The registered task is displayed
  }

  public function test_A_list_of_registered_tasks_is_displayed(){
    //   if yes The registered task is displayed
  }

  public function test_The_content_of_the_task_is_displayed(){
    //   if yes The registered task is displayed
  }
}
  
```

First, move to a directory called `Unit` under the` tests` directory, and you will find a file `TaskTest.php` created after we run `php artisan make:test TaskTest --unit` command. Once found, paste the above code into this file.

At this point, let's check if System Unit Test works properly. To execute the System Unit Test described in `tests / Unit / TaskTest`, execute the following command.

```
$ php artisan test tests/Unit/TaskTest.php
```

If the following screen is displayed, there is no problem.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/0e1577523604d92b396dc000ccb598b5.png)] (https://diveintocode.gyazo.com/0e1577523604d92b396dc000ccb598b5)

Next, write tests for each item in the template.
Here, we will introduce the code that serves as a sample only for the items of "list display function", "when transitioning to the list screen", and "displaying the registered task list".

[tests / Unit / TaskTest.php]
```php
  # omit 
  public function test_A_list_of_registered_tasks_is_displayed()
    {   
        #Register a task to use in the test
        $task = Task::create([
            'title'=>'Create documents',
            'content'=>'Create a proposal.',
        ]);
        #Transition to task list screen
        $repsonse = $this->get('/tasks');
        # visit (transition) page (in this case, task list screen), the character string "document creation" is expected to be seen on screen
        $repsonse->assertSeeText('Document creation'); //the test result is output as success, and if it is "false", the test result is output as failure.
    }
  # omit
```
A function, such as the `assertSeeText` used to compares the actual value with the expected value and determines if they match is called an assertion. PHPUnit comes with a variety of assertions, so check them out as needed.

With this as a hint, let's create the remaining two tests while examining them by yourself, and let's make all the tests successful.


## Create test data using Laravel Factory

When testing with PHPUnit, it is common to create test data using a feature called `Laravel Factory`. Also, the test data template generated using `Laravel Factory` is called a factory.
By default, test data is saved in a database dedicated to testing, and it is automatically saved and deleted for each test. Therefore, test data does not accumulate.

To use Laravel Factory, you need to set up  `PHPUnit.xml`for testing.
Add the following to your PHPUnit xml file.

[PHPUnit.xml]
```php
  <env name="APP_ENV" value="testing"/>
  <env name="DB_CONNECTION" value="pgsql"/>
  <env name="DB_DATABASE" value=":memory"/>
```

Now let's use Laravel Factory to define a factory for the task.
Create a directory called `factories` under the` database` directory, and create a file called `tasks.` in it.
Paste the following code into the `database / factories / TaskFactory.php` file you created.

[database / factories / TaskFactory.php]

```php
use App\Models\Task;
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $task = Task::class;
 
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Document Creation',
            'description' => 'Create a proposal',
        ];
    }
}
```

The above is the code to create test data for a task using Laravel Factory.
By writing code like this in `database / factories / TaskFactory.php`, you can use the test data using Laravel factory.
Let's rewrite the test code described in `tests / Unit / TaskTest.php` to the code using Laravel Factory.

[tests / Unit / TaskTest.php]
```diff
  # omit
  public function test_A_list_of_registered_tasks_is_displayed()
    {   
        #Register a task to use in the test
--$task = Task::create(['title'=>'Create documents','content'=>'Create a proposal.']);
+ $task = Task::factory()->count(2)->create();
        #Transition to task list screen
        $repsonse = $this->get('/tasks');
        # visit (transition) page (in this case, task list screen), the character string "document creation" is expected to be seen on screen
        $repsonse->assertSeeText('Document creation'); //the test result is output as success, and if it is "false", the test result is output as failure.
    }
  # omit
```

As you can see, FactoryBot allows you to create test data with more concise code.
It is also possible to override the factory properties when generating test data. In that case, write as follows.

```php
# Generate test data while overwriting the property title declared at the time of factory definition
Task::factory()->create(['title'=>'Create meeting materials'])
# Generate test data while overwriting the properties title and content declared at the time of factory definition
Task::factory()->create(['title'=>'Competition investigation','content'=>'Investigate other companies services'])
```

** Based on the explanation so far, let's write the test code for the remaining two items by yourself so as to meet the following requirements. ** **

### System Unit Test requirements

1. Creating test data using FactoryBot
1. Successful test of "If you register a task, the registered task will be displayed"
1. The test of "When transitioning to the list screen, the registered task list is displayed" is successful.
1. Successful test of "If you move to any task details screen, the contents of that task will be displayed"
1. Have a test written that can verify that the code is correct

Also, since the following explains whether the test code is written correctly and how to debug the test, let's check this as well.

## Verify if the test fails
In order to verify that the test itself is written correctly, it is effective to intentionally set the wrong result as the expected value and check the test result. Rewrite the test code as follows and try running the test again.

[tests / Unit / TaskTest.phpb]
```php
  # omit
  describe'list display function' do
    context'When transitioning to the list screen' do
      it'Displays a list of created tasks' do
        FactoryBot.create (: task)
        visit tasks_path
        # Deliberately set the wrong result as the expected value
        expect (page) .to have_content'Create a budget for the project. '
      end end
    end end
  end end

  public function test_A_list_of_registered_tasks_is_displayed()
    {   
        #Register a task to use in the test
        $task = Task::factory()->count(2)->create();
        #Transition to task list screen
        $repsonse = $this->get('/tasks');
        # Deliberately set the wrong result as the expected value
        $repsonse->assertSeeText('Create a budget for the project.'); 
    }
  # omit
```

As a result, you can prove that the test fails if you set the wrong result as the expected value by returning the result that the test failed as shown below. Conversely, if the test succeeds even if you set the wrong result as the expected value, you can determine that the test itself is problematic.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/9900e4bfb8ec64d4a48a38a0254a24ad.png)] (https://diveintocode.gyazo.com/9900e4bfb8ec64d4a48a38a0254a24ad)

** It is very important to check if the test itself is correct, so be sure to check if the test fails once when you write a new test. ** **

## System Unit Test debugging

By using a debugging tool such as `xdebug`, the following verification can be performed.
--Is the test data registered correctly?
-Is it possible to transition to the target page?
--Is the data displayed on the page appropriate?

You can debug while displaying the browser by adding the debug tool to the part you want to verify. 

## Deploy to Heroku

Follow the steps below to deploy your application to Heroku.

1. Make sure all previous work is committed
1. Create a new application on Heroku
1. Deploy to Heroku

To deploy an application developed in the `step1` branch to the` master` branch of Heroku for step 3, run the following command:
`` ```
$ git push heroku step1: master
`` ```

If you want to reconfirm how to deploy to Heroku, please refer to the text "[Introduction to Heroku 3 [How to deploy to heroku]] (https://diver.diveintocode.jp/curriculums/464)". ..

*** Also, since anyone can refer to the application deployed on Heroku, please do not post information that is bad for publishing. ** **

## Link GitHub and Heroku

GitHub and Heroku are automatically pushed to Heroku once the code is merged into the GitHub master so that you don't have to manually deploy to Heroku every time you develop. Please make it work together (for how to make it work together, refer to the articles on the Web and set it while checking it by yourself).
** When linked, the following display will appear. Please take a screenshot to show this part and attach the image to the comment section of the assignment submission screen. ** **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/f091ea2a0a02cbd384a410ff7fc64b0e.png)] (https://diveintocode.gyazo.com/f091ea2a0a02cbd384a410ff7fc64b0e)

## Pass requirements
### Basic requirements

1. The assignment has been submitted with the pull request raised (not merged)
1. The version of PHP is 8.1.1.
1. Laravel version is 8.0 series
1. The database uses PostgreSQL
1. Make settings so that unnecessary files are not generated.
1. The task table name should be `tasks`
1. The `tasks` table is created according to the requirements
1. A screenshot of the integration between GitHub and Heroku has been submitted.
1. Deploy to Heroku's master branch and reflect the content of step 1

### Screen design requirements

1. HTML id attribute and class attribute must be assigned according to the requirements
1. Display characters, links and buttons on each screen as required
1. Display the task title, description, and creation date and time in a list on the list screen.
1. Display the task title, content, and creation date and time on the details screen.

### Screen transition requirements

1. Make a transition according to the screen transition diagram
1. The path prefix is ​​generated as follows

    | Prefix | Access |
    |-|-|
    | root | task list screen |
    | tasks | task list screen |
    | new_task | task registration screen |
    | task | task details screen |
    | edit_task | task edit screen |

### Functional requirements

1. When you click the link to delete the task, the text "Are you sure?" Is displayed in the confirmation dialog.
1. If validation fails when registering or editing a task, display the validation message according to the following conditions.

    | Conditions | Validation message |
    |-|-|
    | If no title is entered | Title can't be blank |
    | If no content is entered | Content can't be blank |

1. Display the flash message according to the following conditions

    | Condition | Flash message to display |
    |-|-|
    | Task was successfully created. |
    | Task was successfully updated. |
    | If the task is deleted | Task was successfully destroyed. |

### Test requirements
-** Model Spec **
1. Successful test of "Validation fails if task title is empty string"
1. Successful test of "Validation fails if task description is empty string"
1. Successful test of "If the task title and description have values, you can register the task"
1. Have a test written that can verify that the code is correct
-** System Unit Test **
1. Creating test data using Laravel Factory
1. Successful test of "If you register a task, the registered task will be displayed"
1. The test of "When transitioning to the list screen, the registered task list is displayed" is successful.
1. Successful test of "If you move to any task details screen, the contents of that task will be displayed"
1. Have a test written that can verify that the code is correct

## Submit an assignment

When submitting an assignment, be sure to check the following four items.

1. If you have completed Step 1, submit a pull request and submit the GitHub URL and Heroku URL from the [Submission Page] (https://diver.diveintocode.jp/submissions/new). give me.

2. Be sure to submit the assignment with a pull request, and be careful not to perform a merge. When you raise a pull request, you will see a button called "Merge pull request", but ** instruct the mentor to proceed to the next step, then click this button ** to merge.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/a49d80a2871fb7634ae3a881d6858f94.png)] (https://diveintocode.gyazo.com/a49d80a2871fb7634ae3a881d6858f94)

3. If the mentor returns a comment requesting correction, please respond accordingly. ** Once the fix is ​​complete, reflect the fix in the `step1` branch on GitHub and the` master` branch on Heroku, and submit a review request again in the comments. ** **
4. You can take the next step while waiting for the review. In this case, be careful to create the branch only from master, not the grandchild branch. Also, consider advancing texts and assignments other than the Manyo assignment so that the branch operation is not complicated.