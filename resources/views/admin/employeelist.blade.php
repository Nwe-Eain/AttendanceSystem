@extends('layouts.topheader')
@section('content')

<link rel="stylesheet" href="{{asset('css/employee.css')}}">

<div class="container emp-profile"  style="background: white;">
      <div class="panel panel-default mt-3 mb-4">
          <div class="row">
              <div class="col-md-9 section-title mt-4 mb-4">
                  <h4>
                      Employee List 
                  </h4>        
              </div>
              <div class="col-md-3" style="float: righ;">
                  <button type="button" class="btn btn-primary mt-4 mb-4" data-toggle="modal" data-target="#emp-entry">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> 
                    <i style="font-size: 13px;"> Add New Employee</i>
                    </button>
              </div>
          </div>
      </div>
    
    <div class="table table-responsive">
      <table id="employeelist" class="table table-sm" style="font-size:13px" >
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Emp No</th>
            <th scope="col">Name</th>
            <th scope="col">NRC</th>
            <th scope="col">DOB</th>
            <th scope="col">Gender</th>
            <th scope="col">Ph No</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Position</th>
            <th scope="col">Joined date</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody >
          @foreach($employees as $employee)
            @if(!$employee->delete_flag)
              <tr>
                <td> <img src="{{ asset('storage/employeeprofile/'.$employee['emp_img']) }}" style="width:25px;height: 25px; border-radius: 50%;" alt="No image"></td>
                <td >{{$employee->emp_no}}</td>            
                <td > 
                  {{-- <i class="fa fa-user-circle-o text-primary" aria-hidden="true" style="font-size:20px;"></i> --}}
                  {{$employee ->emp_name}}</td>
                <td >{{$employee->emp_nrc}}</td>                
                <td >{{ dateCovert($employee->dateofbirth) }}</td>
                <td >{{$employee->gender}}</td>    
                <td >{{$employee->emp_phno}}</td>
                <td >{{$employee->emp_email}}</td>
                <td >{{$employee->emp_address}}</td>
                <td>{{$employee->emp_position}}</td>                
                <td >{{ dateCovert($employee->emp_joindate) }}</td>
                <td>
                  <form method="POST" action="{{route('delete')}}" >
                    @csrf
                    <input type="text" name="id" value="{{$employee -> id}}" hidden>
                    <div  class="row">
                        <div class="col-sm-2 mr-3"><a href="/employees/{{$employee->id}}/edit" class="btn btn-sm btn-primary " ><i class="fa fa-pencil fa-fw"></i></a></div>
                        <div class="col-sm-2"><button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this employee?')"> <i class="fa fa-trash-o fa-fw"></i> </button></div>                            
                    </div>               
                  </form>
                </td>
              </tr>
            @endif
          @endforeach    
        </tbody>
      </table> 
    </div>
 </div>   
 
    <!-- The Employee Entry Modal -->
    <div class="modal" id="emp-entry">
      <div class="modal-dialog modal-lg">
          <div class="modal-content" >
              <div class="modal-header float-right">
                <h5 class="modal-title " id="exampleModalLabel"> Add New Employee </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
  
              <form method="POST" action="{{route('store')}}" enctype="multipart/form-data" id="form" class="form">
                @csrf

                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="emp_no" class="col-form-label"> Employee No:  </label>
                                  <input type="text" class="form-control" id="emp_no" name="emp_no"  placeholder="emp_001" onchange="checkEmpno();" value="{{old('emp_no')}}" required>
                                  <small id="empno" style="color:red;">  </small>
                              </div>
                                <div class="form-group">
                                  <label for="emp_name" class="col-form-label"> Name</label>
                                  <input type="text" class="form-control" id="emp_name" name="emp_name"  placeholder="Ella" onchange="checkEmpname();"  value="{{old('emp_name')}}" required>
                                  <small id="name" style="color:red;">  </small>
                                </div>
                                <div class="form-group">
                                  <label for="emp_img" class="col-form-label">  Profile CV</label>
                                  <input type="file" class="form-control" id="emp_img" name="emp_img">
                                </div>
                                <div class="form-group">
                                  <label for="gender" class="col-form-label"> Gender</label>
                                    <div class="input-group">
                                      <select class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon" name="gender" required>                                
                                        <option @if (old('gender') == "Choose...") {{ 'selected' }} @endif>Choose...</option>
                                        <option value="Male" @if (old('gender') == "Male") {{ 'selected' }} @endif>Male</option>
                                        <option  value="Female"  @if (old('gender') == "Female") {{ 'selected' }} @endif>Female</option>
                                        <!-- <option value="Female">Female</option> -->
                                        <option value="Other" @if (old('gender') == "Other") {{ 'selected' }} @endif >Other</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="emp_position" class="col-form-label"> Position</label>
                                    <input type="text" class="form-control" id="emp_position" name="emp_position" required placeholder="Developer" onchange="checkPosition();"  value="{{old('emp_position')}}">
                                    <small id="position" style="color:red;">  </small>
                                </div>
                                  <div class="form-group">
                                    <label for="emp_joindate" class="col-form-label"> Joined date</label>
                                    <input type="date" class="form-control" id="emp_joindate" name="emp_joindate" placeholder="join date" required  value="{{old('emp_joindate')}}" required>
                                </div>
                          </div>
                        <div class="col-md-6">
                              <div class="form-group">
                                  <label for="emp_nrc" class="col-form-label"> NRC No:</label>
                                  <input type="text" class="form-control" id="emp_nrc" name="emp_nrc" required placeholder="1/YaKaNa(N)034556" onchange="checkNrc();" value="{{old('emp_nrc')}}" required>
                                  <small id="nrc" style="color:red;"> </small>
                                </div>
                              <div class="form-group">
                                  <label for="emp_email" class="col-form-label"> Email:   </label>
                                  <input type="email" class="form-control" id="emp_email" name="emp_email" required placeholder="example@gmail.com" onchange="checkEmail();" value="{{old('emp_email')}}" required>
                                  <small id="email" style="color:red;"> </small>
                                </div>
                                <div class="form-group">
                                  <label for="emp_phno" class="col-form-label"> Phone no:</label>
                                  <input type="text" class="form-control" id="emp_phno" name="emp_phno" required placeholder="09-235549856" onchange="checkPhno();" value="{{old('emp_phno')}}" required>
                                  <small id="phno" style="color:red;">  </small>
                                </div>
                                <div class="form-group">
                                  <label for="emp_address" class="col-form-label"> Address </label>
                                  <textarea class="form-control" id="emp_address" name="emp_address" required > {{old('emp_address')}}</textarea>
                                </div>
                                <div class="form-group">
                                  <label for="password" class="col-form-label"> Employee Password </label>
                                  <input type="password" class="form-control" id="emp_password" name="password" required placeholder="at least 8 characters with specials character" onchange="checkPassword();" value="{{old('password')}}" required>
                                  <span class="input-group-btn" id="eyeSlash" style="position:relative;float:right;margin-left: -25px;margin-top: -35px;z-index: 2;">
                                    <button class="btn btn-default reveal" onclick="Show()" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                  </span>
                                  <span class="input-group-btn" id="eyeShow" style="display: none;position:relative;float:right;margin-left: -25px;margin-top: -35px;z-index: 2;">
                                    <button class="btn btn-default reveal" onclick="Show()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                  </span>
                                  <small id="pass" style="color:red;">  </small>
                                </div>
                                  <div class="form-group">
                                    <label for="dateofbirth" class="col-form-label"> Date Of Birth</label>
                                    <input type="date" class="form-control" id="dateofbirth" data-date-format="YYYY MMMM DD" name="dateofbirth" required value="{{old('dateofbirth')}}">
                                  </div>
                                  <div style="float:right">
                                    <button type="submit" class="btn btn-success" style="width: 80px; font-size:13px;"> <i class="fa fa-plus-square"></i> Add </button>
                                    <button type="reset" class="btn btn-danger" data-dismiss="modal" style="width: 80px; font-size:13px;"><i class="fa fa-trash"></i> Cancel</button>
                                </div>
                         </div>
                      </div>
                  </div>
              </form>
            </div>
      </div>
    </div>
@endsection

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/employee.js')}}"></script>

<?php
// change date m/d/y
function dateCovert($date)
{
$originalDate = $date;
$newDate = date("m/d/Y", strtotime($date));

return $newDate;
}
?>

