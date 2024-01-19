<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeEtudiant extends Model
{
    protected $table = 'groupe_etudiant';

    protected $fillable = ['idEtudiant', 'idGroupe'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}