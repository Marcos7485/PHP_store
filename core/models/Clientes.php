<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Clientes
{
  // ========================================
  public function verificar_email_existe($email)
  {

    // verifica se ja existe outra conta com o mesmo email
    // verifica na base de dados se existe cliente com mesmo email
    $bd = new Database();
    $parametros = [
      ':email' => strtolower(trim($email))
    ];
    $resultados = $bd->select("SELECT email FROM clientes WHERE email = :email", $parametros);


    // se o cliente já existe...
    if (count($resultados) != 0) {
      return true;
    } else {
      return false;
    }
  }
  // ========================================
  public function registrar_cliente()
  {

    // registra o novo cliente na base de dados
    $bd = new Database();

    // cria um hash para o registro do cliente
    $purl = Store::criarHash();


    /////////////////////// intereses ///////////////////////////////////

    $interes = '';
    $pontos_interes = 0;

    if (array_key_exists("c_Vinho_dia_a_dia", $_POST)) {
      $interes .= 'Vinho dia a dia';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Tintos", $_POST)) {
      $interes .= 'Tintos';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Brancos", $_POST)) {
      $interes .= 'Brancos';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Roses", $_POST)) {
      $interes .= 'Roses';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Espumantes", $_POST)) {
      $interes .= 'Espumantes';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_V_mundo", $_POST)) {
      $interes .= 'Velho mundo (Europa)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_N_mundo", $_POST)) {
      $interes .= 'Novo mundo (Arg,Chi,Uru,etc)';
      $interes .= " | ";
      $pontos_interes = 10;
    }
    if (array_key_exists("c_L_cost", $_POST)) {
      $interes .= 'Low-cost (Até R$100)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_M_price", $_POST)) {
      $interes .= 'Mid-price (De R$100 - R$250)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Premium", $_POST)) {
      $interes .= 'Premium (R$250++)';
      $interes .= " | ";
      $pontos_interes = 10;
    }
    /////////////////////// intereses ///////////////////////////////////


    // parametros
    $parametros = [
      ':email' => strtolower(trim($_POST['text_email'])),
      ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
      ':nome_completo' => (trim($_POST['text_nome_completo'])),
      ':morada' => (trim($_POST['text_cep'])),
      ':cidade' => (trim($_POST['text_cidade'])),
      ':telefone' => (trim($_POST['text_telefone'])),
      ':pontos_cliente' => $pontos_interes,
      ':pontos_usados' => 0,
      ':purl' => $purl,
      ':intereses' => $interes,
      ':aniversario' => '',
      ':vendedor' => $_POST['recomendado_por'],
      ':ativo' => 0
    ];
    $bd->insert("
        INSERT INTO clientes VALUES(
            0,
            :email,
            :senha,
            :nome_completo,
            :morada,
            :cidade,
            :telefone,
            :pontos_cliente,
            :pontos_usados,
            :purl,
            :intereses,
            :aniversario,
            :vendedor,
            :ativo,
            NOW(),
            NOW(),
            NULL
        )
    ", $parametros);
    // retorna o purl criado
    return $purl;
  }
  
  // ========================================
  public function registrar_cliente_cel()
  {

    // registra o novo cliente na base de dados
    $bd = new Database();

    // cria um hash para o registro do cliente
    $purl = Store::criarHash();


    /////////////////////// intereses ///////////////////////////////////

    $interes = '';
    $pontos_interes = 0;

    if (array_key_exists("c_Vinho_dia_a_dia", $_POST)) {
      $interes .= 'Vinho dia a dia';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Tintos", $_POST)) {
      $interes .= 'Tintos';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Brancos", $_POST)) {
      $interes .= 'Brancos';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Roses", $_POST)) {
      $interes .= 'Roses';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Espumantes", $_POST)) {
      $interes .= 'Espumantes';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_V_mundo", $_POST)) {
      $interes .= 'Velho mundo (Europa)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_N_mundo", $_POST)) {
      $interes .= 'Novo mundo (Arg,Chi,Uru,etc)';
      $interes .= " | ";
      $pontos_interes = 10;
    }
    if (array_key_exists("c_L_cost", $_POST)) {
      $interes .= 'Low-cost (Até R$100)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_M_price", $_POST)) {
      $interes .= 'Mid-price (De R$100 - R$250)';
      $interes .= " | ";
      $pontos_interes = 10;
    }

    if (array_key_exists("c_Premium", $_POST)) {
      $interes .= 'Premium (R$250++)';
      $interes .= " | ";
      $pontos_interes = 10;
    }
    /////////////////////// intereses ///////////////////////////////////


    // parametros
    $parametros = [
      ':email' => strtolower(trim($_POST['text_email_cel'])),
      ':senha' => password_hash(trim($_POST['text_senha_1_cel']), PASSWORD_DEFAULT),
      ':nome_completo' => (trim($_POST['text_nome_completo_cel'])),
      ':morada' => (trim($_POST['text_cep_cel'])),
      ':cidade' => (trim($_POST['text_cidade_cel'])),
      ':telefone' => (trim($_POST['text_telefone_cel'])),
      ':pontos_cliente' => $pontos_interes,
      ':pontos_usados' => 0,
      ':purl' => $purl,
      ':intereses' => $interes,
      ':aniversario' => '',
      ':vendedor' => $_POST['recomendado_por'],
      ':ativo' => 0
    ];
    $bd->insert("
        INSERT INTO clientes VALUES(
            0,
            :email,
            :senha,
            :nome_completo,
            :morada,
            :cidade,
            :telefone,
            :pontos_cliente,
            :pontos_usados,
            :purl,
            :intereses,
            :aniversario,
            :vendedor,
            :ativo,
            NOW(),
            NOW(),
            NULL
        )
    ", $parametros);
    // retorna o purl criado
    return $purl;
  }
  //=========================================
  public function validar_email($purl)
  {

    // validar o email do cliente

    $bd = new Database();
    $parametros = [
      ':purl' => $purl
    ];
    $resultados = $bd->select("
      SELECT * FROM clientes 
      WHERE purl = :purl
    ", $parametros);

    // verifica se foi encontrado o clientes
    if (count($resultados) != 1) {
      return false;
    }
    // foi encontrado este cliente com o purl indicado
    $id_cliente = $resultados[0]->id_cliente;

    // atualizar os dados do cliente
    $parametros = [
      ':id_cliente' => $id_cliente,
    ];
    $bd->update("
      UPDATE clientes SET
      purl = NULL,
      activo = 1,
      updated_at = NOW() 
      WHERE id_cliente = :id_cliente
    ", $parametros);

    return true;
  }
  //=========================================
  public function validar_login($usuario, $senha)
  {

    // verificar se o login é valido
    $parametros = [
      ':usuario' => $usuario,

    ];
    $bd = new Database();
    $resultados = $bd->select("
      SELECT * FROM clientes 
      WHERE email = :usuario 
      AND deleted_at IS NULL
    ", $parametros);


    if (count($resultados) != 1) {
      //não existe usuario
      return false;
    } elseif ($resultados[0]->activo == 1) {

      // temos usuario. vamos ver a sua password
      $usuario = $resultados[0];

      // verificar a password
      if (!password_verify($senha, $usuario->senha)) {
        // password inválida
        return false;
      } else {
        //login valido
        return $usuario;
      }
    } else {
      // temos usuario. vamos ver a sua password
      $usuario = $resultados[0];

      if (!password_verify($senha, $usuario->senha)) {
        // password inválida

        return false;
      } else {
        return 'validar';
      }
    }
  }
  //=========================================
  public function buscar_dados_cliente($id_cliente)
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
  //=========================================
  public function verificar_se_email_existe_noutra_conta($id_cliente, $email)
  {

    // verificar se existe a conta de email noutra conta de cliente
    $parametros = [
      ':email' => $email,
      ':id_cliente' => $id_cliente,
    ];
    $bd = new Database();
    $resultados = $bd->select("SELECT id_cliente
      FROM clientes
      WHERE id_cliente <> :id_cliente
      AND email = :email
    ", $parametros);

    if (count($resultados) != 0) {
      return true;
    } else {
      return false;
    }
  }
  //=========================================
  public function atualizar_dados_cliente($nome_completo, $morada, $cidade, $telefone)
  {

    //atualiza os dados do cliente na base de dados
    $parametros = [
      ':id_cliente' => $_SESSION['cliente'],
      ':nome_completo' => $nome_completo,
      ':morada' => $morada,
      ':cidade' => $cidade,
      ':telefone' => $telefone
    ];

    $bd = new Database();

    $bd->update("UPDATE clientes
      SET
        nome_completo = :nome_completo,
        morada = :morada,
        cidade = :cidade,
        telefone = :telefone,
        updated_at = NOW()
      WHERE id_cliente = :id_cliente
    ", $parametros);
  }
  //=========================================
  public function adicionar_aniversario($id_cliente, $aniversario)
  {

    //atualiza os dados do cliente na base de dados
    $parametros = [
      ':id_cliente' => $id_cliente,
      ':aniversario' => $aniversario,
    ];

    $bd = new Database();

    $bd->update("UPDATE clientes
      SET
        aniversario = :aniversario,
        updated_at = NOW()
      WHERE id_cliente = :id_cliente
    ", $parametros);
  }
  //=========================================

  public function obter_aniversario($id_cliente)
  {

    //atualiza os dados do cliente na base de dados
    $parametros = [
      ':id_cliente' => $id_cliente,
    ];

    $bd = new Database();

    $resultados = $bd->select("SELECT aniversario FROM clientes
      WHERE id_cliente = :id_cliente
    ", $parametros);

    $aniversario = unserialize($resultados[0]->aniversario);

    return $aniversario;
  }


  //=========================================
  public function verifica_senha($id_cliente, $senha_atual)
  {

    // verifica se a senha atual esta correta(de acordo com a base de dados)
    $parametros = [
      ':id_cliente' => $id_cliente
    ];
    $bd = new Database();

    $senha_na_bd = $bd->select("SELECT senha
      FROM clientes
      WHERE id_cliente = :id_cliente
    ", $parametros)[0]->senha;

    // verificar se a senha corresponde a senha atual na bd
    return password_verify($senha_atual, $senha_na_bd);
  }
  //=========================================
  public function atualizar_nova_senha($id_cliente, $nova_senha)
  {

    // atualização da senha do cliente
    $parametros = [
      ':id_cliente' => $id_cliente,
      ':nova_senha' => password_hash($nova_senha, PASSWORD_DEFAULT)
    ];

    $bd = new Database();
    $bd->update("UPDATE clientes
      SET
        senha = :nova_senha,
        updated_at = NOW()
      WHERE id_cliente = :id_cliente
    ", $parametros);
  }

  //=========================================
  public function somar_pontos($id_cliente, $pontos)
  {

    //atualiza os dados do cliente na base de dados
    $parametros = [
      ':id_cliente' => $id_cliente,
    ];

    $bd = new Database();
    // busca pontos do cliente
    $pontos_cliente = $bd->select("SELECT 
    pontos_cliente
    FROM clientes
    WHERE id_cliente = :id_cliente
  ", $parametros);

    $resultados = $pontos_cliente[0]->pontos_cliente + $pontos;

    $parametros = [
      ':id_cliente' => $id_cliente,
      ':pontos_cliente' => $resultados
    ];

    $bd->update("UPDATE clientes
    SET
      pontos_cliente = :pontos_cliente,
      updated_at = NOW()
    WHERE id_cliente = :id_cliente
  ", $parametros);
  }

  // ========================================
  public function restar_pontos($id_cliente, $pontos)
  {

    //atualiza os dados do cliente na base de dados
    $parametros = [
      ':id_cliente' => $id_cliente,
    ];

    $bd = new Database();
    // busca pontos do cliente
    $pontos_usados = $bd->select("SELECT 
    pontos_usados
    FROM clientes
    WHERE id_cliente = :id_cliente
  ", $parametros);

    $resultados = $pontos_usados[0]->pontos_usados + $pontos;

    $parametros = [
      ':id_cliente' => $id_cliente,
      ':pontos_cliente' => $resultados
    ];

    $bd->update("UPDATE clientes
    SET
      pontos_usados = :pontos_cliente,
      updated_at = NOW()
    WHERE id_cliente = :id_cliente
  ", $parametros);
  }

  public function pontos_cliente($id_cliente)
  {

    // vamos apresentar a nova view com esses dados
    $bd = new Database();
    $encomenda = new Encomendas();
    $info_encomendas = $encomenda->buscar_historico_encomendas_concluidas($id_cliente);

    $parametros = [
      ':id_cliente' => $id_cliente
    ];

    $pontos = 10;

    foreach ($info_encomendas as $encomenda) :
      $pontos += $encomenda->pontos;
    endforeach;

    $parametros = [
      ':id_cliente' => $id_cliente,
      ':total_pontos' => $pontos
    ];

    $bd->update("UPDATE clientes
    SET
      pontos_cliente = :total_pontos,
      updated_at = NOW()
    WHERE id_cliente = :id_cliente
  ", $parametros);
  }

  public function obter_nome($id_cliente)
  {

    $bd = new Database();

    $parametros = [
      ':id_cliente' => $id_cliente,
    ];

    $bd = new Database();
    // busca pontos do cliente
    $nome = $bd->select("SELECT 
    nome_completo
    FROM clientes
    WHERE id_cliente = :id_cliente
  ", $parametros);

    return $nome[0];
  }
}
