<?php 

namespace core\models;

use core\classes\Database;
use core\classes\Store;


class Premios
{   
    // ========================================
    public function lista_premios_disponiveis($categoria){
        

        // buscar todas as informações na nossa base de dados
        $bd = new Database();

        // buscar a lista de categorias da loja
        $categorias = $this->lista_categorias();

        $sql = "SELECT * FROM premios ";
        $sql .= "WHERE visivel = 1 ";

        if(in_array($categoria, $categorias)){
            $sql .= "AND categoria = '$categoria'";
        }


        $premios = $bd->select($sql);
        return $premios;
    }

    //=========================================
    public function lista_categorias(){
        
        // devolve a lista de categorias existentes na base de dados
        $bd = new Database();
        $resultados = $bd->select("SELECT DISTINCT categoria FROM premios");
        $categorias = [];
        foreach($resultados as $resultado){
            array_push($categorias, $resultado->categoria);
        }

        return $categorias;

    }

    //=========================================
    public function verificar_disponibilidad_premio($id_premio){

        $bd = new Database();
        $parametros = [
            ':id_premio' => $id_premio,
        ];
        $resultados = $bd->select("SELECT * FROM premios 
        WHERE id_premio = :id_premio
        AND visivel = 1
        ", $parametros);

        return count($resultados) != 0 ? true : false;
    }

    //=========================================
    public function buscar_premios_por_ids($ids){
        $bd = new Database();
        return $bd->select("SELECT * FROM premios
            WHERE id_premio IN ($ids)
        ");
    }

    public function guardar_premio($parametros){

        //Guardar na base de dados a transação

        $bd = new Database();
        $bd->insert("INSERT INTO premios_register VALUES(
            0,
            :id_premio,
            :id_cliente,
            :coste,
            :codigo,
            :telefone,
            :status,
            NOW(),
            NOW()
        )", $parametros);

    }


    public function preco_premio($id_premio){

        $parametros = [
            ':id_premio' =>$id_premio
        ];
        $bd = new Database();
        $resultados = $bd->select("SELECT preco FROM premios WHERE id_premio = :id_premio", $parametros);

        return $resultados;
    }



}