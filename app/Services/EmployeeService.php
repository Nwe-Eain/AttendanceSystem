<?php

namespace App\Services;

use App\Dao\EmployeeDao;
use Illuminate\Http\Request;
use App\Attendance;
use DB;

class EmployeeService
{

    protected $employeeDao;

    public function __construct(EmployeeDao $employeeDao){

        $this->employeeDao = $employeeDao;
    }

    //get all employee
    public function getAllEmployee(){
        return $this->employeeDao->getAll();
    }

    //save new employee
    public function saveEmployee($request){
        $result = $this->employeeDao->saveEmployee($request);
        return $result;
    }

    //get employee By Id
    public function getById($id){        
        return $this->employeeDao->getById($id);
    }

    //update employee
    public function updateEmployee($data){        
        $result = $this->employeeDao->updateEmployee($data);
        return $result;
    }

    //delete employee
    public function deleteEmployee($data){        
        $this->employeeDao->delete($data);
    }

}
