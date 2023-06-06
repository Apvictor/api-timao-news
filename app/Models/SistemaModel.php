<?php

namespace App\Models;

use CodeIgniter\Model;

class SistemaModel extends Model
{
  protected $table = 'sistemas';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'nome_fantasia', 'razao_social', 'ramo_sistema', 'cnpj', 'email', 'telefone', 'foto',
    'cep', 'endereco', 'numero', 'cidade', 'estado', 'tempo_entrega_min', 'tempo_entrega_max', 'pix',
    'aberto', 'fechado',
    'cor_primaria', 'cor_texto',
    'status'
  ];
  protected $validationRules = [
    'nome_fantasia' => 'required',
  ];

  public function getAll()
  {
    $resultado = $this->where("status", ATIVO);

    return $resultado->findAll();
  }

  /* Retorna uma empresa pelo seu e-mail */
  public function getByEmail(string $email)
  {
    $resultado = $this->where("email", $email)->first();

    return $resultado;
  }

  /* Retorna uma empresa pelo seu id */
  public function getById(string $id)
  {
    $resultado = $this->where("id", $id)->first();

    return $resultado;
  }
}
