<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ocbg extends Model
{
    use HasFactory;

    protected $table = "ocbg";
    protected $fillable = [
        'numero_OP',
        'section',
        'Date_regèlement',
        'libelle',
        'montant',
        'justification',
        'pdf_file_path'
    ];
}
