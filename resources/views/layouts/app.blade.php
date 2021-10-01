<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Emplyoee Attendance System') }}</title>
    <link rel="shortcut icon" href ="{{asset('/img/logo.png')}}" type="image/x-icon">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet"> 
   
    <style>
        .footer {
           position: fixed;
           left: 0;
           bottom: 0;
           width: 100%;
           background-color: red;
           color: white;
           text-align: center;
        }
        
        .topnav {

        width: 100%;
        display: flex;
        flex-flow: nowrap;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        transition: .5s;
        list-style-type: none;
        opacity: inherit;
        height: 100px;
        background-color: #ffebcd;

        -moz-box-shadow: 5px 10px 16px #FFC300;
        -webkit-box-shadow: 5px 10px 16px #B7950B;
        box-shadow: outset 5px 10px 16px #e0e574;

        box-shadow:inset 5px 5px 50px #B7950B;
        box-shadow:inset -5px -5px 50px #B7950B;

        }

        #caption 
        {
        text-align: center;
        font-weight: 900;
        color: #8f5910;
        text-shadow: 2px 8px 6px rgba(0,0,0,0.2),
                    0px -5px 35px rgba(255,255,255,0.3);

        }

        header 
        {
        display: flex;
        justify-content: center;
        box-shadow: inset 0 5px 15px rgba(0,0,0,.2);  

        }
</style>
</head>
<body style="background-color: #e8ddba;background-image:url(' {{ asset('img/goldbt1.png')}}');background-size:10px;">
   
     <header >
        <div class="topnav" >
          <h2 id="topheader" class="p-4 mt-5 mb-5">
            EMPLOYEE ATTENDANCE MANAGEMENT 
         </h2>
     </div>
         </header>
   
        <!-- ======= Header ======= -->

        <main class="py-4">          
         @include('inc.messages') 
            @yield('content')
        </main>

         <!-- ======= Footer ======= -->

     <script src="{{ asset('js/bootstrap.min.js') }}" type="javascriptss"></script>
     <script src="{{ asset('js/jquery.min.js') }}"></script>
     <script src="{{ asset('js/app.js') }}"></script>
     <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
