<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterPage extends Model
{
    protected $table = 'parameter_pages';
    protected $fillable = ['NamePage', 'lastdate', 'statu','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
    use HasFactory;
}
