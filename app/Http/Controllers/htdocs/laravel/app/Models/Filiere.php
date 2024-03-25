<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $table = 'filieres';
    protected $fillable = ['CodeFiliere', 'NomFiliere', 'Parcours'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'Etudiants_Filieres', 'idFiliere', 'idEtudiant');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'idFiliere');
    }
}
