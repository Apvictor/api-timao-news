<?php

namespace App\Models;

use CodeIgniter\Model;

class RodadaModel extends Model
{
  protected $table = 'rodadas';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'campeonato_id', 'temporada', 'time1', 'time2', 'nome', 'placar1', 'placar2', 'penalti1', 'penalti2', 'data', 'horario', 'estadio', 'local'];

  public function getRodadasCampeonato($campeonato, $temporada, $equipe)
  {
    $equipeModel = new EquipeModel();

    $equipe = $equipeModel->getEquipe($equipe);

    $resultado = $this
      ->where("campeonato_id", $campeonato)
      ->where("temporada", $temporada)
      ->where("time1", $equipe["id"])
      ->orWhere("time2", $equipe["id"])
      ->orderBy("id")
      ->orderBy("data")
      ->orderBy("horario")
      ->findAll();

    for ($i = 0; $i < count($resultado); $i++) {
      $resultado[$i]["time1"] = $equipeModel->getEquipeId($resultado[$i]["time1"]);
      $resultado[$i]["time2"] = $equipeModel->getEquipeId($resultado[$i]["time2"]);
    }

    return $resultado;
  }

  public function add($campeonato, $temporada, $params)
  {
    $dados = (array) $params;

    $existeRodada = $this->where(["id" => $dados["rodada"], 'campeonato_id' => $campeonato, 'temporada' => $temporada, 'time1' => $dados["time1"], 'time2' => $dados["time2"]])->first();

    if (!$existeRodada) {
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
    } else {
      $this->where([
        'id' => $dados["rodada"],
        'campeonato_id' => $campeonato,
        'temporada' => $temporada,
        'time1' => $dados["time1"],
        'time2' => $dados["time2"]
      ])->save(
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

      return ["message" => MSG_UPDATE];
    }
  }
}
