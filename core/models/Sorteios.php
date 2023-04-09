<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Sorteios
{

    public function inscribir($id_cliente, $id_premio, $preco)
    {

        $bd = new Database();

        $sorteio_preco = $preco/10;

        $parametros = [
            ':id_cliente' => $id_cliente,
            ':id_premio' => $id_premio,
            ':preco' => $sorteio_preco
        ];

        $bd->insert("INSERT INTO sorteios VALUES(
            0,
            :id_cliente,
            :id_premio,
            :preco,
            1,
            NOW(),
            NULL
        )
    ", $parametros);

        $c = new Clientes();
        $c->restar_pontos($id_cliente, $sorteio_preco);
    }
    

    public function sorteio_ativo($id_cliente){

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $resultados = $bd->select("SELECT * FROM sorteios WHERE ativo = 1 AND id_cliente = :id_cliente", $parametros);

        if(empty($resultados)){
            return false;
        }else{
            return true;
        }
    }

    public function data_sorteio($id_cliente){

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $resultados = $bd->select("SELECT created_at FROM sorteios WHERE ativo = 1 AND id_cliente = :id_cliente", $parametros);

        return $resultados;
    }
}
