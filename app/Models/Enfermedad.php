<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    
    // una enfermedad tiene varios sintomas
    public function sintomas_m()
    {
        return $this->belongsToMany(Sintoma::class, 'enfermedadsintomas', 'enfermedad_id', 'sintoma_id');
    }

    public function tieneSintoma($idE,$idS)
    {
        $es=Enfermedadsintoma::where(['enfermedad_id'=>$idE,'sintoma_id'=>$idS])->first();
        if($es){
            return true;
        }
        return false;
    }

    public function historiasClinicas_m()
    {
        return $this->hasMany(Historiaclinica::class);
    }
}
