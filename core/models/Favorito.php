<?php

namespace core\models;

use core\classes\Database;



class Favorito
{

    // ======================================================

    public function guardar_favorito($id_cliente, $id_premio)
    {

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente,
        ];

        $deposit = $bd->select('SELECT * FROM favorito WHERE id_cliente = :id_cliente', $parametros);

        $parametros = [
            ':id_cliente' => $id_cliente,
            ':id_premio' => $id_premio
        ];

        if ($deposit != null) {

            $bd->update('UPDATE favorito 
            SET
                id_premio = :id_premio,
                updated_at = NOW()
             WHERE id_cliente = :id_cliente', $parametros);

        } else {


            $bd->insert("INSERT INTO favorito VALUES(
                0,
                :id_cliente,
                :id_premio,
                NOW(),
                NULL
            )", $parametros);
        }
    }

    public function cargar_favorito($id_cliente)
    {

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $resultados = $bd->select("SELECT * FROM favorito WHERE id_cliente = :id_cliente", $parametros);

        return $resultados;
    }
}
