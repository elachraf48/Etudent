<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $fillable = ['CodeModule', 'NomModule', 'Semester', 'idFiliere','statu'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'idFiliere');
    }
    public function DetailProfesseur()
    {
        return $this->belongsTo(DetailProfesseur::class, 'idModule');
    }

    public function calendrierModules()
    {
        return $this->hasMany(CalendrierModule::class, 'idModule');
    }
}
