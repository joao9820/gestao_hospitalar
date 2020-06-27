<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SolicitacaoItem;
use Illuminate\Support\Facades\Auth;


class SolicitacaoItensController extends Controller
{
    
    public function count(){

        $solicitacao = SolicitacaoItem::join('solicitacoes', 'solicitacao_itens.solicitacao_id',
        'solicitacoes.id')->where([['solicitacoes.user_id', Auth::user()->id],  ['solicitacoes.finalizada', false]])->count();

        return response()->json($solicitacao, 200);

    }
}
