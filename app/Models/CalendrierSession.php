<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendrierSession extends Model
{
    use HasFactory;

    protected $fillable = ['SESSION', 'part_Semester'];

    public function calendrierModules()
    {
        return $this->hasMany(CalendrierModule::class, 'idSESSION');
    }

    public function detailModules()
    {
        return $this->hasMany(DetailModule::class, 'idSESSION');
    }

    public static function getAllSessions()
    {
        return self::all();
    }
}
