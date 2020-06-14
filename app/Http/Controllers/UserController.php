<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
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
        $user = User::find($id);

        if(!$user)
            return response()->json(['resp' => 'Usuário não foi encontrado'], 400);

        //Retorna o objeto com os atributos públicos do usuário encotrado
        return response()->json($user, 200);
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
        $user = User::find($id);

        /*Nessa página é possível mudar o nível de acesso se a pessoa tiver status
        de admin*/

        if(!$user){

            return response()->json(['resp' =>'Usuário não encontrado'], 500);

        }

        //is_admin por default no bd está 0, o admin não precisa informar a senha antiga
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:6',
            'email' => [
                'required',
                'string', 'email',
                    Rule::unique('users')->ignore($user->id)
            ],
            'old_password' => [
                'nullable',
                 function ($attribute, $value, $fail) use ($user) {
                    if (!\Hash::check($value, $user->password)) {
                        return $fail(__('messages.old_password_incorrect'));
                    }
                }
            ],
            'is_admin' => 'nullable',
            'password' => 'nullable|string|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        //Quando o usuário tiver acesso valdiar essa posição
        $user->is_admin = (boolean) $request->is_admin;

        if($request->password)
            $user->password = bcrypt($request->password);

        if(!$user->save())
            return response()->json(['resp' => 'Não foi possível atualizar os dados do usuário'], 500);


        return response()->json(['resp'=>'Dados atualizados com sucesso!', 'obj' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user)
            return response()->json(['resp' =>'Usuário não encontrado'], 500);

        if(!$user->destroy($id))
            return response()->json(['resp' =>'Não foi possível deletar o usuário'], 500);

        return response()->json(['resp' =>'Usuário deletado com sucesso!'], 200);
    }
}
