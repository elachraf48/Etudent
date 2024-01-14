<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModule extends Model
{
    use HasFactory;

    protected $fillable = ['idSESSION', 'idModule', 'idEtudiant', 'etat', 'AnneeUniversitaire'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }

    public function calendrierSession()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSESSION');
    }
}
