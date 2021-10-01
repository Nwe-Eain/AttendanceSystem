<?php

namespace App\Dao;
use App\Attendance;
use App\Employee;

use Illuminate\Http\Request;

class AttendanceListDao
{
    protected $attendance;
    protected $employee;

    public function __construct(Attendance $attendance,Employee $employee)
    {
        $this->attendance=$attendance;
        $this->employee=$employee;

    }

    public function getAll()
    {   

        $list = Attendance::join('employees', 'employees.id', '=', 'attendances.emp_id')
                ->whereMonth('attend_date','=',date('m'))
                ->where('delete_flag','=',false)
                ->orderBy('attendances.id','desc')
               ->get(['attendances.*','employees.emp_name','employees.emp_no']);

        return $list;

    }


    public function getFilter($request)
    {
        
    $list = Attendance::join('employees','employees.id','=','attendances.emp_id')
            ->where(function ($query) use($request){
                //filter by date between only 
                if($request->frmdate && $request->todate){
                    $query->whereBetween('attend_date',[$request->frmdate, $request->todate])
                          ->where('delete_flag','=',false);
                }

                //filter by searchtext only
                if($request->searchtext){
                    $query->where('emp_name', 'like', '%' . $request->searchtext . '%')
                          ->orwhere('emp_no', 'like', '%' . $request->searchtext . '%')
                          ->where('delete_flag','=',false);
                }

                //filter by all
                if($request->frmdate && $request->todate && $request->searchtext )
                {
                    $query->whereBetween('attend_date',[$request->frmdate, $request->todate])
                          ->where('emp_name', 'like', '%' . $request->searchtext . '%')
                          ->where('delete_flag','=',false)
                          ->orwhere('emp_no', 'like', '%' . $request->searchtext . '%');
                }

                //filter by fromdate and searchtext

                if($request->frmdate && $request->searchtext )
                {
                    $query->whereDate('attend_date','>=', $request->frmdate)
                          ->where('emp_name', 'like', '%' . $request->searchtext . '%')
                          ->where('delete_flag','=',false)
                          ->orwhere('emp_no', 'like', '%' . $request->searchtext . '%');
                }

                //filter by todate and searchtext
                if($request->todate && $request->searchtext )
                {
                    $query->whereDate('attend_date','<=', $request->todate)
                          ->where('emp_name', 'like', '%' . $request->searchtext . '%')
                          ->where('delete_flag','=',false)
                          ->orwhere('emp_no', 'like', '%' . $request->searchtext . '%');
                }

                //filter by fromdate only
                if($request->frmdate )
                {
                    // dd($request->frmdate);
                    $query->whereDate('attend_date', '>=',  $request->frmdate)
                         ->where('delete_flag','=',false);
                          
                }

                 //filter by todate only
                 if($request->todate )
                 {
                     $query->whereDate('attend_date', '<=',  $request->todate)
                           ->where('delete_flag','=',false);
                           
                 }
               
            })
    ->orderBy('attend_date','asc')
    ->get();

        return $list;
    }


}




?>