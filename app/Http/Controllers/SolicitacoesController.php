<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Solicitacao;
use App\SolicitacaoItem;

class SolicitacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'unidade' => 'required|integer',
            'medicamento' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $solicitacao = new Solicitacao();

        $solicitacaoId = '';

        //Sempre terá que trazer apenas uma pendente verificar condições para que isso ocorr\

        //Se não encontrar retorna null da collect
        $pedidoPendente = $solicitacao::where([['user_id', '=' ,Auth::user()->id], ['unidade_id', '=' ,$request->unidade], ['finalizada', '=' ,false]])->first();

        if($pedidoPendente){

            $solicitacaoId = $pedidoPendente->id;

            $medicamento_id = $request->medicamento;


            $medicamentos = $solicitacao::find($solicitacaoId)->medicamentoExist($medicamento_id)->get();

            if($medicamentos->isNotEmpty()){


                /*$existMed = $medicamentos->contains(function($value, $key) use ($medicamento_id){

                    return $value->pivot->medicamento_id == $medicamento_id;

                });*/

                return response()->json(["O medicamento já foi adicionado, verifique a sua cesta"], 400);

            }


        }else{

            $solicitacao->user_id = Auth::user()->id;
            $solicitacao->unidade_id = $request->unidade;

            if(!$solicitacao->save()){
                return response()->json(["resp" => "Não foi possível criar a solicitação"], 400);
            }

            $solicitacaoId = $solicitacao->id;

        }

        $itemSolicitacao = new SolicitacaoItem();

        $itemSolicitacao->solicitacao_id = $solicitacaoId;
        $itemSolicitacao->medicamento_id = $request->medicamento;
        $itemSolicitacao->quantidade_item = 1; //Quantidade Padrão ao adicionar ao carrinho

        if(!$itemSolicitacao->save()){
            return response()->json(["resp" => "Não foi possível inserir o medicamento à sua cesta"], 400);
        }

        return response()->json(["resp" => "O medicamento foi inserido à sua cesta"], 200);

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
