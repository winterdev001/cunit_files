# One-to-one message function

## Goal
-** Understand the requirements for implementing the message function **

## What is the message function?
<!-textlint-disable->
The message function is a function that allows messages to be exchanged between users who are using the Web application.
Specifically, it refers to functions that allow messages to be exchanged with each other, such as LINE, WhatsApp, and WeChat.
<!-textlint-enable->
<a href="https://diveintocode.gyazo.com/a7cd7f71d9bba90a4491bdb7e861f359"> <img src = "https://t.gyazo.com/teams/diveintocode/a7cd7f71d9bba90a4491bdb7e861f359.png" alt = "Image from "600" /> </a>

This time, we will implement a function that allows such one-to-one messages to be exchanged. When the implementation in this series is completed, the following application will be completed. Please try to implement it.

https://dic-message-app.herokuapp.com/

## Requirements for message function

When implementing a new function, it is necessary to define the requirements in advance so that the development can proceed efficiently.
Here, we will consider the requirements by following the steps below.

1. Decide the screen configuration
2. Identify the required functions
3. Decide on a table design
4. Determine the table structure
5. Check what kind of association is needed

### 1. Decide the screen configuration

In order to implement a message function like LINE, it is first necessary to imagine the appearance of what kind of screen configuration should be used.
In LINE, when you select a user from the talk list, you will be taken to the message list screen with that user. In addition to this screen configuration, we will proceed with a configuration that transitions from the user list to the message list screen.
Therefore, the screen configuration is as follows.

--Conversation Index: Conversation list screen (talk list screen)
--Message Index: Message list screen
--Users Index: User list screen

<a href="https://diveintocode.gyazo.com/62e20d7469cb977feb38ae7cfc631263"> <img src = "https://t.gyazo.com/teams/diveintocode/62e20d7469cb977feb38ae7cfc631263.png" alt = "Image from Gyazo" width = "800" /> </a>

### 2. Identify the required functions

Next, let's think about what kind of functions are needed.
The following six are the requirements for the message function. LINE does not have this function for 5 and 6, but it will be implemented in this text.

1. The message screen can be displayed from the user list screen.
2. The message screen displays the speaker and content of each message in chronological order.
3. You can send a message from the message screen.
4. Display "read" or "unread" so that the other party can tell if the message has been read.
5. On the message screen, display the latest 10 items.
6. Click the "Show all messages" link to see all the messages.

### 3. Table design

Next, let's think about what kind of table we need. In addition to a table of users and messages, we also need a table to manage which users have conversations with each other.
Therefore, the table structure looks like this:

--`users`: A table that manages user information
--`conversations`: A table that manages which users have conversations.
--`messages`: Table that manages messages

<a href="https://diveintocode.gyazo.com/be75ea14df090f2cb0eed57034f01031"> <img src = "https://t.gyazo.com/teams/diveintocode/be75ea14df090f2cb0eed57034f01031.png" alt = "Image from Gyazo" width = "800" /> </a>

### 4. Determine the table structure

Next, let's think about the elements required for each table.

`users`: In addition to the name, you need a column to register the email address and password required for the login function.

| column | type |
|:-|:-|
| id | Integer |
| name | String |
| email | String |
| password | String |

`conversations`: Conversations are created for each combination of users. By registering the user who started the conversation as `sender` and the other party as` recipient` and registering each `id`, it is possible to identify which conversation.

| column | type |
|:-|:-|
| id | Integer |
| sender_id | Integer |
| recipient_id | Integer |

`messages`: In addition to the content of the message, a column for registering which user and which conversation is associated is required. Also, prepare `read` as a column to judge whether it is" unread "or" read ".

| column | type |
|:-|:-|
| id | Integer |
| content | text |
| user_id | Integer |
| conversation_id | Integer |
| read | boolean |

With such a table structure, messages can be displayed in the following flow.

1. You can identify which conversation you have by selecting a user from the list screen.
2. By identifying a conversation, you can retrieve all the messages exchanged in that conversation.

### 5. Table Association

Finally, let's think about the association between tables.

--`users`: One user has multiple conversations and messages.
--`conversations`: A conversation has multiple messages, as well as the user who started the conversation (`sender`) and the other user (`recipient`).
--`messages`: One message belongs to one user and belongs to one conversation.

Therefore, you need to associate as follows:

<a href="https://diveintocode.gyazo.com/c5da29b4db241cc3ec268df657e55e6f"> <img src = "https://t.gyazo.com/teams/diveintocode/c5da29b4db241cc3ec268df657e55e6f.png" alt = "Image from Gyazo" width = "600" /> </a>

This completes the confirmation of the requirements required to implement the message function.
From the following text, we will actually implement it.

## summary
-** When implementing a new function, actually develop it after identifying the necessary requirements. ** **