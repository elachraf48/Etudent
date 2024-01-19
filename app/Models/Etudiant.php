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

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupe_etudiant', 'idEtudiant', 'idGroupe');
    }

    public function infoExames()
    {
        return $this->hasMany(InfoExame::class, 'idEtudiant');
    }

    public function detailsModules()
    {
        return $this->hasMany(DetailModule::class, 'idEtudiant');
    }
}
