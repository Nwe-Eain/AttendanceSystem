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
        </div>
        
        <div class="row">
            <div class="col-md-8 profile-head"><br>
                <p> <span id="name"> Name : {{ $emp['emp_name']}} </span> </p>
                <p> <span id="position"> Position : {{ $emp['emp_position']}} </span> </p>
            </div>
        </div><hr>

        <div class="row">
            @if (count($skill)>0)
            <div class="col-md-2">
            <br>
            <div class="profile-work">    
                <p style="font-size: 16px;color:rgb(60, 75, 124)">SKILLS</p> <hr>
                @foreach ($skill as $s)
                <p> {{ $s['emp_skill']}}</p>
                @endforeach
            </div>
                <hr>
            </div>
            @endif

            <div class="col-md-6">
                <div class="container">
                    <input class="radio" id="one" name="group" type="radio" checked>
                    <input class="radio" id="two" name="group" type="radio">
                    <input class="radio" id="three" name="group" type="radio">
  
                    <div class="tabs">
                    <label class="tab" id="one-tab" for="one"> About </label>
                    <label class="tab" id="two-tab" for="two"> Edit Skills </label>
                    <label class="tab" id="three-tab" for="three"> Upload New Profile </label>
                    </div>
                    
                     <div class="panels container-fluid">
                        <div class="panel" id="one-panel">
                            <div class="panel-title mb-3">  Edit Info </div>
                             <hr>
                            <form method="post" action="{{ route('employee.updatedata')}}">
                            @csrf     
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" class="form-control" id="data1" value="{{ $emp['emp_name']}}" required>
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">Email</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="email" class="form-control" id="data1" value="{{ $emp['emp_email']}}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">NRC</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="nrc" class="form-control" id="data1" value="{{ $emp['emp_nrc']}}" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">Date of Birth</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="dob" class="form-control" id="data1" value="{{ $emp['dateofbirth'] }}" enabled="true" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="phno" class="form-control" id="data1" value="{{$emp['emp_phno']}}" enabled="true" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-control" id="label">Address </label>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea class="form-control" id="area1" style="font-size: 13px;" name="address" required> {{ $emp['emp_address']}} </textarea>
                                    </div>
                                </div>

                                <div style="text-align: right;margin-top:20px;">
                                    <button type="submit" name="edit" class="btn btn-info btn-sm" style="width: 80px;"> <i class="fa fa-pencil" aria-hidden="true"></i> Update </button>
                                    <button type="reset" name="reset" class="btn btn-sm btn-danger" style="width: 80px;"> <i class="fa fa-trash"></i> Cancel</button>
                                </div>      
                            </form>
                            
                        </div>
                        <div class="panel" id="two-panel">
                            <div class="panel-title">Edit Skills</div><br><br>
                                <input type="hidden" value="{{ $emp['id']}}" name="empid">
                            <div class="field_wrapper">
                                @foreach ($skill as $s)
                                    <div class="row" style="margin-bottom: 10px;">
                                        <div class="col-md-9">
                                         <form method="post" action="{{url('employee/editskill')}}">
                                            @csrf
                                            <input type="hidden" value="{{$s['id']}}" name="esid">
                                            <input type="text" name="emp_skill" value="{{ $s['emp_skill']}}" id="emp_skill{{ $s['id']}}" class="form-control emp_skill" disabled="true" required/>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="javascript:void(0);" onclick="Edit({{ $s['id']}})" title="Click to edit">
                                                <span class="fa fa-pencil" aria-hidden="true"></span>
                                            </a>
                                        </div>
                                        <div class="col-md-1">
                                        <button type="submit" class="btn btn-sm" title="Click to Update"><i class="fa fa-check-square-o" aria-hidden="true" style="color:rgb(33, 228, 15)"></i>  </button>
                                        </form>
                                        </div>
                                    </div> 
                                @endforeach
                            </div><br><br>
                        </div>

                            {{-- Upload New Profile Panel --}}

                        <div class="panel" id="three-panel">
                            <div class="panel-title"> Choose New Profile </div><br><br>
                                <form method="post" action="{{ url ('employee/editphoto') }}" enctype="multipart/form-data">
                                  @csrf
                                
                                    <div class="field_wrapper">
                                        <img src="{{ asset('storage/employeeprofile/'.$emp['emp_img']) }}" style="width:100px;height: 100px; border-radius: 50%;" alt="" class="img-fluid" id="output">
                                        <br>
                                        <a href="#" style="" onclick="document.getElementById('getFile').click()" class="btn btn-sm" id="btn_pho">Select Photo</a>
                                        <input type="file" class="form-control @error('Photo') is-invalid @enderror" name="photo" id="getFile" style="display: none">
                                            <script>
                                                var input =document.getElementById('getFile');
                                                input.addEventListener('change',function(e){

                                                document.getElementById('btn_pho').innerText = 'Photo Selected';
                                                var image = document.getElementById('output');
                                                image.src = URL.createObjectURL(e.target.files[0]);

                                                });
                                            </script>
                                        <br><br>
                                        <button type="submit" name="update" class="btn btn-info btn-sm" style="width: 80px;"> <i class="fa fa-pencil" aria-hidden="true"></i>Update </button>
                                        <button type="reset" name="reset" class="btn btn-sm btn-danger" style="width: 80px;"> <i class="fa fa-trash"></i> Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>       
                 </div>
            </div>              
        </div>
     </div>
    </div>      
</div>
 
 

@endsection
 
<script src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript">
 function Edit(id)
 {
 document.getElementById('emp_skill'+id).disabled=false;

 }
</script>

<?php

// change date m/d/y
function dateCovert($date)
{
$originalDate = $date;
$newDate = date("m/d/Y", strtotime($date));

return $newDate;
}
?>



