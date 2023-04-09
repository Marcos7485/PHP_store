<?php

namespace core\controllers;

use Closure;
use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Administrador;
use core\models\Clientes;

class admin
{
    //=============================================
    //================================================
    public function index()
    {


        // verifica se já existe sessão aberta (admin)
        if (!Store::adminLogado()) {
            Store::redirect('admin_login', true);
            return;
        }

        // verificar se existe encomendas em estado PENDENTES
        $ADMIN = new Administrador();
        $total_encomendas_agendadas = $ADMIN->total_encomendas_agendadas();
        $total_encomendas_pendentes = $ADMIN->total_encomendas_pendentes();
        $total_encomendas_em_processamento = $ADMIN->total_encomendas_em_processamento();
        $total_encomendas_enviadas = $ADMIN->total_encomendas_enviadas();
        $total_encomendas_canceladas = $ADMIN->total_encomendas_canceladas();
        $total_encomendas_concluidas = $ADMIN->total_encomendas_concluidas();

        //premios
        $total_premios_pendentes = $ADMIN->total_premios_pendentes();
        $total_premios_recebidos = $ADMIN->total_premios_recebidos();


        $data = [
            'total_encomendas_agendadas' => $total_encomendas_agendadas,
            'total_encomendas_pendentes' => $total_encomendas_pendentes,
            'total_encomendas_em_processamento' => $total_encomendas_em_processamento,
            'total_encomendas_enviadas' => $total_encomendas_enviadas,
            'total_encomendas_canceladas' => $total_encomendas_canceladas,
            'total_encomendas_concluidas' => $total_encomendas_concluidas,
            'total_premios_pendentes' => $total_premios_pendentes,
            'total_premios_recebidos' => $total_premios_recebidos
        ];


        // ja existe um admin logado
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/home',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }



    //================================================
    // AUTENTICAÇÃO
    //================================================
    public function admin_login()
    {

        if (Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        // apresenta o quadro de login
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/login_frm',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ]);
    }
    //================================================
    public function admin_login_submit()
    {

        //Verificar se ja existe um utilizador logado
        if (Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        // verifica se foi efetuado o post do formulario login do admin
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect('inicio', true);
            return;
        }


        // validar se os campos vieram corretamente
        if (
            !isset($_POST['text_admin']) ||
            !isset($_POST['text_senha'])  ||
            !filter_var(trim($_POST['text_admin']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulario
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('admin_login', true);
            return;
        }

        // prepara os dados para o model
        $admin = trim(strtolower($_POST['text_admin']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é
        $admin_model = new Administrador();
        $resultado = $admin_model->validar_login($admin, $senha);

        // analisa o resultado
        if (is_bool($resultado)) {

            //login invalido
            $_SESSION['erro'] = 'login invalido';
            Store::redirect('login', true);
            return;
        } else {

            // login valido. Coloca os dados na sessao
            $_SESSION['admin'] = $resultado->id_admin;
            $_SESSION['admin_usuario'] = $resultado->usuario;

            // redirecionar para a pagina inicial do backoffice
            Store::redirect('inicio', true);
        }
    }
    //================================================
    public function admin_logout()
    {

        // faz o logout do admin da sessão
        unset($_SESSION['admin']);
        unset($_SESSION['admin_usuario']);

        // redirecionar para o inicio
        Store::redirect('inicio', true);
    }



    //================================================
    // CLIENTES
    //================================================
    public function lista_clientes()
    {

        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        // vai buscar a lista de clientes
        $ADMIN = new Administrador();
        $clientes = $ADMIN->lista_clientes();

        $data = [
            'clientes' => $clientes
        ];

        // apresenta a pagina da lista de clientes
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/lista_clientes',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }
    // ==========================================
    public function detalhe_cliente()
    {

        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        // verifica se existe um i_cliente na query string 
        if (!isset($_GET['c'])) {
            Store::redirect('inicio', true);
            return;
        }

        $id_cliente = Store::aesDesencriptar($_GET['c']);
        // verifica se o id_cliente é válido
        if (empty($id_cliente)) {
            Store::redirect('inicio', true);
            return;
        }

        // buscar os dados do cliente
        $ADMIN = new Administrador();
        $data = [
            'dados_cliente' => $ADMIN->buscar_cliente($id_cliente),
            'total_encomendas' => $ADMIN->total_encomendas_cliente($id_cliente)
        ];

        // apresenta a pagina das encomendas
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/detalhe_cliente',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }
    // =========================================
    public function cliente_historico_encomendas()
    {
        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }


        // verifica se existe um id_cliente encriptado
        if (!isset($_GET['c'])) {
            Store::redirect('inicio', true);
        }

        // definir o id_cliente que vem encriptado
        $id_cliente = Store::aesDesencriptar($_GET['c']);
        $ADMIN = new Administrador();
        $data = [
            'cliente' => $ADMIN->buscar_cliente($id_cliente),
            'lista_encomendas' => $ADMIN->buscar_encomendas_clientes($id_cliente)
        ];

        // apresenta a pagina das encomendas
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/lista_encomendas_cliente',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }



    //================================================
    // ENCOMENDAS
    //================================================
    public function lista_encomendas()
    {


        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
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


        // Carregar a lista de encomendas
        $admin_model = new Administrador();
        $lista_encomendas = $admin_model->lista_encomendas($filtro, $id_cliente);



        $data = [
            'lista_encomendas' => $lista_encomendas,
            'filtro' => $filtro
        ];


        // apresenta a pagina das encomendas
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/lista_encomendas',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }

    public function lista_sugerencias()
    {
        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        $ADMIN = new Administrador();

        $data  =  [
            'lista_sugerencias' => $ADMIN->total_sugerencias()
        ];

        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/lista_sugerencias',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }

    public function marcar_lido()
    {
        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        $id_sugerencia = Store::aesDesencriptar($_GET['id']);

        $ADMIN = new Administrador();

        $ADMIN->marcar_lido($id_sugerencia);

        Store::redirect('lista_sugerencias', true);
    }

    public function lista_premios()
    {


        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }


        // apresenta a lista de encomendas (usando filtro se for o caso)
        // verifica se existe um filtro da query string

        $filtros = [
            'pendente' => 'PENDENTE',
            'recebido' => 'RECEBIDO'
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


        // Carregar a lista de encomendas
        $admin_model = new Administrador();
        $lista_premios = $admin_model->lista_premios($filtro, $id_cliente);


        $data = [
            'lista_premios' => $lista_premios,
            'filtro' => $filtro
        ];


        // apresenta a pagina das encomendas
        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/lista_premios',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }

    //====================================
    public function detalhe_encomenda()
    {
        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        //buscar o id_encomenda
        $id_encomenda = null;
        if (isset($_GET['e'])) {
            $id_encomenda = Store::aesDesencriptar($_GET['e']);
        }

        if (gettype($id_encomenda) != 'string') {
            Store::redirect('inicio', true);
            return;
        }
        //carregar os dados da encomenda selecionada
        $ADMIN = new Administrador();
        $encomenda = $ADMIN->buscar_detalhes_encomenda($id_encomenda);

        //apresentar os dados forma a poder ver os detalhes e alterar o status
        $data  = $encomenda;

        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/encomenda_detalhe',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }

    //====================================
    public function detalhe_premio()
    {
        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        //buscar o id_encomenda
        $id_peticao = null;
        if (isset($_GET['p'])) {
            $id_peticao = Store::aesDesencriptar($_GET['p']);
        }

        if (gettype($id_peticao) != 'string') {
            Store::redirect('inicio', true);
            return;
        }
        //carregar os dados da encomenda selecionada
        $ADMIN = new Administrador();
        $premio = $ADMIN->buscar_detalhes_premios($id_peticao);

        //apresentar os dados forma a poder ver os detalhes e alterar o status
        $data  = $premio;

        Store::Layout_admin([
            'admin/Layouts/html_header',
            'admin/Layouts/header',
            'admin/premios_detalhe',
            'admin/Layouts/footer',
            'admin/Layouts/html_footer',
        ], $data);
    }

    //====================================
    public function encomenda_alterar_estado()
    {

        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }

        //buscar o id_encomenda
        $id_encomenda = null;
        if (isset($_GET['e'])) {
            $id_encomenda = Store::aesDesencriptar($_GET['e']);
        }

        if (gettype($id_encomenda) != 'string') {
            Store::redirect('inicio', true);
            return;
        }

        // buscar o novo estado
        $estado = null;

        if (isset($_GET['s'])) {
            $estado = $_GET['s'];
        }

        if (!in_array($estado, STATUS)) {
            Store::redirect('inicio', true);
            return;
        }

        // regras de negocio para gerir a encomenda (novo estado)

        // atualizar o estado da encomenda na base da dados
        $ADMIN = new Administrador();
        $ADMIN->atualizar_status_encomenda($id_encomenda, $estado);
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

        /*// executar operações basadas no novo estado 
        switch ($estado) {
            case 'PENDENTE':
                // nao existem ações
                break;
            case 'EM PROCESSAMENTO':
                // nao existem ações
                break;

            case 'ENVIADA':
                $this->operacao_enviar_email_encomenda_enviada($id_encomenda);
                break;

            case 'CANCELADA':

                break;      
                
            case 'CONCLUIDA':


                break;
            default:
                # code...
                break;
        }*/

        // redireciona para a pagina da propria encomenda
        Store::redirect('detalhe_encomenda&e=' . $_GET['e'], true);
    }

    //====================================
    public function premio_alterar_estado()
    {

        //Verificar se existe um utilizador logado
        if (!Store::adminLogado()) {
            Store::redirect('inicio', true);
            return;
        }


        //buscar o id_encomenda
        $id_peticao = null;
        if (isset($_GET['p'])) {
            $id_peticao = Store::aesDesencriptar($_GET['p']);
        }


        if (gettype($id_peticao) != 'string') {
            Store::redirect('inicio', true);
            return;
        }

        // buscar o novo estado
        $estado = null;

        if (isset($_GET['s'])) {
            $estado = $_GET['s'];
        }

        if (!in_array($estado, STATUS_PREMIO)) {
            Store::redirect('inicio', true);
            return;
        }

        // regras de negocio para gerir a encomenda (novo estado)

        // atualizar o estado da encomenda na base da dados
        $ADMIN = new Administrador();
        $ADMIN->atualizar_status_premio($id_peticao, $estado);
        $bd = new Database();

        $parametros = [
            ':id_peticao' => $id_peticao
        ];

        $id_cliente = $bd->select("SELECT id_cliente
            FROM premios_register
            WHERE id_peticao = :id_peticao
        ", $parametros);


        $cliente = new Clientes();
        $cliente->pontos_cliente($id_cliente[0]->id_cliente);

        /*// executar operações basadas no novo estado 
        switch ($estado) {
            case 'PENDENTE':
                // nao existem ações
                break;
            case 'EM PROCESSAMENTO':
                // nao existem ações
                break;

            case 'ENVIADA':
                $this->operacao_enviar_email_encomenda_enviada($id_encomenda);
                break;

            case 'CANCELADA':

                break;      
                
            case 'CONCLUIDA':


                break;
            default:
                # code...
                break;
        }*/

        // redireciona para a pagina da propria encomenda
        Store::redirect('detalhe_premio&e=' . $_GET['p'], true);
    }

    // ===================================================
    // Operações apos mudança de estado
    // ===================================================

    public function operacao_notificar_cliente_mudanca_estado($id_encomenda)
    {

        // vai enviar um email para o cliente indicando que a encomenda sufreu alterações

    }


    private function operacao_enviar_email_encomenda_enviada($id_encomenda)
    {

        // Executar as operações para enviar email ao cliente.

    }
}
