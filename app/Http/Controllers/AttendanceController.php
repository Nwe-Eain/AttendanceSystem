<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeAttendanceService;
use App\Attendance;
use DB;
use Session;

class AttendanceController extends Controller
{

    protected $employeeAttendanceService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService){

        $this->employeeAttendanceService = $employeeAttendanceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp_id=Session::get('employee')->id; 
        $attendances = $this->employeeAttendanceService->getAllAttentByCurrentDate($emp_id);
        return view('main')->with('attendances',$attendances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $emp_id=Session::get('employee')->id;
        $this->employeeAttendanceService->saveCheckIn($emp_id);
        return redirect('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $this->employeeAttendanceService->employeeCheckout($id);
        return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
