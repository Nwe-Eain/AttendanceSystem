@extends('layouts.topheader')
@section('content')
<style>
 table{ width: 100%;text-align: justify;font-size: 14px;}
.emp-profile{margin-bottom: 3%;border-radius: 0.5rem;background: #fff;}
</style>
<div class="row" style="background-color: rgb(246, 246, 244);">
  <div class="container emp-profile">
      <div class="row">
        <div class="col-md-12 section-title mt-4 mb-4">
            <h5>
                Employees Attendance List 
            </h5>        
        </div>
      </div>

    <div class="panel panel-default mt-3 mb-4">
      <form action="{{ route('attendanceFilter')}}" method="post">
        @csrf
        
        <div class="row">
          <div class="col-md-3">
            <input type="date" name="frmdate" id="frmdate" class="form-control" value="{{request()->get('frmdate')}}" >
          </div>
          <div class="col-md-3"> <input type="date" name="todate" id="tomdate" class="form-control" value="{{request()->get('todate')}}"></div>
          <div class="col-md-2"> <input type="text" name="searchtext" id="searchtext" class="form-control" placeholder="Enter Text" value="{{request()->get('searchtext')}}"></div>
          <div class="col-md-3"> 
            <button type="submit" name="search" class="btn btn-sm"> 
            <i class="fa fa-search-plus text-primary" aria-hidden="true"></i> search</button>
            <a href="{{url('admin/attendancelistrefresh')}}" class="btn btn-sm"> 
            <i class="fa fa-refresh text-success" aria-hidden="true"></i> refresh</a>
          </div>
        </div>
      </form>
    </div>

    <div class="table ">
     <table id="attendance" class="table table-responive">
        <thead id="tophead">
          <tr>
            <th scope="col"> No </th>
            <th scope="col" >Date</th>
            <th scope="col">Employee No</th>
            <th scope="col">Employee Name</th>
            <th scope="col">Checkin Time</th>
            <th scope="col">Checkout Time</th>
            <th scope="col">Total Working Time</th>
            <th scope="col">Overtime</th>
            <th scope="col"> Status</th>
          </tr>
        </thead>
        <tbody>
         @php
             $i=1;
         @endphp
          @foreach ($result as $data)
          <tr>
            <td> {{ $i++ }}</td>
            <td> {{ dateCovert($data->attend_date) }} </td> 
            <td> {{ $data['emp_no'] }}</td>
            <td style="text-align: left;"> 
              <span class="text-sm-left">  {{ $data['emp_name'] }}  </span> 
            </td>
            <td> {{ $data['checkin'] }} </td>
            <td>
              @if ($data->checkout==NULL)
                  -
              @else
              {{ $data['checkout'] }}
              @endif
            </td>
            <td> {{ totaltime($data['checkin'],$data['checkout']) }} </td>
            <td> 
              @php
                $ot = overtime($data['checkin'],$data['checkout']);  
              @endphp
              @if ($ot == "no overtime")
                 {{ $ot }} 
              @else
              <i class="fa fa-clock-o text-primary" aria-hidden="true"></i>
              <span class="text-sm-left text-primary">  {{ $ot }}  </span>
              @endif
            </td>
            <td>
              @if ($data['status']==1)
              <i class="fa fa-check-square-o text-success" aria-hidden="true"></i>
              <span class="text-sm-left text-success">  {{ "Present" }}  </span>
                @else
              <i class="fa fa-times text-danger" aria-hidden="true"></i>
              <span class="text-sm-left text-danger">  {{ "Absent" }}  </span> 
              @endif 
            </td> 
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
</div>
</div>

@endsection
<?php
function dateCovert($date)
{
  $originalDate = $date;
  $newDate = date("m/d/Y", strtotime($date));
  
  return $newDate;
}

function totaltime($in, $out)
{
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
 function overtime($in,$out)
{
  $diff_time=(strtotime($out)-strtotime($in)); 
    if($diff_time>34200){
        $overtime = $diff_time-34200;
        return gmdate("H:i:s", $overtime);
    }
    return "no overtime";
}

?>

