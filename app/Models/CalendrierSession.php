<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendrierSession extends Model
{
    protected $table = 'Calendrier_SESSIONS';
    protected $fillable = ['SESSION', 'part_Semester'];

    public function calendrierModules()
    {
        return $this->hasMany(CalendrierModule::class, 'idSESSION');
    }

    // Add other relationships as needed
}
