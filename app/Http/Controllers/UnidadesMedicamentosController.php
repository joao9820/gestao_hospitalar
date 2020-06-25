<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadeMedicamento;

class UnidadesMedicamentosController extends Controller
{

    private $paginate = 12;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesMed = UnidadeMedicamento::with('unidade', 'medicamento');

        if(isset($request->unidade)){
            $unidadesMed = $unidadesMed->where('unidade_id', '=', $request->unidade);
        }
            
        $unidadesMed = $unidadesMed->paginate($this->paginate);

        //Pensar em trazer duas posições, outra com os dados da solicitação através de um Join

        return response()->json($unidadesMed, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
