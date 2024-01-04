<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $fillable = ['nomGroupe', 'Semester'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'groupe_etudiant', 'idGroupe', 'idEtudiant');
    }

    public function infoExames()
    {
        return $this->hasMany(InfoExame::class, 'idGroupe');
    }

    public function calendrierModuleGroupes()
    {
        return $this->hasMany(CalendrierModuleGroupe::class, 'idGroupe');
    }
}