<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
    </head>
    <body class="antialiased">
        <div id="app">
            
            <show-tasks></show-tasks>
            <ul class="navbar-nav float-end mt-2 mx-5 mb-lg-0">
                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link p-2 bg-info" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{route('logout')}}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
        </div>

        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
