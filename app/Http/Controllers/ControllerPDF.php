<?php

namespace App\Http\Controllers;

use App\Models\ocbg;
use Illuminate\Http\Request;

class ControllerPDF extends Controller
{
    public function downloadOpPdf($id)
    {
        $op = ocbg::find($id);

        if (!$op) {
            return redirect()->route('table-all')->with('error', 'Operation not found.');
        }

        if (!$op->pdf_file_path) {
            return redirect()->route('table-all')->with('error', 'PDF file not found for this operation.');
        }

        $pdfFilePath = public_path($op->pdf_file_path);

        if (!file_exists($pdfFilePath)) {
            return redirect()->route('table-all')->with('error', 'PDF file not found on server.');
        }

        $fileName = $op->section . '.pdf';

        return response()->download($pdfFilePath, $fileName);
    }
}
