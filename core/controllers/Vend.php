<?php

namespace core\controllers;

use Closure;
use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Vendedor;
use core\models\Clientes;

class vend
{
    //=============================================

    public function index()
    {


        // verifica se já existe sessão aberta (admin)
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('vendedor_login');
            return;
        }

        $id_vendedor = $_SESSION['vendedor'];

        // verificar se existe encomendas em estado PENDENTES
        $VENDEDOR = new Vendedor();
        $total_encomendas_agendadas = $VENDEDOR->total_encomendas_agendadas($id_vendedor);
        $total_encomendas_pendentes = $VENDEDOR->total_encomendas_pendentes($id_vendedor);
        $total_encomendas_em_processamento = $VENDEDOR->total_encomendas_em_processamento($id_vendedor);
        $total_encomendas_enviadas = $VENDEDOR->total_encomendas_enviadas($id_vendedor);
        $total_encomendas_canceladas = $VENDEDOR->total_encomendas_canceladas($id_vendedor);
        $total_encomendas_concluidas = $VENDEDOR->total_encomendas_concluidas($id_vendedor);


        $data = [
            'total_encomendas_agendadas' => $total_encomendas_agendadas,
            'total_encomendas_pendentes' => $total_encomendas_pendentes,
            'total_encomendas_em_processamento' => $total_encomendas_em_processamento,
            'total_encomendas_enviadas' => $total_encomendas_enviadas,
            'total_encomendas_canceladas' => $total_encomendas_canceladas,
            'total_encomendas_concluidas' => $total_encomendas_concluidas
        ];


        // ja existe um admin logado
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/home',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }

    //================================================
    // AUTENTICAÇÃO
    //================================================
    public function vendedor_login()
    {

        if (Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // apresenta o quadro de login
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/login_frm',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ]);
    }
    //================================================
    public function vendedor_login_submit()
    {

        //Verificar se ja existe um utilizador logado
        if (Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // verifica se foi efetuado o post do formulario login do admin
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect_vendedor('inicio');
            return;
        }

        // validar se os campos vieram corretamente
        if (
            !isset($_POST['text_vendedor']) ||
            !isset($_POST['text_senha'])
        ) {
            // erro de preenchimento do formulario
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect_vendedor('vendedor_login');
            return;
        }
        
        // prepara os dados para o model
        $vendedor = trim(strtolower($_POST['text_vendedor']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é
        $vendedor_model = new Vendedor();
        $resultado = $vendedor_model->validar_login($vendedor, $senha);

        // analisa o resultado
        if (is_bool($resultado)) {

            //login invalido
            $_SESSION['erro'] = 'login invalido';
            Store::redirect_vendedor('login');
            return;
        } else {

            // login valido. Coloca os dados na sessao
            $_SESSION['vendedor'] = $resultado->id_vendedor;
            $_SESSION['vendedor_usuario'] = $resultado->usuario;

            // redirecionar para a pagina inicial do backoffice
            Store::redirect_vendedor('inicio');
        }
    }
    //================================================
    public function vendedor_logout()
    {

        // faz o logout do admin da sessão
        unset($_SESSION['vendedor']);
        unset($_SESSION['vendedor_usuario']);

        // redirecionar para o inicio
        Store::redirect_vendedor('inicio');
    }



    //================================================
    // CLIENTES
    //================================================
    public function lista_clientes()
    {

        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }
        $id_vendedor = $_SESSION['vendedor'];

        // vai buscar a lista de clientes
        $VENDEDOR = new Vendedor();
        $clientes = $VENDEDOR->lista_clientes($id_vendedor);

        $data = [
            'clientes' => $clientes
        ];

        // apresenta a pagina da lista de clientes
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/lista_clientes',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }
    // ==========================================
    public function detalhe_cliente()
    {

        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // verifica se existe um i_cliente na query string 
        if (!isset($_GET['c'])) {
            Store::redirect_vendedor('inicio');
            return;
        }

        $id_cliente = Store::aesDesencriptar($_GET['c']);
        // verifica se o id_cliente é válido
        if (empty($id_cliente)) {
            Store::redirect_vendedor('inicio');
            return;
        }

        $id_vendedor = $_SESSION['vendedor'];

        // buscar os dados do cliente
        $VENDEDOR = new Vendedor();
        $data = [
            'dados_cliente' => $VENDEDOR->buscar_cliente($id_cliente),
            'total_encomendas' => $VENDEDOR->total_encomendas_cliente($id_cliente, $id_vendedor)
        ];

        // apresenta a pagina das encomendas
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/detalhe_cliente',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }
    // =========================================
    public function cliente_historico_encomendas()
    {
        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // verifica se existe um id_cliente encriptado
        if (!isset($_GET['c'])) {
            Store::redirect_vendedor('inicio');
        }

        $id_vendedor = $_SESSION['vendedor'];
        // definir o id_cliente que vem encriptado
        $id_cliente = Store::aesDesencriptar($_GET['c']);
        $VENDEDOR = new Vendedor();
        $data = [
            'cliente' => $VENDEDOR->buscar_cliente($id_cliente),
            'lista_encomendas' => $VENDEDOR->buscar_encomendas_clientes($id_cliente, $id_vendedor)
        ];

        // apresenta a pagina das encomendas
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/lista_encomendas_cliente',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }

    //================================================
    // ENCOMENDAS
    //================================================
    public function lista_encomendas()
    {
        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // apresenta a lista de encomendas (usando filtro se for o caso)
        // verifica se existe um filtro da query string

        $filtros = [
            'agendada' => 'AGENDADA',
            'pendente' => 'PENDENTE',
            'em_processamento' => 'EM PROCESSAMENTO',
            'cancelada' => 'CANCELADA',
            'enviada' => 'ENVIADA',
            'concluida' => 'CONCLUIDA',
        ];

        $filtro = '';
        if (isset($_GET['f'])) {

            // verificar se a variável é uma key dos filtros
            if (key_exists($_GET['f'], $filtros)) {
                $filtro = $filtros[$_GET['f']];
            }
        }


        // vai buscar o id cliente se existir na query string
        $id_cliente = null;
        if (isset($_GET['c'])) {
            $id_cliente = Store::aesDesencriptar($_GET['c']);
        }


        $id_vendedor = $_SESSION['vendedor'];

        // Carregar a lista de encomendas
        $vendedor_model = new Vendedor();
        $lista_encomendas = $vendedor_model->lista_encomendas($filtro, $id_cliente, $id_vendedor);


        $data = [
            'lista_encomendas' => $lista_encomendas,
            'filtro' => $filtro
        ];


        // apresenta a pagina das encomendas
        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/lista_encomendas',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }

    //====================================
    public function detalhe_encomenda()
    {
        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        //buscar o id_encomenda
        $id_encomenda = null;
        if (isset($_GET['e'])) {
            $id_encomenda = Store::aesDesencriptar($_GET['e']);
        }

        if (gettype($id_encomenda) != 'string') {
            Store::redirect_vendedor('inicio');
            return;
        }

        $id_vendedor = $_SESSION['vendedor'];
        //carregar os dados da encomenda selecionada
        $VENDEDOR = new Vendedor();
        $encomenda = $VENDEDOR->buscar_detalhes_encomenda($id_encomenda, $id_vendedor);

        //apresentar os dados forma a poder ver os detalhes e alterar o status
        $data  = $encomenda;

        Store::Layout_vendedor([
            'vendedor/Layouts/html_header',
            'vendedor/Layouts/header',
            'vendedor/encomenda_detalhe',
            'vendedor/Layouts/footer',
            'vendedor/Layouts/html_footer',
        ], $data);
    }

    //====================================
    public function encomenda_alterar_estado()
    {

        //Verificar se existe um utilizador logado
        if (!Store::vendedorLogado()) {
            Store::redirect_vendedor('inicio');
            return;
        }

        //buscar o id_encomenda
        $id_encomenda = null;
        if (isset($_GET['e'])) {
            $id_encomenda = Store::aesDesencriptar($_GET['e']);
        }

        if (gettype($id_encomenda) != 'string') {
            Store::redirect_vendedor('inicio');
            return;
        }

        // buscar o novo estado
        $estado = null;

        if (isset($_GET['s'])) {
            $estado = $_GET['s'];
        }

        if (!in_array($estado, STATUS)) {
            Store::redirect_vendedor('inicio');
            return;
        }

        // atualizar o estado da encomenda na base da dados
        $VENDEDOR = new Vendedor();
        $VENDEDOR->atualizar_status_encomenda($id_encomenda, $estado);
        $bd = new Database();

        $parametros = [
            ':id_encomenda' => $id_encomenda
        ];

        $id_cliente = $bd->select("SELECT id_cliente
            FROM encomendas
            WHERE id_encomenda = :id_encomenda
        ", $parametros);


        $cliente = new Clientes();
        $cliente->pontos_cliente($id_cliente[0]->id_cliente);

        Store::redirect_vendedor('detalhe_encomenda&e=' . $_GET['e'], true);
    }

}
