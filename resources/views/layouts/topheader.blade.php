<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Emplyoee Attendance System') }}</title>
    <link rel="shortcut icon" href ="{{asset('/img/logo.png')}}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet"> 

    <!-- for export -->
    <link href="{{asset('css/datatables.min.css')}}" rel="stylesheet">

<style>
    .footer {
        position:relative;
        padding: 14px;
        width: 100%;
        background-color: #F0E68C;;
       -moz-box-shadow: 5px 10px 16px #FFC300;
       -webkit-box-shadow: 5px 10px 16px #B7950B;
        box-shadow: outset 5px 10px 16px #e0e574;
        color: rgb(62 66 7);
        text-align: center;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 0.7em;
        font-weight: bold;
        color: rgb(59, 36, 9);
    }  
     .topnav
    {
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
      background-color: #ffebcd;;
      -moz-box-shadow: 5px 10px 16px #FFC300;
      -webkit-box-shadow: 5px 10px 16px #B7950B;
      box-shadow: outset 5px 10px 16px #e0e574;
      box-shadow:inset 5px 5px 50px #B7950B;
      box-shadow:inset -5px -5px 50px #B7950B;

    }
  #topheader
  {
    color: #945F00 ;
    font-family:Garamond , serif;
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
          <div class="wrapper d-flex align-items-stretch" >
            <nav id="sidebar" style="background:#E1C16E;">
                <div class="custom-menu">
                  <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                  </button>
                </div>
              <div class="p-4">
                  <div class="img bg-wrap text-center py-4" >
                    <div class="user-logo">
                      <div class="img">
                        <img src="{{ asset('storage/employeeprofile/'.Session()->get('employee')->emp_img) }}" style="width:100px;height: 100px; border-radius: 50%;">
                      </div>
                      @if(Session()->get('employee')->status)
                      <span style="color:white;"> Admin </span>
                      @else
                      <span style="color:white;"> Employee </span>
                      @endif
                    </div>
                </div>
                <ul class="list-unstyled components mb-5">
                  
                  <li class="active">
                    <a href="{{route('home')}}"><i class="fa fa-tachometer" aria-hidden="true"></i>  Dashboard</a>
                  </li>

                  <li  class="active">
                     <a href="{{route('employee.profile')}}"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                  </li>

                  <li  class="active">
                  <a href="{{url('employeeAttendances')}}"><i class="fa fa-briefcase" aria-hidden="true"></i> Attendance Log</a>
                  </li>
                  @if(Session()->get('employee')->status)
                  <li  class="active">
                      <a href="/employees"><i class="fa fa-users" aria-hidden="true"></i> Employee List</a>
                  </li>
                  <li  class="active">
                    <a href="{{route('getAllList')}}">
                    <i class="fa fa-th-list" aria-hidden="true"></i> Attendance List</a>
                  </li>
                  @endif
                  <li  class="active">
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Log out </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                </ul>
              </div>
            </nav>

            <div id="content" class="p-4 p-md-5 pt-5">
              @include('inc.messages')
              @yield('content')
            </div>
           
          </div>
       </main>

         <!-- ======= Footer ======= -->



  <div class="footer">
    <div class="container">
     <div class="copyright">
       &copy; Copyright <strong><span> @</span></strong>. All Rights Reserved
    </div>
    <div class="credits mb-2">
        Designed by <a href="">Group</a>
    </div>
    </div>
  </div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="javascriptss"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script>
$(document).ready(function(){
    $('#attendancelog').DataTable({
        pageLength: 25,
        dom: 'lTfgitp',
        searching: false,
    });
});
</script>

<script>
  $(document).ready(function(){
      $('#employeelist').DataTable({
          pageLength: 25,
          dom: 'lTfgitp',
          searching: true,
          "scrollX": true
      });
      
  });
</script>


<!-- export Scripts HMS-->
<script>
  $(document).ready(function(){
      $('#attendance').DataTable({
          pageLength: 25,
          dom: '<"html5buttons"B>lTfgitp',
          searching: false,
          "scrollX": true,
          buttons: [
              {extend: 'excel', title: 'AttendanceList'},
              {extend: 'csv', title: 'AttendanceList'},
              {extend: 'pdf', title: 'AttendanceList'},
             
          ]
      });
  });

</script>

</body>
</html>

