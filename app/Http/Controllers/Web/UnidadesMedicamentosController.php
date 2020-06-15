<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UnidadeMedicamento;

class UnidadesMedicamentosController extends Controller
{

	private $paginate = 12;

    public function index(Request $request){

    	$unidadesMed = UnidadeMedicamento::with('unidade', 'medicamento');

		if(isset($request->unidade)){
			$unidadesMed = $unidadesMed->where('unidade_id', '=', $request->unidade);
		}
    		
    	$unidadesMed = $unidadesMed->paginate($this->paginate);

        return view('unidades_medicamentos', compact('unidadesMed'));

    }
}
