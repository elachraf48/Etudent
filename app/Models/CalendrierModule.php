<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendrierModule extends Model
{
    use HasFactory;

    protected $fillable = ['DateExamen', 'Houre', 'idModule', 'idSESSION', 'AnneeUniversitaire'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function calendrierSession()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSESSION');
    }
    public function detailModule()
    {
        return $this->hasOne(DetailModule::class, 'idCalendrierModule');
    }
}
