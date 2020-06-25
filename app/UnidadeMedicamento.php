<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadeMedicamento extends Model
{
    public function unidade(){
 
    	return $this->belongsTo("App\Unidade", "unidade_id");
    }

    public function medicamento(){

    	return $this->belongsTo("App\Medicamento", "medicamento_id");

    }

}
