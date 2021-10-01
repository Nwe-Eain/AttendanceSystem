<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Services\EmployeeService;
use Session;

class EmployeeController extends Controller
{

    protected $employeeService;

    public function __construct(EmployeeService $employeeService){

        $this->employeeService = $employeeService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employeeService->getAllEmployee();
        return view('admin.employeelist')->with('employees', $employees);
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
                $this->validate($request,[
          
            'emp_img'=> 'image|nullable|max:1999'
          ]);
          $result = $this->employeeService->saveEmployee($request);
          if($result['status']==200){
              return redirect('/employees')->with('success',$result['message']);
          }else{
            return redirect('/employees')->withInput()->with('error',$result['message']);;
          }
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
        $employee = $this->employeeService->getById($id);
        return view('admin.employeeedit')->with('employee',$employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $this->validate($request,[
            'emp_img'=> 'image|nullable|max:1999'
          ]);

          $result = $this->employeeService->updateEmployee($request);
          if($result['status']==200){
              return redirect('/employees')->with('success',$result['message']);
          }else{

              return redirect()->back()->with('error',$result['message']);
          }      
        
    }

    /**
     * Remove the specified resource from storage.
     ** @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory(Request $request)
    {
        $this->employeeService->deleteEmployee($request);
        return redirect('/employees')->with('success','Employee have been deleted!');
    }
}
