<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RankingRepository;
use App\Utils\ResponseUtils;
use Exception;

class RankingController extends Controller
{
    private RankingRepository $rankingRepository;

    public function __construct()
    {
        $this->rankingRepository = new RankingRepository();
    }

    public function ranking(int $idMovement)
    {
        try 
        {

            $listaRanking = $this->rankingRepository->buscarRanking($idMovement);

            if(empty($listaRanking))
                throw new Exception("Lista vazia");
            
            $separadoPorData = [];
            foreach($listaRanking as $ranking)
            {
                $separadoPorData[$ranking->date][] = $ranking;
            }

            $rankingFinal = [];
            foreach($separadoPorData as $data => $item)
            {
                usort($item, function($a, $b) {
                    return $b->value <=> $a->value;
                });

                $posicao = 0;
                $valorAnterior = null;
                foreach($item as $ranking)
                {
                    if ($ranking->value != $valorAnterior)
                        $posicao++; 

                    $ranking->posicao = $posicao;
                    $rankingFinal[$data][] = $ranking;
                    $valorAnterior = $ranking->value;
                }
            }

            return ResponseUtils::responseOK($rankingFinal);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
}

