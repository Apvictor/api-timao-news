<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

use App\Models\TokenModel;
use App\Models\UsuarioModel;
use PHPUnit\Util\Json;

class AuthApi implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $header = $request->getHeader("Authorization");
    $token = null;

    // extract the token from the header
    if (!empty($header)) {
      if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
        $token = $matches[1];
      }
    }

    // check if token is null or empty
    if (is_null($token) || empty($token)) {
      log_message('info', 'Acesso negado - Token JWT não fornecido');
      $response = service('response');
      $response->setBody('Acesso negado - Token JWT não fornecido');
      $response->setStatusCode(401);
      return $response;
    }

    $usuarioModel = new UsuarioModel();
    $tokenModel = new TokenModel();

    try {
      $responseToken = $tokenModel->getByToken($token);

      $dataAtual = date("Y-m-d H:i:s");

      $usuario = $usuarioModel->select(['id', 'nome', 'sobrenome', 'email'])
        ->where('id', $responseToken['usuario_id'])
        ->first();

      $request->setGlobal('post', $usuario);
    } catch (Exception $ex) {
      if ($dataAtual > $responseToken["expiracao"]) {
        $novoToken = $usuarioModel->createToken($responseToken["usuario_id"], 60);

        $response = service('response');
        $response->setBody($novoToken);
        $response->setBody("NOVO TOKEN");
        $response->setStatusCode(200);
        return $response;
      }

      log_message('info', 'Acesso negado - Falha no JWT ' . $ex);
      $response = service('response');
      $response->setBody("Acesso negado - Falha no JWT");
      $response->setStatusCode(401);
      return $response;
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    //
  }
}
