<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Professeur extends Model
{
    protected $fillable = ['Nom', 'Prenom'];
    use HasFactory;
    // No relationships in this example
}