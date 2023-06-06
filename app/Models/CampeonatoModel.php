<?php

namespace App\Models;

use CodeIgniter\Model;

class CampeonatoModel extends Model
{
  protected $table = 'campeonatos';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'nome_completo', 'nome_comum', 'temporada'];

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
