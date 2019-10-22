<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jogo extends Model
{
    private $id;
    private $classificacao;
    private $nome;
    private $pontos;
    private $jogos;
    private $vitoria;
    private $derrota;
    private $empate;
    private $golsPro;
    private $golsContra;
    private $saldoDeGols;

    /* Sets */
    public function setClassificacao($classificacao)
    {
        $this->classificacao = $classificacao;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }

    public function setJogos($jogos)
    {
        $this->jogos = $jogos;
    }

    public function setVitoria($vitoria)
    {
        $this->vitoria = $vitoria;
    }

    public function setDerrota($derrota)
    {
        $this->derrota = $derrota;
    }

    public function setEmpate($empate)
    {
        $this->empate = $empate;
    }

    public function setGolsPro($golsPro)
    {
        $this->golsPro = $golsPro;
    }

    public function setGolsContra($golsContra)
    {
        $this->golsContra = $golsContra;
    }

    public function setSaldoDeGols($saldoDeGols)
    {
        $this->saldoDeGols = $saldoDeGols;
    }

    public function setDados($id, $classificacao, $nome, $jogos, $pontos, $vitoria, $derrota, $empate, $golsPro, $golsContra, $saldoDeGols)
    {
        $this->id = $id;
        $this->classificacao = $classificacao;
        $this->nome = $nome;
        $this->pontos = $pontos;
        $this->jogos = $jogos;
        $this->vitoria = $vitoria;
        $this->derrota = $derrota;
        $this->empate = $empate;
        $this->golsPro = $golsPro;
        $this->golsContra = $golsContra;
        $this->saldoDeGols = $saldoDeGols;
    }

    /* GETs */
    public function getId()
    {
        return $this->id;
    }

    public function getClassificacao()
    {
        return $this->classificacao;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getPontos()
    {
        return $this->pontos;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    public function getVitoria()
    {
        return $this->vitoria;
    }

    public function getDerrota()
    {
        return $this->derrota;
    }

    public function getEmpate()
    {
        return $this->empate;
    }

    public function getGolsPro()
    {
        return $this->golsPro;
    }

    public function getGolsContra()
    {
        return $this->golsContra;
    }

    public function getSaldoDeGols()
    {
        return $this->saldoDeGols;
    }

    public function getDados()
    {
        return $data = [
            'id' => $this->id,
            'classificacao' => $this->classificacao,
            'nome' => $this->nome,
            'pontos' => $this->pontos,
            'jogos' => $this->jogos,
            'vitoria' => $this->vitoria,
            'derrota' => $this->derrota,
            'empate' => $this->empate,
            'gols_pro' => $this->golsPro,
            'gols_contra' => $this->golsContra,
            'saldo_de_gols' => $this->saldoDeGols,
        ];
    }

    public function getDadosPeloNome($nome)
    {
        return \DB::table('jogos')->get()->where('nome', $nome);
    }
}
