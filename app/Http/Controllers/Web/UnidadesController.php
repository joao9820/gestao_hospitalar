<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unidade;

class UnidadesController extends Controller
{
    public function index(){


    	$unidades = Unidade::all();

        return view('unidades', compact('unidades'));

    }
}
