<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use App\User;
use DB;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $emp_id=Session::get('employee')->id;
        // $attendances = Attendance::all();
        $attendances = DB::table('attendances')
                ->where('attend_date', date('Y-m-d'))
                ->where('emp_id', $emp_id)
                ->get(); 

        // if (count($attendances)!=0){
        //     $att_id= $attendances[0]->id;
        //     $attendance = Attendance::find($att_id);
        // }
        // else{
        //     dd($attendances [0]->id);
        //     $att_id= $attendances[0]->id;
        //     $attendance = Attendance::find($att_id);
            return view('main')->with('attendances',$attendances);
        
        

    }
}
