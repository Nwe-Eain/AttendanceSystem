@extends('layouts.topheader')

@section('content')

<div class="container">
<div class="row">

    <!-- The Employee Entry Modal -->
  <div class="container">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Add New Employee </h5>
            <a href="/employees" class="btn close btn-default" aria-label="Close" data-dismiss="modal"></a>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{route('update')}}"  enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                             <div class="form-group">
                                <input type="text" class="form-control" id="id" name="id" value="{{$employee -> id}}" hidden>
                                <label for="emp_no" class="col-form-label"> Employee No:  </label>
                                <input type="text" class="form-control" id="emp_no" name="emp_no" value="{{$employee -> emp_no}}" required>
                              </div>
                              <div class="form-group">
                                <label for="emp_name" class="col-form-label">  Name</label>
                                <input type="text" class="form-control" id="emp_name" name="emp_name" value="{{$employee -> emp_name}}" required >
                              </div>
                              <div class="form-group">
                                <label for="emp_img" class="col-form-label">  Profile CV</label>
                                <input type="file" class="form-control" id="emp_img" name="emp_img">
                              </div>
                              <div class="form-group">
                                  <label for="gender" class="col-form-label"> Gender</label>
                                  <div class="input-group">
                                    @if($employee -> gender=="Male")
                                      <select class="custom-select" id="{{$employee -> gender}}" aria-label="Example select with button addon" name="gender" value="{{$employee -> gender}}">                                
                                        <option selected value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                      </select>
                                      @elseif($employee -> gender=="Female")
                                        <select class="custom-select" id="{{$employee -> gender}}" aria-label="Example select with button addon" name="gender" value="{{$employee -> gender}}">                                
                                          <option value="Male">Male</option>
                                          <option selected value="Female">Female</option>
                                          <option value="Other">Other</option>
                                        </select>
                                      @else
                                      <select class="custom-select" id="{{$employee -> gender}}" aria-label="Example select with button addon" name="gender" value="{{$employee -> gender}}">                                
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option selected value="Other">Other</option>
                                      </select>
                                    @endif
                                 </div>
                               </div>
                               <div class="form-group">
                                  <label for="emp_position" class="col-form-label"> Position</label>
                                  <input type="text" class="form-control" id="emp_position" name="emp_position" value="{{$employee -> emp_position}}" required>
                                </div>
                                <div class="form-group">
                                  <label for="emp_joindate" class="col-form-label"> Joined date</label>
                                  <input type="date" class="form-control" id="emp_joindate" name="emp_joindate" value="{{$employee -> emp_joindate}}" required>
                                </div>
                         </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="emp_nrc" class="col-form-label"> NRC No:</label>
                              <input type="text" class="form-control" id="emp_nrc" name="emp_nrc" value="{{$employee -> emp_nrc}}" required>
                            </div>
                            <div class="form-group">
                              <label for="emp_email" class="col-form-label"> Email:  </label>
                              <input type="email" class="form-control" id="email" name="emp_email" value="{{$employee -> emp_email}}" required>
                            </div>
                            <div class="form-group">
                              <label for="emp_phno" class="col-form-label"> Phone no:</label>
                              <input type="text" class="form-control" id="emp_phno" name="emp_phno" value="{{$employee -> emp_phno}}" required>
                            </div>
                            <div class="form-group">
                              <label for="emp_address" class="col-form-label"> Address </label>
                              <textarea class="form-control" id="emp_address" name="emp_address" required>  {{$employee ->emp_address}} </textarea>
                            </div>
                            <div class="form-group">
                              <label for="password" class="col-form-label"> Employee Password </label>
                              <input type="password" class="form-control" id="password" name="password" value="{{$employee -> password}}" required>
                            </div>
                            <div class="form-group">
                              <label for="dateofbirth" class="col-form-label"> Date Of Birth</label>
                              <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="yyyy-mm-dd" value="{{$employee -> dateofbirth}}" required>
                            </div>
                            <div style="float: right;">
                              <button type="submit" class="btn btn-info" style="width: 85px;  font-size:13px;"> <i class="fa fa-pencil" aria-hidden="true"></i> Update</button>
                              <a href="/employees" class="btn btn-danger" style="width: 85px;  font-size:13px;"><i class="fa fa-trash"></i> Cancel</a>
                            </div>
                      </div>
                    </div>
                </div>
          </form>
      </div>
    </div>
  </div>
 </div>   
</div>
@endsection
