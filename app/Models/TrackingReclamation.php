<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TrackingReclamation extends Model
{
    protected $fillable = ['idReclamation', 'idProfesseur', 'stratu', 'Repense'];

    public function reclamation()
    {
        return $this->belongsTo(Reclamation::class, 'idReclamation');
    }

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'idProfesseur');
    }
    use HasFactory;

}