<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index', ['companies' => Company::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = new Company($request->all());
        if($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('company/logos', 'public');
            ImageOptimizer::optimize(Storage::disk('public')->path($company->logo));
        }
            
        $company->save();

        return redirect()->route('companies.show', ['company' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.form', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->fill($request->all());
        if($request->hasFile('logo')) {
            Storage::delete($company->logo);
            $company->logo = $request->file('logo')->store('company/logos', 'public');
            ImageOptimizer::optimize(Storage::disk('public')->path($company->logo));
        }

        $company->save();
        return redirect()->route('companies.show', ['company' => $company->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Storage::disk('public')->delete($company->logo);
        $company->delete();

        return redirect()->route('companies.index');
    }

    public function employees(Company $company)
    {
        return view('employees.index', ['employees' => $company->employees()->paginate(10),'company' => $company]);
    }
}
