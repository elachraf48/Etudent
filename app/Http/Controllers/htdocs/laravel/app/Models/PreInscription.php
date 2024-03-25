<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreInscription extends Model
{
    protected $fillable = [
        'idEtudiant',
        'idSession',
        'AnneeUniversitaire',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function session()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSession');
    }
    use HasFactory;
}
