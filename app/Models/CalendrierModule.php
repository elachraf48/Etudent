<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CalendrierModule extends Model
{
    protected $fillable = ['DateExamen', 'Houre', 'idModule', 'AnneeUniversitaire'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function calendrierModuleGroupes()
    {
        return $this->hasMany(CalendrierModuleGroupe::class, 'idCmodule');
    }
}