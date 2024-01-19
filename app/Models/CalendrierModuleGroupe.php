<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendrierModuleGroupe extends Model
{
    protected $table = 'calendrier_module_groupes';

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