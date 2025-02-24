<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MovementRepository;
use App\Utils\ResponseUtils;
use Exception;

class MovementController extends Controller
{
    private MovementRepository $movementRepository;
    public function __construct()
    {
        $this->movementRepository = new MovementRepository();
    }

    public function inserir(Request $request)
    {
        try
        {
            $parametros = array_filter($request->all(['name']));
            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $filtro = $this->userRepository->filter(['name'=>$parametros['name']]);

            if((int)count($filtro))
                throw new Exception("Name ja existente");

            $retorno = $this->movementRepository->insert($parametros);

            return ResponseUtils::responseCreated($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
    public function buscarPorId($id)
    {
        try
        {
            
            $retorno = $this->movementRepository->getById($id);

            if(empty($retorno))
                throw new Exception("Item nao encontrado");

            return ResponseUtils::responseOK($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
    public function atualizar(Request $request, $id)
    {
        try
        {
            $parametros = array_filter($request->all(['name']));

            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $retorno = $this->movementRepository->update($id, $parametros);

            if(empty($retorno))
                throw new Exception("Item nao encontrado");

            return ResponseUtils::responseOK($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
    public function deletar($id)
    {
        try
        {
            $retorno = $this->movementRepository->delete($id);

            return ResponseUtils::responseOK($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }

    public function buscarTodos()
    {
        try
        {
            $retorno = $this->movementRepository->buscarTodos();

            if(empty($retorno))
                throw new Exception("Sem registros");

            return ResponseUtils::responseOK([$retorno]);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
}
