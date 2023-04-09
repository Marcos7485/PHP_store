<?php


// coleção de rotas
$rotas=[
    'inicio' => 'vend@index',

    'vendedor_login' => 'vend@vendedor_login',
    'vendedor_login_submit' => 'vend@vendedor_login_submit',
    'vendedor_logout' => 'vend@vendedor_logout',

    //clientes
    'lista_clientes' => 'vend@lista_clientes',
    'detalhe_cliente' => 'vend@detalhe_cliente',
    'cliente_historico_encomendas' => 'vend@cliente_historico_encomendas',
    'lista_sugerencias' => 'vend@lista_sugerencias',

    // encomendas
    'lista_encomendas' => 'vend@lista_encomendas',
    'lista_premios' => 'vend@lista_premios',
    'detalhe_premio' => 'vend@detalhe_premio',
    'detalhe_encomenda' => 'vend@detalhe_encomenda',
    'encomenda_alterar_estado' => 'vend@encomenda_alterar_estado',
    'premio_alterar_estado' => 'vend@premio_alterar_estado',
    'marcar_lido' => 'vend@marcar_lido',
];

// define ação por defeito

$acao = 'inicio';

// verifica se existe a ação na query string
if(isset($_GET['a'])){

    // verifica se a ação existe nas rotas
    if(!key_exists($_GET['a'], $rotas)){
        $acao = 'inicio';
    } else{
        $acao = $_GET['a'];
    }
}

// trata a definição da rota
$partes = explode('@',$rotas[$acao]);

$controlador = 'core\\controllers\\'.ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();

