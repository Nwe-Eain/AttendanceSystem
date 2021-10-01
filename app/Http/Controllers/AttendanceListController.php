<?php

namespace App\Http\Controllers;                     
use App\Services\AttendanceListService as AttendanceListService;
use Illuminate\Http\Request;
use Session;

class AttendanceListController extends Controller
{

    protected $attendancelistservice;

    public function __construct(AttendanceListService $attendancelistservice)
    {
        $this->attendancelistservice=$attendancelistservice;
        
    }

    

    /**
     * Display current month attendance list
     *
     */
    public function index()
    {

        $result=$this->attendancelistservice->getAll();
        //dd($result);
        
        return view('admin/attendancelist',compact('result',$result));

    }

    /**
     * Displayign attendance list with filter function
     *
     */
    public function getFilter(Request $request)
    {
       
        $result=$this->attendancelistservice->getFilter($request);
        
        return view('admin/attendancelist',compact('result',$result));

    }

    /**
     * Clear all input data from attendance list filter
     */
    public function getRefresh(Request $request)
    {
      
       // session()->flush();
        return redirect()->route('getAllList');
        
    }
    
}
