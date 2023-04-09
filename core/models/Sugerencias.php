<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Sugerencias
{

    public function sugerencias_cargar($id_cliente)
    {
        // vai buscar a quantidade de encomendas em processamento
        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $resultados = $bd->select("SELECT * FROM sugerencias WHERE id_cliente = :id_cliente", $parametros);

        return $resultados;
    }

    public function sugerencia_guardar($id_cliente, $sugerencia)
    {

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente,
            ':sugerencia' => $sugerencia,
            ':activo' => 1
        ];


        $bd->insert("
              INSERT INTO sugerencias VALUES(
                  0,
                  :id_cliente,
                  :sugerencia,
                  :activo,
                  NOW(),
                  NULL
              )
          ", $parametros);
    }
}
