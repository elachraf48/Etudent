<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reclamation extends Model
{
    protected $fillable = ['idEtudiant', 'idProfesseur', 'idModule', 'idInfo_Exames', 'Sujet', 'observations', 'code_tracking'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'idProfesseur');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function infoExames()
    {
        return $this->belongsTo(InfoExame::class, 'idInfo_Exames');
    }
    use HasFactory;

}