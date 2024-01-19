<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['CodeModule', 'NomModule', 'Semester', 'idFiliere'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'idFiliere');
    }

    public function calendrierModules()
    {
        return $this->hasMany(CalendrierModule::class, 'idModule');
    }
}
