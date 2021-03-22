<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Jobs\EmployeeJob;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee_data = Employee::with('company')->paginate(10);
        
        return view('employee.index', compact('employee_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_list = Company::where('status','active')->pluck('name','id')->toArray();

        return view('employee.create',compact('company_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
        dispatch(new EmployeeJob($data));

        return redirect()->route('employee.index')->with('message_type','success')->with('message','Data stored successfully.');
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
        $company_list = Company::where('status','active')->pluck('name','id')->toArray();

        $employeeData = Employee::where('id',$id)->first();

        return view('employee.edit',compact('company_list','employeeData'));
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
        $data = $request->all();

        dispatch(new EmployeeJob($data));
        return redirect()->route('employee.index')->with('message_type','success')->with('message','Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $employeeDelete = Employee::where('id',$id)->delete();

        return response()->json(['success' => true],200);
    }
}
