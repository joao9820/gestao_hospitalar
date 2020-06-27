<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacoes';

    public function unidades(){

    	return $this->belongsTo('App\Unidade', 'unidade_id');

    }

    public function medicamentos(){

    	return $this->belongsToMany('App\Medicamento', 'solicitacao_itens')->withPivot('quantidade_item');

    }

    public function medicamentoExist($medicamento_id){

    	return $this->belongsToMany('App\Medicamento', 'solicitacao_itens')->wherePivot('medicamento_id', $medicamento_id);

    }

}
