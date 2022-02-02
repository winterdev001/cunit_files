#Create a message controller

## Goal
-** You can create a `messages` controller that handles messages **

## Creating a message controller

In the message controller, create the following actions:
--`index` action: Create an instance to display a list of messages (①) and an input form (②).

<a href="https://diveintocode.gyazo.com/38d277443ce6170bba3fec177c225d38"> <img src = "https://t.gyazo.com/teams/diveintocode/38d277443ce6170bba3fec177c225d38.png" alt="Image from Gyazo" width = "600" /> </a>

--` store` action: Save the message

First, run the following command to create a `messages` controller.

```
$ php artisan make:controller MessagesController
```

Since the message is tied to the conversation, information such as "Which conversation was the message was exchanged" is required for each action.
Therefore, let's define the process that identifies the conversation in the controller as a common process. Please add the following code.

[app / Http/ Controllers / MessagesController.php]

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Conversation;

class MessagesController extends Controller
{
    public function set_conversation($id){
        $conversation = Conversation::find($id)->get();
    }
}
```

### Creating an `index` action

Next, let's create a `index` action that displays a message list and an input form.

[app / Http/ Controllers / MessagesController.php]

```php
#omit

public function index(){
    $conversation = Conversation::find($id)->messages;
    $messages = $conversation->messages()->orderBy('created_at')->wherNotIn('user_id',Auth()->user()->id)->update(['read'=>true]);
        if(!empty($conversation)){
            $messages = Conversation::find($id)->messages;           
            $messages->where('user_id','!=',Auth()->user()->id)->push(['read'=>true]);
            if($messages->count() > 10 ){
                $messages = $messages->latest()->take(10)->get();
                return view('messages.index')->with(['messages'=>$messages, 'conversation'=>$conversation]);
            } else {
                return view('messages.index')->with(['conversation'=>$conversation, 'messages'=>$messages]);
            }
        } 
        return view('messages.index')->with(['conversation'=>$conversation]);
}
    
```

I will explain each code of the `index` action.

<a href="https://diveintocode.gyazo.com/eb9697ef2909df04a2b09272c7eb9428"> <img src = "https://t.gyazo.com/teams/diveintocode/eb9697ef2909df04a2b09272c7eb9428.png" alt = "Image from Gyazo" width = "500" /> </a>

1. Get all the messages associated with the conversation.
2. Use the [`orderBy`] (https://laravel.com/docs/8.x/queries#ordering" doc ") method to sort them in the order they were created.

<a href="https://diveintocode.gyazo.com/22cfddcecbb503d41c442294202bafb1"> <img src = "https://t.gyazo.com/teams/diveintocode/22cfddcecbb503d41c442294202bafb1.png" alt = "Image from Gyazo" width = "550" /> </a>

1. Get all the messages associated with the conversation other than your own `id`. That is, the message of the other party is acquired.
2. Using the [`update`] (https://laravel.com/docs/8.x/queries#update-statements" doc ") method, the` read` column of the message retrieved in 1. Is updated to `true` at once.

Here, when checking the message list screen, it is necessary to mark all the messages sent from the other party as read, so all the `read` columns of the other party's message are updated to` true`.

```php
if($messages->count() > 10){
      $messages = $messages->latest()->take(10)->get();
  }
```

If there are more than 10 messages, get the last (latest) 10 messages.

```php
 return view('messages.index')->with(['conversation'=>$conversation, 'messages'=>$messages]);
```

Create an instance for the form that composes the message.

### `create` action creation

Next, let's create a `create` action that saves the message.

[app / controllers / messages_controller.rb]

```php
  #omit
  public function store(Request $request){
      $message = new Message();
        $message->content = $request->content;
        $message->user_id = $request->user_id;
        $message->conversation()->associate($request->conversation);
        
  
        if($message->save()){
            return redirect()->back();
        }else {
            return redirect()->route('conversations.index');
        }          
  }
```

Describes the code for the `create` action.

```php
  $message->content = $request->content;
        $message->user_id = $request->user_id;
        $message->conversation()->associate($request->conversation);
```

Generate a message associated with the conversation using the parameters sent from the message input form.

```php
    if($message->save()){
            return redirect()->back();
        }else {
            return redirect()->route('conversations.index');
        }    
```

If the message can be saved, it will be transitioned to the message list. If you cannot save it, you can use `redirect` to display the list screen with the contents of the input form left.

## summary
-** The `index` action gets the other party's message, marks it as read, and creates an instance for the input form. ** **