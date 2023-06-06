<?php

namespace App\Libraries;

class UolLibertadores
{
  protected $campeonato;
  protected $temporada;

  public function __construct($campeonato, $temporada)
  {
    $this->campeonato = $campeonato;
    $this->temporada = $temporada;
  }

  public function api()
  {
    $url = "https://jsuol.com.br/c/monaco/utils/gestor/commons.js?callback=simulador_dados_jsonp&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/$this->temporada/$this->campeonato/dados.json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_POST, 0);

    $resultado = curl_exec($ch);
    curl_close($ch);

    $resultado = urldecode($resultado);
    $resultado = mb_convert_encoding($resultado, "UTF-8");
    parse_str($resultado, $retorno);

    $resultado = json_decode(substr(trim(str_replace('simulador_dados_jsonp(', '', $resultado)), 0, -2));

    return $resultado;
  }

  public function campeonato()
  {
    $resultado = (array) $this->api();

    return [
      "campeonato" => $resultado["id"],
      "temporada" => $resultado["temporada"],
      "nome-completo" => $resultado["nome-completo"],
      "nome-comum" => $resultado["nome-comum"],
    ];
  }

  public function rodadas()
  {
    $resultado = (array) $this->api();

    $ordem_fases = (array) $resultado["ordem-fases"];
    $fases = (array) $resultado["fases"];

    $rodadas = [];
    for ($i = 0; $i < count($ordem_fases); $i++) {
      $rodadas[$ordem_fases[$i]] = (array) $fases[$ordem_fases[$i]]->jogos->id;
      foreach ($rodadas[$ordem_fases[$i]] as $value) {
        $value->nome = $fases[$ordem_fases[$i]]->nome;
      }
    }

    return [
      "ordem_fases" => $ordem_fases,
      "rodadas" => $rodadas,
    ];
  }

  public function equipes()
  {
    $resultado = (array) $this->api();

    return $resultado["equipes"];
  }
}
