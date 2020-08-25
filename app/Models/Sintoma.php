<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    //

    public function hcTieneSintoma($hc,$sintoma)
    {
        $dg=Diagnostico::where(['historiaclinica_id'=>$hc,'sintoma_id'=>$sintoma])->first();
        if($dg){
            return $dg;
        }
        return null;
    }
}
