<?php

namespace Config;


use App\Controllers\Admin\CategoriaController;
use App\Controllers\Admin\ConfiguracaoController;
use App\Controllers\Admin\CupomController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\FormaPagamentoController;
use App\Controllers\Admin\GatewayController;
use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\PainelController;
use App\Controllers\Admin\PedidoController;
use App\Controllers\Admin\ProdutoController;
use App\Controllers\Admin\RegiaoController;
use App\Controllers\Admin\UsuarioController;

use App\Controllers\Api\CartaoController;
use App\Controllers\Api\CategoriaController as ApiCategoriaController;
use App\Controllers\Api\CupomController as ApiCupomController;
use App\Controllers\Api\EnderecoController;
use App\Controllers\Api\PagamentoController;
use App\Controllers\Api\PedidoController as ApiPedidoController;
use App\Controllers\Api\ProdutoController as ApiProdutoController;
use App\Controllers\Api\SistemaController;
use App\Controllers\Api\UsuarioController as ApiUsuarioController;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController(LoginController::class);
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route ADMIN
 * --------------------------------------------------------------------
 */
$routes->get('/', [LoginController::class, "index"]);
$routes->post('/login', [LoginController::class, "login"]);
$routes->get('/logout', [LoginController::class, "logout"]);

$routes->group('admin', ['filter' => 'authAdmin'], function ($routes) {

    $routes->group('dashboard', function ($routes) {
        $routes->get('', [DashboardController::class, "index"]);
        $routes->get('graphic/(:num)', [DashboardController::class, "graphic"]);
    });

    $routes->group('painel', function ($routes) {
        $routes->get('', [PainelController::class, "index"]);
        $routes->get('kanban', [PainelController::class, "kanban"]);
        $routes->get('pedido/(:num)/status/(:any)', [PainelController::class, "status"]);
    });

    $routes->group('forma_de_pagamentos', function ($routes) {
        $routes->get('', [FormaPagamentoController::class, "index"]);
        $routes->get('(:num)/status', [FormaPagamentoController::class, "status"]);
        $routes->get('(:num)/adicionar', [FormaPagamentoController::class, "adicionar"]);
    });

    $routes->group('categorias', function ($routes) {
        $routes->get('', [CategoriaController::class, "index"]);
        $routes->post('cadastrar', [CategoriaController::class, "cadastrar"]);
        $routes->get('(:num)/status', [CategoriaController::class, "status"]);
        $routes->post('(:num)/editar', [CategoriaController::class, "editar"]);
    });

    $routes->group('cupons', function ($routes) {
        $routes->get('', [CupomController::class, "index"]);
        $routes->post('cadastrar', [CupomController::class, "cadastrar"]);
        $routes->get('(:num)/status', [CupomController::class, "status"]);
        $routes->post('(:num)/editar', [CupomController::class, "editar"]);
    });

    $routes->group('gateways', function ($routes) {
        $routes->get('', [GatewayController::class, "index"]);
        $routes->post('cadastrar', [GatewayController::class, "cadastrar"]);
        $routes->get('(:num)/status', [GatewayController::class, "status"]);
        $routes->post('(:num)/editar', [GatewayController::class, "editar"]);
    });

    $routes->group('regioes', function ($routes) {
        $routes->get('', [RegiaoController::class, "index"]);
        $routes->post('cadastrar', [RegiaoController::class, "cadastrar"]);
        $routes->get('(:num)/status', [RegiaoController::class, "status"]);
        $routes->post('(:num)/editar', [RegiaoController::class, "editar"]);
    });

    $routes->group('produtos', function ($routes) {
        $routes->get('', [ProdutoController::class, "index"]);
        $routes->post('cadastrar', [ProdutoController::class, "cadastrar"]);
        $routes->get('(:num)/status', [ProdutoController::class, "status"]);
        $routes->post('(:num)/editar', [ProdutoController::class, "editar"]);
    });

    $routes->group('usuarios', function ($routes) {
        $routes->get('', [UsuarioController::class, "index"]);
        $routes->get('(:num)/status', [UsuarioController::class, "status"]);
    });

    $routes->group('pedidos', function ($routes) {
        $routes->get('', [PedidoController::class, "index"]);
    });

    $routes->group('configuracoes', function ($routes) {
        $routes->get('', [ConfiguracaoController::class, "index"]);
        $routes->post('(:num)/editar', [ConfiguracaoController::class, "editar/$1"]);
    });
});

/*
 * --------------------------------------------------------------------
 * Route API
 * --------------------------------------------------------------------
 */


$routes->group('api', ['filter' => 'cors'], function ($routes) {

    $routes->group('usuarios', function ($routes) {
        $routes->post('login', [ApiUsuarioController::class, "login"]);
        $routes->post('cadastrar', [ApiUsuarioController::class, "cadastrar"]);
        $routes->post('logout', [ApiUsuarioController::class, "logout"]);
        $routes->get('endereco/(:num)', [ApiUsuarioController::class, "endereco"]);
    });

    $routes->group('sistema', function ($routes) {
        $routes->get('', [SistemaController::class, "index"]);
        $routes->get('regioes/(:num)', [SistemaController::class, "regioes"]);
        $routes->get('pagamentos', [SistemaController::class, "formaPagamentos"]);
    });

    $routes->get('produtos', [ApiProdutoController::class, "index"]);
    $routes->get('categorias', [ApiCategoriaController::class, "index"]);
    $routes->get('cupons/(:any)', [ApiCupomController::class, "validarCupom"]);

    $routes->group('', ['filter' => 'authApi'], function ($routes) {

        $routes->group('usuarios', function ($routes) {
            $routes->get('', [ApiUsuarioController::class, "index"]);
            $routes->get('status', [ApiUsuarioController::class, "status"]);
        });

        $routes->group('enderecos', function ($routes) {
            $routes->get('', [EnderecoController::class, "index"]);
            $routes->post('cadastrar', [EnderecoController::class, "cadastrar"]);
            $routes->post('editar', [EnderecoController::class, "editar"]);
            $routes->post('(:num)/status', [EnderecoController::class, "status"]);
            $routes->post('(:num)/principal', [EnderecoController::class, "principal"]);
        });

        $routes->group('cartoes', function ($routes) {
            $routes->get('', [CartaoController::class, "index"]);
            $routes->post('cadastrar', [CartaoController::class, "cadastrar"]);
            $routes->post('editar', [CartaoController::class, "editar"]);
            $routes->post('(:num)/status', [CartaoController::class, "status"]);
            $routes->post('(:num)/principal', [CartaoController::class, "principal"]);
        });

        $routes->group('pedidos', function ($routes) {
            $routes->get('', [ApiPedidoController::class, "index"]);
            $routes->get('detalhes/(:num)', [ApiPedidoController::class, "detalhes"]);
            $routes->post('cadastrar', [ApiPedidoController::class, "cadastrar"]);
        });
    });
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
