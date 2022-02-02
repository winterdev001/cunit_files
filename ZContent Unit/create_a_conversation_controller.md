# Create a conversation controller

## Goal

-**Create a `conversations` controller that handles conversations**

## Advance preparation

To implement the message function, it is necessary to prepare an application that implements the login function.
Clone your application from the Sample Repository (<https://github.com/diveintocode-corp/cdp_web_rails_conversation_practice>).

After cloning, execute the following command.

```bash
$ composer install
$ npm install or yarn  
$ copy .env.example .env
$ php artisan key:generate
```

Open your `.env` file and change the database name `(DB_DATABASE)` to whatever you have,
username `(DB_USERNAME)` and password `(DB_PASSWORD)` field correspond to your configuration.

```bash
$ php artisan migrate
```

## Implementation procedure

In the text from here, follow the steps below to implement the message function.

1. Routing settings
2. Creating a `conversations` controller
3. Creating a `Conversation` model
4. Creating a `messages` controller
5. Creating a `Message` model
6. Create a view to display the message

## Set up routing

First of all, we will go from the routing settings.
Because `messages` is a child element of`conversations`
Routing nests `messages` within`conversations`.

[config / routes.rb]

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
Route::resource('conversations.messages',MessagesController::class);
```

Nesting the routing has the following effects:

1. You can judge which record is associated with from the path.

A path such as `http: // localhost: 8000 / conversations / 1 / messages` will be issued. In this case, you can tell from the path that `id` is a list of conversation messages with 1.

2. The parameter can include the `id` of the associated parent element.

`conversation` is the parent element and`message` is the child element. In this case, the following routing is generated:

[![Image from Gyazo](<https://t.gyazo.com/teams/diveintocode/4b2754931dbc1e7938dee42086b79a61.png>)](<https://diveintocode.gyazo.com/4b2754931dbc1e7938dee42086b79a61>)

In this way, a path containing the `id` of the parent element is issued. This allows you to get the `id` of the parent element by writing something like`request->conversation_id`.

## Create a conversation controller

The conversation controller creates a `index` action that displays a list of all conversations and a`create` action that creates a new conversation.

First, run the following command to create a `conversations` controller for the conversation.

```
php artisan make:controller ConversationsController
```

Next, create a `index` action. Please add the following code.

[app / Https/ Controllers / ConversationsController.php]

```php
#omit
class ConversationsController extends Controller
{ 
    public function index()
    {
        $conversations = Conversation::where('sender_id',Auth::user()->id)->orWhere'recipient_id',Auth::user()->id)->get();

        return view('conversations.index')->with(['conversations'=>$conversations]);
    }
}
```

Here, I am using [`where`](https://laravel.com/docs/8.x/eloquent-relationships#chaining-orwhere-clauses-after-relationships "doc") and [`orWhere`](https://laravel.com/docs/8.x/eloquent-relationships#chaining-orwhere-clauses-after-relationships) method to search for conversations that I have registered as `sender_id` or`recipient_id`. In other words, I'm only getting the conversations I'm involved in. This will show only the conversations you are interacting with in the conversation list.

Next, create a `store` action that creates a new conversation. Please add the following code.

[app / Https/ Controllers / ConversationsController.php]

```php
#omit
class ConversationsController extends Controller
{ 
    #omit
    **
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $conversation = Conversation::where([['sender_id','=',$request->sender_id ], ['recipient_id','=',$request->recipient_id]])
        ->orWhere([['sender_id','=',$request->recipient_id],['recipient_id','=',$request->sender_id]])->get();
                                    
        if(!empty($conversation)){
            $conversation = Conversation::create([
                'sender_id'=>$request->sender_id,
                'recipient_id'=>$request->recipient_id
            ]);
        }

        return redirect()->route('conversations.messages.index',$conversation);
    }
}
```

Let's take a closer look at the code for the `create` action.

```php
$conversation = Conversation::where([['sender_id','=',$request->sender_id ], ['recipient_id','=',$request->recipient_id]])
        ->orWhere([['sender_id','=',$request->recipient_id],['recipient_id','=',$request->sender_id]])->get();
                                    
        if(!empty($conversation)){
            $conversation = Conversation::create([
                'sender_id'=>$request->sender_id,
                'recipient_id'=>$request->recipient_id
            ]);
        }
```

This code uses the `where` and`orWhere` methods to check if a conversation between the users has existed in the past (①) and returns the result as an array (②). If the conversation exists, use the if statement from the array to take the conversation. Get it (③) and assign it to $conversation (④).

[![Image from Gyazo](<https://t.gyazo.com/teams/diveintocode/749ad773f16663ee1a5cd41e66e4b110.png>)](<https://diveintocode.gyazo.com/749ad773f16663ee1a5cd41e66e4b110>)

If no conversation exists (1), an empty array is returned (2). Since the if statement returns`null` if the element cannot be obtained (③), `null` is assigned to $conversation (④).

[![Image from Gyazo](<https://t.gyazo.com/teams/diveintocode/53ba422f7ee0e94cdbdc804eeb860ca6.png>)](<https://diveintocode.gyazo.com/53ba422f7ee0e94cdbdc804eeb860ca6>)

Also, when checking whether a conversation exists as described above, for example, if the conversation between the user whose `id` is 1 and the user whose`id` is 2 is divided as follows, the conversations between the same users will be divided as follows. It becomes an unnatural state that there are two conversations.

[![Image from Gyazo](<https://t.gyazo.com/teams/diveintocode/b854fad213b3a98ccfb95290f525be7c.png>)](<https://diveintocode.gyazo.com/b854fad213b3a98ccfb95290f525be7c>)

Therefore, in order to confirm that neither of the above patterns exists, we also use `orWhere` to verify the opposite pattern.

[![Image from Gyazo](<https://t.gyazo.com/teams/diveintocode/2ed9c4c6967ba2d4dddd8603a737c6e9.png>)](<https://diveintocode.gyazo.com/2ed9c4c6967ba2d4dddd8603a737c6e9>)

This prevents new conversations between the same users from being created.

```php
return redirect()->route('conversations.messages.index',$conversation);
```

Here, transition to the message list screen associated with `$conversation`.

## summary

-**By nesting routes, you can include the parent `id` in paths and parameters.**
-**By using `if assignment expression` or `unless assignment expression`, conditional branching is possible at the same time as assignment.**
