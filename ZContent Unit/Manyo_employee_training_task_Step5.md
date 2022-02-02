

# Manyo employee training task Step 5

## Handling of this issue
This issue is being used as an issue for DIVE INTO CODE with the official permission of [Manyo Co., Ltd.] (https://everyleaf.com/). The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

## About license

The copyright is as follows (It is a commercial use contrary to the license, but in our case, it can be used as an issue because it has been individually licensed by Manyo Co., Ltd.).

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)] (https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)

[https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja] (https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja)

Original GitHub URL: [everyleaf / el-training] (https://github.com/everyleaf/el-training)

## Before tackling step 5

Be sure to check the following items before working on step 5.

1. Did you merge the pull request created in step 4 into the `master` branch?
2. Did you run the `git pull origin master` command on the local` master` branch to pull the changes from the remote repository into the local repository?
3. Did you create and move a new `step5` branch from your local` master` branch?

## Contents of step 5

In step 5, you will be asked to do the following:

1. Set the error page
2. Implement the label function
3. Implement a search function using labels
4. Guess the design
5. Add test items

## Set error page

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/e28904e427e035a57eb097591622ae82.png)] (https://diveintocode.gyazo.com/e28904e427e035a57eb097591622ae82)

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/48ceaad9092468c4124f24075a6e8558.png)] (https://diveintocode.gyazo.com/48ceaad9092468c4124f24075a6e8558)

Edit the 400 error page and the 500 error page referring to the above.
For the image, access ["Error page sample image"] (https://docbase.io/posts/1985783/sharing/5484e398-bce6-42ff-9943-9c72f9c953cc) and enter ** 546 ** in the password input field. You can download it by doing.
Please set the downloaded image to be displayed on each error page.

1. Display the downloaded image on the 404 and 500 error pages
1. Display the text "The page you are looking for cannot be found" on the 404 error page.
1. Display the text "There is some error inside the server" on the 500 error page.

## Add label function

Implement the ability to label tasks to meet the following requirements:

### Development requirements

1. Implement the label function without using external libraries
4. The label table name should be `labels`
5. Create a `labels` table that meets the following requirements

    | Column Meaning | Column Name | Data Type | Database Constraints |
    |-|-|-|-|
    | Name | name | string | · Not Null constraint |

### Screen transition requirements

--Transition according to the screen transition diagram below

    [! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/cd0abd6ad40e009b1f9a870dcd1a2eaa.png)] (https://diveintocode.gyazo.com/cd0abd6ad40e009b1f9a870dcd1a2eaa)

--The path prefix is ​​generated as follows

    | Prefix | Access |
    |-|-|
    | labels | Label list screen |
    | new_label | Label registration screen |
    | edit_label | Label edit screen |

### Screen design requirements

** Global navigation **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/379cd9519389db3064355ba88a614197.png)] (https://diveintocode.gyazo.com/379cd9519389db3064355ba88a614197)

--Refer to the above, create a global navigation that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Link to label list screen | Label list | labels-index |
    | Link to label registration screen | Register label | new-label |

** Label list screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/5697b35ff7f3911b02e2ce487559a898.png)] (https://diveintocode.gyazo.com/5697b35ff7f3911b02e2ce487559a898)

1. Refer to the above and create a label list screen that meets the following requirements.

    | Target | Character to be displayed | HTML class attribute given to the target |
    |-|-|-|
    | Screen title | Label list page ||
    | Table header | Name, number of tasks ||
    | Link to label edit screen | Edit | edit-label |
    | Link to remove label | Remove | destroy-label |

2. Display the number of tasks associated with the label

** Label registration screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/f07777a3b0dbcb4a1dc328df5902a9f3.png)] (https://diveintocode.gyazo.com/f07777a3b0dbcb4a1dc328df5902a9f3)

1. Refer to the above and create a label registration screen that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Screen title | Label registration page ||
    | Name form label | Name ||
    | Button to register label | Register ||
    | Link to return to label list screen | Back | back |

** Label edit screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/539c5fe5083ca847530ee2c08ae9d4e4.png)] (https://diveintocode.gyazo.com/539c5fe5083ca847530ee2c08ae9d4e4)

1. Refer to the above and create a label edit screen that meets the following requirements.

    | Target | Character to be displayed | HTML id attribute given to the target |
    |-|-|-|
    | Screen title | Label registration page ||
    | Name form label | Name ||
    | Update | Update ||
    | Link to return to label list screen | Back | back |

** Task registration screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/17a61c45b062e725b00711a05a76a468.png)] (https://diveintocode.gyazo.com/17a61c45b062e725b00711a05a76a468)

--Display a form label named "Label" and a checkbox to select the label (In the image above, the checkboxes are arranged side by side using CSS, but they can be arranged vertically. )

** Task edit screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/e0d00de8546375c36d02ae679f2d21b2.png)] (https://diveintocode.gyazo.com/e0d00de8546375c36d02ae679f2d21b2)

1. Display a form label named "Label" and a checkbox to select the label (in the image above, the checkboxes are arranged side by side using CSS, but they can be arranged vertically. .)
1. Display the label associated with the task with a check mark.

** Task details screen **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/d31be09f1a24310e90429093d7794feb.png)] (https://diveintocode.gyazo.com/d31be09f1a24310e90429093d7794feb)

--Add an item called "Label" to display all label names associated with the task.

### Functional requirements

1. Display the flash message according to the following conditions

    | Condition | Flash message to display |
    |-|-|
    | If the label is registered successfully | The label is registered |
    | If the label is updated successfully | The label has been updated |
    | If the label is deleted | The label has been deleted |

1. If you try to register or edit the label name without entering it, the validation message "Please enter the name" will be displayed.
1. When you click the link to delete the label, the text "Are you sure you want to delete it?" Is displayed in the confirmation dialog.
1. To be able to label when registering and editing tasks
2. Allowing multiple labels to be registered for one task
4. The registered label should be available only to the registered user.

### Tips for implementing the label function 1

It is a standard practice to design a table in a ** many-to-many ** relationship where labels can be attached to multiple tasks and tasks can be labeled multiple times.

### Tips for implementing the label function 2

The label checkboxes to be displayed when registering or editing a task are [`checkbox`], and let's think about the implementation method using `checkbox`.

You can display the checkboxes for each label by using iterative processing to generate as many `checkbox`s as there are labels, as shown below.
```php
@foreach ( $labels as $i => $label )
{!! Form::checkbox( 'label_ids[]', $label, !in_array($labels[$i], $labels),[$label->id]) !!}
{!! Form::label($label->name,  $label->name) !!}
@endforeach
```
When you create a task using this checkbox, you will receive parameters similar to the following:
`` ```
"task" => {"title" => "test", "content" => "testcontent", "expired_at (1i)" => "2018", "expired_at (2i)" => "9", "expired_at" (3i) "=>" 26 "," status "=>" Not started "," label_ids "=> ["1 "," 2 "," 4 "," 8 "]}," commit "=>" sign up"}
`` ```
`" label_ids "=> ["1 "," 2 "," 4 "," 8 "]` is the content of the check box, `[" 1 "," 2 "," 4 "," 8 " ] `Corresponds to the id of the checked label. Let's use this value to store the value in the intermediate table.

In addition, the details of `checkbox` are summarized below.
--You can send a hash with the key `Form::checkbox( 'label_ids[]', $label, !in_array($labels[$i], $labels),[$label->id])` as a parameter.
--`!in_array`: check if in array exist values that can be sent as array format parameters (In the specification of` checkbox`, the checked one is "1" and the unchecked one is "0", which is unnecessary. The value will be included.)

It's almost impossible to come up with ways to use these options on your own, but you don't have to memorize them all.
** It is important to find a way to implement the feature you want to implement and to be able to find the optimal solution. ** **
For example, if you can make good use of official references and articles to derive the optimal solution for implementing a function, you can say that you have acquired the first step in problem-solving ability.
For how to implement labels, search for keywords such as "rails label function" to find articles that may be helpful.

## Implement a search function using labels

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/0bd1ce42f9aabc36d9f9ee9d2fbd685c.png)] (https://diveintocode.gyazo.com/0bd1ce42f9aabc36d9f9ee9d2fbd685c)

1. Implement the label search form by adding it to the search form on the task list screen implemented in step 3.
1. Use `select` on the label search form and leave the default value empty
2. By specifying one label and searching, only the task with that label is displayed.

### Tips for implementing the label search function 1

Official reference [select (method, choices = nil, options = {}, html_options = {}, & block)] (https://api.rubyonrails.org/classes/ActionView/Helpers/FormBuilder.html#method-i- Let's implement it with reference to select).
By implementing the search form with reference to this, you can send parameters such as `" label_id "=>" 13 "`.

Also, let's do conditional branching in the controller as we did when we implemented the task search function before.
```php
if(!empty($request->search)){
  if (the_parameters_passed_were_both_title_and_status){
    # omit
  }
  elsif (the parameter passed was a label){
    # omit
  }}
```

### Tips for implementing the label search function 2

By narrowing down the data as shown below, you can get all the tasks associated with the label to be searched.

1. Identify the label using the `label_id` sent by the parameter
2. Get the task associated with the specified label using the association method

If a user is associated with a label and has an association, you can get all the tasks associated with the label created by a particular user in this way.

## Guess the design

Please refer to [Bootstrap4 Official Reference] (https://getbootstrap.jp/docs/4.3/getting-started/introduction/) and apply the following design. ** When applying the design, be careful not to erase the id and class specified in the development requirements. ** **

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3632e1a914338fcd16cc5a07313ad3bf.png)] (https://diveintocode.gyazo.com/3632e1a914338fcd16cc5a07313ad3bf)

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/284a369bc6167d2a9ce3c1cec6048c50.png)] (https://diveintocode.gyazo.com/284a369bc6167d2a9ce3c1cec6048c50)

The sample designs above all use Bootstrap's selectors to apply styles.

### Design requirements

*** Please be careful not to delete the id attribute and class attribute of HTML specified in the development requirements so far. ** **

1. Display global navigation links right-justified in a horizontal row (either Bootstrap or CSS can be used to apply the design).
2. Elements other than global navigation and flash messages are enclosed in Bootstrap's `container` selector.
3. Apply the design to the following elements using Bootstrap (see [Bootstrap3 Tutorial] (https://bootstrap.hana87.club/)).

    --Button elements on each screen
    --Table elements on each list screen
    --Form elements on each screen
    --Flash message

### Tip 1
By applying Bootstrap's `container` selector, margins will be inserted on the left and right of the element enclosed by` container` as shown below. This makes it easy to arrange the display area.

[Before application]
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/b2ab72cdff82d1d267153de3d27ce38b.png)] (https://diveintocode.gyazo.com/b2ab72cdff82d1d267153de3d27ce38b)

[After application]
[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3632e1a914338fcd16cc5a07313ad3bf.png)] (https://diveintocode.gyazo.com/3632e1a914338fcd16cc5a07313ad3bf)

To apply the `container` selector to elements other than global navigation and flash messages, change the` <% = yield%> `in` app / views / layouts / application.blade.php` to the `container` selector as shown below. Enclose in the `<div>` element with.

[example]
```php
  <body>
    <div class ='container'>
      @yield('content')
    </div>
  </body>
```

### Tip 2

In the sample global navigation, the following sample code in the official reference is customized to apply the design.

```php
<nav class = "navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"> Navbar </a>
  <button class = "navbar-toggler" type = "button" data-toggle = "collapse" data-target = "# navbarNavAltMarkup" aria-controls = "navbarNavAltMarkup" aria-expanded = "false" aria-label = "Toggle navigation">
    <span class = "navbar-toggler-icon"> </span>
  </button>
  <div class = "collapse navbar-collapse" id = "navbarNavAltMarkup">
    <div class = "navbar-nav">
      <a class="nav-item nav-link active" href="#"> Home <span class = "sr-only"> (current) </span> </a>
      <a class="nav-item nav-link" href="#"> Features </a>
      <a class="nav-item nav-link" href="#"> Pricing </a>
      <a class="nav-item nav-link disabled" href="#"> Disabled </a>
    </div>
  </div>
</nav>
```

If you want to know more, check [Bootstrap Official Reference / Navbar] (https://getbootstrap.jp/docs/4.3/components/navbar/).

### Tip 3

You can apply the design to buttons and links by specifying the selector (class) introduced in [Bootstrap Official Reference / Buttons] (https://getbootstrap.jp/docs/4.3/components/buttons/).

[example]
```php
<a href="/tasks/{{$task->id}}" class="btn btn-info">Details</a>
```

For other elements, apply the design to each element by referring to the official reference below.

[Bootstrap Official Reference / Tables] (https://getbootstrap.jp/docs/4.3/content/tables/)
[Bootstrap Official Reference / Forms] (https://getbootstrap.jp/docs/4.3/components/forms/)
[Bootstrap Official Reference / Alerts] (https://getbootstrap.jp/docs/4.3/components/alerts/)

## Add test items to Model 

Create a `LabelTest.php` file under the`tests/Feature` directory and write a test that meets the following three requirements.

1. Add the following test items to complete the test code

    [tests/Feature/LabelTest.php]
    ```php
    namespace Tests\Unit;
    use Tests\TestCase;

    class LabelTest extends TestCase
    {
      //Validation test
        public function test_If_the_label_name_is_an_empty_string(){
          //if Validation fails
        }

        public function test_the_label_name_has_a_value(){
          //if successfully validated
        }
    }
    ```

1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in steps 1 to 4 to make all tests successful.

## Add test items to System 

Create a `LabelTest.php` file under the `tests/Feature` directory and write a test that meets the following four requirements.

1. Add the following test items to complete the test

    [tests/Feature/LabelTest.php]
    ```php
    rnamespace Tests\Unit;
    use Tests\TestCase;

    class LabelTest extends TestCase
    {
        //registration function
        public function test_If_you_registered_a_label(){
          //if true The registered label is displayed
        }

      //list display function
        public function test_When_transitioning_to_the_list_screen(){
          //if true A list of registered labels is displayed
        }
    }
    ```

1. Add the following test items to `tests/Feature/TaskTest.php` to complete the test.

    [tests/Feature/TaskTest.php]
    ```php
      //search function
        public function test_when_searching_by_label(){
          // if true Show all tasks with that label
            //Use the assertions to see both what is shown and what is not
        }
    ```

1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in steps 1 to 4 to make all tests successful.

### Test implementation tips
Let's create test data using FactoryBot as follows.
--Create label test data in the `tests/Feature/LabelTest.php` file
--Create test data for the intermediate table in the `tests/Feature / intermediate table name.php` file
--Use the `association` method to handle associations

## Reflect your changes on Heroku

1. Apply the changes in the `step5` branch to Heroku's` master` branch using the following command:

```
$ git push heroku step5: master
```
If an error occurs due to the influence of existing data, reset the data on Heroku using the following command, and then push it to the `master` branch of Heroku again.

```
$ heroku pg: reset
$ heroku run php artisan migrate
```

2. Use the following command to populate Heroku with initial data (you don't need to run it if you have already populated one general user and one admin data using seed data).
```
$ heroku run php artisan db:seed
```

## Pass requirements
### Development requirements

1. Display the downloaded image on the 404 and 500 error pages
1. Display the text "The page you are looking for cannot be found" on the 404 error page.
1. Display the text "There is some error inside the server" on the 500 error page.
1. Implement the label function without using gems
1. The label table name should be `labels`
1. The `labels` table is created as required
1. Implement the label search form by adding it to the search form on the task list screen implemented in step 3.
1. Use `select` on the label search form and leave the default value empty
1. Heroku's master branch reflects the content of step 5.

### Screen transition requirements

1. Make a transition according to the screen transition diagram
1. The path prefix is ​​generated as follows

    | Prefix | Access |
    |-|-|
    | labels | Label list screen |
    | new_label | Label registration screen |
    | edit_label | Label edit screen |

### Screen design requirements

1. HTML id attribute and class attribute must be assigned according to the requirements
1. Display characters, links and buttons on each screen as required
1. Display the number of tasks associated with the label on the label list screen.
1. Display a check box for selecting a label on the task registration / editing screen.
1. On the task edit screen, display with the label associated with the task checked.
1. Add an item called "Label" to the task details screen and display all label names associated with that task.

### Functional requirements

1. Display the flash message according to the following conditions

    | Condition | Flash message to display |
    |-|-|
    | If the label is registered successfully | The label is registered |
    | If the label is updated successfully | The label has been updated |
    | If the label is deleted | The label has been deleted |

1. When you try to register or update the label name without entering it, the validation message "Please enter the name" is displayed.
1. When you click the link to delete the label, the text "Are you sure you want to delete it?" Is displayed in the confirmation dialog.
1. To be able to label when registering and editing tasks
1. Allowing multiple labels to be registered for one task
1. The registered label should be available only to the registered user.
1. By specifying one label and searching, only the task with that label is displayed.

### Design requirements

1. Display global navigation links right-justified in a horizontal row (either Bootstrap or CSS can be used to apply the design).
1. Elements other than global navigation and flash messages are enclosed in Bootstrap's `container` selector.
1. Use Bootstrap to apply designs to button elements, table elements, form elements, and flash messages on each screen.

### Test requirements
-** Model Test **
1. Complete the added test
1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in steps 1 to 4 to make all tests successful.
-** System Test **
1. Complete the added test
1. Have a test written that can verify that the code is correct
1. Make appropriate modifications to the tests implemented in steps 1 to 4 to make all tests successful.

## Submit an assignment

When receiving a review, be sure to check the following three items.

1. If you have completed step 5, please raise a pull request and let us know in the comments that step 5 has been completed by referring to the following.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/344d270e142b2046f1fda6932ce4afcc.png)] (https://diveintocode.gyazo.com/344d270e142b2046f1fda6932ce4afcc)

2. Be sure to submit the assignment with a pull request, and be careful not to perform a merge. When you raise a pull request, you will see a button called "Merge pull request", but please click this button after instructing the mentor to proceed to the next step, and then merge.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/a49d80a2871fb7634ae3a881d6858f94.png)] (https://diveintocode.gyazo.com/a49d80a2871fb7634ae3a881d6858f94)

3. If the mentor returns a comment requesting correction, please respond accordingly. ** Once the fix is ​​complete, reflect the fix in the `step5` branch on GitHub and the` master` branch on Heroku, and submit a review request again in the comments. ** **