<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Employee;
use App\Attendance;
use DB;
use Session; 

class UserAuthController extends Controller
{
    function login()
    {
        return view('auth.login'); //you can use Slash here also
    }                       

    function check(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'password' => 'required'
          ]);

        $id = $request->get('id');
        $password = $request->get('password');
        $data=Employee::Where('emp_no','=', $id)->first();
        // dd($data);
        if($data!=null){
            if($password == $data['password']){
                if( $data['delete_flag']){
                    return redirect()->back()->with('error','This Employee is No longer in Our company');
                }else{
                    Session::put('employee', $data);
                    // $attendances = Attendance::all();
                    $attendances = DB::table('attendances')
                    ->where('attend_date', date('Y-m-d'))
                    ->where('emp_id', $data->id)
                    ->get(); 
                    return redirect('home');
                }
                   
            }else{
                return redirect()->back()->with('error','Your input password is wrong');
            }    
        }else{
            return redirect()->back()->with('error', 'Please check your Employee ID!');
            // Session::put('alert', 'Please check your Employee ID!');
        }  
    }

}
