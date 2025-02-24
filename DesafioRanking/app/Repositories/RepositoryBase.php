<?php
namespace App\Repositories;

use App\Models\TesteLeo;
use Exception;

class RepositoryBase
{
    protected $model;

    public function getById(int $id){
        try
        {
            $res = $this->model->find($id);
            return $res;
        }
        catch(Exception $e)
        {
            throw new Exception("Registro nao encontrado");
        }
    }

    public function buscarTodos(){
        try
        {
            return $this->model->all();
        }
        catch(Exception $e)
        {
            throw new Exception("Erro ao retornar registros");   
        }
    }

    public function insert(array $parametros){
        try
        {
            return $this->model->create($parametros);
        }
        catch(Exception $e)
        {
            throw new Exception("Erro ao inserir registro -> ". $e->getMessage() );   
        }
    }
    
    public function update($id, $parametros){
        try
        {
            $modelRef = $this->getById($id);
            
            if(empty($modelRef))
                throw new Exception("Registro nao encontrado");

            $modelRef->update($parametros);
            return $modelRef;
        }
        catch(Exception $e)
        {
            throw new Exception("Erro ao atualizar registros. ". (!empty($e->getMessage()) ? $e->getMessage() : ""));
        }
    }

    public function delete($id){
        try
        {
            $modelRef = $this->getById($id);

            if(empty($modelRef))
                throw new Exception("Registro nao encontrado");

            $modelRef->delete();

            return $modelRef;
        }
        catch(Exception $e)
        {
            throw new Exception("Erro ao excluir registro. " . (!empty($e->getMessage()) ? $e->getMessage() : ""));
        }
    }

    public function filter(array $filtros){
        try
        {
            $modelRef = $this->model;

            foreach($filtros as $key => $filtro)
            {
                $modelRef = $modelRef->where($key, $filtro);
            }

            return $modelRef->get();
        }
        catch(Exception $e)
        {
            throw new Exception("Erro ao excluir registro. " . (!empty($e->getMessage()) ? $e->getMessage() : ""));
        }
    }
}