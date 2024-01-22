<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'Etudiants';
    protected $fillable = ['CodeApogee', 'Nom', 'Prenom', 'DateNaiss'];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'Etudiants_Filieres', 'idEtudiant', 'idFiliere');
    }

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'Groupe_etudiant', 'idEtudiant', 'idGroupe');
    }

    public function examens()
    {
        return $this->hasMany(InfoExame::class, 'idEtudiant');
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'Detail_modules', 'idEtudiant', 'idModule');
    }
}
