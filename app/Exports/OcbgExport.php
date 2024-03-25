<?php

namespace App\Exports;

use App\Models\ocbg;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class OcbgExport implements FromCollection, WithHeadings
{
    protected $ocbg;

    public function __construct(Collection $ocbg)
    {
        $this->ocbg = $ocbg;
    }

    public function headings(): array
    {
        return [
            'numero_OP',
            'section',
            'Date_regèlement',
            'libelle',
            'montant',
            'justification',
        ];
    }

    public function collection()
    {
        $data = [];

        foreach ($this->ocbg as $ocbg) {
            $data[] = [
                'numero_OP' => $ocbg->numero_OP,
                'section' => $ocbg->section,
                'Date_regèlement' => $ocbg->Date_regèlement,
                'libelle' => $ocbg->libelle,
                'montant' => $ocbg->montant,
                'justification' => $ocbg->justification,
            ];
        }

        return collect($data);
    }
}
