@extends('layouts.topheader')

@section('content')

<link href="{{ asset('css/attendancelist.css') }}" rel="stylesheet">

<div class="container" style="background-color:white;">
    <div class="row">
        <div class="col-md-4 section-title mt-4 mb-4">
            <h4>
                Attendance Log 
            </h4>        
        </div>
    </div>

    <div class="panel panel-default mt-3 mb-4">
        <form action="{{ route('empattendaceFilter')}}" method="post">
            @csrf

            <div class="row">
                <input type="text" name="emp_id" id="emp_id" class="form-control" value={{Session()->get('employee')->id}} hidden >
                <div class="col-md-3"> <input type="date" name="frmdate" id="frmdate" class="form-control" value="{{request()->get('frmdate')}}"></div>
                <div class="col-md-3"> <input type="date" name="todate" id="tomdate" class="form-control" value="{{request()->get('todate')}}"></div>
                <div class="col-md-4"> 
                    <button type="submit" name="search" class="btn btn-sm"> 
                    <i class="fa fa-search-plus text-info" aria-hidden="true"></i> search</button>
                    <a href="{{url('employeeAttendances')}}" class="btn btn-sm"> 
                    <i class="fa fa-refresh text-success" aria-hidden="true"></i> refresh</a>
                </div>
            </div>
        </form>
  </div>
 
    <div class="table table-responive">
        <table  id="attendancelog" class="table table-responive">
            <thead id="tophead">
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Checkin Time</th>
                    <th scope="col">Checkout Time</th>
                    <th scope="col">Total Working Time</th>
                    <th scope="col">Overtime</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
              @foreach($attendances as $attend)
                 <tr>                    
                        <td >{{ dateCovert($attend->attend_date) }} </td>
                        <td >
                            {{$attend->checkin}}
                        </td>
                        <td >
                            @if ($attend->checkout==NULL)
                                {{ "- " }}
                            @else
                                {{$attend->checkout}}
                            @endif
                        </td>
                        <td >{{totaltime($attend->checkin,$attend->checkout)}} </td>
                        <td>
                            @php
                            $ot = overtime($attend->checkin,$attend->checkout);  
                            @endphp
                            @if ($ot == "no overtime")
                                {{ $ot }} 
                            @else
                            <i class="fa fa-clock-o text-primary" aria-hidden="true"></i>
                            <span class="text-sm-left text-primary">  {{ $ot }}  </span>
                            @endif
                        </td>
                        @if($attend->status==1)
                        <td class="text-success">
                            <i class="fa fa-check-square-o text-success" aria-hidden="true"></i>
                            <span class="text-sm-left text-success">  {{ "Present" }}  </span>
                        </td>
                        @else
                        <td class="text-danger">
                            <i class="fa fa-times text-danger" aria-hidden="true"></i>
                            <span class="text-sm-left text-danger">  {{ "Absent" }}  </span> 
                        </td>
                        @endif
                  </tr>
           @endforeach
         </tbody>
     </table> 
  </div>
</div>
@endsection
<?php
    // caculate working time
    function totaltime($in, $out){
       if($out==null){
            return "not checkout";
       }
       else{
            $diff_time=(strtotime($out)-strtotime($in)); 
            if($diff_time>10800) {
                $total_time=$diff_time-3600;
                return gmdate("H:i:s", $total_time);
            }  
            else
                return gmdate("H:i:s", $diff_time);
       }
    }

    // caculate overtime
    function overtime($in, $out){
        $diff_time=(strtotime($out)-strtotime($in)); 
        if($diff_time>34200){
            $overtime = $diff_time-34200;
            return gmdate("H:i:s", $overtime);
        }
        return "no overtime";
    }

 // change date m/d/y
    function dateCovert($date)
    {
    $originalDate = $date;
    $newDate = date("m/d/Y", strtotime($date));
    return $newDate;
    }
?>