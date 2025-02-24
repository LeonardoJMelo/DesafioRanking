<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PersonalRecordRepository;
use App\Utils\ResponseUtils;
use Exception;

class PersonalRecordController extends Controller
{
    private PersonalRecordRepository $personalRecordRepository;
    public function __construct()
    {
        $this->personalRecordRepository = new PersonalRecordRepository();
    }

    public function inserir(Request $request)
    {
        try
        {
            $parametros = array_filter($request->all(['user_id', 'movement_id', 'value', 'date']));
            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $retorno = $this->personalRecordRepository->insert($parametros);

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
            
            $retorno = $this->personalRecordRepository->getById($id);

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
            $parametros = array_filter($request->all(['user_id', 'movement_id', 'value', 'date']));

            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $retorno = $this->personalRecordRepository->update($id, $parametros);

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
            $retorno = $this->personalRecordRepository->delete($id);

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
            $retorno = $this->personalRecordRepository->buscarTodos();

            if(empty($retorno))
                throw new Exception("sem registros");

            return ResponseUtils::responseOK([$retorno]);
        }
        catch(Exception $e)
        {
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
}
