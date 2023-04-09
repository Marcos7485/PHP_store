<?php

// coleção de rotas
$rotas=[
    'inicio' => 'main@index',
    'loja' => 'main@loja',
    'loja_premios' => 'main@loja_premios',
    'loja_premios_cliente' => 'main@loja_premios_cliente',
    'detalhe_premio' => 'main@detalhe_premio',
    'cestas' => 'main@cestas',
    'sugerencia_add' => 'main@sugerencia_add',
    'sugerencia_add_perfil' => 'main@sugerencia_add_perfil',
    'meu_favorito_add' => 'main@meu_favorito_add',
    'contactos' => 'main@contactos',

    // cliente
    'novo_cliente' => 'main@novo_cliente',
    'criar_cliente' => 'main@criar_cliente',
    'criar_cliente_cel' => 'main@criar_cliente_cel',
    'confirmar_email' => 'main@confirmar_email',
    'intereses' => 'main@meus_intereses', 
    'parabens_premio_adq' => 'main@parabens_premio_adq',
    'minhas_sugerencias' => 'main@minhas_sugerencias',



    // login
    'login' => 'main@login',
    'login_submit' => 'main@login_submit',
    'logout' => 'main@logout',
    'recuperar_senha' => 'main@recuperar_senha',
    'recuperar_senha_submit' => 'main@recuperar_senha_submit',
    'recuperacao_email_confirmar' => 'main@recuperacao_email_confirmar',
    'reiniciar_senha_submit' => 'main@reiniciar_senha_submit',

    // perfil
    'perfil' => 'main@perfil',
    'config_perfil' => 'main@config_perfil',
    'alterar_dados_pessoais' => 'main@alterar_dados_pessoais',
    'alterar_dados_pessoais_submit' => 'main@alterar_dados_pessoais_submit',
    'alterar_password' => 'main@alterar_password',    
    'alterar_password_submit' => 'main@alterar_password_submit',
    'historico_encomendas' => 'main@historico_encomendas', 
    'meus_pontos' => 'main@meus_pontos',  
    'sorteios' => 'main@sorteios',  
    'meu_aniversario' => 'main@meu_aniversario',  
    'definir_aniversario' => 'main@definir_aniversario',
    'partecipar' => 'main@partecipar',
    'detalhe_sorteio' => 'main@detalhe_sorteio',

    // historico encomendas
    'historico_encomendas' => 'main@historico_encomendas',
    'detalhe_encomenda' => 'main@historico_encomendas_detalhe',
    'detalhe_p_cliente' => 'main@detalhe_p_cliente',
    'detalhe_produto' => 'main@detalhe_produto',


    // carrinho
    'adicionar_carrinho' => 'carrinho@adicionar_carrinho',
    'adicionar_carrinho_presente' => 'carrinho@adicionar_carrinho_presente',
    'remover_produto_carrinho' => 'carrinho@remover_produto_carrinho',
    'adicionar_produto_carrinho' => 'carrinho@adicionar_produto_carrinho',
    'limpar_carrinho' => 'carrinho@limpar_carrinho',
    'carrinho'=> 'carrinho@carrinho',
    'finalizar_encomenda' => 'carrinho@finalizar_encomenda',
    'finalizar_encomenda_resumo' => 'carrinho@finalizar_encomenda_resumo',
    'cep_alternativo' => 'carrinho@cep_alternativo',
    'estabelecer' => 'carrinho@estabelecer',
    'estabelecer_cel' => 'carrinho@estabelecer_cel',
    'procura_local' => 'carrinho@procura_local',
    'finalizar_compra' => 'carrinho@finalizar_compra',
    'agendar_compra' => 'carrinho@agendar_compra',
    'adquirir_premio' => 'carrinho@adquirir_premio',
    'adquirir_premio_confirmacao' => 'carrinho@adquirir_premio_confirmacao',
    'cancelar_encomenda' => 'carrinho@cancelar_encomenda',


    // pagamentos
    'pagamento' => 'main@pagamento',

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

