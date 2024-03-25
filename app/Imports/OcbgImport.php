<?php


namespace App\Imports;

use App\Models\ocbg;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class OcbgImport implements ToModel, WithHeadingRow
{    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    
        $validator = Validator::make($row, [
            'numero_OP' => ['string'],
            'section' => ['string'],
            'Date_regèlement' => ['date', 'date_format:Y-m-d'],
            'libelle' => ['string'],
            'montant' => ['required', 'numeric'], 
            'justification' => Rule::in(['non', 'oui']),
        ]);
    
        if ($validator->fails()) {
            // Handle validation errors
            // For example, you can log the errors or skip the row
            return null;
        }

        $ocbg = new ocbg([
            'numero_OP' => $row['numero_OP'],
            'section' => $row['section'],
            'Date_regèlement' => $row['Date_regèlement'],
            'libelle' => $row['libelle'],
            'montant' => $row['montant'],
            'justification' => $row['justification'],
        ]);
        return $ocbg;
    }
    
}




        

