<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

use App\Libraries\UolBrasileiro;

use App\Models\CampeonatoModel;
use App\Models\EquipeModel;
use App\Models\RodadaModel;

class BrasileiroController extends ResourceController
{
    use ResponseTrait;

    protected $equipeModel;
    protected $rodadaModel;
    protected $campeonatoModel;

    protected $campeonato;

    public function __construct()
    {
        $this->equipeModel = new EquipeModel();
        $this->rodadaModel = new RodadaModel();
        $this->campeonatoModel = new CampeonatoModel();

        $this->campeonato = BRASILEIRO;
    }

    public function sincronizar($temporada)
    {
        try {
            $dados = $this->cadastrarCampeonato($temporada);

            $dados = $this->cadastrarEquipes($temporada);

            $dados = $this->cadastrarRodadas($temporada);

            return $dados;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function cadastrarCampeonato($temporada)
    {
        $brasileirao = new UolBrasileiro($this->campeonato, $temporada);

        $campeonato = $brasileirao->campeonato();

        $resultado = $this->campeonatoModel->add($campeonato);

        return $resultado;
    }

    private function cadastrarEquipes($temporada)
    {
        $brasileirao = new UolBrasileiro($this->campeonato, $temporada);

        $equipes = $brasileirao->equipes();

        foreach ($equipes as $value) {
            $resultado = $this->equipeModel->add($value);
        }

        return $resultado;
    }

    public function cadastrarRodadas($temporada)
    {
        $brasileirao = new UolBrasileiro($this->campeonato, $temporada);

        $rodadas = $brasileirao->rodadas();

        foreach ($rodadas["rodadas"] as $value) {
            $resultado = $this->rodadaModel->add($this->campeonato, $temporada, $value);
        }

        return $resultado;
    }
}
