<?php

namespace App\Imports;

use App\Models\ocbg;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OcbgImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Log the keys in the $row array
        // dd($row);
    
        $validator = Validator::make($row, [
            'numero_op' => ['string'],
            'section' => 'string',
            'date_reglement' => ['date', 'date_format:Y-m-d'],
            'libelle' => 'string',
            'montant' => ['numeric', 'min:0'],
            'justification' => Rule::in(['non', 'oui']),
        ]);
    
        if ($validator->fails()) {
            // Handle validation errors
            // For example, you can log the errors or skip the row
            return null;
        }
    
        $ocbg = new ocbg([
            'numero_OP' => $row['numero_op'],
            'section' => $row['section'],
            'Date_regèlement' => $row['date_reglement'],
            'libelle' => $row['libelle'],
            'montant' => $row['montant'],
            'justification' => $row['justification'],
        ]);
        return $ocbg;
    }
    
}
