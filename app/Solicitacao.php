<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    public function medicamentos(){

    	return $this->belongsToMany('App\Medicamento', 'solicitacao_itens');

    }

    public function medicamentoExist($medicamento_id){

    	return $this->belongsToMany('App\Medicamento', 'solicitacao_itens')->wherePivot('medicamento_id', $medicamento_id);

    }

}
