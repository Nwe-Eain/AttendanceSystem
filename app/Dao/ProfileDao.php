<?php

namespace App\Dao;
use App\Attendance;
use App\Employee;
use App\Skill;

use Illuminate\Http\Request;

class ProfileDao
{
    protected $attendance;
    protected $employee;

    public function __construct(Attendance $attendance,Employee $employee,Skill $skill)
    {
        $this->attendance=$attendance;
        $this->employee=$employee;
        $this->skill=$skill;

    }

    //add new skill for employee

    public function addSkill($request)
    {
        $empid=$request->get('empid');
        $eskill=$request->get('emp_skills');
          
          foreach($eskill as $s)
          {
            $empskill = new Skill([
                'emp_id' => $empid,
                'emp_skill'=> $s,
              ]);
              $empskill->save();
          }
         
          return $empskill->fresh();
    }


    //select result for current login employee profile

    public function showProfile($id)
    {
        // $emp = Employee::find($id);
        $skill = Skill::where('emp_id',$id)->get();

        return $skill;
    }


    //select data for current login employee edit profile form

    public function showEditProfile($id)
    {
        $skill = Skill::where('emp_id',$id)->get();

        return $skill;
    }


    //update data for current login employee

    public function updateProfile($request,$id)
    {

        $employee = Employee::find($id);
        $employee->emp_email = $request->get('email');
        $employee->emp_nrc = $request->get('nrc');
        $employee->dateofbirth = $request->get('dob');
        $employee->emp_address = $request->get('address');
        $employee->emp_phno = $request->get('phno');
        $employee->emp_name = $request->get('name');
        $employee->save();

        return $employee->fresh();
    }

    

    //update skill for current login employee
    public function editSkill($request)
    {
        $sid=$request->get('esid');
        $skill = Skill::find($sid);
        $skill->emp_skill=$request->get('emp_skill');
        $skill->save();

        return $skill->fresh();
    }
    

    //update photo for current login employee
    public function editPhoto($id,$request)
    {
        $employee = Employee::find($id);
        $path =$request->file('photo')->storeAs("employeeprofile","emp_image_".$employee->emp_name.".jpg",['disk'=>'public']);  
        $imgname = substr($path,strlen("employeeprofile/")); 
        $employee->emp_img = $imgname;
        $employee->save();

        return $employee->fresh();
    }
   
    
    
   
}


?>