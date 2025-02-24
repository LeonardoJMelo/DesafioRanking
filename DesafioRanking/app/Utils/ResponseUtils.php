<?php 

namespace App\Utils;

class ResponseUtils
{
    public static function responseCreated($retorno = [], $msg = "Sucesso"){
        return self::responseBase($retorno, $msg, 201);
    }
    
    public static function responseOK($retorno = [], $msg = "Sucesso"){
        return self::responseBase($retorno, $msg, 200);
    }

    public static function responseBadRequest($retorno = [], $msg = "Erro ao realizar request"){
        return self::responseBase([], $msg, 400);
    }

    public static function responseBase($retorno, $msg, $code){
        return response()->json(
            [
                'msg' => $msg,
                'response' => $retorno,
            ]
            , $code);
    }
}