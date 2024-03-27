<?php

namespace App\Http\Controllers;

use App\Models\ocbg;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\PostTooLargeException;

class GestionOCBGController extends Controller
{
    public function index()
    {
        $ocbg = ocbg::all();
        return view('content.tables.table-all', compact('ocbg'));
    }

    public function filter_Athlétisme()
    {
        $ocbg = ocbg::where('section', 'Athlétisme')->get();
        return view('content.tables.table-athletisme', compact('ocbg'));
    }
    public function filter_karaté()
    {
        $ocbg = ocbg::where('section', 'karaté')->get();
        return view('content.tables.table-karate', compact('ocbg'));
    }
    public function filter_Gymnastique()
    {
        $ocbg = ocbg::where('section', 'Gymnastique')->get();
        return view('content.tables.table-gymnastique', compact('ocbg'));
    }
    
    public function filter_Natation()
    {
        $ocbg = ocbg::where('section', 'Natation')->get();
        return view('content.tables.table-natation', compact('ocbg'));
    }
    public function filter_Halteroptrit()
    {
        $ocbg = ocbg::where('section', 'Halteroptrit')->get();
        return view('content.tables.table-halteroptrit', compact('ocbg'));
    }
    public function filter_Cyclisme()
    {
        $ocbg = ocbg::where('section', 'Cyclisme')->get();
        return view('content.tables.table-cyclisme', compact('ocbg'));
    }
    public function filter_Petanque()
    {
        $ocbg = ocbg::where('section', 'Petanque')->get();
        return view('content.tables.table-petanque', compact('ocbg'));
    }
    public function filter_Tennis()
    {
        $ocbg = ocbg::where('section', 'Tennis')->get();
        return view('content.tables.table-tennis', compact('ocbg'));
    }
    public function filter_Tirauvol()
    {
        $ocbg = ocbg::where('section', 'Tir_au_vol')->get();
        return view('content.tables.table-tir_au_vol', compact('ocbg'));
    }


    

    public function search(Request $request)
    {
        $query = $request->input('query');
        $ocbg = ocbg::where('numero_OP', 'like', '%' . $query . '%')
            ->orWhere('section', 'like', '%' . $query . '%')
            ->orWhere(ocbg::raw('YEAR(Date_regèlement)'), 'like', '%' . $query . '%')
            ->get();
    
        return view('content.tables.table-search', compact('ocbg'));
    }
    

    public function create()
    {
        return view('content.form-layout.form-create');
    }

    public function store(Request $request)
    {
        
        try {
            //dd($request);
            $validatedData = $request->validate([
                'numero_OP' => ['string'],
                'section' => ['string'],
                'Date_regèlement' => ['date', 'date_format:Y-m-d'],
                'libelle' => ['string'],
                'montant' => ['required', 'numeric'], 
                'justification' => Rule::in(['non', 'oui']),
                'pdf_file' => 'nullable|mimes:pdf|max:10240', 
            ]);
    
            $ocbg = new ocbg();
    
            $ocbg->numero_OP = $validatedData['numero_OP'];
            $ocbg->section = $validatedData['section'];
            $ocbg->Date_regèlement = $validatedData['Date_regèlement'];
            $ocbg->libelle = $validatedData['libelle'];
            $ocbg->montant = $validatedData['montant'];
            $ocbg->justification = $validatedData['justification'];
    
            if ($request->hasFile('pdf_file')) {
                $pdfFileName = $request->file('pdf_file')->getClientOriginalName();
                $request->file('pdf_file')->move(public_path('pdf_files'), $pdfFileName);
                $ocbg->pdf_file_path = 'pdf_files/' . $pdfFileName;
            }
            $ocbg->save();
    
            return redirect()->route("table-all")->with('success', 'OCBG created successfully.');
        } catch (\Exception $e) {
            $error = 'the error in the NUMÉRO OP is unique';
            return view('content.form-layout.form-create')->with('error', $error);
        }
    }
    public function edit(string $id)
    {
        $ocbg = ocbg::findOrFail($id);
        $Date = date('Y-m-d', strtotime($ocbg->Date_regèlement));
        return view('content.form-layout.form-edite', compact('ocbg','Date'));
    }
    

    
    public function update(Request $request, string $id)
    {
        
        $validatedData = $request->validate([
            'numero_OP' => 'string',
            'section' => 'string',
            'Date_regèlement' => 'required', 
            'libelle' => 'string',
            'montant' => 'string',
            'justification' => 'string',
            'pdf_file' => 'mimes:pdf|max:5120',
        ]);

         
         //$bd = '2030/06/07'; //date('Y-m-d', strtotime($validatedData['Date_regèlement']));
         //$dateString = "2090/06/07";
         //$bd = date('d-m-Y', strtotime($dateString));
         //$ocbg = ocbg::findOrFail($id);
        $ocbg = ocbg::findOrFail($id);
        $ocbg->numero_OP = $validatedData['numero_OP'];
        $ocbg->section = $validatedData['section'];
        $ocbg->Date_regèlement = $validatedData['Date_regèlement'];
        $ocbg->libelle = $validatedData['libelle'];
        $ocbg->montant = $validatedData['montant'];
        $ocbg->justification = $validatedData['justification'];



        if ($request->hasFile('pdf_file')) {
            $pdfFileName = $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->move(public_path('pdf_files'), $pdfFileName);
            $ocbg->pdf_file_path = 'pdf_files/' . $pdfFileName;
            $ocbg->save();
        }
        $ocbg->save();
        return redirect()->route("table-all");
        /*        $ocbg->update([
            'numero_OP' => $validatedData['numero_OP'],
            'section' => $validatedData['section'],
            'Date_regèlement' => $bd,
            //dd($bd),
            'libelle' => $validatedData['libelle'],
            'montant' => $validatedData['montant'],
            'justification' => $validatedData['justification'],
        ]);
        //dd($ocbg);*/
    }



    public function destroy(string $id)
    {
        $ocbg = ocbg::findOrFail($id);
        $ocbg->delete();
        return redirect()->route("table-all");
    }
}
