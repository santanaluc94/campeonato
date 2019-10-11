<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Partida extends Controller
{
    private $dadosDoTime;

    public function __construct(
        \App\DadosDoTime $dadosDoTime
    ) {
        $this->dadosDoTime = $dadosDoTime;
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
        }
        die;
    }

    public function executarJogo($timeCasa, $timeVisitante)
    {
        echo '<pre>';
        $placarCasa = $timeCasa['placar_casa'];
        $timeCasa = $timeCasa['time_casa'];
        $placarVisitante = $timeVisitante['placar_visitante'];
        $timeVisitante = $timeVisitante['time_visitante'];

        if (isset($placarCasa) && isset($placarVisitante)) {
            if ($placarCasa > $placarVisitante) {
                if (isset($timeCasa)) {
                    $this->pontuar($placarCasa, $placarVisitante);
                    $timeCasa->jogos();
                    $timeCasa->vitoria();
                    $timeCasa->golsPros($placarCasa);
                    $timeCasa->golsContra($placarVisitante);
                    $timeCasa->saldoGols();
                }

                if (isset($timeVisitante)) {
                    $timeVisitante->jogos();
                    $timeVisitante->derrota();
                    $timeVisitante->golsPros($placarVisitante);
                    $timeVisitante->golsContra($placarCasa);
                    $timeVisitante->saldoGols();
                }

            } elseif ($placarCasa == $placarVisitante) {
                if (isset($timeCasa)) {
                    $timeCasa->pontuar($placarCasa, $placarVisitante);
                    $timeCasa->jogos();
                    $timeCasa->empate();
                    $timeCasa->golsPros($placarCasa);
                    $timeCasa->golsContra($placarVisitante);
                }

                if (isset($timeVisitante)) {
                    $timeVisitante->pontuar($placarVisitante, $placarCasa);
                    $timeVisitante->jogos();
                    $timeVisitante->empate();
                    $timeVisitante->golsPros($placarVisitante);
                    $timeVisitante->golsContra($placarCasa);
                }

            } else {
                if (isset($timeCasa)) {
                    $timeCasa->jogos();
                    $timeCasa->derrota();
                    $timeCasa->golsPros($placarCasa);
                    $timeCasa->golsContra($placarVisitante);
                    $timeCasa->saldoGols();
                }
                if (isset($timeVisitante)) {
                    $timeVisitante->pontuar($placarVisitante, $placarCasa);
                    $timeVisitante->jogos();
                    $timeVisitante->vitoria();
                    $timeVisitante->golsPros($placarVisitante);
                    $timeVisitante->golsContra($placarCasa);
                    $timeVisitante->saldoGols();
                }
            }
        }
    }

    /* Funções de Resultados */
    public function pontuar($golsTime1, $golsTime2)
    {
        if ($golsTime1 > $golsTime2) {
            return $this->dadosDoTime->setPontos($this->dadosDoTime->getPontos() + 3);
        } elseif ($golsTime1 == $golsTime2) {
            $this->dadosDoTime->setPontos($this->dadosDoTime->getPontos() + 1);
        } else {
            return null;
        }
    }

    public function jogos()
    {
        $this->dadosDoTime->setJogos($this->dadosDoTime->getJogos() + 1);
    }

    public function vitoria()
    {
        $this->dadosDoTime->setVitoria($this->dadosDoTime->getVitoria() + 1);
    }

    public function derrota()
    {
        $this->dadosDoTime->setDerrota($this->dadosDoTime->getDerrota() + 1);
    }

    public function empate()
    {
        $this->dadosDoTime->setEmpate($this->dadosDoTime->getEmpate() + 1);
    }

    public function golsPro($gp)
    {
        $this->dadosDoTime->setGolsPros($this->dadosDoTime->getGolsPros() + $gp);
    }

    public function golsContra($gc)
    {
        $this->dadosDoTime->setGolsPros($this->dadosDoTime->getGolsPros() + $gc);
    }
}
