<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ocbg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Analytics extends Controller
{
    public function index()
    {
        $totalOCBG = ocbg::count();
        $totalMONTANT = ocbg::sum('montant');
        $totalJustificationOui = ocbg::where('justification', 'oui')->count();
        $totalJustificationNon = ocbg::where('justification', 'non')->count();

        $orderStatistics = DB::table('ocbg')
            ->select('section', DB::raw('count(*) as total_orders'))
            ->groupBy('section')
            ->get();

        return view('content.dashboard.dashboards-analytics', compact('totalOCBG', 'totalMONTANT', 'totalJustificationOui', 'totalJustificationNon', 'orderStatistics'));
        
    }
}
