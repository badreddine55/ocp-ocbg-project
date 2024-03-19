<?php

namespace App\Http\Controllers;

use App\Models\ops;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class GestionopController extends Controller
{
    public function index()
    {
        $ops = ops::query();

        $ops = $ops->get();

        return view('content.tables.table-all', compact('ops'));
    }

    public function filter_paiement()
    {
        $ops = ops::query();

        $ops->where('regellement', 'oui');

        $ops = $ops->get();

        return view('content.tables.table-paiement', compact('ops'));
    }
    public function filter_non_paiement()
    {
        $ops = Ops::query();

        $ops->where('regellement', 'non');
        $ops = $ops->get();
        return view('content.tables.table-non-paiement', compact('ops'));
    }
    /**
     * Display a listing of the resource.
     */

    public function search(Request $request)
    {
        // Retrieve the value of 'numero' from the request
        $numero = $request->input('numero');

        // Initialize the $error variable
        $error = null;
        // Search for ops by 'numero'
        if ($numero) {
            $ops = Ops::where('numero', $numero)->get();

            // Check if $ops is empty
            if ($ops->isEmpty()) {
                // If $ops is empty, set error message
                $error = 'No OP found for the provided numero.';
            } else {
                $error = null;
            }
        } else {
            // Search by a general query
            $query = $request->input('query');
            $ops = Ops::where('numero', 'like', '%' . $query . '%')
                ->orWhere('libelle', 'like', '%' . $query . '%')
                ->orWhere('created_at', 'like', '%' . $query . '%')
                ->orWhere('elaboration', 'like', '%' . $query . '%')
                ->orWhere('type', 'like', '%' . $query . '%')
                ->orWhere('regellement', 'like', '%' . $query . '%')
                ->orWhere('montant', 'like', '%' . $query . '%')
                ->get();
        }

        return view('content.tables.table-search', ['ops' => $ops, 'error' => $error]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.form-layout.form-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pdf_file' => 'mimes:pdf|max:5120',
            'numero' => 'string',
            'libelle' => 'string',
            'elaboration' => 'string',
            'type' => 'string',
            'montant' => 'string',
            'regellement' => 'string',
        ]);

        if ($request->hasFile('pdf_file')) {
            $pdfFileName = $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->move(public_path('pdf_files'), $pdfFileName);
            $validatedData['pdf_file_path'] = 'pdf_files/' . $pdfFileName;
        }

        ops::create($validatedData);

        return redirect(route("table-all"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $op = ops::find($id);
        return view('content.form-layout.form-edite', compact('op'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'pdf_file' => 'mimes:pdf|max:5120',
            'numero' => 'string',
            'libelle' => 'string',
            'elaboration' => 'string',
            'type' => 'string',
            'montant' => 'string',
            'regellement' => 'string',
        ]);
    
        // Retrieve the Ops record by ID
        $op = Ops::findOrFail($id);
    
        // Update the fields based on the validated data
        $op->numero = $validatedData['numero'] ?? $op->numero;
        $op->libelle = $validatedData['libelle'] ?? $op->libelle;
        $op->elaboration = $validatedData['elaboration'] ?? $op->elaboration;
        $op->type = $validatedData['type'] ?? $op->type;
        $op->montant = $validatedData['montant'] ?? $op->montant;
        $op->regellement = $validatedData['regellement'] ?? $op->regellement;
    
        // Handle file upload if a new file is provided
        if ($request->hasFile('pdf_file')) {
            $pdfFileName = $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->move(public_path('pdf_files'), $pdfFileName);
            $op->pdf_file_path = 'pdf_files/' . $pdfFileName;
        }
    
        // Save the updated record
        $op->save();
    
        return redirect(route("table-all"));
    }

    /**
     * Remove the specified resource from storage.
     */





    public function destroy(string $id)
    {
        $op = ops::find($id);
        $op->delete();
        return redirect(route("table-all"));
    }
}
