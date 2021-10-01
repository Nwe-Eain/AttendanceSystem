<?php

namespace App\Http\Controllers;                     
use App\Services\ProfileService as ProfileService;
use Illuminate\Http\Request;
use App\Employee;
use App\Skill;
use Session;

class ProfileController extends Controller
{

    protected $profileservice;

    public function __construct(ProfileService $profileservice)
    {
        
        $this->profileservice=$profileservice;
    }


    /**
     * Store a newly created skill for current login employee.
     */
    public function addSkill(Request $request)
    {
        //    $request->validate([
        //     "emp_skill"    => "required|array|min:3",
        //     "emp_skill.*"  => "required|string|distinct|min:3",
        //     ]);
        
        $result=$this->profileservice->addSkill($request);
 
        return redirect('/employee/profile')->with('success', 'Skill has been added');
    }


    /**
     * Display Logined Employee
     *
     */
    public function showProfile()
    {
        
        $id=Session::get('employee')->id; 
        //show login employee profile
        $skill =$this->profileservice->showProfile($id);
        $emp = Employee::find($id);
    
        return view('/employee/profile',compact('emp',$emp),compact('skill',$skill));

    }

     /**
     * Show the form of editprofile for logined employee
     *
     */

    public function showEditProfile()
    {
        $id=Session::get('employee')->id; 
        //show login employee profile
        $emp = Employee::find($id);
        $skill =$this->profileservice->showEditProfile($id);
       
    
        return view('/employee/editprofile',compact('emp',$emp),compact('skill',$skill));

    }


    /**
     * Show the form for editing logined employee
     *
     */
    public function updateProfile(Request $request)
    {
        $id=Session::get('employee')->id;
        $request->validate([
            'email'=>'required| email',
            'nrc'=>'required',
            'phno' => 'required | string',
            'dob'=> 'required | date',
            'address'=> 'required | string',
            'name'=> 'required| string'
          ]);

          $result=$this->profileservice->updateProfile($request,$id);
          
          return redirect('/employee/editprofile')->with('success', 'Employee has been updated');
    }


    /**
     * Update the logined employee skill
     */
    public function editSkill(Request $request)
    {
       
        $request->validate([
            'emp_skill'=>'required | string',
        ]);

        $result=$this->profileservice->editSkill($request);
       
        return redirect('/employee/editprofile')->with('success', 'Employee Skill has been updated');

    }
     

    /**
     * Update the logined employee profile photo
     */
    public function editPhoto(Request $request)
    {
        $id=Session::get('employee')->id;         
        $result = $this->profileservice->editPhoto($id,$request);    
        return redirect('/employee/editprofile')->with('success', 'Profile has been updated');
        
    }
}
