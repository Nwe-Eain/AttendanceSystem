<?php

namespace App\Dao;
use Illuminate\Http\Request;
use App\Employee;
use DB;
use Session;

class EmployeeDao
{

    protected $employee;

    public function __construct(Employee $employee){
        $this->employee =$employee;
    }

    /**
     *get all employee
     */
    public function getAll()
    {
        $empid=Session::get('employee')->id;
       
        $employees = Employee::Where('id','<>',$empid)
                              ->where('status','<>',1)
                              ->orderby('id','desc')
                              ->get();
        return $employees;
    }

    /**
     *save absent employee attendance
     */
    public function saveEmployee($data)
    {
        $employee = new $this->employee;
        $employee -> emp_name = $data->input('emp_name');
        $employee -> emp_no = $data->input('emp_no');        
        $employee -> emp_phno = $data->input('emp_phno');        
        $employee -> emp_address = $data->input('emp_address');
        $employee -> emp_position = $data->input('emp_position');
        $employee -> password = $data->input('password');
        $employee -> emp_email = $data->input('emp_email');        
        $employee -> emp_joindate = $data->input('emp_joindate');        
        $employee -> dateofbirth = $data->input('dateofbirth');
        $employee -> emp_nrc = $data->input('emp_nrc');
        $employee -> gender = $data->input('gender');        
        $employee -> delete_flag = false;
        $employee -> status = false;
        
        // handle the is_uploaded_file
        if($data->hasFile('emp_img')){
          $path =$data->file('emp_img')->storeAs("employeeprofile","emp_image_".$employee -> emp_name.".jpg",['disk'=>'public']);  
          $imgname = substr($path,strlen("employeeprofile/"));            
          }
          if ($data->hasFile('emp_img')) {
            $employee-> emp_img = $imgname;
          }
          $result = ['status'=>200];
          try
          {
            $employee->save();
            $result = [
              'status'=> 200,
              'message'=> "New Employee have been created!"
            ];
          }catch(\Illuminate\Database\QueryException $ex)
          {
            $result = [
                'status'=> 500,
                'message'=> "Entry Failed!! 
                EmpNo,NRC and Email must be unique!!!"
            ];
          }
        return $result;
    }

    // get employee by Id
    public function getById($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }  


    // update employee  by Id
    public function updateEmployee($data)
    {
      $id=$data->input('id');
      $employee = Employee::find($id);
      $employee -> emp_name = $data->input('emp_name');
      $employee -> emp_no = $data->input('emp_no');        
      $employee -> emp_phno = $data->input('emp_phno');        
      $employee -> emp_address = $data->input('emp_address');
      $employee -> emp_position = $data->input('emp_position');
      $employee -> password = $data->input('password');
      $employee -> emp_email = $data->input('emp_email');        
      $employee -> emp_joindate = $data->input('emp_joindate');        
      $employee -> dateofbirth = $data->input('dateofbirth');
      $employee -> gender = $data->input('gender');
      $employee -> emp_nrc = $data->input('emp_nrc');    
      // handle the is_uploaded_file
         if($data->hasFile('emp_img')){
          $path =$data->file('emp_img')->storeAs("employeeprofile","emp_image_".$employee -> emp_name.".jpg",['disk'=>'public']);  
          $imgname = substr($path,strlen("employeeprofile/"));  
         }
         
         try
         {
           $employee->save();
           $result = [
             'status'=> 200,
             'message'=> "Employee have been updated!"
           ];
         }catch(\Illuminate\Database\QueryException $ex)
         {
           $result = [
               'status'=> 500,
               'message'=> "Entry Failed!! 
               Employee NRC & Email must be unique!"
           ];
         }
       return $result;
    }   
    // delete employee by changing delete_flag
    public function delete($data)
    {
        $id=$data->input('id');
        $employee = Employee::find($id);
        $employee-> delete_flag = true;        
        $employee-> deleted_at = date('Y-m-d H:i:s');;
        $employee->save();

    }  

    
}