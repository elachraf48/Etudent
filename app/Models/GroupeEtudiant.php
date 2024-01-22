<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupeEtudiant extends Model
{
    protected $table = 'Groupe_etudiant';
    protected $primaryKey = 'id';

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
    public function groupes()
{
    return $this->belongsToMany(Groupe::class, 'Groupe_etudiant');
}

}
