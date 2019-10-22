<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Partida extends Controller
{
    private $jogo;
    private $database;

    public function __construct(
        \App\Jogo $jogo,
        \DB $database
    ) {
        $this->jogo = $jogo;
        $this->database = $database;
    }

    public function index()
    {
        $times = $this->jogo->orderBy('created_at', 'desc')->take(4)->get();
        return view('/partida')->with('times', $times);
    }

    public function dadosDaRodada(Request $req)
    {
        $data = $req->toArray();
        unset($data['_token']);

        $qtd = count($data) / 2;

        for ($_i = 1; $_i < $qtd; $_i++) {

            if (isset($data['placar_time_' . $_i]) && isset($data['time_' . $_i])) {
                $timeCasa['time_casa'] = $data['time_' . $_i];

                if ($data['placar_time_' . $_i] >= 0) {
                    $timeCasa['placar_casa'] = $data['placar_time_' . $_i];
                } else {
                    return "O valor " . $data['placar_time_' . $_i] . " do time " . $data['time_' . $_i] . " é inválido";
                }

            } else {
                return "Preencha todos os campos";
            }

            $_i++;

            if (isset($data['placar_time_' . $_i]) && isset($data['time_' . $_i])) {
                $timeVisitante['time_visitante'] = $data['time_' . $_i];

                if ($data['placar_time_' . $_i] >= 0) {
                    $timeVisitante['placar_visitante'] = $data['placar_time_' . $_i];
                } else {
                    return "O valor " . $data['placar_time_' . $_i] . " do time " . $data['time_' . $_i] . " é inválido";
                }

            } else {
                return "Preencha todos os campos";
            }

            $this->executarJogo($timeCasa, $timeVisitante);

            return redirect('/partida');
        }
    }

    public function executarJogo($timeCasa, $timeVisitante)
    {
        echo '<pre>';

        /* Dados do Time Mandante */
        $placarCasa = $timeCasa['placar_casa'];
        $timeCasa = $timeCasa['time_casa'];
        $timeCasaDados = $this->jogo->getDadosPeloNome($timeCasa)->first();

        /* Dados do Time Visitante */
        $placarVisitante = $timeVisitante['placar_visitante'];
        $timeVisitante = $timeVisitante['time_visitante'];
        $timeVisitanteDados = $this->jogo->getDadosPeloNome($timeVisitante)->first();
        // var_dump($timeCasaDados);die;
        if (isset($placarCasa) && isset($placarVisitante)) {
            if ($placarCasa > $placarVisitante) {
                /* Vitória Time Mandante */
                if (isset($timeCasa)) {
                    $this->pontuar($timeCasaDados, $timeVisitanteDados, $placarCasa, $placarVisitante);
                    $this->jogos($timeCasaDados);
                    $this->vitoria($timeCasaDados);
                    $this->golsPro($timeCasaDados, $placarCasa);
                    $this->golsContra($timeCasaDados, $placarVisitante);
                    $this->saldoDeGols($timeCasaDados, $placarCasa, $placarVisitante);
                }

                if (isset($timeVisitante)) {
                    $this->jogos($timeVisitanteDados);
                    $this->derrota($timeVisitanteDados);
                    $this->golsPro($timeVisitanteDados, $placarVisitante);
                    $this->golsContra($timeVisitanteDados, $placarCasa);
                    $this->saldoDeGols($timeVisitanteDados, $placarCasa, $placarVisitante);
                }

                /* Empate */
            } elseif ($placarCasa == $placarVisitante) {
                if (isset($timeCasa)) {
                    $this->pontuar($timeCasaDados, $timeVisitanteDados, $placarCasa, $placarVisitante);
                    $this->jogos($timeCasaDados);
                    $this->empate($timeCasaDados);
                    $this->golsPro($timeCasaDados, $placarCasa);
                    $this->golsContra($timeCasaDados, $placarVisitante);
                }

                if (isset($timeVisitante)) {
                    $this->pontuar($timeCasaDados, $timeVisitanteDados, $placarCasa, $placarVisitante);
                    $this->jogos($timeVisitanteDados);
                    $this->empate($timeVisitanteDados);
                    $this->golsPro($timeVisitanteDados, $placarVisitante);
                    $this->golsContra($timeVisitanteDados, $placarCasa);
                }

                /* Vitória Time Visitante */
            } else {
                if (isset($timeCasa)) {
                    $this->jogos($timeCasaDados);
                    $this->derrota($timeCasaDados);
                    $this->golsPro($timeCasaDados, $placarCasa);
                    $this->golsContra($timeCasaDados, $placarVisitante);
                    $this->saldoDeGols($timeCasaDados, $placarCasa, $placarVisitante);
                }
                if (isset($timeVisitante)) {
                    $this->pontuar($timeCasaDados, $timeVisitanteDados, $placarCasa, $placarVisitante);
                    $this->jogos($timeVisitanteDados);
                    $this->vitoria($timeVisitanteDados);
                    $this->golsPro($timeVisitanteDados, $placarVisitante);
                    $this->golsContra($timeVisitanteDados, $placarCasa);
                    $this->saldoDeGols($timeVisitanteDados, $placarCasa, $placarVisitante);
                }
            }
        }
    }

    /* Funções de Resultados */
    public function pontuar($timeCasaDados, $timeVisitanteDados, $golsTime1, $golsTime2)
    {
        if ($golsTime1 > $golsTime2) {
            $this->jogo->setPontos($timeCasaDados->pontos + 3);
        } elseif ($golsTime1 == $golsTime2) {
            $this->jogo->setPontos($timeCasaDados->pontos + 1);
            $this->jogo->setPontos($timeVisitanteDados->pontos + 1);
        } elseif ($golsTime1 < $golsTime2) {
            $this->jogo->setPontos($timeVisitanteDados->pontos + 3);
        } else {
            return null;
        }
    }

    public function jogos($time)
    {
        $this->jogo->setJogos($time->jogos + 1);
    }

    public function vitoria($time)
    {
        $this->jogo->setVitoria($time->vitoria + 1);
    }

    public function derrota($time)
    {
        $this->jogo->setDerrota($time->derrota + 1);
    }

    public function empate($time)
    {
        $this->jogo->setEmpate($time->empate + 1);
    }

    public function golsPro($time, $gp)
    {
        $this->jogo->setGolsPro($time->gols_pro + $gp);
    }

    public function golsContra($time, $gc)
    {
        $this->jogo->setGolsPro($time->gols_contra + $gc);
    }

    public function saldoDeGols($time, $gp, $gc)
    {
        $sg = $gp - $gc;
        $this->jogo->setSaldoDeGols($time->saldo_de_gols + $sg);
    }
}
