<?php

namespace App\Http\Controllers\API;

use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class CompanyController extends Controller
{
    public function index()
    {
        return response()->json(['companies' => Company::paginate(10)]);
    }

    public function store(CompanyRequest $request)
    {
        $company = new Company($request->all());
        if($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('company/logos', 'public');
            ImageOptimizer::optimize(Storage::disk('public')->path($company->logo));
        }
            
        $company->save();

        return response(null, 201);
    }
}
