<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Historiaclinica extends Model
{
    public function user_m()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function diagnosticos_m()
    {
        return $this->belongsToMany(Sintoma::class, 'diagnosticos', 'historiaclinica_id', 'sintoma_id');

    }

    public function enfermedad_m()
    {
        return $this->belongsTo(Enfermedad::class, 'enfermedad_id');
    }

}
