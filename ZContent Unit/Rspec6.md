
# Introduction [Manyo Co., Ltd. New employee education issues]

This issue is being used as an issue for DIVE INTO CODE with the official permission of Manyo Co., Ltd. The text has been partially modified to match the format of the DIVE INTO CODE assignment evaluation.

[Manyo Co., Ltd.] (https://everyleaf.com/)

## About license

The copyright is as follows.
(This is a commercial use that goes against the license, but in the case of our company, it can be used as an issue because it has been individually licensed by Manyo Co., Ltd.)

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/3275f3893e266506ab5d7509a681e00c.png)] (https://diveintocode.gyazo.com/3275f3893e266506ab5d7509a681e00c)
https://creativecommons.org/licenses/by-nc-sa/4.0/deed.ja

The URL of the original GitHub is [here] (https://github.com/everyleaf/el-training).

## How to proceed with this task with DIVE INTO CODE

Follow the steps below to proceed with this task with DIVE INTO CODE.
1. Create a development branch and work on it
2. After each step, report to the mentor that the step has been completed in the comment in the assignment submission column.
3. When reporting, include the name of the branch you worked on in the comments (the mentor will check to the point where it is complete and review it).
4. You can proceed with the next step even if you are waiting for a review. But create branches only from master, not grandchild branches
5. After the review, if a correction request is made, correct the specified part and report to the mentor that the correction has been completed again by commenting in the assignment posting column.
After completing one step, be sure to comment your report and review request in the issue post section.
Steps are set from 1 to 5.

## About the handling of "reference article (reference URL)" of this subject
In this task, even if you do not know the implementation or you have never done it, you can acquire the `self-propelled ability` to implement it by yourself by referring to the reference and external articles. Some of the steps have a `posted URL of a reference external article`.

However, ** the posted article is for reference only (quotation) and is not an official issue of our company **, so we cannot respond to questions and answers regarding the content of the article **. ** **
`" I'm having trouble implementing this part of the step, what should I do? "`, `" I don't quite understand the meaning of this description given as a hint, what does it mean? "` I can answer questions like, "I don't understand the meaning of this part of this article, which is mentioned as a reference, but what do you mean?" Please note that we cannot answer for the above reasons **.
It was
## About the coverage rate of the test of this task
In this task, the test description is included in the pass requirements of the specified steps so that you can acquire the `test` technique, which is an essential technique for practical work.

However, since the goal is not to perfect this application, the test coverage rate (app code and the percentage of tests written for that code) required by the requirements is kept to a minimum level. I'm keeping it.

If you can afford it, be sure to write a test for the parts that are not required by the requirements.

As you write your tests, we recommend that you also read the ** Reference Articles ** below. (Please note that we cannot answer the `questions regarding the content of the following article`.)

[[For beginners] Think about the policy of the test code (what should be tested. What kind of test should be written?)] (Https://qiita.com/jnchito/items/2a5d3e15761fd413657a)
It was
## Overview
### System requirements

In this task, you will develop a task management system.
The requirements of the task management system to be developed must meet the following.

――I want to register my task
--I want to be able to set an expiration date for a task
--I want to prioritize tasks
--I want to manage the status of tasks (not started / started / completed)
--I want to narrow down the tasks by status
--I want to search for a task by task name
--I want to display a list of tasks
--I want to sort based on the priority and end deadline on the list screen.
--I want to label and classify tasks
--I want to register as a user so that I can see only the tasks I registered.

We also want the following management functions to meet the above requirements.
--User management function

### Support Browser
--Support browser is assumed to be the latest version of macOS / Chrome

### About application (server) configuration
Please build using the following languages and middleware.
Use a stable version for both. Please check the recommended version of the issue displayed at the top of the text.

--PHP
--Laravel
--PostgreSQL

## Final goal of this task

At the end of this curriculum, it is assumed that you will learn the following items.

--Being able to implement basic web applications using Laravel
--Being able to publish an application using a general environment in a Laravel application
--Additional functions and data maintenance for published Laravel applications
--Learn the flow of creating and merging pull requests on GitHub. Also, learn the Git commands needed for it.
  --Being able to commit with appropriate particle size
  --Being able to write a description of the pull request properly
  ――Being able to go through the response to reviews and the correction cycle
--Being able to ask team members and related parties (this time I will be a mentor) oral or question postings at appropriate times if there are any unclear points about specifications or implementation methods.

## Recommended books
In advancing this curriculum, we recommend the following books as recommended books.

[Laravel 8 Quick Learning Practice Guide that can be used in the field] (https://book.mynavi.jp/ec/products/detail/id=93905)
In the Laravel 8 quick learning practice guide that can be used in the field, the task management system is the subject as in this task. Therefore, there are many points that will be helpful in advancing this task.

It also explains what could not be covered in this task and how to proceed with team development. Please refer to it.

## Topic collection useful for development

[Topics.md] (https://github.com/everyleaf/el-training/blob/master/docs/topics.md) It is summarized in. Please use it as needed.

### Reference article introduction

We recommend that you also read the ** reference articles ** below. (Please note that we cannot answer the `questions regarding the content of the following articles`.)

[Programming beginners are welcome! Basics and secrets for graduating from "I got an error. What should I do?" (With commentary video)] (https://qiita.com/jnchito/items/056325421b7e36f02335)

[[Beginners with videos] A fun introduction to object-oriented programming in Taiyaki class] (https://qiita.com/jnchito/items/f07e58824f92395c353b)

[[For beginners] Idioms and useful methods that can be used for refactoring in Laravel
] (Https://qiita.com/jnchito/items/dedb3b889ab226933ccf)

[Catch the latest information on PHP e-mail newsletters and RSS feeds I subscribe to] (https://qiita.com/jnchito/items/a57a42c206c2e2b487ce)

We also recommend reading our certified textbook ** Junichi Ito (2017) "Introduction to Ruby for Professionals, From Language Specifications to Test-Driven Development / Debugging Techniques" Gijutsu-Hyoronsha **. ..

## Challenge step

To proceed with the steps, create a pull request on Github for each step and ask the mentor to score each time.

[Step 1 CRUD function + PHPUnit] (https://diver.diveintocode.jp/curriculums/2755)
[Step 2 Internationalization] (https://diver.diveintocode.jp/curriculums/2756)
[Step 3 Sort function + Search function] (https://diver.diveintocode.jp/curriculums/2757)
[Step 4 Login function + Administrator function] (https://diver.diveintocode.jp/curriculums/2758)
[Step 5 Error Page + Labeling Function] (https://diver.diveintocode.jp/curriculums/2759)

As explained at the beginning of this text, this task is a step-up task to acquire the `self-propelled ability` to be implemented by oneself. However, when you research and develop from design to implementation by yourself, you may be worried about where to start from the beginning. Therefore, as a reference for the development process, let's proceed according to the steps specified for each text.