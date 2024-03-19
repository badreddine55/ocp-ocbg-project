<?php

namespace App\Http\Controllers;

use App\Models\ops;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ControllerPDF extends Controller
{


public function downloadOpPdf($id)
{
    $op = ops::find($id);
    if (!$op) {
        return redirect()->route('table-all')->with('error', 'Operation not found.');
    }

    $pdfFilePath = public_path($op->pdf_file_path);
    if (!file_exists($pdfFilePath)) {
        return redirect()->route('table-all')->with('error', 'PDF file not found.');
    }

    return response()->download($pdfFilePath, 'document.pdf');
}

}
