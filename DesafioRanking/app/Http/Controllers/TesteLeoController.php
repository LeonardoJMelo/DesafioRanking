<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TesteLeoRepository;
use App\Utils\ResponseUtils;
use Exception;

class TesteLeoController extends Controller
{

    private TesteLeoRepository $testeLeoRepository;
    public function __construct()
    {
        $this->testeLeoRepository = new TesteLeoRepository();
    }

    public function inserir(Request $request)
    {
        try
        {
            $parametros = array_filter($request->all(['nome','sobrenome']));
            if(!(int)count($parametros))
                throw new Exception();
            $retorno = $this->testeLeoRepository->insert($parametros);
            return ResponseUtils::responseCreated($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest(["erro" => $e->getMessage()]);
        }
    }
    public function buscarPorId($id)
    {
        try
        {
            
            $retorno = $this->testeLeoRepository->getById($id);

            if(empty($retorno))
                throw new Exception("Item nao encontrado");

            return ResponseUtils::responseOK($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest(["erro" => $e->getMessage()]);
        }
    }
    public function atualizar(Request $request, $id)
    {
        try
        {
            $parametros = array_filter($request->all(['nome','sobrenome']));

            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $retorno = $this->testeLeoRepository->update($id, $parametros);

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
            $retorno = $this->testeLeoRepository->delete($id);

            return ResponseUtils::responseOK($retorno);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest(["erro" => $e->getMessage()]);
        }
    }

    public function buscarTodos()
    {
        try
        {
            $retorno = $this->testeLeoRepository->buscarTodos();

            if(empty($retorno))
                throw new Exception("sem registros");

            return ResponseUtils::responseOK([$retorno]);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest(["erro" => $e->getMessage()]);
        }
    }
}
