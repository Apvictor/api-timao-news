<?php

namespace App\Models;

use CodeIgniter\Model;

class CampeonatoModel extends Model
{
  protected $table = 'campeonatos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'nome_completo', 'nome_comum', 'temporada'];

  public function getCampeonatos()
  {
    return $this
      ->select("id, nome_comum")
      ->groupBy("id")
      ->findAll();
  }

  public function getTemporadas()
  {
    $resultado = $this
      ->select("temporada")
      ->groupBy("temporada")
      ->orderBy("temporada", "DESC")
      ->findAll();

    $data = [];
    for ($i = 0; $i < count($resultado); $i++) {
      $data[$i]["nome_comum"] = $resultado[$i]["temporada"];
    }

    return $data;
  }

  public function getCampeonatoId($campeonato, $temporada = null)
  {
    return $this->where([
      "id" => $campeonato,
      "temporada" => $temporada ? $temporada : date("Y-m-d")
    ])->first();
  }

  public function add($params)
  {
    $dados = (array) $params;

    $existeCampeonato = $this->where(["id" => $dados["campeonato"], "temporada" => $dados["temporada"]])->first();

    if (!$existeCampeonato) {
      $this->insert(
        [
          'id' => $dados["campeonato"],
          'temporada' => $dados["temporada"],
          'nome_completo' => $dados["nome-completo"],
          'nome_comum' => $dados["nome-comum"],
        ]
      );

      return ["message" => MSG_INSERT];
    } else {
      $this->where([
        'id' => $dados["campeonato"],
        'temporada' => $dados["temporada"],
      ])->save(
        [
          'id' => $dados["campeonato"],
          'temporada' => $dados["temporada"],
          'nome_completo' => $dados["nome-completo"],
          'nome_comum' => $dados["nome-comum"],
        ]
      );

      return ["message" => MSG_UPDATE];
    }
  }
}
