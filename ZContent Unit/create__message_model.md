#Create a message model

## Goal
-** Create a `Message` model for the message **

## Creating a Message model

The `messages` table requires the following columns:

| column | type |
| --- | --- |
| id | Integer |
| content | text |
| user_id | Integer |
| conversation_id | Integer |
| read | boolean |

Run the following command to create a `Message` model with the above columns.

```
$ php artisan make:model Message -m
```

Let's edit the created migration file as follows.

```php
#omit
class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('conversation_id');
            $table->foreign('conversation_id')->references('id')->on('conversations')->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->nullable(false);
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

}
#omit
```

`boolean` is a type of data that manages the value of` true` or `false`.
Specify a default value so that this column does not contain the extra information `nil`. Here, we want to display "unread" when `read` is` false`, so specify `false` as the default value.

After editing, let's execute the migration.

```
$ php artisan migrate
```

## Editing the Message model

Next, let's edit the `Message` model. Edit the code as follows:

[app / Models / Message.php]

```php
#omit
class Message extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    protected $casts = [
        'created_at' => 'date_format:m/d H:i',
    ];

}
```

I will explain each of the above codes.

```php
 return $this->belongsTo(User::class,'user_id');
 return $this->belongsTo(Conversation::class,'conversation_id');
```

```php
    protected $casts = [
        'created_at' => 'date_format:m/d H:i',
    ];
```

[`Date mutators`] (https://laravel.com/docs/5.4/eloquent-mutators#date-mutators" doc ") is a method to format date data.

If you display the `create_at` column as it is, it will be as follows.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/791a54115c76ca0297a847cc48a69648.png)] (https://diveintocode.gyazo.com/791a54115c76ca0297a847cc48a69648)

As it is, there are many display items and the notation is difficult to understand. Therefore, by defining a unique method called `$casts` to describe it as ` 'created_at' => 'date_format:m/d H:i'`, it will be as follows. You can convert it to a date and time that is easy to see.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/1238cbd4acc20ff67a485f36c55a974c.png)] (https://diveintocode.gyazo.com/1238cbd4acc20ff67a485f36c55a974c)

The same functionality can be achieved by saving timestamps as is and change its format during displaying the data to laravel views using `format` method  as follows: 

```php
#omit
{{$message->created_at->format('m/d H:i')}}
#omit
```

## summary
-** The message model needs to be tied to the conversation and the user. ** **
-** By using the `strtotime` method, you can change the display items and notation of the date and time. ** **