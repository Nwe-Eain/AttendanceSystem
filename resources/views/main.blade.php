@extends('layouts.topheader')

@section('content')
    <!-- Styles -->
<link rel="stylesheet" type="text/css" href="/css/main.css">

<div class="container" style="background: white;min-height:500px;"> 
    <div class="col-sm-12 col-md-12 text-white"><br>
        <div class="mbh-information mbh-information-box">
            Welcome : {{Session()->get('employee')->emp_email}} 
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6" > 
            <div class="clock">
                <div class="outer-clock-face">
                    <div class="marking marking-one"></div>
                    <div class="marking marking-two"></div>
                    <div class="marking marking-three"></div>
                    <div class="marking marking-four"></div>
                    <div class="inner-clock-face">
                    <div class="hand hour-hand"></div>
                    <div class="hand min-hand"></div>
                    <div class="hand second-hand"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 mb-4"> 
            @if(count($attendances)>0)
                 @foreach($attendances as $attendance)
                      <div class="container" style="margin-top: 30px;"><br><br>
                            <div class="row">
                                <div class="col-md-4">
                                @if($attendance->status == true)
                                    <a class="btn button float-right disabled text-success" style="font-size:14px; " href="/attendances/create">
                                        <i class="fa fa-check-square text-success"></i> Check in at
                                        {{$attendance->checkin}}
                                    </a>
                                @endif
                                </div>
                                <div class="col-md-4">
                                @if($attendance->checkout == null)   
                                    <a class="btn btn-outline-info button float-right text-info" style="font-size:14px; width: 140px; " href="/attendances/{{$attendance->id}}/edit">
                                    <i class="fa fa-hand-o-down"></i>
                                        Checkout Here 
                                    </a>  
                                @else
                                    <a class="btn button float-right disabled" style="font-size:14px;margin-left:20px; width: 140px;" href="#">
                                        <i class="fa fa-check-square-o text-primary"></i> 
                                        <span class="text-primary"> Checkout at 
                                        {{$attendance->checkout}}
                                    </span>
                                    </a>  
                                @endif
                                </div>
                            </div>
                            <div class="row succesRrow mt-4"><br><br>
                            @if($attendance->checkout == null)   
                            <div class="mbh-tip mbh-notification-box">
                                You are Work In!! 
                            </div>                     
                            @else
                            <div class="mbh-tip mbh-notification-box">
                                Now your are Checkout
                            </div>  
                            @endif
                            </div>
                            <div class="row succesRrow mt-4"><br><br>
                            @if($attendance->checkout == null)                        
                            <div class="mbh-notice mbh-notification-box">
                                {{Session()->get('employee')->emp_name}}
                                Workin at {{$attendance->checkin}}  
                            </div>
                            @else
                            <div class="mbh-notice mbh-notification-box"> {{Session()->get('employee')->emp_name}}
                                Workout at {{$attendance->checkout}}  
                            </div>
                            @endif
                            </div>
                    </div>
              @endforeach
                <!--if employee not still workin -->
                @else
                <div class="container mb-3"><br><br>
                    <div class="row">
                        <div class="col-md-4 ">
                            <a class="btn btn-outline-info button float-right text-info" style="font-size:16px; width: 120px; " href="/attendances/create">
                            <i class="fa fa-hand-o-up text-info" ></i>
                            CheckIn 
                            </a>
                        </div>
                        <div class="col-md-4 ">
                            <a class="btn btn-outline-warning button float-right text-info disabled" style="font-size:16px; width: 120px; " href="">
                            <i class="fa fa-hand-o-down text-info" ></i>
                            CheckOut 
                            </a>
                        </div>
                    </div> <br><br>
                    <div class="row mt-4 mt-4">
                    <div class="mbh-warning mbh-warning-box mt-4">
                            You are not WorkIn                            
                    </div>
                    </div>
                    <div class="row">
                    <div class="mbh-warning mbh-warning-box">
                        You need to click CheckIn                           
                    </div>
                    </div>
                </div>
               @endif       
            </div>
        </div>
    </div>  
</div>
</div>
<script type="text/javascript" src="{{asset('js/clock.js')}}"></script>
@endsection