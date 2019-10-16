<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cadastro extends Controller
{
    public function cadastroDeTimes(Request $req)
    {
        $data = $req->toArray();
        unset($data['_token']);

        // var_dump($data);die;

        foreach ($data as $nome) {
            $_i = 1;
            if ($data['time_' . $_i] != null) {
                $jogo = new \App\Jogo();
                $jogo->nome = $nome;
                $jogo->save();
            } else {
                return view('cadastro_de_times');
            }
            $_i++;
        }
        return view('partida');
    }
}
