<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OcbgImport;
use Illuminate\Validation\Rule;
use App\Exports\OcbgExport;
use App\Models\ocbg; // Update namespace to reference the Ops model

class ExcelController extends Controller
{
    public function excel()
    {
        return view("Excel.import");
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'numero_OP' => ['string'],
            'section' => ['string'],
            'Date_regèlement' => ['date', 'date_format:Y-m-d'],
            'libelle' => ['string'],
            'montant' => ['required', 'numeric'], 
            'justification' => Rule::in(['non', 'oui']),
        ]);
    
        // Check if the validation passes
        if ($request->file('file')->isValid()) {
            // Proceed with importing the Excel file
            Excel::import(new OcbgImport, $request->file('file'));
            return redirect()->back()->with('success', 'File imported successfully.');
        } else {
            // If the file is not valid, redirect back with an error message
            return redirect()->back()->with('error', 'The uploaded file is not valid.');
        }
    }
    
    public function exportall()
    {
        $ops = ocbg::all();
        
        if ($ops->isNotEmpty()) {
            return Excel::download(new OcbgExport($ops), 'All_Ops.xlsx');
        } else {
            return redirect()->back()->with('error', 'No records found.');
        }
    }
    
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'numero_OP' => ['string'],
                'section' => ['string'],
                'Date_regèlement' => ['date', 'date_format:Y-m-d'],
                'libelle' => ['string'],
                'montant' => ['required', 'numeric'], 
                'justification' => Rule::in(['non', 'oui']),
                'pdf_file' => 'nullable|mimes:pdf|max:10240', 
            ]);
    
            // Create a new ocbg instance
            $ocbg = new ocbg();
    
            // Assign validated data to the ocbg instance
            $ocbg->numero_OP = $validatedData['numero_OP'];
            $ocbg->section = $validatedData['section'];
            $ocbg->Date_regèlement = $validatedData['Date_regèlement'];
            $ocbg->libelle = $validatedData['libelle'];
            $ocbg->montant = $validatedData['montant'];
            $ocbg->justification = $validatedData['justification'];
    
            // Handle file upload if provided
            if ($request->hasFile('pdf_file')) {
                $pdfFileName = $request->file('pdf_file')->getClientOriginalName();
                $request->file('pdf_file')->move(public_path('pdf_files'), $pdfFileName);
                $ocbg->pdf_file_path = 'pdf_files/' . $pdfFileName;
            }
    
            // Save the ocbg instance
            $ocbg->save();
    
            return redirect()->route("table-all")->with('success', 'OCBG created successfully.');
        } catch (\Exception $e) {
            $error = 'An error occurred while creating OCBG.';
            return view('content.form-layout.form-create')->with('error', $error);
        }
    }
}
