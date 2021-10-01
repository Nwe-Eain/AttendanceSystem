@extends('layouts.topheader')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css')}}">

<div class="row">
    <div class="container emp-profile">
            <div class="container">
                <div class="section-title mt-4 mb-4">
                    <h5>
                        Employee Profile
                    </h5>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div><br/>
                @endif
                @if ($errors->any())
                    <div class="alert alert-success">
                    <ul> 
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    </div><br/>
                @endif
            </div><hr>
        
            <div class="row">
                <div class="col-md-8 profile-head"><br>
                    <p> <span id="name"> Name :  {{ $emp['emp_name']}} </span> </p>
                    <p> <span id="position"> Position : {{ $emp['emp_position']}} </span> </p>
                </div>
                <div class="col-md-4" style="text-align: right;">
                    <a class="btn" href="{{url('employee/editprofile')}}" style="font-size: 14px;color:rgb(7, 92, 32)"> <i class="fa fa-edit"></i> Edit Profile </a>
                </div>
            </div><hr>
         
           
            <div class="row">
                @if (count($skill)>0)
                    <div class="col-md-2"><br>
                     <div class="profile-work">
                        <p style="font-size: 16px;color:rgb(33, 74, 207)">SKILLS</p> <hr>
                        @foreach ($skill as $s)
                        <p> {{ $s['emp_skill']}}</p>
                        @endforeach
                      </div>
                    </div> 
                @endif

                <div class="col-md-8">  
                    <div class="container">
                        <input class="radio" id="one" name="group" type="radio" checked>
                        <input class="radio" id="two" name="group" type="radio">
                        <div class="tabs">
                            <label class="tab" id="one-tab" for="one"> About </label>
                            <label class="tab" id="two-tab" for="two"> Skills </label>
                        </div>
                        <div class="panels container-fluid">
                            <div class="panel" id="one-panel">
                                <div class="panel-title mb-3">  Profile Detail </div>
                                <hr>
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label"> EmpNo </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="empno" class="form-control" id="data" value="{{$emp['emp_no']}}" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">Email</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="mail" class="form-control" id="data" value="{{ $emp['emp_email']}}" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">NRC</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="nrc" class="form-control" id="data" value="{{ $emp['emp_nrc']}}" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">Date of Birth</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="email" class="form-control" id="data" value="{{ dateCovert($emp['emp_email'])}}" disabled="true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label"> Gender </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="gender" class="form-control" id="data" value="{{ $emp['gender']}}" disabled="true">
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">Phone</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="phno" class="form-control" id="data" value="{{$emp['emp_phno']}}" disabled="true">
                                        </div>
                                     </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">Address </label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="area" style="font-size: 13px;"> {{ $emp['emp_address']}} </textarea>
                                        </div>
                                     </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-control" id="label">Joined Date</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="phno" class="form-control" id="data" value="{{dateCovert($emp['emp_joindate'])}}" disabled="true">
                                        </div>
                                    </div>
                                 </form>
                            </div>

                            <div class="panel" id="two-panel">
                                  <div class="panel-title">Add Skills</div><br><br>
                                  <form method="post" action="{{ url ('employee/addskill') }}">
                                     @csrf

                                        <input type="hidden" value="{{ $emp['id']}}" name="empid">
                                     <div class="field_wrapper">
                                        <div style="margin-bottom:14px;" >
                                            <input type="text" name="emp_skills[]" value="" id="emp_skill" class="emp_skill" required/>
                                        <a href="javascript:void(0);" class="add_button" title="Add field">
                                            <span class="fa fa-plus-circle" aria-hidden="true"></span>
                                        </a>
                                        </div>
                                     </div><br><br>
                                        <button type="submit" name="addskill" class="btn btn-success btn-sm" style="width: 80px;"> <i class="fa fa-plus-square"></i> Add </button>
                                        <button type="reset" name="reset" class="btn btn-sm btn-danger" style="width: 80px;"> <i class="fa fa-trash"></i> Cancel</button>
                                </form>
                            </div>
                         </div>
                     </div>
                </div>
            </div>                 
   </div>
</div>   

@endsection
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/profile.js')}}"></script>

<?php
// change date m/d/y
function dateCovert($date)
    {
    $originalDate = $date;
    $newDate = date("m/d/Y", strtotime($date));
    
    return $newDate;
    }
?>

