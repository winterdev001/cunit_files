# Create a conversation model

## Goal
-** Create a `Conversation` model for conversation **

## Creating a Conversation model

The `conversations` table requires the following columns:

| column | type |
| --- | --- |
| id | Integer |
| sender_id | Integer |
| recipient_id | Integer |

Run the following command to create a `Conversation` model with the above columns.

```
$ php artisan make:model Conversation -m
``` 

Let's edit the created migration file as follows.

```php
#omit
public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id')->index();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('recipient_id')->index();
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['sender_id','recipient_id']);
        });
    }
```

Here, a unique constraint is set so that the combination of `sender_id` and` recipient_id` is not saved in duplicate. This allows you to control that the same conversation is not registered more than once.

[! [Image from Gyazo] (https://t.gyazo.com/teams/diveintocode/b237abf48f85f3002866f8e945f3530a.png)] (https://diveintocode.gyazo.com/b237abf48f85f3002866f8e945f3530a)

You can also improve the search speed for a column by indexing the column, such as `add_index table name column name`.

After editing, let's execute the migration.
```
$ php artisan migrate
```

## Editing the Conversation model

Next, let's edit the `Conversation` model. Add the code as below.

[app / Models / Conversation.php]

```php
#omit
    public function users(){
        return $this->belongsToMany(User::class,'conversations','sender_id','recipient_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
```

I will explain each of the above codes.

```php
return $this->belongsToMany(User::class,'conversations','sender_id','recipient_id');
```

In the conversation record, the `id` of the user who started the conversation is registered as` sender_id`, and the `id` of the other party is registered as` recipient_id`.
At this time, the association is divided into `sender` and` recipient` so that each user information can be acquired. This allows you to get the other party's user data using `recipient` if you started the conversation and` sender` if the other party started the conversation. Also, if you set your own model name, such as `sender` and` recipient`, you must explicitly specify the class using `model_name::class`.

## summary
-** You can set your own model name to associate by specifying the class using the `model_name::class` option. ** **
