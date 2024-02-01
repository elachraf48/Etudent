<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_professeurs extends Model
{
    use HasFactory; 
}
class DetailProfesseur extends Model
{
    protected $fillable = ['idProfesseur', 'idModule', 'AnneeUniversitaire', 'idGroupe'];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'idProfesseur');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}