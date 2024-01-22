<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendrierModule extends Model
{
    protected $table = 'Calendrier_modules';
    protected $fillable = ['DateExamen', 'Houre', 'idModule', 'idSESSION', 'AnneeUniversitaire'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'idModule');
    }

    public function session()
    {
        return $this->belongsTo(CalendrierSession::class, 'idSESSION');
    }
}
