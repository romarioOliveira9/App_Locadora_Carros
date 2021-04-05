<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->all(['email','password']);

        //autenticação(email e senha)
        $token = auth('api')->attempt($credenciais);

        if ($token) { //usuario autenticado com sucesso
            return response()->json(['token' => $token], 200);
        } else { //erro de usuário ou senha
            return response()->json(['erro' => 'Usuário ou senha inválido'], 403);
        }

        //401 = Unathorized -> não autorizado
        //403 = forbbiden -> proibido (login inválido)

        return 'login';
    }

    public function logout()
    {
        return 'logout';
    }

    public function refresh()
    {
        return 'refresh';
    }

    public function me()
    {
        return 'me';
    }
}
