# Manyo Employee Training Assignment Step 3

## Handling of this assignment
This assignment has been used as a DIVE INTO CODE assignment with official permission from [Manyo Corporation](https://everyleaf.com/). The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

## About the license

The copyright is as follows (although this constitutes commercial use in violation of the license, in our case we have obtained individual permission from Manyo Corporation, so we can use it as an assignment).

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)](https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)

[https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja](https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja)

URL of the original GitHub: [everyleaf/el-training](https://github.com/everyleaf/el-training)

## Before working on Step 3

Before tackling Step 3, make sure to check the following items: 1.

Make sure you have merged the pull request you created in step 2 into your `master` branch. 2.
Have you run the `git pull origin master` command on your local `master` branch to import the changes from the remote repository into your local repository? 3.
3. created and moved a new `step3` branch from your local `master` branch.

## Contents of Step 3

In Step 3, you will be working on the following tasks: 1.

1. add an end due date, priority, and status to the task
1. implement the sort function
Implement search function 1.
1. refactoring
Put up search index 1.
Add a test item 1.
Submit initial data to Heroku 1.

## Allow tasks to register due date, priority, and status

Add a new function to register a deadline, priority, and status to a task.

## Coding requirements.

1. add `deadline_on` column, `priority` column and `status` column to `tasks` table with the following requirements.

    |column meaning|column name|datatype|database constraints|.
    |--|--|--||--
    |end_expiry_date|deadline_on|date|・NotNull constraint|
    |priority|priority|integer|・NotNull constraint|
    |status|status|integer|・NotNull constraint| 3.

3. deadline input form should be implemented using `date_field`.
Use `select` for the priority input form. 3.
Use `enum` to set `0` for low priority, `1` for medium priority, and `2` for high priority. 3.
Use `select` for status entry forms. 3.
Use `enum` to assign `0` to status 'Not Started', `1` to status 'In Process', and `2` to status 'Completed'. 5.
The default values of the priority and status entry forms in the task registration screen should be left blank.

## Screen requirements

### Task List screen

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/34f1735645e0520a552cfa8219810378.png)](https://diveintocode.gyazo.com/34f1735645e0520a552cfa8219810378)

Using the above as a reference, modify the Task List screen to meet the following requirements: 1.

Add "Due Date", "Priority", and "Status" items to the table header. 1.
Task priority should be displayed as 'High', 'Medium', or 'Low'. 1.
Task status should be displayed as 'Not Started', 'In Process', or 'Completed'.

### Task Registration Screen

[Image from [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/604173b369b05c3316619e51c705f80d.png)](https://diveintocode.gyazo.com/604173b369b05c3316619e51c705f80d) 1.

1. display the word "Due" on the form label for entering the due date.
Display the word "Priority" on the form label for selecting the priority. 1.
Display the word "Status" on the form label for selecting the status. 1.
The priority selection form should display "High", "Medium", and "Low". 1.
The status selection form should show "Not Started", "In Progress", and "Completed".

### Task Detail screen

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/1de5d024a82ed8993f43e3f1b59d55da.png)](https://diveintocode.gyazo.com/1de5d024a82ed8993f43e3f1b59d55da) 1.

Add "Due Date", "Priority", and "Status" items. 1.
Task priority should be displayed as "High", "Medium", or "Low". 1.
Task status should be displayed as "Not Started", "In Process", or "Completed".

### Task Edit Screen

[Image from! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/1ef61e626ed0eb6809fde98dd79812ea.png)](https://diveintocode.gyazo.com/1ef61e626ed0eb6809fde98dd79812ea) 1.

To display the word "Due" on the form label for entering the due date. 1.
Display the word "Priority" on the form label for selecting the priority. 1.
Display the word "Status" on the form label for selecting the status. 1.
The priority selection form should display "High", "Medium", and "Low". 1.
The status selection form shall show "Not Started", "In Process", and "Completed".

### Functional Requirements 1.
When registering or editing a task, it should be possible to register the due date, priority, and status. 1.
When registering or editing a task, the following validation requirements should be added.

    |Add the following validation requirements for task registration and editing.
    |--|||.
    |If the due date is not entered, please enter the due date.
    |--|||If priority is not entered, please enter priority|||If status is not entered, please enter status
    |if status is not entered|please enter status|.

## Implement the sort function.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/fb1413b1135d9968bf17f41ce0491972.png)](https://diveintocode.gyazo.com/fb1413b1135d9968bf17f41ce0491972)

Using the above as a reference, implement a sort (sort) function that meets the following requirements: 1.

1. to sort in **ascending order** of the due date when clicking on the "Due Date" in the table header
When "Priority" of the table header is clicked, it should be sorted in **ascending order** of priority.

### Hints for sorting by expiration date: 1.

1. implement a link `{{ link_to "Sort by expiration date", sort_deadline_on: true }}` in the list screen.
1. if you click on a link with no path specified as in 1, the current page will be reloaded
1. send a parameter `$request->input('sort_deadline_on','true')` with key and value like `sort_deadline_on: true`. 1. 3.
The value of 1.3 can be retrieved by the controller by writing `$request->sort_deadline_on`.
1. conditional branching in the controller using the parameter of `params[:sort_deadline_on]` (e.g., if `$request->sort_deadline_on` has a value **, return the value sorted by the deadline, if `$request->sort_deadline_on` does not have a value **, return the value retrieved from Tasks. all, etc.)

## Implement a search function.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/b31529c9c28d0a99df71bc1bab749218.png)](https://diveintocode.gyazo.com/b31529c9c28d0a99df71bc1bab749218)

Using the above as a reference, implement a search function that meets the following requirements: 1.

1. implement a function to search by status on the list screen
Implement a function for fuzzy search by title on the list screen. 1.
Use `form` to implement the search function and set `scope: :search` (the usage of the `scope` option is explained in "Hints for searching by status 1" below). 1.
You should be able to narrow down your search by both title and status. 1.
1. use `select` for the status search form, and leave the default value empty.
1. display the word `status' in the form label for status search
Use `select` for the status search form and leave the default value empty. 1.
Title ambiguous search form label should display the word "Title" 1.
The button to execute a search should display the word "Search". 1.
The button to execute the search should have the HTML id attribute `search_task`. 1.

### What is fuzzy search?

Fuzzy search refers to a search method that uses partial matching of search conditions. For example, if you want to search for a task whose title is "Today's Task", you need to search for the exact word "Today's Task" in an exact match search. However, with fuzzy search, you can search for tasks that contain "today's" in the title by simply searching for "today's".

### Hints for implementing a search function.

By not specifying the `model` in `form` and using the `scope` option to add a setting like `scope: :search`, you can send parameters like the following.

[! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/3023facd0f95a3c4ba8f36b3e8eec02f.png)](https://diveintocode.gyazo.com/3023facd0f95a3c4ba8f36b3e8eec02f)

By using the `scope` option to specify the prefix of the parameter, you can send parameters like `"search"=>{"status"=>"not started"}`, and retrieve the value sent by the search form with `$request->search`. You can use `$request->search` to retrieve the values sent by the search form.
Note that the `scope` described here is not the same as the `scope` method defined in the model, so be careful not to confuse them.

Also, by using a conditional branch based on whether `$request->search` is present or absent, you can distinguish between cases where a search is performed and cases where it is not.
```rb
if(!empty($request->search)){}
````

### Hints for refining your search: 1.

Write a further conditional branch in the search conditional of the `index` action of the `tasks` controller.
    ```php
    if(!empty($request->search)){
        if parameter has both title and status{}
        elsif if parameter has title only{}
        else parameter has only status{}
        }
    }
    ```` 
2.If you want to search with multiple criteria, try to connect the `where` method to the `where` method.

## Refactoring

Sorting and searching logic should generally be written in the model to keep the writing in the controller lightweight.
If you have logic in the controller, move it to the model. 1.

1. move the logic for sorting and searching from the `tasks` controller to the `Task` model using the `scope` method.
2. move the logic implemented in step 2, which sorts the tasks in order of creation date, to the `Task` model.

## Add a search index.

- To put an index on the `status` column used for search.

## What is an index?

Indexes are like index information in a book, and they are created in a database to retrieve data efficiently. Indexing will speed up the time to find data, the larger the data is. Indexing a small amount of data may make the process slower, but it is a good idea to index information that is often searched or used as a key for association.

### Hints for putting up a search index

You can index the `email` column by creating and running a migration file like the one below. You can put an index on the `status` column by creating and running the following migration file.
```php
class AddIndexToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
        });
    }
}
```

## Add test items to Model Spec

Write a test that meets the following four requirements: 
1.Add the following test items to complete the test.

    [tests/Unit/TaskTest.php].
    ```php
      # omit
      Define 'search function' 
        function 'Fuzzy search for title in scope method' {
          "Tasks containing the search word will be narrowed down" 
            # use assertions to check both what was searched and what was not.
            # Check the number of test data that were retrieved
        }
        funtion 'When status search is done in scope method' {
          "Tasks that match the status exactly will be narrowed down"
            # use the assertions to check both what was searched and what was not
            # Check the number of test data that were retrieved
        }
        function 'Scope method for title fuzzy search and status search' {
          "Tasks are narrowed down to include the search word in the title and an exact match to the status" 
            # Use the assertions to check both what was searched and what was not.
            # Check the number of test data retrieved
        }
      }
      # omit
    ````

1. prepare at least three sets of test data with different values for title, due date, priority, and status, and use them in your sort and search test code, referring to the following example

    |title|end due date|priority|status|.
    |-|-|-|-|-|
    |first_task|2025-02-18|in|unstarted|
    |second_task|2025-02-17|high|initiated|
    |second_task|2025-02-17|high|starting| |third_task|2025-02-16|low|complete| 1.

1. tests must be written to verify that the code is correct.
The tests implemented in steps 1 and 2 should be modified accordingly and all tests should be successful.

Hints for testing the ### scope method

The following code is a hint for the section "When the scope method performs a fuzzy title search, tasks containing the search word are narrowed down" in the "Task Model Functionality" section.

```php
  # omit
  class SearchTest extends TestCase
 {   
    public function test_Fuzzy_search_for_title_in_scope_method()
      {
        # Create multiple test data.
        $first_task = Tasks::make(['title'=>'first_task_title']);
        $second_task = Tasks::make(['title'=>'second_task_title']);
        $third_task = Tasks::make(['title'=>'third_task_title']);
        # Example code when the title search method is defined with scope as seach_title
        # Insert the search word into the search method defined with scope.
        # Use the assertions to check both what was searched and what was not.
        # Check the number of test data that were retrieved
        $this->assertTrue($first_task->title === "first_task_title");
        $this->assertTrue($first_task->title !== "second_task_title");
        $this->assertTrue($first_task->title !== "third_task_title");
        $this->assertCount(1,$first_task->toArray());        
    }
  }
  # omit
```

## Add a test item to the System Spec.

Write tests that meet the following four requirements: 1.

1. add the following test items to `tests/Unit/TaskTest.php` and complete the test.

    [tests/Unit/TaskTest.php].
    ```php
    Define SortFuntion extends TestCase {
      # omit
        function test_When_you_click_on_the_link_Sort_by_due_date(){
          #A list of tasks sorted in ascending order by due date will be displayed
          # Use the all method to check the sort order of multiple test data
          
        }
        function test_When_you_click_on_the_link_Sort_by_priority(){
          #A list of tasks sorted by priority will be displayed.
            # Use the all method to check the order of multiple test data
        }
      #search function
        funtion test_Fuzzy_search_by_title () {
          #Only tasks containing the search word will be shown
            # use the assertions to see what is and is not shown
        }
        function test_When_searching_by_status (){
          #Only tasks that match the searched status will be shown
            # use the assertions to check both what is shown and what is not
        }
        function test_Search_by_title_and_status(){
          #Only tasks that contain the search word in the title and match the status will be shown
            # use the assertions to check both what is shown and what is not
        }
    }
    ````

1. prepare at least three sets of test data with different values for title, deadline, priority, and status, and use them in your sort and search test code, referring to the following example

    |title|end due date|priority|status|.
    |-|-|-|-|-|
    |first_task|2025-02-18|in|unstarted|
    |second_task|2025-02-17|high|initiated|
    |second_task|2025-02-17|high|starting| |third_task|2025-02-16|low|complete| 1.

1. that tests are written to verify that the code is correct.
The tests implemented in steps 1 and 2 should also be modified as necessary, and all tests should be successful.

### Hints for registering date and time in tests
If you want to enter a date in the task registration screen, you can easily register a task by inserting the date into the input value of `fill_in` using the `Date` class or something similar. Let's find out how to use the `Date` class.

## Modify the initial data

Modify the contents of the seed data to meet the following requirements.

- Referring to the following example, at least 10 task data with different values for title, end due date, priority, and status should be able to be registered (the "content" is optional)

|title|content|end due date|priority|status|
|-|-|-|-|-|
|first_task|optional|2025-02-18|in progress|not started|
|second_task|optional|2025-02-17|high|in-progress|
|third_task|optional|2025-02-16|low|complete|

## Reflect the changes to Heroku and submit the initial data.

Use the following command to reflect the changes on the `step3` branch to the Heroku `master` branch.
    ````
    $ git push heroku step3:master
    ```
    If an error occurs due to existing data, use the following command to reset the data on Heroku, and then push it to the Heroku `master` branch again.
    ````
    $ heroku pg:reset
    $ heroku run rails db:migrate
    ``` 2.
2. submit the seed data to Heroku using the following command
    ```
    $ heroku run rake db:seed
    ```

## Passing Requirements.

## Basic requirements.

1. the issue must have been submitted with a pull request raised (not merged)
1. heroku master branch should reflect step 3.
1. at least 10 task data with different title, content, due date, priority, and status values can be registered using seed data
1. seed data should be submitted to Heroku.

### Coding Requirements 1.

Columns should be added to the `tasks` table as per requirements. 1.
Deadline input form should be implemented using `date_field`. 1.
Priority input form should be implemented using `select` 1.
Using `enum` to assign `0` to low priority, `1` to medium priority, and `2` to high priority. 1.
Using `select` for status entry forms 1.
Using `enum` to assign `0` to status 'not started', `1` to status 'in progress', and `2` to status 'completed'. 1.
1. leave the default values of the priority and status entry forms in the task registration screen blank
Use `form_with` to implement the search function and set `scope: :search`. 1.
Use `select` for the status search form, and leave the default value empty. 1.
Add an HTML id attribute `search_task` to the button to perform the search. 1.
1. move the sorting and searching logic from the `tasks` controller to the `Task` model using the `scope` method.
1. move the logic implemented in step 2 for sorting by creation date to the `Task` model.
1. index the `status` column used for search.

### Screen Requirements 1.

To add `end due date`, `priority`, and `status` items to the table header of the task list screen. 1.
To add items of `end due date`, `priority` and `status` to the task detail screen. 3.
Task priority should be displayed as 'High', 'Medium', or 'Low' in the Task List screen and Detail screen. 4.
Task status should be displayed as 'Not Started', 'In Process', or 'Completed' in the Task List and Details screens.
To display the word "Due Date" on the form label for entering the due date of a task. 1.
The word "Priority" should be displayed on the form label for selecting the priority of the task. 1.
To display the word 'Status' on the form label to select the status of the task. 1.
The priority selection form in the Task Registration screen and the Edit screen should display the words 'High', 'Medium', and 'Low'. 1.
The status selection form in the Task Registration screen and the Edit screen should display 'Not Started', 'In Process', and 'Completed'. 1.
The word "Status" should be displayed in the form label of status search. 1.
The text "Title" should be displayed on the form label for fuzzy search. 1.
The word "Search" should be displayed on the button to execute a search.

### Functional Requirements 1.

When registering or editing a task, it should be possible to register the deadline, priority and status. 1.
To add validation requirements for task registration and editing. 1.
To be sorted in ascending order** of due date when clicking "Due Date" in the table header. 1.
When clicking on "Priority" in the table header, it should be sorted in order of priority**. 1.
To implement a function to search by status on the list screen. 1.
To implement a function to search by title in the list screen. 1.
To implement a function to search by title in the list screen. 1.

### Test Requirements

- **System Spec** 1.
1. to complete the added tests 1.
At least three test data sets with different values for title, due date, priority, and status shall be prepared and used in the sort and search test code. 1.
The tests should be written to verify that the code is correct. 1.
1. all tests implemented in steps 1 and 2 should be successful, with modifications as necessary.
- Model Spec** 1.
1. complete the added tests
1. prepare at least three sets of test data with different values for title, due date, priority, and status, and use them in your sorting and searching test code
The tests should be written to verify that the code is correct. 1.
1. all tests implemented in steps 1 and 2 should be successful, with modifications as necessary.

## Obtain a mentor's review

When receiving a review, be sure to check the following four items: 1.

1. if you have completed Step 3, please raise a pull request and let us know in the comments that you have completed Step 3, referring to the following.

    [! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/344d270e142b2046f1fda6932ce4afcc.png)](https://diveintocode.gyazo.com/344d270e142b2046f1fda6932ce4afcc)

Be sure to submit the issue with a pull request, and be very careful not to perform a merge. When you submit a pull request, you will see a button that says "Merge pull request", **click on this button after you have been instructed by your mentor to proceed to the next step** to merge.

    [! [Image from Gyazo](https://t.gyazo.com/teams/diveintocode/a49d80a2871fb7634ae3a881d6858f94.png)](https://diveintocode.gyazo.com/a49d80a2871fb7634ae3a881d6858f94) 

3.If you receive a comment from your mentor requesting modifications, please respond to it. **When you have completed the modification, please reflect the modification in the `step3` branch on GitHub and the `master` branch on Heroku, and submit a review request again from the comments. ** 

4.While you are waiting for the review, you can continue with the next step. In this case, be careful to create branches from master only, and not grandchild branches. Also, consider proceeding with texts and issues other than the Manyara issue to avoid complicating branch operations.




