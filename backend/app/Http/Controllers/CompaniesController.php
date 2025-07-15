<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.manage-company', compact('companies'));
    }
     public function create()
    {
        return view('admin.create-company');
    }
   public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'company_desc' => 'nullable|string',
        ]);

        Company::create([
            'company_name' => $request->company_name,
            'company_type' => $request->company_type,
            'company_desc' => $request->company_desc,
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'Company added successfully.');
    }
    public function edit($company_id)
    {
        $company = Company::findOrFail($company_id);
        return view('admin.edit-company', compact('company'));
    }

    public function update(Request $request, $company_id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'company_desc' => 'nullable|string',
        ]);

        $company = Company::findOrFail($company_id);
        $company->update([
            'company_name' => $request->company_name,
            'company_type' => $request->company_type,
            'company_desc' => $request->company_desc,
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy($company_id)
    {
        $company = Company::findOrFail($company_id);
        $company->delete();

        return redirect()->route('admin.companies.index')->with('success', 'Company deleted successfully.');
    }

}

