<?php

namespace App\Dao;

use Illuminate\Http\Request;
use App\Attendance;
use DB;

class EmployeeAttendanceDao
{

    protected $attendance;

    public function __construct(Attendance $attendance){
        $this->attendance =$attendance;
    }

        /**
     * Get Attendance by id
     *
     * @param  int  $id
     * @return mixed
     */
    public function getById($id)
    {
        $attendances = DB::table('attendances')
        ->where('emp_id', $id)
        ->whereMonth('attend_date','=',date('m'))
        ->get();   
        return $attendances;
    }

            /**
     * Get all Attendance by current date
     
     */
    public function getAllAttendByCurrentDate($emp_id)
    {
        $attendances = DB::table('attendances')
        ->where('attend_date', date('Y-m-d'))
        ->where('emp_id', $emp_id)
        ->get();  
        return $attendances;
    }

    public function saveAbsent($data)
    {
        // dd($data);
        $attendance = new $this->attendance;
        $attendance -> attend_date = date('Y-m-d');
        $attendance -> status =false;
        $attendance -> emp_id =$data->id;
        $attendance->save();
        return $attendance->fresh();
    }

          /**
     *save absent employee attendance
     *
     * @param  $data
     * @return $attendaces
     */
    public function saveCheckIn($emp_id)
    {
        $attendance = new $this->attendance;
        $attendance -> checkin = date('H:i:s');
        $attendance -> attend_date = date('Y-m-d');
        $attendance -> emp_id = $emp_id;
        $attendance -> status = true;
        $attendance->save();
        return $attendance->fresh();
    }

    //update checkout employee
    public function saveCheckout($id)
    {
        $attendance = Attendance::find($id);
        $attendance -> checkout = date('H:i:s'); 
        $attendance ->save();
        return $attendance->fresh();
    }


    //get employee by id and current date
    public function getEmpAttentByIdAndCurrentDate($id)
    {
        $epm_attendance = DB::table('attendances')
        ->where('attend_date', '=', date('Y-m-d'))
        ->where('emp_id', '=', $id)
        ->get();
        return $epm_attendance;
    }      

    //filter by date and emp_id
    public function getFilterByDate($request)
        {
            $from=$request->get('frmdate');
            $to =$request->get('todate');
            $emp_id = $request->get('emp_id');

            // dd($request);
            $list = $attendances = DB::table('attendances')
            ->where('emp_id', $emp_id)
            ->where(function ($query) use($request){
                //filter by date between only 
                if($request->frmdate && $request->todate){
                    $query->whereBetween('attend_date',[$request->frmdate, $request->todate]);
                }

                //filter by fromdate only
                if($request->frmdate )
                {
                    // dd($request->frmdate);
                    $query->whereDate('attend_date', '>=',  $request->frmdate);
                          
                }

                 //filter by todate only
                 if($request->todate )
                 {
                     $query->whereDate('attend_date', '<=',  $request->todate);
                           
                 }
               
            })
            ->orderBy('attend_date','asc')
            ->get();

        return $list;   
    
        }
        
    //get employee by id and current date
    public function getAllEmpByDeleteFlag()
    {        
        $emloyees =DB::table('employees')
        ->where('delete_flag', '=', false)
        ->get();
        return $emloyees;
    }


}