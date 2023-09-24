<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content=`{{ csrf_token() }}`>
    <title>Todo List</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/note.png') }}">

</head>
<body>

        <div class="container h-100">
            @yield('content')
        </div>

</body>
</html>