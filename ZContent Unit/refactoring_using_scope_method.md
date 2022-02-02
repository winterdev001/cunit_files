#Refactoring using scope method

## Goal
-** You will be able to eliminate the fat controller by using the scope method **

## Check the code to refactor

In the text that creates the `conversations` controller, I wrote the following code:

[app /Http/ Controllers / ConversationsController.php]

```php
#omit
class ConversationsController extends Controller
{
    public function index()
    {
        $conversations = Conversation::where('sender_id',Auth::user()->id)
                        ->orWhere('recipient_id',Auth::user()->id)->get();

        return view('conversations.index')->with(['conversations'=>$conversations]);
    }

    /**
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

In this code, the part of the query using the `where` and` or` methods is very confusing.
Ideally, the logic should be in the model.
So, use the [`scope`] (https://laravel.com/docs/8.x/eloquent#local-scopes" doc ") method to cut out the query and migrate to the model. Let's do it. As a result, the bloated controller (fat controller) can be eliminated.

## index Refactor the action

Actually, let's cut out the following query of the `index` action using` scope`.

```php
where('sender_id',Auth::user()->id)->orWhere('recipient_id',Auth::user()->id)->get();
```

Add the following code to the `Conversation` model.

[app / Models / Conversation.php]

```php
#omit

class Conversation extends Model
{ 
    #omit
    public function scopeWithUser($query ,$current_user){
        return $query->where('sender_id',$current_user->id)->orWhere('recipient_id',$current_user->id);
    }
}
```

Here, the query is cut out with the method name `WithUser`. This will execute the query defined in the model when the `WithUser` method is called from the controller.
Therefore, the controller's `index` action can be modified as follows:

[app /Http/ Controllers / ConversationsController.php]

```php
  public function index()
    {
        $conversations = Conversation::WithUser(Auth::user())->get();
        return view('conversations.index')->with(['conversations'=>$conversations]);
    }
```

As a result, when the `index` action is called, the process is performed according to the following flow.

<a href="https://diveintocode.gyazo.com/33d10ff02996c2827073dcecf1f77883"> <img src = "https://t.gyazo.com/teams/diveintocode/33d10ff02996c2827073dcecf1f77883.png" alt = "Image from Gyazo" width = "1100" /> </a>

1. The `index` action is called
2. The `WithUser` method is called with the` current_user` argument.
3. The `WithUser` method defined in the` Conversation` model is executed
4. The query defined by `scope` is executed
5. The return value is returned in the `index` action and is assigned to` $conversations`.

By using `scope` to cut out the query in this way, you can modify the controller side to a concise and easy-to-read code.

## Refactor the create action

Similarly, cut out the following query for the `create` action.

```php
where([['sender_id','=',$request->sender_id ], ['recipient_id','=',$request->recipient_id]])->orWhere([['sender_id','=',$request->recipient_id],['recipient_id','=',$request->sender_id]])
```

Add the following code to the `Conversation` model.

[app / Models / Conversation.php]

```php
#omit

class Conversation extends Model
{ 
    #omit
    public function scopeBetween($query, $sender_id, $recipient_id){
        return $query->where([['sender_id','=',$sender_id ], ['recipient_id','=',$recipient_id]])
            ->orWhere([['sender_id','=',$recipient_id],['recipient_id','=',$sender_id]]);
    }
}
```

The controller's `create` action can be modified as follows:

[app /Http/ Controllers / ConversationsController.php]

```php
  public function store(Request $request)
    {   
        $conversation = Conversation::Between($request->sender_id,$request->recipient_id)->get();
        if(!empty($conversation)){
            $conversation = Conversation::create([
                'sender_id'=>$request->sender_id,
                'recipient_id'=>$request->recipient_id
            ]);
        }

        return redirect()->route('conversations.messages.index',$conversation);
    }
```

The final `Conversation` model looks like this:

[app / Models / Conversation.php]

```php
#omit
class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id','recipient_id'];

    public function users(){
        return $this->belongsToMany(User::class,'conversations','sender_id','recipient_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }          

    public function target_user($conversation){
        $current_user_id = Auth::id();
        if($conversation->sender_id == $current_user_id){
            return User::find($conversation->recipient_id);
        }elseif($conversation->recipient_id == $current_user_id){
            return User::find($conversation->sender_id);
        }
    }

    public function scopeWithUser($query ,$current_user){
        return $query->where('sender_id',$current_user->id)->orWhere('recipient_id',$current_user->id);
    }

    public function scopeBetween($query, $sender_id, $recipient_id){
        return $query->where([['sender_id','=',$sender_id ], ['recipient_id','=',$recipient_id]])
            ->orWhere([['sender_id','=',$recipient_id],['recipient_id','=',$sender_id]]);
    }

}
```
Start the server again and check if the message function works properly.

This completes the refactoring using the `scope` method.
Let's continue to code with the consciousness that "logic is put together in a model".

## summary
-By using ** `scope` to cut out the query to the model side, you can write the controller code in a concise and easy-to-read manner. ** **