<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendrierModule extends Model
{
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
