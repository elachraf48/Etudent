<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtudiantsFiliere extends Model
{
    protected $table = 'Etudiants_Filieres';
    protected $primaryKey = 'id';

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'idFiliere');
    }
}
