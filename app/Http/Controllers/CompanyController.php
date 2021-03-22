<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use App\Jobs\CompanyJob;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_data = Company::paginate(10);
        return view('company.index', compact('company_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();

        dispatch(new CompanyJob($data));
        return redirect()->route('company.index')->with('message_type','success')->with('message','Data stored successfully.');
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
        $companyData = Company::where('id',$id)->first();

        return view('company.edit',compact('companyData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $data = $request->all();

        dispatch(new CompanyJob($data));
        return redirect()->route('company.index')->with('message_type','success')->with('message','Data updated successfully.');
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
        $logo_image = Company::where('id',$id)->value('logo');
        $logoImage = storage_path().'/app/public/'.$logo_image;
        
        if (\File::exists($logo_image)) { 
            unlink($logo_image);
        }

        $companyDelete = Company::where('id',$id)->delete();
        return response()->json(['success' => true],200);
    }
}
