<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeAttendanceService;
use Session;

class EmployeeAttendanceController extends Controller
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
        $attendances=$this->employeeAttendanceService->getById($emp_id);
  
        return view('employee.employeeAttendance')->with('attendances',$attendances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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

//filter function
    public function getFilter(Request $request)
    {
        $attendances=$this->employeeAttendanceService->getFilterByDate($request);
        // dd($result);
        return view('employee.employeeAttendance')->with('attendances',$attendances);
    }

    //clear search data
    public function getRefresh(Request $request)
    {       
        return redirect()->route('getAllList');
    }


}
