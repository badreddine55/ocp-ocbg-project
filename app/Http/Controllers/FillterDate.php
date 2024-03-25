<?php

namespace App\Http\Controllers;

use App\Models\ocbg; 
use Illuminate\Http\Request;

class FillterDate extends Controller
{
    public function filterOCBG(Request $request)
    {
        $filterYear = $request->input('filterYear');

        // Perform the query to filter ocbg records by year
        $ocbg = ocbg::whereYear('Date_regèlement', $filterYear)->get();
    
        // Pass the filtered ocbg records to the view
        return view('content.tables.table-all', ['ocbg' => $ocbg]);
    }
}
