<?php

namespace App\Models;

use CodeIgniter\Model;

class RodadaModel extends Model
{
  protected $table = 'rodadas';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'campeonato_id', 'temporada', 'time1', 'time2', 'nome', 'placar1', 'placar2', 'penalti1', 'penalti2', 'data', 'horario', 'estadio', 'local'];

  public function getRodadasCampeonato($campeonato = 0, $temporada = 0, $equipeId = 0, $proximosJogos = false)
  {
    $equipeModel = new EquipeModel();
    $campeonatoModel = new CampeonatoModel();

    if ($campeonato != 0) {
      $this->where("campeonato_id", $campeonato);
    }

    if ($temporada != 0 && $temporada != "Todos") {
      $this->where("temporada", $temporada);
    }

    if ($equipeId != 0) {
      $this->where("(time1 = " . $equipeId . " or " . "time2 = " . $equipeId . ")");
    }


    if ($proximosJogos) {
      $this->where("data >=", date("Y-m-d"));
    }

    $resultado = $this
      ->where("data <>", null)
      ->orderBy("data")
      ->orderBy("horario")
      ->orderBy("id")
      ->findAll();

    for ($i = 0; $i < count($resultado); $i++) {
      $resultado[$i]["campeonato_id"] = $campeonatoModel->getCampeonatoId($resultado[$i]["campeonato_id"], $resultado[$i]["temporada"]);
      $resultado[$i]["time1"] = $equipeModel->getEquipeId($resultado[$i]["time1"]);
      $resultado[$i]["time2"] = $equipeModel->getEquipeId($resultado[$i]["time2"]);
      $resultado[$i]["data"] = format_date($resultado[$i]["data"]);
    }

    return $resultado;
  }

  public function add($campeonato, $temporada, $params)
  {
    $dados = (array) $params;

    $existeRodada = $this->where([
      'campeonato_id' => $campeonato,
      'temporada' => $temporada,
      'time1' => $dados["time1"],
      'time2' => $dados["time2"]
    ])->first();


    if ($existeRodada) {
      $this->where([
        'campeonato_id' => $campeonato,
        'temporada' => $temporada,
        'time1' => $dados["time1"],
        'time2' => $dados["time2"]
      ])->save(
        [
          'id' => $existeRodada["id"],
          'campeonato_id' => $campeonato,
          'temporada' => $temporada,
          'time1' => $dados["time1"],
          'time2' => $dados["time2"],
          'nome' => $dados["nome"],
          'placar1' => $dados["placar1"],
          'placar2' => $dados["placar2"],
          'penalti1' => $dados["penalti1"],
          'penalti2' => $dados["penalti2"],
          'data' => $dados["data"],
          'horario' => $dados["horario"],
          'estadio' => $dados["estadio"],
          'local' => $dados["local"],
        ]
      );

      return ["message" => MSG_UPDATE];
    } else {
      $this->insert(
        [
          'id' => $dados["rodada"],
          'campeonato_id' => $campeonato,
          'temporada' => $temporada,
          'time1' => $dados["time1"],
          'time2' => $dados["time2"],
          'nome' => $dados["nome"],
          'placar1' => $dados["placar1"],
          'placar2' => $dados["placar2"],
          'penalti1' => $dados["penalti1"],
          'penalti2' => $dados["penalti2"],
          'data' => $dados["data"],
          'horario' => $dados["horario"],
          'estadio' => $dados["estadio"],
          'local' => $dados["local"],
        ]
      );
      return ["message" => MSG_INSERT];
    }
  }
}
