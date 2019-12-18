<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .separator{
            width:1.5px;
            height:25px;
            background-color:orangered;
        }

        #time{
            margin: 0 40px 0 15px;
            font-size: 12px;
            cursor:default;
        }

        .ask{
            font-size: 14px;
            border-radius: 3px;
            padding: 4px 8px;
            background-color: #e3342f;
            color: white;
            text-decoration: none;
        }
        .ask:hover{
            background-color: #d0211c;
            color: white;
            text-decoration: none;
        }
        .question-form>div{
            margin-bottom: 15px;
            width: 100%;
        }
        .question-form>div:nth-last-child(1){
            margin-bottom: 0;
        }

        .profile-picture{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            box-shadow: 0px 0px 1px 0.5px black;
        }
        #app{
            font-size: 17px;
        }
        .heading{
            font-weight: bold;
            background-color: white;
            padding:20px;
            border: solid 1px lightgrey;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a style="font-size: 23px;"class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Bjora') }}
                </a>
                <span class="separator"></span>
                <span id="time"></span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                            @if(\Illuminate\Support\Facades\Route::currentRouteName() != "question")
                                <li class="nav-item">
                                    <a class="ask" href="{{url('/question')}}">Ask Question</a>
                                </li>
                            @endif
                            @if(Auth::user()->role == "admin")
                                {{-- khusus utk admin --}}
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Manage
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Manage User</a>
                                        <a class="dropdown-item" href="#">Manage Question</a>
                                        <a class="dropdown-item" href="{{ route('topic.index') }}">Manage Topic</a>
                                    </div>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a style="display:flex; align-items: center"id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="profile-picture" src="{{ asset("images/".Auth::user()->profile_image) }}">
                                    <p style="margin: 0 7px;">{{ Auth::user()->name }} </p>
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/profile/{id}') }}">Profile</a>
                                    <a class="dropdown-item" href="{{url("/my-question")}}">My Questions</a>
                                    <a class="dropdown-item" href="#">Inbox</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script defer>
        //show current time
        (function showTime() {
            let date = new Date();
            let monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];
            let day = date.getDate();
            let monthIndex = date.getMonth();
            let year = date.getFullYear();
            let hour = date.getHours();
            let minute = date.getMinutes();
            let second = date.getSeconds();
            document.getElementById('time').innerHTML = day + ' ' + monthNames[monthIndex] + ' ' +
                year + ' - ' + ((hour < 10) ? '0'+hour : hour) + ':' + (minute < 10 ? '0'+minute : minute) + ':' + (second < 10 ? '0'+second : second);

            setTimeout(showTime, 1000);
        })();
    </script>
</body>
</html>
