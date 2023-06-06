<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipeModel extends Model
{
  protected $table = 'equipes';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id', 'nome', 'nome_comum', 'sigla', 'tipo', 'brasao'];

  public function getEquipeId($equipe)
  {
    return $this
      ->select('id, nome, nome_comum, sigla, brasao')
      ->find($equipe);
  }
  
  public function getEquipe($equipe)
  {
    return $this
      ->select('id, nome, nome_comum, sigla, brasao')
      ->like("nome", $equipe)
      ->like("nome_comum", $equipe)
      ->first();
  }

  public function add($params)
  {
    $dados = (array) $params;

    $existeEquipe = $this->find($dados["id"]);

    if (!$existeEquipe) {
      $this->insert(
        [
          'id' => $dados["id"],
          'nome' => $dados["nome"],
          'nome_comum' => $dados["nome-comum"],
          'sigla' => $dados["sigla"],
          'tipo' => $dados["tipo"],
          'brasao' => $dados["brasao"]
        ]
      );

      return ["message" => MSG_INSERT];
    } else {
      $this->where([
        'id' => $dados["id"]
      ])->save(
        [
          'id' => $dados["id"],
          'nome' => $dados["nome"],
          'nome_comum' => $dados["nome-comum"],
          'sigla' => $dados["sigla"],
          'tipo' => $dados["tipo"],
          'brasao' => $dados["brasao"]
        ]
      );

      return ["message" => MSG_UPDATE];
    }
  }
}
