<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendrierModuleGroupe extends Model
{
    protected $table = 'Calendrier_module_Groupes';
    protected $fillable = ['idCmodule', 'idGroupe'];

    public function calendrierModule()
    {
        return $this->belongsTo(CalendrierModule::class, 'idCmodule');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'idGroupe');
    }
}
