<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailModule extends Model
{
    protected $table = 'detail_modules';
    protected $fillable = ['idSESSION', 'idModule', 'idEtudiant', 'etat', 'AnneeUniversitaire'];

    public function session()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSESSION');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'idEtudiant');
    }
}
