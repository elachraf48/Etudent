<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = ['CodeFiliere', 'NomFiliere', 'Parcours'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'etudiants_filieres', 'idFiliere', 'idEtudiant');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'idFiliere');
    }
}
