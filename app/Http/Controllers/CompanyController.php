<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companyIndex()
    {
        $company = Company::where('estatud',"=",'1')->get();
        foreach ($company as $change ) {
            $change = $change->type;
        }
        return $company;
    }
    public function companyAdm()
    {
        $company = Company::where('id',"=",'1')->get();
        foreach ($company as $change ) {
            $change = $change->type;
        }
        return $company;
    }
    public function companyGerente()
    {
        $company = Company::where('id',"<>",'1')->get();
        foreach ($company as $change ) {
            $change = $change->type;
        }
        return $company;
    }

    public function index()
    {
        return view('company.index'); 
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
        $company = new Company;
        $company->nombre = $request->name;
        $company->rif = $request->rif;
        $company->direccion = $request->address;
        $company->telefono = $request->cellphone;
        $company->estatud = 1;
        $company->type_id = $request->type;
        $company->save();
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
        $company = Company::findOrFail($id);
        $company->nombre = $request->name;
        $company->rif = $request->rif;
        $company->direccion = $request->address;
        $company->telefono = $request->cellphone;
        $company->type_id = $request->type;
        $company->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->estatud = 0;
        $company->save();
    }
}
