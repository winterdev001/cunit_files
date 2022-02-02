#Create a view

## Goal
-** Create the view required to display the message **


## Create a conversation list screen

First, create a `index.blade.php` file under the` resources/views/conversations/index.blade.php` directory.
Write the following code in this file to display the conversation list.

[resources/ views/ conversations/ index.blade.php]

```php
<table>
  <thead>
    <h2> Conversations </h2>
  </thead>
  <tbody>
    @foreach ($conversations as $conversation)
    <tr>
      <td>        
          <a href="/conversations/{{$conversation->id}}/messages" class="btn btn-warning">
              {{$conversation->target_user($conversation)->name}}
          </a>
        </td>
    </tr>
    @endforeach
  </tbody>
</table>
```

`$conversation->target_user($conversation)->name` shows the name of the person you are talking to. The `target_user` method is a unique method for calling the conversation partner. Let's define this `target_user` method in the` Conversation` model.

[app / Models / Conversation.php]

```php
#omit
    use Illuminate\Support\Facades\Auth;  
  

    public function target_user($conversation){
        $current_user_id = Auth::id();
        if($conversation->sender_id == $current_user_id){
            return User::find($conversation->recipient_id);
        }elseif($conversation->recipient_id == $current_user_id){
            return User::find($conversation->sender_id);
        }
    }
```

This code will be explained separately.

```php
if($conversation->sender_id == $current_user_id){
    return User::find($conversation->recipient_id)
}
```

If the user id that started the conversation is the same as the logged-in user id, the user corresponding to the user id of the other party in the conversation is acquired.

```php
elseif($conversation->recipient_id == $current_user_id){
    return User::find($conversation->sender_id)
}
```

If the user id of the conversation partner is the same as the logged-in user id, the user corresponding to the user id who started the conversation is acquired.

The `target_user` method results in the user instance of the conversation partner being returned as the return value in either case. Laravel methods take advantage of the fact that the last evaluated expression is the return value. As a result, the name of the other party is displayed on the conversation list screen.

Next, let's add a link to the header so that we can access the conversation list screen.

[resources / views / layouts / app.blade.php]

```php
  <body>
    # omit
  </body>

    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="users/{{auth()->user()->id}}" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                Profile
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>            
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('conversations.index') }}">Conversation Index</a>
        </li>
    @endguest
    </body>
```

## Create a message list screen

Next, let's create a message list screen. Create a `index.html.erb` file under the` app / views / messages` directory.
In this file, write the following code to display the message list and the message submission form.

[resources / views / messages / index.blade.php]

```php
     @if(count($conversation) > 10)
        <a href="/conversations/{'show_all'=>'true'}/messages">Show all messages</a>
    @endif

    @foreach($messages as $message)
    @if($message->content != '')
        <div>{{$message->user->name}} {{$message->created_at->format('m/d H:i')}}</div>
        <div>{{$message->content}}</div>
        <div>
        @if($message->user == auth()->user())
            {{$message->read ? 'Read' : 'Unread'}}
        @endif
        </div>
        <hr>
    @endif
    @endforeach
    {!! Form::model( ['conversations.messages.store']) !!}
    {!! Form::textarea('content',null) !!}
    {!! Form::hidden('user_id', auth()->user()->id) !!}
    {!! Form::submit('Send Message') !!}
    {!! Form::close() !!}
```

I will explain the above code.

```php
 @if(count($conversation) > 10)
    <a href="/conversations/{'show_all'=>'true'}/messages">Show all messages</a>
 @endif
```

Here, if there are more than 10 messages, you will see the link "Show all messages".
Also, if you do not specify a path for `href` as above, the current page will be reloaded. When using `href`, you can issue your own parameters by specifying` key: value` as an option, such as `'show_all'=>" true "`.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/57d60ecd98314a1521cc9f7339c4bf7f.png)] (https://diveintocode.gyazo.com/57d60ecd98314a1521cc9f7339c4bf7f)

Edit the `index` action of the` messages` controller so that all messages are displayed when `show_all=>" true "` is sent as a parameter:

[app / Http/ Controllers / MessagesController.php]

```php
#omit
  if($messages->count() > 10 && $request->show_all != 'true'){
      $messages = $messages->latest()->take(10)->get();
  } 
```

By doing this, if `show_all=>" true "` is sent as a parameter, the processing in `if` will not be executed and all messages will be displayed.

```php
@if($message->user == auth()->user())
    {{$message->read ? 'Read' : 'Unread'}}
@endif
```

`$message->read ? 'Read' : 'Unread'` is a notation called a ternary operator and has the following syntax.

** Conditional expression ? True expression: False expression **

If the conditional expression is `true`, the expression on the left of`: `is executed, and if it is` false`, the expression on the right is executed.
In other words, in this code, if it is a message you sent, "read" is returned if `$message->read` is` true`, and "unread" is returned if it is `false`.

```php
{!! Form::model( ['conversations.messages.store']) !!}
{!! Form::textarea('content',null) !!}
{!! Form::hidden('user_id', auth()->user()->id) !!}
{!! Form::submit('Send Message') !!}
{!! Form::close() !!}
```

By specifying multiple models in `Form::model` as described above, the path corresponding to the nested routing will be issued.
Let's check the path when calling the `create` action of the message by executing the` php artisan route:list` command.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/d04aa6a073bfc16c2e04df897f5b42dd.png)] (https://diveintocode.gyazo.com/d04aa6a073bfc16c2e04df897f5b42dd)

If the model order is `[$message, $conversation]`, the path `/conversations/{conversation}/messages/create` will be issued and an error will occur. Be sure to specify from the outside of the nest.

```php
    {!! Form::hidden('user_id', auth()->user()->id) !!}
```

By using `Form::hidden` and specifying the column name and` value`, values ​​other than the input value can be included in the parameter.

## Create a user list screen

Finally, create a user list screen so that users can freely select and exchange messages.
First, add the `index` action to the` users` controller.

[app /Http / Controllers / UsersController.php]

```php
  #omit
  public function index(){
      $users = User::all();
      return view('users.index')->with('users'=>$users);
  }
```

Next, edit the routing so that the `index` action of the` users` controller created above is called.

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ConversationsController;
use App\Http\Controllers\UsersController;

Route::resource('conversations.messages',MessagesController::class);
Route::get('/conversations',ConversationsController::class);;
Route::resource('users', UsersController::class)->only(['index', 'show', 'store', 'create']);
```

Next, create a `index.blade.php` file under the` resources / views / users /` directory and write the following code.

[resources / views / users/ index.blade.php]

```php
<h2> Users </h2>
@foreach($users as $user)
    @if($user->id != auth()->user()->id)
        <li>
            <a href="/users/{$user}">{{$user->name}}</a>
            <form action="/conversations" method="post">
                @csrf
                <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
                <input type="hidden" name="recipient_id" value="{{$user->id}}">
                <button type="submit">message</button>
            </form>
        </li>
    @endif
@endforeach
```

I will explain each of the above codes.

```php
@if($user->id != auth()->user()->id)
```

This code will show users other than yourself.

```php
<form action="/conversations" method="post">
    @csrf
    <input type="hidden" name="sender_id" value="{{auth()->user()->id}}">
    <input type="hidden" name="recipient_id" value="{{$user->id}}">
    <button type="submit">message</button>
</form>
```

Here, by specifying the link destination to `action="/conversations" ` and setting the method to `method="post"` the `store` action of the conversations controller is called .

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/aa20d503de84f1dcf896f23dac1648dc.png)] (https://diveintocode.gyazo.com/aa20d503de84f1dcf896f23dac1648dc)

Next, let's add a link to the header so that we can access the user list screen.

[resources / views / layouts / app.blade.php]

```php
  <body>
  # omit
    <li class="nav-item">
        <a class="nav-link" href="{{ route('conversations.index') }}">Conversation Index</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">User Index</a>
    </li>
  # omit
  </ body>
```

This completes the implementation of the one-to-one message function.
Start the server and check if the following four functions work properly.

1. The user list, conversation list, and message list screens are displayed respectively.
2. Messages can be sent and are displayed in the order they were sent.
3. If you enter 11 or more messages, the "Show all messages" link will be displayed.
4. When the recipient confirms the message, "Unread" is updated to "Read".

** User list screen **

<a href="https://diveintocode.gyazo.com/b4350c1a4f96c5d73597c15537be2436"> <img src = "https://t.gyazo.com/teams/diveintocode/b4350c1a4f96c5d73597c15537be2436.png" alt = "Image from Gyazo" "400" /> </a>

** Conversation list screen **

<a href="https://diveintocode.gyazo.com/2da387c012b4de73a5878550bf4c72ba"> <img src = "https://t.gyazo.com/teams/diveintocode/2da387c012b4de73a5878550bf4c72ba.png" alt = "Image from Gyazo" width = "400" /> </a>

** Message list screen **

<a href="https://diveintocode.gyazo.com/ef622aca1cebdf2c060d7498185fd9ec"> <img src = "https://t.gyazo.com/teams/diveintocode/ef622aca1cebdf2c060d7498185fd9ec.png" alt = "Image from Gyazo" width = "400" /> </a>

The following text describes query refactoring in the code we've implemented so far.

## summary
-** You can issue your own parameters by sending form request with method `method="post"`. ** **
-** When using `Form::model` for nested routing, you need to specify multiple models. ** **
-** By using `Form::hidden` and specifying the column name and` value`, values ​​other than the input value can be included in the parameter. ** **