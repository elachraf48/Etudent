<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsertBy extends Model
{
    use HasFactory;
    protected $fillable = [
        'NameTable',
        'idTable',
        'insertBy',
    ];
}
