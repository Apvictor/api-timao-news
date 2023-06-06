<?php

namespace App\Models;

use CodeIgniter\Model;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UsuarioModel extends Model
{
  protected $table = 'usuarios';
  protected $primaryKey = 'id';
  protected $allowedFields = ['nome', 'sobrenome', 'email', 'senha', 'telefone', 'cpf'];
  protected $validationRules = [];

  public function getAll($filtros = [])
  {
    $resultado = $this
      ->select("usuarios.*, usuarios_sistemas.status")
      ->join("usuarios_sistemas", "usuario_id = usuarios.id")
      ->where("usuarios_sistemas.sistema_id", session()->get("sistema")["id"]);

    if (!empty($filtros["search"])) {
      $resultado->like(["nome" => $filtros["search"]]);
      $resultado->orLike(["sobrenome" => $filtros["search"]]);
    }

    if (!empty($filtros["status"])) {
      $resultado->where("usuarios_sistemas.status", $filtros["status"]);
    }

    return $resultado->findAll();
  }

  public function getAllForChart($ano)
  {
    $resultado = $this->select("COUNT(usuarios.id) AS total, EXTRACT(MONTH FROM created_at) mes, EXTRACT(YEAR FROM created_at) ano")
      ->join("usuarios_sistemas", "usuario_id = usuarios.id")
      ->where("usuarios_sistemas.sistema_id", session()->get("sistema")["id"])
      ->where('YEAR(created_at)', $ano)
      ->groupBy("EXTRACT(MONTH FROM created_at), EXTRACT(YEAR FROM created_at)")
      ->orderBy("ano", "DESC")
      ->orderBy("mes", "ASC")
      ->findAll();

    $meses = ["0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0"];

    for ($i = 0; $i < count($resultado); $i++) {
      for ($y = 0; $y < count($meses); $y++) {
        if ($y + 1 == $resultado[$i]["mes"]) {
          $meses[$y] = $resultado[$i]["total"];
        }
      }
    }

    return $meses;
  }

  public function getById($usuario_id)
  {
    $resultado = $this
      ->select("usuarios.*, usuarios_sistemas.status, usuarios_sistemas.id AS usuarios_sistemas_id")
      ->join("usuarios_sistemas", "usuario_id = usuarios.id")
      ->where("usuarios_sistemas.sistema_id", session()->get("sistema")["id"])
      ->where("usuarios.id", $usuario_id)
      ->first();

    return $resultado;
  }

  public function getUserCompleteById($usuario_id)
  {
    $resultado = $this->where(["usuarios.id" => $usuario_id])->first();

    return $resultado;
  }

  public function getByEmail($email)
  {
    $resultado = $this
      ->select("usuarios.*, usuarios_sistemas.sistema_id, usuarios_sistemas.status")
      ->join("usuarios_sistemas", "usuario_id = usuarios.id")
      ->where([
        "email" => $email,
        "sistema_id" => get_sistema_api(),
        "usuarios_sistemas.status" => ATIVO
      ]);

    return $resultado->first();
  }

  public function cadastrar($data)
  {
    $this->db->transBegin();

    $usuarioSistemaModel = new UsuarioSistemaModel();

    $data->senha = password_hash($data->senha, PASSWORD_DEFAULT);

    $this->save($data);

    $usuario_id = $this->getInsertID();

    $usuarioSistemaModel->cadastrar($usuario_id);

    if ($this->db->transStatus() === FALSE) {
      $this->db->transRollback();
      return [
        "status" => false,
        "message" => "Ocorreu uma falha ao cadastrar!"
      ];
    } else {
      $this->db->transCommit();
      return [
        "status" => true,
        "message" => "Cadastro realizado com sucesso!"
      ];
    }
  }

  public function createToken($usuario_id, $expiracao = 3600)
  {
    $key = getenv('JWT_SECRET');
    $iat = time(); // current timestamp value
    $exp = $iat + $expiracao;

    $payload = array(
      "iss" => "Issuer of the JWT",
      "aud" => "Audience that the JWT",
      "sub" => "Subject of the JWT",
      "iat" => $iat, //Time the JWT issued at
      "exp" => $exp, // Expiration time of token
      "usuario_id" => $usuario_id,
      "sistema_id" => get_sistema_api(),
    );

    $token = JWT::encode($payload, $key, 'HS256');

    $tokenModel = new TokenModel();

    $dados = [
      "usuario_id" => $usuario_id,
      "authorization" => $token,
      "expiracao" => date("Y-m-d H:i:s", $exp),
    ];

    $tokenModel->add($dados);

    return $token;
  }
}
