<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitacao;
use Illuminate\Support\Facades\Auth;

class SolicitacoesController extends Controller
{

	public function index(){

		$solicitacoes = Solicitacao::with(['medicamentos', 'unidades'])->where([['user_id', Auth::user()->id],  ['finalizada', false]])->get();

		return view('solicitacoes', compact('solicitacoes'));

	}
    
}
