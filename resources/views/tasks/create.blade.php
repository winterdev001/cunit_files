<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>task</title>
</head>
<body>
    @if (session('status'))
        <div class="alert ">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{-- {{$errors}} --}}
        @foreach ($errors->all() as $error)
            {{$error}}<hr>
        @endforeach
    </div>
    @endif
    <form action="/tasks" method="POST" >
        @csrf
        Title: <input type="text" name="title"  > </br>
        Content: <input type="text" name="content"  > </br>
        Status: <input type="text" name="status"  > </br>
        Priority: <input type="text" name="priority"  > </br>
        Deadline: <input type="text" name="deadline"  > </br>
        <input type="submit" value="Save" > </br>
    </form>
</body>
</html>