<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class DetailModule extends Model
{
    protected $fillable = ['idModule', 'idEtudiant', 'etat', 'SESSION', 'part_Semester', 'AnneeUniversitaire'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }
}
