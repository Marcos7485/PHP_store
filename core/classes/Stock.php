<?php

namespace core\classes;

class Stock
{

    public function item_stock($id_produto)
    {

        $bd = new Database();


        $parametros = [
            ':id_produto' => $id_produto
        ];

        $resultados = $bd->select("SELECT stock FROM produtos WHERE id_produto = :id_produto", $parametros);


        return $resultados;
    }

    public function desc_stock($id_produto, $quantidade)
    {
        $bd = new Database();


        $parametros = [
            ':id_produto' => $id_produto
        ];

        $resultados = $bd->select("SELECT stock FROM produtos WHERE id_produto = :id_produto", $parametros);

        if ($id_produto > 100) {
            $parametros = [
                ':id_produto' => $id_produto,
                ':stock' => $resultados[0]->stock - $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
          stock = :stock,
          updated_at = NOW()
        WHERE id_produto = :id_produto
      ", $parametros);

            $parametros = [
                ':id_produto' => $id_produto - 100,
                ':stock' => $resultados[0]->stock - $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
        stock = :stock,
        updated_at = NOW()
        WHERE id_produto = :id_produto
        ", $parametros);
        } else {
            $parametros = [
                ':id_produto' => $id_produto,
                ':stock' => $resultados[0]->stock - $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
          stock = :stock,
          updated_at = NOW()
        WHERE id_produto = :id_produto
      ", $parametros);

            $parametros = [
                ':id_produto' => $id_produto + 100,
                ':stock' => $resultados[0]->stock - $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
        stock = :stock,
        updated_at = NOW()
        WHERE id_produto = :id_produto
        ", $parametros);
        }
    }

    public function recup_stock($id_produto, $quantidade)
    {
        $bd = new Database();


        $parametros = [
            ':id_produto' => $id_produto
        ];

        $resultados = $bd->select("SELECT stock FROM produtos WHERE id_produto = :id_produto", $parametros);

        if ($id_produto > 100) {
            $parametros = [
                ':id_produto' => $id_produto,
                ':stock' => $resultados[0]->stock + $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
          stock = :stock,
          updated_at = NOW()
        WHERE id_produto = :id_produto
      ", $parametros);

            $parametros = [
                ':id_produto' => $id_produto - 100,
                ':stock' => $resultados[0]->stock + $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
        stock = :stock,
        updated_at = NOW()
        WHERE id_produto = :id_produto
        ", $parametros);
        } else {
            $parametros = [
                ':id_produto' => $id_produto,
                ':stock' => $resultados[0]->stock + $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
          stock = :stock,
          updated_at = NOW()
        WHERE id_produto = :id_produto
      ", $parametros);

            $parametros = [
                ':id_produto' => $id_produto + 100,
                ':stock' => $resultados[0]->stock + $quantidade
            ];

            $bd->update("UPDATE produtos
        SET
        stock = :stock,
        updated_at = NOW()
        WHERE id_produto = :id_produto
        ", $parametros);
        }
    }
}
