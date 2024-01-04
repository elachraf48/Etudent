<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['CodeApogee', 'Nom', 'Prenom', 'DateNaiss'];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'etudiants_filieres', 'idEtudiant', 'idFiliere');
    }

    public function detailModules()
    {
        return $this->hasMany(DetailModule::class, 'idEtudiant');
    }

    public function groupeEtudiants()
    {
        return $this->hasMany(GroupeEtudiant::class, 'idEtudiant');
    }

    public function infoExames()
    {
        return $this->hasMany(InfoExame::class, 'idEtudiant');
    }
}
