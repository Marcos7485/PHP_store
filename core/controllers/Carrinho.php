<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Envio;
use core\classes\Horario;
use core\classes\Stock;
use core\classes\Store;
use core\models\Clientes;
use core\models\Encomendas;
use core\models\Premios;
use core\models\Produtos;

class Carrinho
{

    // ===========================================
    public function adicionar_carrinho()
    {
        // vai buscar o id_produto a query string
        if (!isset($_GET['id_produto'])) {

            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }

        // define o id do produto
        $id_produto = $_GET['id_produto'];

        $sp = new Stock();
        $resultados = $sp->item_stock($id_produto);



        /*
        if (!$resultados) {
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }
        */

        // adiciona/gestao da variavel de SESSAO do carrinho
        $carrinho = [];

        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }

        if (key_exists($id_produto + 100, $carrinho)) {
            $stock = $resultados[0]->stock - $carrinho[$id_produto + 100];
        } else {
            $stock = $resultados[0]->stock;
        }

        // adicionar o produto ao carrinho
        if (key_exists($id_produto, $carrinho)) {

            //ja existe o produto. acrecenta mais uma unidade
            if ($carrinho[$id_produto] < $stock) {
                $carrinho[$id_produto]++;
            }
        } else {
            // adicionar novo produto ao carrinho
            if ($stock > 0) {
                $carrinho[$id_produto] = 1;
            }
        }

        //atualiza os dados do carrinho na sessao
        $_SESSION['carrinho'] = $carrinho;

        // devolve a resposta (numero de produtos do carrinho)
        $total_produtos = 0;
        foreach ($carrinho as $quantidade) {
            $total_produtos += $quantidade;
        }
        echo $total_produtos;
    }
    // ===========================================

    public function adicionar_carrinho_presente()
    {
        // vai buscar o id_produto a query string
        if (!isset($_GET['id_produto'])) {

            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }

        // define o id do produto
        $id_produto = ($_GET['id_produto'] + 100);

        $sp = new Stock();
        $resultados = $sp->item_stock($id_produto);


        // adiciona/gestao da variavel de SESSAO do carrinho
        $carrinho = [];
        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }

        if (key_exists($id_produto - 100, $carrinho)) {
            $stock = $resultados[0]->stock - $carrinho[$id_produto - 100];
        } else {
            $stock = $resultados[0]->stock;
        }

        // adicionar o produto ao carrinho
        if (key_exists($id_produto, $carrinho)) {

            //ja existe o produto. acrecenta mais uma unidade
            if ($carrinho[$id_produto] < $stock) {
                $carrinho[$id_produto]++;
            }
        } else {
            // adicionar novo produto ao carrinho
            if ($stock > 0) {
                $carrinho[$id_produto] = 1;
            }
        }

        //atualiza os dados do carrinho na sessao
        $_SESSION['carrinho'] = $carrinho;

        // devolve a resposta (numero de produtos do carrinho)
        $total_produtos = 0;
        foreach ($carrinho as $quantidade) {
            $total_produtos += $quantidade;
        }
        echo $total_produtos;
    }
    // ===========================================
    public function remover_produto_carrinho()
    {

        // vai buscar o id_produto na query string
        $id_produto = Store::aesDesencriptar($_GET['id_produto']);

        // buscar o carrinho a sessão
        $carrinho = $_SESSION['carrinho'];


        // remover um elemento do carrinho
        if ($carrinho[$id_produto] > 1) {
            $carrinho[$id_produto] -= 1;
        } else {
            // remover o produto do carrinho
            unset($carrinho[$id_produto]);
        }

        //atualizar o carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;

        // apresentar novamente a pagina do carrinho
        //$this->carrinho();
        Store::redirect("carrinho");
    }
    // ===========================================
    public function adicionar_produto_carrinho()
    {

        // vai buscar o id_produto na query string
        $id_produto = Store::aesDesencriptar($_GET['id_produto']);


        // buscar o carrinho a sessão
        $carrinho = $_SESSION['carrinho'];

        // adicionar uma quantidade de um produto ja escolhido
        $sp = new Stock();
        $resultados = $sp->item_stock($id_produto);


        if (key_exists($id_produto + 100, $carrinho)) {
            $stock = $resultados[0]->stock - $carrinho[$id_produto + 100];
            $stock -= $carrinho[$id_produto];
        } elseif (key_exists($id_produto - 100, $carrinho)) {
            $stock = $resultados[0]->stock - $carrinho[$id_produto - 100];
            $stock -= $carrinho[$id_produto];
        } else {
            $stock = $resultados[0]->stock - $carrinho[$id_produto];
        }

        //ja existe o produto. acrecenta mais uma unidade
        if ($stock > 0) {
            $carrinho[$id_produto]++;
        } 

        //atualizar o carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;
        // apresentar novamente a pagina do carrinho
        //$this->carrinho();
        Store::redirect("carrinho");
    }

    // ===========================================
    public function limpar_carrinho()
    {

        // limpa o carrinho de todos os produtos
        unset($_SESSION['carrinho']);
        unset($_SESSION['envio']);
        unset($_SESSION['cep']);
        unset($_SESSION['cep_altern']);

        // refrescar a pagina do carrinho
        $this->carrinho();
    }

    // ===========================================
    public function carrinho()
    {

        $dados = [];

        //verificar se existe carrinho
        
        if(isset($_SESSION['envio'])){
            unset($_SESSION['envio']);
        }
        if(isset($_SESSION['cep'])){
            unset($_SESSION['cep']);
        }
        if(isset($_SESSION['cep_altern'])){
            unset($_SESSION['cep_altern']);
        }
        
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            $dados = [
                'carrinho' => null
            ];
        } else {


            $ids = [];
            foreach ($_SESSION['carrinho'] as $id_produto => $value) {
                array_push($ids, $id_produto);
            }

            $ids = implode(",", $ids);
            $produtos = new Produtos();
            $resultados = $produtos->buscar_produtos_por_ids($ids);

            $dados_tmp = [];
            $stock_tmp = [];
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade_carrinho) {

                // imagem do produto
                foreach ($resultados as $produto) {
                    if ($produto->id_produto == $id_produto) {
                        $id_produto = $produto->id_produto;
                        $imagem = $produto->imagem;
                        $titulo = $produto->nome_produto;
                        $quantidade = $quantidade_carrinho;
                        $preco = $produto->preco * $quantidade;
                        $pontos = $produto->pontos * $quantidade;

                        // colocar o produto na coleção
                        array_push($dados_tmp, [
                            'id_produto' => $id_produto,
                            'imagem' => $imagem,
                            'titulo' => $titulo,
                            'quantidade' => $quantidade,
                            'preco' => $preco,
                            'pontos' => $pontos,
                        ]);

                        break;
                    }
                }
            }

            // calcular o total
            $total_da_encomenda = 0;
            $total_pontos = 0;
            foreach ($dados_tmp as $item) {
                $total_da_encomenda += $item['preco'];
                $total_pontos += $item['pontos'];
            }

            array_push($dados_tmp, $total_da_encomenda);
            array_push($dados_tmp, $total_pontos);

            $dados = [
                'carrinho' => $dados_tmp,
                'quantidade' => $stock_tmp
            ];
        }

        // apresenta a página da loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //============================================
    public function estabelecer()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        // Correção limitador de distancia register/////////////////////////////////
        $envio = new Envio();
        $dist = $envio->calcular_envio_J($post['cep_altern']);

        if($dist <= 20){
            $_SESSION['cep_altern'] = $post['cep_altern'];
        } else {
            $_SESSION['erro'] = 'O CEP ingresado excede a distância aceitada de Florianópolis';
            $errors[] = 'erro';
            Store::redirect('finalizar_encomenda_resumo');
            return;
        }
        // Correção limitador de distancia register/////////////////////////////////
        
        if (isset($post['cep_altern']) && !empty($post['cep_altern'])) {


            // Verifica que el CEP tenga el formato correcto
            if (!preg_match('/^\d{5}-?\d{3}$/', $post['cep_altern'])) {
                $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                $errors[] = 'erro';
                Store::redirect('finalizar_encomenda_resumo');
                return;
            }

            if (empty($errors)) {
                $url = 'https://viacep.com.br/ws/' . urlencode($post['cep_altern']) . '/json/';
                $response = file_get_contents($url);

                // Decodifica la respuesta JSON en un arreglo asociativo de PHP
                $data = json_decode($response, true);

                // Verifica si la respuesta indica que el CEP es válido
                if (isset($data['erro'])) {
                    $_SESSION['erro'] = 'Por favor, ingrese um CEP válido. (Se o problema persiste contactenos no Whatsap)';
                    $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                    Store::redirect('finalizar_encomenda_resumo');
                    return;
                }

                $_SESSION['cep'] = $post['cep_altern'];
            }
        }
    }

    //============================================
    public function estabelecer_cel()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        // Correção limitador de distancia register/////////////////////////////////
        $envio = new Envio();
        $dist = $envio->calcular_envio_J($post['cep_altern_cel']);

        if($dist <= 20){
            $_SESSION['cep_altern'] = $post['cep_altern_cel'];
        } else {
            $_SESSION['erro'] = 'O CEP ingresado excede a distância aceitada de Florianópolis';
            $errors[] = 'erro';
            Store::redirect('finalizar_encomenda_resumo');
            return;
        }
        // Correção limitador de distancia register/////////////////////////////////
        
        if (isset($post['cep_altern_cel']) && !empty($post['cep_altern_cel'])) {


            // Verifica que el CEP tenga el formato correcto
            if (!preg_match('/^\d{5}-?\d{3}$/', $post['cep_altern_cel'])) {
                $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                $errors[] = 'erro';
                Store::redirect('finalizar_encomenda_resumo');
                return;
            }

            if (empty($errors)) {
                $url = 'https://viacep.com.br/ws/' . urlencode($post['cep_altern_cel']) . '/json/';
                $response = file_get_contents($url);

                // Decodifica la respuesta JSON en un arreglo asociativo de PHP
                $data = json_decode($response, true);

                // Verifica si la respuesta indica que el CEP es válido
                if (isset($data['erro'])) {
                    $_SESSION['erro'] = 'Por favor, ingrese um CEP válido. (Se o problema persiste contactenos no Whatsap)';
                    $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                    Store::redirect('finalizar_encomenda_resumo');
                    return;
                }

                $_SESSION['cep'] = $post['cep_altern_cel'];
            }
        }
    }

    public function procura_local()
    {

        $post = json_decode(file_get_contents('php://input'), true);

        if ($post['procura_local'] == 'procura_no_local') {
            $_SESSION['cep'] = 'procura_no_local';
        }
    }

    public function cep_alternativo()
    {
        // receber os dados via AJAX(axios)
        $post = json_decode(file_get_contents('php://input'), true);


        if (!isset($_SESSION['cep_altern'])) {

            if ($post['adic_envio'] == 'adic_envio') {

                if (!empty($post['procura_local'])) {
                    unset($post['procura_local']);
                    $cliente = new Clientes();
                    $dados_cliente = $cliente->buscar_dados_cliente($_SESSION['cliente']);

                    $_SESSION['cep'] = $dados_cliente->morada;
                }
            }

            $cliente = new Clientes();
            $dados_cliente = $cliente->buscar_dados_cliente($_SESSION['cliente']);
            $_SESSION['cep'] = $dados_cliente->morada;
        } else {

            if ($post['adic_envio'] == 'adic_envio') {

                if (!empty($post['procura_local'])) {
                    unset($post['procura_local']);

                    $_SESSION['cep'] = $_SESSION['cep_altern'];
                }
            }
            $_SESSION['cep'] = $_SESSION['cep_altern'];
        }




        /*
        $post[procura_local] = procura_no_local
        $_SESSION['cep'] = procura_no_local
        $post[adic_envio] = adic_envio
        $_SESSION['cep'] = cep do usuario ou cep estabelecido.
        */
    }

    // ===========================================
    public function finalizar_encomenda()
    {


        // verifica se existe cliente logado
        if (!isset($_SESSION['cliente'])) {

            // coloca na sessão um referrer temporario
            $_SESSION['tmp_carrinho'] = true;

            // redirecionar para o quadro de login
            Store::redirect('login');
        } else {
            Store::redirect('finalizar_encomenda_resumo');
        }
        echo 'ERRO';
    }
    // ===========================================
    public function cancelar_encomenda()
    {

        // verificar se existe cliente logado
        if (!isset($_SESSION['cliente'])) {
            Store::redirect('inicio');
            return;
        }

        // verificar se veio indicado um id_encomenda (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }

        $id_encomenda = null;
        // verifica se o id_premio é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $id_encomenda = Store::aesDesencriptar($_GET['id']);
            if (empty($id_encomenda)) {
                Store::redirect();
                return;
            }
        }

        $parametros = [
            ':id_encomenda' => $id_encomenda,
        ];

        $bd = new Database();
        $encomenda_produtos = $bd->select('SELECT * FROM encomenda_produto WHERE id_encomenda = :id_encomenda', $parametros);

        $sd = new Stock();

        $parametros = [
            ':id_encomenda' => $id_encomenda,
            ':status' => 'CANCELADA'
        ];

        $bd->update("UPDATE encomendas
        SET
          status = :status,
          updated_at = NOW()
        WHERE id_encomenda = :id_encomenda
      ", $parametros);

        foreach ($encomenda_produtos as $produto) {
            $sd->recup_stock($produto->id_produto, $produto->quantidade);
        }

        Store::redirect('historico_encomendas');
    }

    public function finalizar_encomenda_resumo()
    {


        // verifica se existe cliente logado

        if (!isset($_SESSION['cliente'])) {
            Store::redirect('inicio');
            return;
        }

        // verifica se pode avançar para a gravação da encomenda
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            Store::redirect('inicio');
            return;
        }

        //-----------------------------------------
        // informações do carrinho

        $ids = [];
        foreach ($_SESSION['carrinho'] as $id_produto => $value) {
            array_push($ids, $id_produto);
        }

        $ids = implode(",", $ids);
        $produtos = new Produtos();
        $resultados = $produtos->buscar_produtos_por_ids($ids);

        $dados_tmp = [];
        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade_carrinho) {

            // imagem do produto
            foreach ($resultados as $produto) {
                if ($produto->id_produto == $id_produto) {
                    $id_produto = $produto->id_produto;
                    $imagem = $produto->imagem;
                    $titulo = $produto->nome_produto;
                    $quantidade = $quantidade_carrinho;
                    $preco = $produto->preco * $quantidade;
                    $pontos = $produto->pontos * $quantidade;

                    // colocar o produto na coleção
                    array_push($dados_tmp, [
                        'id_produto' => $id_produto,
                        'imagem' => $imagem,
                        'titulo' => $titulo,
                        'quantidade' => $quantidade,
                        'preco' => $preco,
                        'pontos' => $pontos,
                    ]);

                    break;
                }
            }
        }

        // calcular o total
        $total_da_encomenda = 0;
        $total_pontos = 0;
        foreach ($dados_tmp as $item) {
            $total_da_encomenda += $item['preco'];
            $total_pontos += $item['pontos'];
        }

        array_push($dados_tmp, $total_da_encomenda);
        array_push($dados_tmp, $total_pontos);

        // colocar o preço total na nossa sessão
        $_SESSION['total_encomenda'] = $total_da_encomenda;

        // preparar os dados da view
        $dados = [];

        $dados['carrinho'] = $dados_tmp;

        //---------------------------------------------
        // buscar informações do cliente
        $cliente = new Clientes();
        $dados_cliente = $cliente->buscar_dados_cliente($_SESSION['cliente']);

        $dados['cliente'] = $dados_cliente;

        // --------------------------------------------------
        // gerar o codigo da encomenda
        if (!isset($_SESSION['codigo_encomenda'])) {
            $codigo_encomenda = Store::gerarCodigoEncomenda();
            $_SESSION['codigo_encomenda'] = $codigo_encomenda;
        }

        if (!isset($_SESSION['cep']) || isset($_SESSION['cep']) && empty($_SESSION['cep'])) {
            $_SESSION['cep'] = $dados_cliente->morada;
        }


        // apresenta a página da loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'encomenda_resumo',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //============================================
    public function finalizar_compra()
    {


        // verifica se existe cliente logado

        if (!isset($_SESSION['cliente'])) {
            Store::redirect('inicio');
            return;
        }

        // verifica se pode avançar para a gravação da encomenda
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            Store::redirect('inicio');
            return;
        }

        ///Array ( [2] => 2 [102] => 1 [1] => 1 [101] => 1 )



        // verificadores de CEP/////////////////////////////////////////////////

        if (isset($_SESSION['cep']) && !empty($_SESSION['cep'])) {
            $cep = $_SESSION['cep'];

            if ($_SESSION['cep'] != 'procura_no_local') {

                // Verifica que el CEP tenga el formato correcto
                if (!preg_match('/^\d{5}-?\d{3}$/', $cep)) {
                    $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                    $errors[] = 'erro';
                    Store::redirect('finalizar_encomenda_resumo');
                    return;
                }

                if (empty($errors)) {
                    $url = 'https://viacep.com.br/ws/' . urlencode($cep) . '/json/';
                    $response = file_get_contents($url);

                    // Decodifica la respuesta JSON en un arreglo asociativo de PHP
                    $data = json_decode($response, true);

                    // Verifica si la respuesta indica que el CEP es válido
                    if (isset($data['erro'])) {
                        $_SESSION['erro'] = 'Por favor, ingrese um CEP válido. (Se o problema persiste contactenos no Whatsap)';
                        $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                        Store::redirect('finalizar_encomenda_resumo');
                        return;
                    }
                }
            }
        }

        // verificadores de CEP////////////////////////////////////////////////////


        //-------------------------------------------
        // enviar email para o cliente com os dados da encomenda e pagamento
        $dados_encomenda = [];


        // buscar os dados dos produtos
        $ids = [];


        foreach ($_SESSION['carrinho'] as $id_produto => $value) {
            array_push($ids, $id_produto);
        }

        $ids = implode(",", $ids);
        $produtos = new Produtos();
        $produtos_da_encomenda = $produtos->buscar_produtos_por_ids($ids);
        $sp = new Stock();

        // estrutura dos dados dos produtos 
        $string_produtos = [];

        foreach ($produtos_da_encomenda as $resultado) {

            // quantidade
            $quantidade = $_SESSION['carrinho'][$resultado->id_produto];
            $stock = $sp->item_stock($resultado->id_produto);

            if ($quantidade > $stock[0]->stock) {
                $_SESSION['erro'] = "Lamentamos informarle que o produto que esta tentando adquirir($resultado->nome_produto), já não se encontra disponível.";
                Store::redirect('finalizar_encomenda_resumo');
                return;
            }
            // string do produto
            $string_produtos[] = "$quantidade x $resultado->nome_produto - " . "Uni/$ " . number_format($resultado->preco, 2, ',', '.');
            $sp->desc_stock($resultado->id_produto, $quantidade);
        }

        // lista de produtos para o email
        $dados_encomenda['lista_produtos'] = $string_produtos;

        // preco total da encomenda para o email
        $dados_encomenda['total'] = "R$ " . number_format($_SESSION['total_encomenda'], 2, ',', '.');

        // dados de pagamento
        $dados_encomenda['dados_pagamento'] = [
            'Chave_pix_telefone' => '48 999 906 903',
            'codigo_encomenda' => $_SESSION['codigo_encomenda'],
            'total' => "R$ " . number_format($_SESSION['total_encomenda'], 2, ',', '.'),
        ];



        //-------------------------------------------
        // Guardar na base de dados a encomenda

        $dados_encomenda = [];
        $dados_encomenda['id_cliente'] = $_SESSION['cliente'];

        $CLIENTE = new Clientes();
        $dados_cliente = $CLIENTE->buscar_dados_cliente($_SESSION['cliente']);


        if ($_SESSION['cep'] != $dados_cliente->morada) {
            // considerar a morada alternativa
            $cep = $_SESSION['cep'];

            $dados_encomenda['morada'] = $cep;
            $dados_encomenda['cidade'] = 'CEP diferente';
            $dados_encomenda['email'] = $dados_cliente->email;
            $dados_encomenda['telefone'] = $dados_cliente->telefone;
        } else {
            // considerar a morada do cliente na base de dados
            $cep = $dados_cliente->morada;

            $dados_encomenda['morada'] = $dados_cliente->morada;
            $dados_encomenda['cidade'] = $dados_cliente->cidade;
            $dados_encomenda['email'] = $dados_cliente->email;
            $dados_encomenda['telefone'] = $dados_cliente->telefone;
        }

        if ($_SESSION['cep'] == '') {
            $cep = $dados_cliente->morada;
        }


        $envio = new Envio();
        if ($_SESSION['cep'] != 'procura_no_local') {
            $km_envio = $envio->calcular_envio_J($cep);
            $coste_envio = $envio->calcular_coste($km_envio);
        } else {
            $coste_envio = 0;
        }

        // codigo encomenda
        $dados_encomenda['codigo_encomenda'] = $_SESSION['codigo_encomenda'];

        // estado
        $dados_encomenda['status'] = 'PENDENTE';
        $dados_encomenda['envio'] = $coste_envio;
        $dados_encomenda['pontos'] = 0;

        foreach ($produtos_da_encomenda as $produto) {
            $dados_encomenda['pontos'] += ($_SESSION['carrinho'][$produto->id_produto] * $produto->pontos);
        }

        // ----------------------------------
        // dados dos produtos da encomenda
        $dados_produtos = [];
        foreach ($produtos_da_encomenda as $produto) {
            $dados_produtos[] = [
                'designacao_produto' => $produto->nome_produto,
                'id_produto' => $produto->id_produto,
                'preco_unidade' => $produto->preco,
                'quantidade' => $_SESSION['carrinho'][$produto->id_produto],
                'pontos' => $produto->pontos,
            ];
        }

        //vendedor
        $dados_encomenda['vendedor'] = $dados_cliente->vendedor;
        //vendedor

        $encomenda = new Encomendas();
        $encomenda->guardar_encomenda($dados_encomenda, $dados_produtos);

        // preparar dados para presentar na pagina agradecimento
        $codigo_encomenda = $_SESSION['codigo_encomenda'];
        $total_encomenda = $_SESSION['total_encomenda'];
        if (!is_string($coste_envio)) {
            $total_com_envio = $_SESSION['total_encomenda'] + $coste_envio;
        } else {
            $total_com_envio = $_SESSION['total_encomenda'];
        }
        
        $dados_encomenda['total_com_envio'] = $total_com_envio;
        // enviar o email para o cliente com os dados da encomenda
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_encomenda($_SESSION['usuario'], $dados_encomenda);
        //-----------------------------------------------------
        // Limpar carrinho
        unset($_SESSION['codigo_encomenda']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['total_encomenda']);
        unset($_SESSION['dados_alternativos']);
        unset($_SESSION['envio']);
        unset($_SESSION['cep']);
        unset($_SESSION['cep_altern']);

        // Apresentar a mensagem de confirmação da compra
        $dados = [
            'codigo_encomenda' => $codigo_encomenda,
            'total_encomenda' => $total_encomenda,
            'total_com_envio' => $total_com_envio
        ];

        // apresenta a página da loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'encomenda_confirmada',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //============================================
    public function agendar_compra()
    {



        // verifica se existe cliente logado

        if (!isset($_SESSION['cliente'])) {
            Store::redirect('inicio');
            return;
        }

        // verifica se pode avançar para a gravação da encomenda
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            Store::redirect('inicio');
            return;
        }



        // verificadores de CEP/////////////////////////////////////////////////

        if (isset($_SESSION['cep']) && !empty($_SESSION['cep'])) {
            $cep = $_SESSION['cep'];
            if ($_SESSION['cep'] != 'procura_no_local') {
                // Verifica que el CEP tenga el formato correcto
                if (!preg_match('/^\d{5}-?\d{3}$/', $cep)) {
                    $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                    $errors[] = 'erro';
                    Store::redirect('finalizar_encomenda_resumo');
                    return;
                }

                if (empty($errors)) {
                    $url = 'https://viacep.com.br/ws/' . urlencode($cep) . '/json/';
                    $response = file_get_contents($url);

                    // Decodifica la respuesta JSON en un arreglo asociativo de PHP
                    $data = json_decode($response, true);

                    // Verifica si la respuesta indica que el CEP es válido
                    if (isset($data['erro'])) {
                        $_SESSION['erro'] = 'Por favor, ingrese um CEP válido. (Se o problema persiste contactenos no Whatsap)';
                        $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                        Store::redirect('finalizar_encomenda_resumo');
                        return;
                    }
                }
            }
        }

        // verificadores de CEP////////////////////////////////////////////////////


        //-------------------------------------------
        // enviar email para o cliente com os dados da encomenda e pagamento
        $dados_encomenda = [];


        // buscar os dados dos produtos
        $ids = [];


        foreach ($_SESSION['carrinho'] as $id_produto => $value) {
            array_push($ids, $id_produto);
        }

        $ids = implode(",", $ids);
        $produtos = new Produtos();
        $produtos_da_encomenda = $produtos->buscar_produtos_por_ids($ids);

        // estrutura dos dados dos produtos 
        $string_produtos = [];
        $sp = new Stock();

        foreach ($produtos_da_encomenda as $resultado) {

            // quantidade
            $quantidade = $_SESSION['carrinho'][$resultado->id_produto];
            $stock = $sp->item_stock($resultado->id_produto);

            if ($quantidade > $stock[0]->stock) {
                $_SESSION['erro'] = "Lamentamos informarle que o produto que esta tentando adquirir($resultado->nome_produto), já não se encontra disponível.";
                Store::redirect('finalizar_encomenda_resumo');
                return;
            }
            // string do produto
            $string_produtos[] = "$quantidade x $resultado->nome_produto - " . "Uni/$ " . number_format($resultado->preco, 2, ',', '.');
            $sp->desc_stock($resultado->id_produto, $quantidade);
        }
        // lista de produtos para o email
        $dados_encomenda['lista_produtos'] = $string_produtos;

        // preco total da encomenda para o email
        $dados_encomenda['total'] = "R$ " . number_format($_SESSION['total_encomenda'], 2, ',', '.');

        // dados de pagamento
        $dados_encomenda['dados_pagamento'] = [
            'Chave_pix_telefone' => '48 999 906 903',
            'codigo_encomenda' => $_SESSION['codigo_encomenda'],
            'total' => "R$ " . number_format($_SESSION['total_encomenda'], 2, ',', '.'),
        ];


        //-------------------------------------------
        // Guardar na base de dados a encomenda

        $dados_encomenda = [];
        $dados_encomenda['id_cliente'] = $_SESSION['cliente'];

        $CLIENTE = new Clientes();
        $dados_cliente = $CLIENTE->buscar_dados_cliente($_SESSION['cliente']);

        if ($_SESSION['cep'] != $dados_cliente->morada) {
            // considerar a morada alternativa
            $cep = $_SESSION['cep'];

            $dados_encomenda['morada'] = $cep;
            $dados_encomenda['cidade'] = 'CEP diferente';
            $dados_encomenda['email'] = $dados_cliente->email;
            $dados_encomenda['telefone'] = $dados_cliente->telefone;
        } else {
            // considerar a morada do cliente na base de dados
            $cep = $dados_cliente->morada;

            $dados_encomenda['morada'] = $dados_cliente->morada;
            $dados_encomenda['cidade'] = $dados_cliente->cidade;
            $dados_encomenda['email'] = $dados_cliente->email;
            $dados_encomenda['telefone'] = $dados_cliente->telefone;
        }


        if ($_SESSION['cep'] == '') {
            $cep = $dados_cliente->morada;
        }


        $envio = new Envio();
        if ($_SESSION['cep'] != 'procura_no_local') {
            $km_envio = $envio->calcular_envio_J($cep);
            $coste_envio = $envio->calcular_coste($km_envio);
        } else {
            $coste_envio = 0;
        }

        // codigo encomenda
        $dados_encomenda['codigo_encomenda'] = $_SESSION['codigo_encomenda'];

        // estado
        $horario = new horario();

        if ($horario->aberto() == 'true') {
            $dados_encomenda['status'] = 'PENDENTE';
        } else {
            $dados_encomenda['status'] = 'AGENDADA';
        }

        $dados_encomenda['envio'] = $coste_envio;
        $dados_encomenda['pontos'] = 0;

        foreach ($produtos_da_encomenda as $produto) {
            $dados_encomenda['pontos'] += ($_SESSION['carrinho'][$produto->id_produto] * $produto->pontos);
        }

        // ----------------------------------
        // dados dos produtos da encomenda
        $dados_produtos = [];
        foreach ($produtos_da_encomenda as $produto) {
            $dados_produtos[] = [
                'designacao_produto' => $produto->nome_produto,
                'id_produto' => $produto->id_produto,
                'preco_unidade' => $produto->preco,
                'quantidade' => $_SESSION['carrinho'][$produto->id_produto],
                'pontos' => $produto->pontos,
            ];
        }

        //vendedor
        $dados_encomenda['vendedor'] = $dados_cliente->vendedor;
        //vendedor

        $encomenda = new Encomendas();
        $encomenda->guardar_encomenda($dados_encomenda, $dados_produtos);

        // preparar dados para presentar na pagina agradecimento
        $codigo_encomenda = $_SESSION['codigo_encomenda'];
        $total_encomenda = $_SESSION['total_encomenda'];
        if (!is_string($coste_envio)) {
            $total_com_envio = $_SESSION['total_encomenda'] + $coste_envio;
        } else {
            $total_com_envio = $_SESSION['total_encomenda'];
        }
        
        $dados_encomenda['total_com_envio'] = $total_com_envio;
        // enviar o email para o cliente com os dados da encomenda
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_encomenda_agendada($_SESSION['usuario'], $dados_encomenda);


        //-----------------------------------------------------
        // Limpar carrinho
        unset($_SESSION['codigo_encomenda']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['total_encomenda']);
        unset($_SESSION['dados_alternativos']);
        unset($_SESSION['envio']);
        unset($_SESSION['cep']);
        unset($_SESSION['cep_altern']);

        // Apresentar a mensagem de confirmação da compra
        $dados = [
            'codigo_encomenda' => $codigo_encomenda,
            'total_encomenda' => $total_encomenda,
            'total_com_envio' => $total_com_envio
        ];

        // apresenta a página da loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'agenda_confirmada',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function adquirir_premio()
    {
        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verificar se veio indicado um id_encomenda (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }

        $id_premio = null;
        // verifica se o id_premio é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $id_premio = Store::aesDesencriptar($_GET['id']);
            if (empty($id_premio)) {
                Store::redirect();
                return;
            }
        }

        $id_cliente = $_SESSION['cliente'];

        $bd = new Database();

        $parametros = [
            ':id_premio' => $id_premio
        ];

        $premio = $bd->select("SELECT * FROM premios WHERE id_premio = :id_premio", $parametros);

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $dados_cliente = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);


        $dados = [
            'cliente' => $dados_cliente[0],
            'premio' => $premio[0],
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'premio_confirmacao',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function adquirir_premio_confirmacao()
    {
        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verificar se veio indicado um id_encomenda (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }


        $id_premio = null;
        // verifica se o id_premio é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {

            $id_premio = Store::aesDesencriptar($_GET['id']);
            if (empty($id_premio)) {
                Store::redirect();
                return;
            }
        }


        $id_cliente = $_SESSION['cliente'];

        $bd = new Database();
        $cliente = new Clientes();

        $parametros = [
            ':id_premio' => $id_premio
        ];

        $premio = $bd->select("SELECT * FROM premios WHERE id_premio = :id_premio", $parametros);

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $dados_cliente = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);


        $telefone = $dados_cliente[0]->telefone;


        $coste_pontos = $premio[0]->preco;
        $verif = ($dados_cliente[0]->pontos_cliente - $dados_cliente[0]->pontos_usados);



        //Gerar um codigo de premiação
        $codigo_premio = Store::gerarCodigoEncomenda();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];


        //verificar se a petição foi no mesmo minuto para nao spam.
        $anterior_adq = $bd->select("SELECT * FROM premios_register WHERE id_cliente = :id_cliente", $parametros);
        $quant_adq = (count($anterior_adq) - 1);
        $parametros = [
            ':id_cliente' => $id_cliente,
            ':id_peticao' => $anterior_adq[$quant_adq]->id_peticao
        ];

        $ult_encomenda_minuto = $bd->select("SELECT minute(min_adq) AS 'minutes' FROM premios_register WHERE id_cliente = :id_cliente AND id_peticao = :id_peticao", $parametros);

        $ult_encomenda_dia = $bd->select("SELECT DAY(created_at) AS 'day' FROM premios_register WHERE id_cliente = :id_cliente AND id_peticao = :id_peticao", $parametros);

        $ult_prod_adq = $anterior_adq[$quant_adq]->id_premio;

        $hoy = getdate();
        $min_agora = $hoy['minutes'];
        $dia_hoy = $hoy['mday'];

        $prod_adq = $premio[0]->id_premio;

        // Verificar se alcançam os pontos do cliente para adquirir o premio feito no mesmo min ou dia da encomenda anterior:
        if (($verif < $coste_pontos) && ($ult_encomenda_minuto[0]->minutes == $min_agora) && ($ult_encomenda_dia[0]->day == $dia_hoy)) {
            Store::redirect("parabens_premio_adq");
            return;
        }

        // Verificar se alcançam os pontos do cliente para adquirir o premio feito no mesmo min ou dia da encomenda anterior:
        if (($verif < $coste_pontos) && ($ult_encomenda_minuto[0]->minutes != $min_agora) || ($verif < $coste_pontos) && ($ult_encomenda_dia[0]->day != $dia_hoy)) {
            Store::redirect();
            return;
        }

        if (!empty($anterior_adq)) {
            if (($prod_adq == $ult_prod_adq) && ($ult_encomenda_minuto[0]->minutes == $min_agora) && ($ult_encomenda_dia[0]->day == $dia_hoy)) {
                Store::redirect("parabens_premio_adq");
                return;
            } elseif (($prod_adq != $ult_prod_adq) && ($ult_encomenda_minuto[0]->minutes == $min_agora) && ($ult_encomenda_dia[0]->day == $dia_hoy)) {

                $cliente->restar_pontos($id_cliente, $coste_pontos);

                $parametros = [
                    ':id_premio' => $id_premio,
                    ':id_cliente' => $id_cliente,
                    ':coste' => $coste_pontos,
                    ':telefone' => $telefone,
                    ':codigo' => $codigo_premio,
                    ':status' => 'PENDENTE'
                ];

                //Guardar na base de dados a transação
                $pre = new Premios();

                $pre->guardar_premio($parametros);

                //enviar email de confimação de premio

                $enviar = new EnviarEmail();

                $email_cliente = $dados_cliente[0]->email;

                $produto = $premio[0]->nome_premio;
                $descricao = $premio[0]->descricao;

                $dados_premio = [
                    'produto' => $produto,
                    'decricao' => $descricao,
                    'coste' => $coste_pontos,
                    'telefone' => $telefone,
                    'codigo' => $codigo_premio,
                    'status' => 'PENDENTE'
                ];

                $enviar->enviar_email_confirmacao_premio($email_cliente, $dados_premio);

                //redirect a la loja de premios del cliente.

                Store::redirect("parabens_premio_adq");
            } else {

                $cliente->restar_pontos($id_cliente, $coste_pontos);

                $parametros = [
                    ':id_premio' => $id_premio,
                    ':id_cliente' => $id_cliente,
                    ':coste' => $coste_pontos,
                    ':telefone' => $telefone,
                    ':codigo' => $codigo_premio,
                    ':status' => 'PENDENTE'
                ];

                //Guardar na base de dados a transação
                $pre = new Premios();

                $pre->guardar_premio($parametros);

                //enviar email de confimação de premio

                $enviar = new EnviarEmail();

                $email_cliente = $dados_cliente[0]->email;

                $produto = $premio[0]->nome_premio;
                $descricao = $premio[0]->descricao;

                $dados_premio = [
                    'produto' => $produto,
                    'decricao' => $descricao,
                    'coste' => $coste_pontos,
                    'telefone' => $telefone,
                    'codigo' => $codigo_premio,
                    'status' => 'PENDENTE'
                ];

                $enviar->enviar_email_confirmacao_premio($email_cliente, $dados_premio);

                //redirect a la loja de premios del cliente.

                Store::redirect("parabens_premio_adq");
            }
        } else {

            $cliente->restar_pontos($id_cliente, $coste_pontos);

            $parametros = [
                ':id_premio' => $id_premio,
                ':id_cliente' => $id_cliente,
                ':coste' => $coste_pontos,
                ':telefone' => $telefone,
                ':codigo' => $codigo_premio,
                ':status' => 'PENDENTE'
            ];

            //Guardar na base de dados a transação
            $pre = new Premios();

            $pre->guardar_premio($parametros);

            //enviar email de confimação de premio

            $enviar = new EnviarEmail();

            $email_cliente = $dados_cliente[0]->email;

            $produto = $premio[0]->nome_premio;
            $descricao = $premio[0]->descricao;

            $dados_premio = [
                'produto' => $produto,
                'decricao' => $descricao,
                'coste' => $coste_pontos,
                'telefone' => $telefone,
                'codigo' => $codigo_premio,
                'status' => 'PENDENTE'
            ];

            $enviar->enviar_email_confirmacao_premio($email_cliente, $dados_premio);

            //redirect a la loja de premios del cliente.

            Store::redirect("parabens_premio_adq");
        }
    }
}
