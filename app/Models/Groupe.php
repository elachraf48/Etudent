<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'Groupes';
    protected $fillable = ['idSESSION','nomGroupe', 'Semester', 'AnneeUniversitaire'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'Groupe_etudiant', 'idGroupe', 'idEtudiant');
    }

    public function session()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSESSION');
    }

    public function examens()
    {
        return $this->hasMany(InfoExame::class, 'idGroupe');
    }

    public function calendrierModuleGroupes()
    {
        return $this->hasMany(CalendrierModuleGroupe::class, 'idGroupe');
    }
}
