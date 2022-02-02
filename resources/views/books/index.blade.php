<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books</title>
</head>
<body>
    <h2>Books</h2>
    <ul>
        @foreach ($books as $book)
            <li>{{$book->title}}</li>
        @endforeach
        <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>
    </ul>
</body>
</html>