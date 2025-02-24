<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Utils\ResponseUtils;
use Exception;

class UserController extends Controller
{
    private UserRepository $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function inserir(Request $request)
    {
        try
        {
            $parametros = array_filter($request->all(['name']));
            if(!(int)count($parametros))
                throw new Exception("Objeto invalido");

            $retorno = $this->userRepository->insert($parametros);

            return ResponseUtils::responseCreated($retorno);
        }
        catch(Exception $e)
        {
            var_dump($e->getMessage());exit;
            return ResponseUtils::responseBadRequest([], $e->getMessage());
        }
    }
    public function buscarPorId($id)
    {
        try
        {
            
            $retorno = $this->userRepository->getById($id);

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

            $retorno = $this->userRepository->update($id, $parametros);

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
            $retorno = $this->userRepository->delete($id);

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
            $retorno = $this->userRepository->buscarTodos();

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
