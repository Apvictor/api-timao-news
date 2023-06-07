<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

use App\Models\CampeonatoModel;
use App\Models\EquipeModel;
use App\Models\RodadaModel;

class CampeonatoController extends ResourceController
{
    use ResponseTrait;

    protected $campeonatoModel;
    protected $rodadaModel;
    protected $equipeModel;

    public function __construct()
    {
        $this->campeonatoModel = new CampeonatoModel();
        $this->rodadaModel = new RodadaModel();
        $this->equipeModel = new EquipeModel();
    }

    public function rodadas()
    {
        $campeonato = $this->request->getVar("campeonato");
        $temporada = $this->request->getVar("temporada");
        $equipe = $this->request->getVar("equipe");
        $proximos_jogos = $this->request->getVar("proximos_jogos");

        if (!empty($temporada) && $temporada != "Todos") {
            switch ($campeonato) {
                case BRASILEIRO:
                    $brasileiroController = new BrasileiroController();
                    $brasileiroController->sincronizar($temporada);
                    break;
                case COPA_DO_BRASIL:
                    $copaDoBrasilController = new CopaDoBrasilController();
                    $copaDoBrasilController->sincronizar($temporada);
                    break;
                case LIBERTADORES:
                    $libertadoresController = new LibertadoresController();
                    $libertadoresController->sincronizar($temporada);
                    break;
                case PAULISTA:
                    $paulistaController = new PaulistaController();
                    $paulistaController->sincronizar($temporada);
                    break;
                default:
                    $brasileiroController = new BrasileiroController();
                    $brasileiroController->sincronizar($temporada);
                    break;
            }
        }

        $dados = $this->rodadaModel->getRodadasCampeonato($campeonato, $temporada, $equipe, $proximos_jogos);

        return $this->respond($dados);
    }

    public function equipes()
    {
        $dados = $this->equipeModel->getEquipes();

        return $this->respond($dados);
    }

    public function campeonatos()
    {
        $dados = $this->campeonatoModel->getCampeonatos();

        return $this->respond($dados);
    }

    public function temporadas()
    {
        $dados = $this->campeonatoModel->getTemporadas();

        return $this->respond($dados);
    }
}
