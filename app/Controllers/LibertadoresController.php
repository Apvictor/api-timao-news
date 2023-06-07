<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

use App\Libraries\UolLibertadores;

use App\Models\CampeonatoModel;
use App\Models\EquipeModel;
use App\Models\RodadaModel;

class LibertadoresController extends ResourceController
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

        $this->campeonato = LIBERTADORES;
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
        $uol = new UolLibertadores($this->campeonato, $temporada);

        $campeonato = $uol->campeonato();

        $resultado = $this->campeonatoModel->add($campeonato);

        return $resultado;
    }

    private function cadastrarEquipes($temporada)
    {
        $uol = new UolLibertadores($this->campeonato, $temporada);

        $equipes = $uol->equipes();

        foreach ($equipes as $value) {
            $resultado = $this->equipeModel->add($value);
        }

        return $resultado;
    }

    public function cadastrarRodadas($temporada)
    {
        $uol = new UolLibertadores($this->campeonato, $temporada);

        $rodadas = $uol->rodadas();

        for ($i = 0; $i < count($rodadas["ordem_fases"]); $i++) {
            foreach ($rodadas["rodadas"][$rodadas["ordem_fases"][$i]] as $value) {
                $resultado = $this->rodadaModel->add($this->campeonato, $temporada, $value);
            }
        }

        return $resultado;
    }
}
