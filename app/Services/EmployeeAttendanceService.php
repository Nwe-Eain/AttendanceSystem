<?php

namespace App\Services;

use App\Dao\EmployeeAttendanceDao;
use Illuminate\Http\Request;
use App\Attendance;
use DB;

class EmployeeAttendanceService
{

    protected $employeeAttendanceDao;

    public function __construct(EmployeeAttendanceDao $employeeAttendanceDao){

        $this->employeeAttendanceDao = $employeeAttendanceDao;
    }

    //get attendance by Id
    public function getById($id){
        return $this->employeeAttendanceDao->getById($id);
    }

    //get all attendance bu current date
    public function getAllAttentByCurrentDate($emp_id){
        return $this->employeeAttendanceDao->getAllAttendByCurrentDate($emp_id);
    }


    //save checkin attendance by Id
    public function saveCheckIn($emp_id){
        return $this->employeeAttendanceDao->saveCheckIn($emp_id);
    }



    //employee click on checkout
    public function employeeCheckout($id){

        //update checkout click
        $this->employeeAttendanceDao->saveCheckout($id);
       
        //check absent employee
        $current_time= date('H:i:s', strtotime(date('H:i:s')));
        $checkout_time= date('H:i:s', strtotime("18:00:00"));
        if($current_time>$checkout_time){
            $emloyees =$this->employeeAttendanceDao-> getAllEmpByDeleteFlag();
            foreach($emloyees as $emloyee){
                $emp_attendance = $this->employeeAttendanceDao-> getEmpAttentByIdAndCurrentDate($emloyee->id);
                // dd($emp_attendance);
                if(count($emp_attendance)==0){
                    $data = (object)[
                        "id"=> $emloyee->id
                    ];
                    $this->employeeAttendanceDao->saveAbsent($data);
                }
            }
        }     
    }

//get filter attendance data by date
    public function getFilterByDate($request){
        return $this->employeeAttendanceDao->getFilterByDate($request);
    }

}
