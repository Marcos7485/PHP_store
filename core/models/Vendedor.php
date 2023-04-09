<?php

namespace core\models;

use core\classes\Database;
use core\classes\Stock;
use core\classes\Store;

class Vendedor
{
  // ========================================
  public function validar_login($usuario_vendedor, $senha)
  {

    // verificar se o login é valido
    $parametros = [
      ':usuario_vendedor' => $usuario_vendedor
    ];

    $bd = new Database();
    $resultados = $bd->select("
      SELECT * FROM vendedores 
      WHERE usuario = :usuario_vendedor
      AND deleted_at IS NULL
    ", $parametros);

    if (count($resultados) != 1) {
      //não existe usuario admin
      return false;
    } else {

      // temos usuario admin. vamos ver a sua password
      $usuario_vendedor = $resultados[0];

      // verificar a password
      if (!password_verify($senha, $usuario_vendedor->senha)) {
        // password inválida
        return false;
      } else {

        //login valido
        return $usuario_vendedor;
      }
    }
  }
  // =======================================
  // CLIENTES
  // =======================================
  public function lista_clientes()
  {
    // vai buscar todos os clientes registrados na base de dados

    $id_vendedor = $_SESSION['vendedor'];


    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];
    // agregar puntos aqui para agregar no panel de clientes detalhes no admin panel
    $bd = new Database();
    $resultados = $bd->select("SELECT * FROM clientes WHERE vendedor = :id_vendedor", $parametros);

    return $resultados;
  }

  // =======================================
  public function buscar_cliente($id_cliente)
  {

    $parametros = [
      'id_cliente' => $id_cliente
    ];

    $bd = new Database();
    $resultados = $bd->select("SELECT *
      FROM clientes
      WHERE id_cliente = :id_cliente
    ", $parametros);

    return $resultados[0];
  }

  // ======================================
  public function total_encomendas_cliente($id_cliente)
  {
    $parametros = [
      'id_cliente' => $id_cliente
    ];

    $bd = new Database();
    return $bd->select("SELECT COUNT(*) total 
    FROM encomendas 
    WHERE id_cliente = :id_cliente
    ", $parametros)[0]->total;
  }

  public function buscar_encomendas_clientes($id_cliente)
  {

    // buscar todas as encomendas do cliente indicado
    $parametros = [
      'id_cliente' => $id_cliente
    ];
    $bd = new Database();
    return $bd->select("SELECT * FROM encomendas
    WHERE id_cliente = :id_cliente 
    ", $parametros);
  }



  // =======================================
  // ENCOMENDAS
  // =======================================
  public function total_encomendas_agendadas($id_vendedor)
  {

    $bd = new Database();

    // vai buscar a quantidade de encomendas pendentes
    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];
    
    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'AGENDADA' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }
  //=========================================
  public function total_encomendas_pendentes($id_vendedor)
  {

    // vai buscar a quantidade de encomendas pendentes
    $bd = new Database();

    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];

    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'PENDENTE' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }

  //========================================
  public function total_encomendas_em_processamento($id_vendedor)
  {

    // vai buscar a quantidade de encomendas em processamento
    $bd = new Database();

    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];

    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'EM PROCESSAMENTO' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }
  //========================================
  public function total_encomendas_enviadas($id_vendedor)
  {

    // vai buscar a quantidade de encomendas em processamento
    $bd = new Database();

    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];

    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'ENVIADA' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }
  //========================================
  public function total_encomendas_canceladas($id_vendedor)
  {

    // vai buscar a quantidade de encomendas em processamento
    $bd = new Database();

    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];

    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'CANCELADA' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }
  public function total_encomendas_concluidas($id_vendedor)
  {

    // vai buscar a quantidade de encomendas em processamento
    $bd = new Database();

    $parametros = [
      ':id_vendedor' => $id_vendedor
    ];

    $resultados = $bd->select("SELECT COUNT(*) total 
      FROM encomendas
      WHERE status = 'CONCLUIDA' AND vendedor = :id_vendedor
    ", $parametros);
    return $resultados[0]->total;
  }

  //========================================

  public function lista_encomendas($filtro, $id_cliente, $id_vendedor)
  {
    $bd = new Database();

    $sql = "SELECT e.*, c.nome_completo FROM encomendas e LEFT JOIN 
    clientes c ON e.id_cliente = c.id_cliente
    WHERE 1";

    if ($filtro != '') {
      $sql .= " AND e.status = '$filtro'";
    }
    if (!empty($id_cliente)) {
      $sql .= " AND e.id_cliente = $id_cliente";
    }
    
    $sql .= " AND e.vendedor = $id_vendedor";

    $sql .= " ORDER BY e.id_encomenda DESC";

    return $bd->select($sql);
  }

  //==========================================
  public function buscar_detalhes_encomenda($id_encomenda, $id_vendedor)
  {

    // vai buscar os detalhes de uma encomenda
    $bd = new Database();

    $parametros = [
      ':id_encomenda' => $id_encomenda,
      ':id_vendedor' => $id_vendedor
    ];
    
    // buscar os dados da encomenda
    $dados_encomenda = $bd->select("SELECT clientes.nome_completo, encomendas.* FROM clientes, encomendas
      WHERE encomendas.id_encomenda = :id_encomenda
      AND clientes.id_cliente = encomendas.id_cliente AND encomendas.vendedor = :id_vendedor
    ", $parametros);
    
    $parametros = [
      ':id_encomenda' => $id_encomenda
    ];
    // lista de produtos da encomenda
    $lista_produtos = $bd->select("SELECT * FROM encomenda_produto
      WHERE id_encomenda = :id_encomenda 
    ", $parametros);

    return [
      'encomenda' => $dados_encomenda[0],
      'lista_produtos' => $lista_produtos
    ];
  }

  //==========================================
  public function atualizar_status_encomenda($id_encomenda, $estado)
  {

    // atualizar o estado da encomenda
    $bd = new Database();
    $parametros = [
      ':id_encomenda' => $id_encomenda
    ];
    $encomenda_produtos = $bd->select('SELECT * FROM encomenda_produto WHERE id_encomenda = :id_encomenda', $parametros);

    $sd = new Stock();


    $parametros = [
      ':id_encomenda' => $id_encomenda,
      ':status' => $estado
    ];

    $bd->update("UPDATE encomendas
      SET 
        status = :status,
        updated_at = NOW()
      WHERE id_encomenda = :id_encomenda
    ", $parametros);

    if ($estado == 'CANCELADA') {
      foreach ($encomenda_produtos as $produto) {
        $sd->recup_stock($produto->id_produto, $produto->quantidade);
      }
    }
  }
}
