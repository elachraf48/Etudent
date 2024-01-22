<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoExame extends Model
{
    protected $table = 'Info_Exames';
    protected $fillable = ['NumeroExamen', 'Semester', 'AnneeUniversitaire', 'Lieu', 'idEtudiant', 'idGroupe'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}
