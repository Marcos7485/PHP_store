<?php


namespace core\controllers;

use core\classes\Consultas;
use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Envio;
use core\classes\Store;
use core\models\Clientes;
use core\models\Encomendas;
use core\models\Favorito;
use core\models\Premios;
use core\models\Produtos;
use core\models\Sorteios;
use core\models\Sugerencias;

use function PHPSTORM_META\type;

class Main
{
    // ===========================================
    public function index()
    {

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    // ===========================================
    public function loja()
    {
        // apresenta a página da loja

        // buscar a lista de produtos disponiveis
        $produtos = new Produtos();

        // analisa que categoria mostrar
        $c = 'todos';
        if (isset($_GET['c'])) {
            $c = $_GET['c'];
        }

        // buscar informação na base de dados
        $lista_produtos = $produtos->lista_produtos_disponiveis($c);
        $lista_categorias = $produtos->lista_categorias();
        $dados = [
            'produtos' => $lista_produtos,
            'categorias' => $lista_categorias
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function loja_premios()
    {
        // apresenta a página dos premios
        // verifica se já existe sessao
        if (Store::clientelogado()) {
            $this->loja_premios_cliente();
            return;
        }

        // buscar a lista de premios disponiveis
        $premios = new Premios();

        // analisa que categoria mostrar
        $c = 'todos';
        if (isset($_GET['c'])) {
            $c = $_GET['c'];
        }

        // buscar informação na base de dados
        $lista_premios = $premios->lista_premios_disponiveis($c);
        $lista_categorias = $premios->lista_categorias();
        $dados = [
            'premios' => $lista_premios,
            'categorias' => $lista_categorias
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja_premios',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }




    public function loja_premios_cliente()
    {
        // apresenta a página dos premios
        // verifica se já existe sessao
        if (!Store::clientelogado()) {
            $this->index();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $cliente = $bd->select('SELECT * FROM clientes WHERE id_cliente = :id_cliente', $parametros);


        // buscar a lista de premios disponiveis
        $premios = new Premios();

        // analisa que categoria mostrar
        $c = 'todos';
        if (isset($_GET['c'])) {
            $c = $_GET['c'];
        }

        $favorito = new Favorito();
        $info = $favorito->cargar_favorito($id_cliente);

        if (empty($info[0])) {
            $verif = $info;
        } else {
            $verif = $info[0]->id_premio;
        }
        // buscar informação na base de dados
        $lista_premios = $premios->lista_premios_disponiveis($c);
        $lista_categorias = $premios->lista_categorias();
        $dados = [
            'premios' => $lista_premios,
            'categorias' => $lista_categorias,
            'cliente' => $cliente[0],
            'favorito' => $verif
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja_premios_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }





    public function cestas()
    {

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja_cestas',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }




    public function novo_cliente()
    {

        // verifica se ja existe sessao aberta
        if (Store::clientelogado()) {
            $this->index();
            return;
        }

        // apresenta o layout para criar um novo utilizador
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }





    // ========================================
    public function criar_cliente()
    {



        // verifica se já existe sessao
        if (Store::clientelogado()) {
            $this->index();
            return;
        }

        // verifica se houve submissão de um formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // verifica se senha 1 = senha 2
        if ($_POST['text_senha_1'] != $_POST['text_senha_2']) {

            // as passwords são diferentes
            $_SESSION['erro'] = 'As senhas não são iguais.';
            $this->novo_cliente();
            return;
        }

        // verificadores de CEP/////////////////////////////////////////////////

        if (isset($_POST['text_cep'])) {
            
            // Correção limitador de distancia register/////////////////////////////////
            $envio = new Envio();
            $dist = $envio->calcular_envio_J($_POST['text_cep']);
    
            if($dist <= 20){
                $cep = $_POST['text_cep'];
            } else {
                $_SESSION['erro'] = 'O CEP ingresado excede a distância aceitada de Florianópolis';
                $errors[] = 'erro';
                $this->novo_cliente();
                return;
            }
            // Correção limitador de distancia register/////////////////////////////////

            // Verifica que el CEP tenga el formato correcto
            if (!preg_match('/^\d{5}-?\d{3}$/', $cep)) {
                $_SESSION['erro'] = 'O CEP ingresado no tiene el formato correcto. Por favor, ingrese um CEP válido.';
                $errors[] = 'erro';
                $this->novo_cliente();
                return;
            }
        } else {
            $_SESSION['erro'] = 'O campo do CEP é obligatorio. Por favor, ingrese um CEP válido.';
            $errors[] = 'erro';
            $this->novo_cliente();
            return;
        }

        if (empty($errors)) {
            $url = 'https://viacep.com.br/ws/' . urlencode($cep) . '/json/';
            $response = file_get_contents($url);

            // Decodifica la respuesta JSON en un arreglo asociativo de PHP
            $data = json_decode($response, true);

            // Verifica si la respuesta indica que el CEP es válido
            if (isset($data['erro'])) {
                $errors[] = 'O CEP ingresado no es válido. Por favor, ingrese um CEP válido.';
                $this->novo_cliente();
                return;
            } else {
                // El CEP es válido, puedes utilizar la información adicional obtenida de la API de ViaCEP
                $logradouro = $data['logradouro'];
                $bairro = $data['bairro'];
                $localidade = $data['localidade'];
                $uf = $data['uf'];
                // etc.
            }
        }

        // verificadores de CEP////////////////////////////////////////////////////

        // verifica na base de dados se existe cliente com mesmo email
        $cliente = new Clientes();
        if ($cliente->verificar_email_existe($_POST['text_email'])) {
            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->novo_cliente();
            return;
        }

        // inserir novo cliente na base de dados e devolver o purl.
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registrar_cliente();

        // Envio do email para o cliente
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);

        if ($resultado) {

            // apresenta o layout para informar o envio do email.
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            echo 'Aconteceu um erro';
        }
    }
    
     // ========================================
    public function criar_cliente_cel()
    {



        // verifica se já existe sessao
        if (Store::clientelogado()) {
            $this->index();
            return;
        }

        // verifica se houve submissão de um formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // verifica se senha 1 = senha 2
        if ($_POST['text_senha_1_cel'] != $_POST['text_senha_2_cel']) {

            // as passwords são diferentes
            $_SESSION['erro'] = 'As senhas não são iguais.';
            $this->novo_cliente();
            return;
        }

        // verificadores de CEP/////////////////////////////////////////////////

        if (isset($_POST['text_cep_cel'])) {
            
            // Correção limitador de distancia register/////////////////////////////////
            $envio = new Envio();
            $dist = $envio->calcular_envio_J($_POST['text_cep_cel']);
        
            if($dist <= 20){
                $cep = $_POST['text_cep_cel'];
            } else {
                $_SESSION['erro'] = 'O CEP ingresado excede a distância aceitada de Florianópolis';
                $errors[] = 'erro';
                $this->novo_cliente();
                return;
            }
            // Correção limitador de distancia register/////////////////////////////////

            // Verifica que el CEP tenga el formato correcto
            if (!preg_match('/^\d{5}-?\d{3}$/', $cep)) {
                $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                $errors[] = 'erro';
                $this->novo_cliente();
                return;
            }
        } else {
            $_SESSION['erro'] = 'O CEP é obrigatório. Por favor, ingrese um CEP válido.';
            $errors[] = 'erro';
            $this->novo_cliente();
            return;
        }

        if (empty($errors)) {
            $url = 'https://viacep.com.br/ws/' . urlencode($cep) . '/json/';
            $response = file_get_contents($url);

            // Decodifica la respuesta JSON en un arreglo asociativo de PHP
            $data = json_decode($response, true);

            // Verifica si la respuesta indica que el CEP es válido
            if (isset($data['erro'])) {
                $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                $this->novo_cliente();
                return;
            } else {
                // El CEP es válido, puedes utilizar la información adicional obtenida de la API de ViaCEP
                $logradouro = $data['logradouro'];
                $bairro = $data['bairro'];
                $localidade = $data['localidade'];
                $uf = $data['uf'];
                // etc.
            }
        }

        // verificadores de CEP////////////////////////////////////////////////////

        // verifica na base de dados se existe cliente com mesmo email
        $cliente = new Clientes();
        if ($cliente->verificar_email_existe($_POST['text_email_cel'])) {
            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->novo_cliente();
            return;
        }

        // inserir novo cliente na base de dados e devolver o purl.
        $email_cliente = strtolower(trim($_POST['text_email_cel']));
        $purl = $cliente->registrar_cliente_cel();

        // Envio do email para o cliente
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);

        if ($resultado) {

            // apresenta o layout para informar o envio do email.
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            echo 'Aconteceu um erro';
        }
    }

    public function confirmar_email()
    {

        // verifica se já existe sessao
        if (Store::clientelogado()) {
            $this->index();
            return;
        }

        // verificar se existe na query string um purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];
        // verifica se o purl é válido
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado = $cliente->validar_email($purl);

        if ($resultado) {

            // apresenta o layout para informar que a conta foi validada com sucesso.
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'conta_confirmada_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
            return;
        } else {
            //redirecionar para a pagina inicial
            Store::redirect();
        }
    }

    public function login()
    {


        //Verificar se ja existe um utilizador logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // apresentação do formulario login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===========================================
    public function login_submit()
    {

        //Verificar se ja existe um utilizador logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se foi efetuado o post do formulario login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }


        // validar se os campos vieram corretamente
        if (
            !isset($_POST['text_usuario']) ||
            !isset($_POST['text_senha'])  ||
            !filter_var(trim($_POST['text_usuario']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulario
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        // prepara os dados para o model
        $usuario = trim(strtolower($_POST['text_usuario']));
        $senha = trim($_POST['text_senha']);

        // carrega o model e verifica se login é
        $cliente = new Clientes();
        $resultado = $cliente->validar_login($usuario, $senha);

        // analisa o resultado
        if (is_bool($resultado)) {

            //login invalido
            $_SESSION['erro'] = 'login inválido';
            Store::redirect('login');
            return;
        } elseif ($resultado == 'validar') {
            $_SESSION['erro'] = 'Precisa validar seu e-mail para ingresar a sua conta';
            Store::redirect('login');
            return;
        } else {

            // login valido. Coloca os dados na sessao
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['usuario'] = $resultado->email;
            $_SESSION['nome cliente'] = $resultado->nome_completo;

            // redirecionar para o local correto
            if (isset($_SESSION['tmp_carrinho'])) {

                // remove a variavel temporaria da sessão
                unset($_SESSION['tmp_carrinho']);

                // redireciona para o resumo da encomenda
                Store::redirect('finalizar_encomenda_resumo');
            } else {

                // redirecionamento para a loja
                Store::redirect('inicio');
            }
        }
    }

    public function logout()
    {

        // remove as variáves da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome cliente']);

        // redireciona para o inicio da loja 
        Store::redirect();
    }

    //===============================================
    //Perfil usuario
    //===============================================
    public function perfil()
    {

        // verifica se ja existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // buscar informações do cliente
        $cliente = new Clientes();
        $dtemp = $cliente->buscar_dados_cliente($_SESSION['cliente']);

        $dados_cliente = [
            'Email' => $dtemp->email,
            'Nome  completo' => $dtemp->nome_completo,
            'CEP' => $dtemp->morada,
            'Cidade' => $dtemp->cidade,
            'Telefone' => $dtemp->telefone,
            'Pontos' => $dtemp->pontos_cliente,
            'Intereses' => $dtemp->intereses
        ];

        $dados = [
            'dados_cliente' => $dados_cliente
        ];


        // apresentação da pagina de perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'perfil',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function config_perfil()
    {

        // verifica se ja existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // buscar informações do cliente
        $cliente = new Clientes();
        $dtemp = $cliente->buscar_dados_cliente($_SESSION['cliente']);

        $dados_cliente = [
            'Email' => $dtemp->email,
            'Nome  completo' => $dtemp->nome_completo,
            'CEP' => $dtemp->morada,
            'Cidade' => $dtemp->cidade,
            'Telefone' => $dtemp->telefone,
            'Pontos' => $dtemp->pontos_cliente,
            'Intereses' => $dtemp->intereses
        ];

        $dados = [
            'dados_cliente' => $dados_cliente
        ];


        // apresentação da pagina de perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao_config',
            'perfil',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //===============================================
    public function alterar_dados_pessoais()
    {

        // verifica se ja existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        //vai buscar os dados pessoais:
        $cliente = new Clientes();
        $dados = [
            'dados_pessoais' => $cliente->buscar_dados_cliente($_SESSION['cliente']),
        ];

        // apresentação da pagina de perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao_config',
            'alterar_dados_pessoais',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //===============================================
    public function alterar_dados_pessoais_submit()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // verificadores de CEP/////////////////////////////////////////////////

        if (isset($_POST['text_cep'])) {
            $cep = $_POST['text_cep'];

            // Verifica que el CEP tenga el formato correcto
            if (!preg_match('/^\d{5}-?\d{3}$/', $cep)) {
                $_SESSION['erro'] = 'O CEP ingresado não tem o formato correto. Por favor, ingrese um CEP válido.';
                $errors[] = 'erro';
                $this->alterar_dados_pessoais();
                return;
            }
        } else {
            $_SESSION['erro'] = 'O CEP é obligatório. Por favor, ingrese um CEP válido.';
            $errors[] = 'erro';
            $this->alterar_dados_pessoais();
            return;
        }

        if (empty($errors)) {
            $url = 'https://viacep.com.br/ws/' . urlencode($cep) . '/json/';
            $response = file_get_contents($url);

            // Decodifica la respuesta JSON en un arreglo asociativo de PHP
            $data = json_decode($response, true);

            // Verifica si la respuesta indica que el CEP es válido
            if (isset($data['erro'])) {
                $errors[] = 'O CEP ingresado não é válido. Por favor, ingrese um CEP válido.';
                $this->alterar_dados_pessoais();
                return;
            } else {
                // El CEP es válido, puedes utilizar la información adicional obtenida de la API de ViaCEP
                $logradouro = $data['logradouro'];
                $bairro = $data['bairro'];
                $localidade = $data['localidade'];
                $uf = $data['uf'];
                // etc.
            }
        }

        // verificadores de CEP////////////////////////////////////////////////////

        // validar os dados
        $nome_completo = trim($_POST['text_nome_completo']);
        $morada = trim($_POST['text_cep']);
        $cidade = trim($_POST['text_cidade']);
        $telefone = trim($_POST['text_telefone']);

        // validar os campos 
        if (empty($nome_completo) || empty($cidade) || empty($telefone)) {
            $_SESSION['erro'] = "Precisa-se preencher corretamente os campos";
            $this->alterar_dados_pessoais();
            return;
        }

        // validar se este email ja existe noutra conta do cliente
        $cliente = new Clientes();

        // atualizar os dados do cliente na base de dados
        $cliente->atualizar_dados_cliente($nome_completo, $morada, $cidade, $telefone);

        // atualizar os dados do cliente na sessão
        $_SESSION['usuario'] = $nome_completo;
        $_SESSION['nome cliente'] = $nome_completo;

        unset($_SESSION['envio']);
        unset($_SESSION['cep']);

        // redireciona pela pagina do perfil
        Store::redirect('perfil');
    }

    //==============================================
    public function recuperar_senha()
    {

        // verifica que nao deve ter um usuario logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // apresentação do formulario de recuperação de senha
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'recuperar_senha',
            'layouts/footer',
            'layouts/html_footer',
        ]);

        //link abre o panel onde desencriptando o link gera o codigo do usuario 
        //donde se modifica a senha do usuario desencriptado.

    }
    //===============================================
    public function recuperar_senha_submit()
    {

        // verifica que nao deve ter um usuario logado
        if (Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se houve submissão de um formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // verifica na base de dados se existe cliente com mesmo email
        $cliente = new Clientes();

        if ($cliente->verificar_email_existe($_POST['text_email_recup'])) {

            $bd = new Database();
            $parametros = [
                ':email' => $_POST['text_email_recup']
            ];

            $resultados = $bd->select("
            SELECT * FROM clientes 
            WHERE email = :email
            ", $parametros);
            // verifica se tem pedido vigente de recuperaçao/////////////
            $parametros = [
                ':id_cliente' => $resultados[0]->id_cliente
            ];

            $verificacao = $bd->select("SELECT * FROM recuperacao_senha
            WHERE id_cliente = :id_cliente
            ", $parametros);


            if (($verificacao != null)) {
                // apresentação do formulario de recuperação de senha
                Store::Layout([
                    'layouts/html_header',
                    'layouts/header',
                    'recuperar_senha_fail',
                    'layouts/footer',
                    'layouts/html_footer',
                ]);
                return;
            }

            // coloca a solicitaçao do cliente em vigencia///////////////

            $bd->insert("INSERT INTO recuperacao_senha VALUES(
                    0,
                    :id_cliente,
                    :id_cliente,
                    NOW(),
                    NULL
                )
            ", $parametros);

            ///////////////////////////////////////////////////////////
            $email_cliente = $resultados[0]->email;
            $id_cliente = Store::aesEncriptar($resultados[0]->id_cliente);
            // Envio do email para o cliente
            $email = new EnviarEmail();
            $recuperacao = $email->enviar_email_recuperacao($email_cliente, $id_cliente);

            if ($recuperacao) {
                // apresentação do formulario de recuperação de senha
                Store::Layout([
                    'layouts/html_header',
                    'layouts/header',
                    'recuperar_senha_sucesso',
                    'layouts/footer',
                    'layouts/html_footer',
                ]);
                return;
            } else {
                echo 'Aconteceu um erro';
            }
        } else {
            $_SESSION['erro'] = 'Não existe um cliente registrado com esse email.';
            Store::redirect('recuperar_senha');
            return;
        }
    }
    //==============================================
    public function recuperacao_email_confirmar()
    {
        // remove as variáves da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome cliente']);

        // verificar se existe na query string um user
        if (!isset($_GET['user'])) {
            $this->index();
            return;
        }

        // verifica se o codigo tem diferente de 32 carateres
        if (strlen($_GET['user']) != 32) {
            $this->index();
            return;
        }

        $user = $_GET['user'];
        $id_cliente = Store::aesDesencriptar($user);

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $bd = new Database();
        // verifica se o cliente solicitou a recuperaçao de senha, senao index.

        $verificacao = $bd->select("SELECT * FROM recuperacao_senha
            WHERE id_cliente = :id_cliente
        ", $parametros);

        if ($verificacao == null) {
            $this->index();
            return;
        }

        ///////////////////////////////////////////////////////////////////////


        $resultados = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);

        // verifica se o usuario esta en la base de dados
        if ($resultados != null) {
            $this->reiniciar_pas($resultados[0]->id_cliente);
            return;
        } else {
            $this->index();
            return;
        }
    }
    // ==========================================================
    public function reiniciar_pas($id_cliente)
    {
        // login valido. Coloca os dados na sessao
        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $bd = new Database();
        $resultados = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);

        $data = [
            'id_cliente' => $resultados[0]->id_cliente
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'reiniciar_senha',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    //================================================================

    public function reiniciar_senha_submit()
    {
        // remove as variáves da sessão
        unset($_SESSION['cliente']);
        unset($_SESSION['usuario']);
        unset($_SESSION['nome cliente']);

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        $user = $_GET['u'];
        $id_cliente = Store::aesDesencriptar($user);

        // validar os dados
        $nova_senha = trim($_POST['text_nova_senha_r']);
        $repetir_nova_senha = trim($_POST['text_repetir_nova_senha_r']);

        // validar se a nova senha vem com dados
        if (strlen($nova_senha) < 6) {
            $_SESSION['erro'] = 'A senha é muito curta (mínimo 6 caracteres).';
            $this->reiniciar_pas($id_cliente);
            return;
        }

        // verificar se a nova senha a sua repetição, coincidem
        if ($nova_senha != $repetir_nova_senha) {
            $_SESSION['erro'] = 'As senhas novas não são iguais.';
            $this->reiniciar_pas($id_cliente);
            return;
        }
        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $bd = new Database();

        //Desactiva a solicitação unica///////////////////////////////////////
        $bd->update("UPDATE recuperacao_senha
        SET
          id_cliente = null,
          deleted_at = NOW()
        WHERE id_cliente = :id_cliente
      ", $parametros);
        //////////////////////////////////////////////////////////////////////


        $cliente = new Clientes();

        // atualizar a nova senha
        $cliente->atualizar_nova_senha($id_cliente, $nova_senha);

        // redirecionar para pagina do perfil
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'senha_reiniciada',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    //===============================================
    public function alterar_password()
    {

        // verifica se ja existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // apresentação da pagina de alteração da senha
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao_config',
            'alterar_password',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    //===============================================
    public function alterar_password_submit()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        // validar os dados
        $senha_atual = trim($_POST['text_senha_atual']);
        $nova_senha = trim($_POST['text_nova_senha']);
        $repetir_nova_senha = trim($_POST['text_repetir_nova_senha']);

        // validar se a nova senha vem com dados
        if (strlen($nova_senha) < 6) {
            $_SESSION['erro'] = 'A senha é muito curta (mínimo 6 caracteres).';
            $this->alterar_password();
            return;
        }

        // verificar se a nova senha a sua repetição, coincidem
        if ($nova_senha != $repetir_nova_senha) {
            $_SESSION['erro'] = 'As senhas novas não são iguais.';
            $this->alterar_password();
            return;
        }

        // verificar se a senha atual esta correta
        $cliente = new Clientes();
        if (!$cliente->verifica_senha($_SESSION['cliente'], $senha_atual)) {
            $_SESSION['erro'] = 'A senha atual esta incorreta';
            $this->alterar_password();
            return;
        }

        // verificar se a nova senha é diferente a senha atual
        if ($senha_atual == $nova_senha) {
            $_SESSION['erro'] = 'A nova senha é igual à senha atual';
            $this->alterar_password();
            return;
        }

        // atualizar a nova senha
        $cliente->atualizar_nova_senha($_SESSION['cliente'], $nova_senha);

        // redirecionar para pagina do perfil
        Store::redirect('perfil');
    }

    //===============================================
    public function historico_encomendas()
    {

        // verifica se ja existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // carrega o historico das encomendas
        $encomendas = new Encomendas();


        $historico_encomendas = $encomendas->buscar_historico_encomendas($_SESSION['cliente']);

        $data = [
            'historico_encomendas' => $historico_encomendas
        ];


        /*
        apresentar uma tabela com as encomendas e o seu estado
        -> detalhes de cada encomenda
        */

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'historico_encomendas',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function detalhe_p_cliente()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }


        // verificar se veio indicado um id_premio (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        // verifica se o id_cliente é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $codigo_premio = Store::aesDesencriptar($_GET['id']);
            if (empty($id_cliente)) {
                Store::redirect();
                return;
            }
        }

        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $info_cliente = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);

        $parametros = [
            ':codigo_premio' => $codigo_premio
        ];

        $info_premio = $bd->select("SELECT * FROM premios_register WHERE codigo = :codigo_premio", $parametros);
        $id_premio_produto = $info_premio[0]->id_premio;

        $parametros = [
            ':id_premio' => $id_premio_produto
        ];
        $info_premio_produto = $bd->select("SELECT * FROM premios WHERE id_premio = :id_premio", $parametros);

        $info_premio = $info_premio_produto[0];
        $cliente = $info_cliente[0];


        $data = [
            'cliente' => $cliente,
            'codigo_premio' => $codigo_premio,
            'premio' => $info_premio
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'detalhe_premio_adq',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function detalhe_premio()
    {

        // verificar se veio indicado um id_premio (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }

        // verifica se o id_premio é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $codigo_premio = Store::aesDesencriptar($_GET['id']);
            if (empty($codigo_premio)) {
                Store::redirect();
                return;
            }
        }

        $bd = new Database();

        $parametros = [
            ':id_premio' => $codigo_premio
        ];

        $premio = $bd->select("SELECT * FROM premios WHERE id_premio = :id_premio", $parametros);

        $data = [
            'premio' => $premio[0]
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'detalhe_premio',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function detalhe_produto()
    {

        // verificar se veio indicado um id_premio (encriptado)
        if (!isset($_GET['id'])) {
            Store::redirect();
            return;
        }

        // verifica se o id_premio é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $codigo_produto = Store::aesDesencriptar($_GET['id']);
            if (empty($codigo_produto)) {
                Store::redirect();
                return;
            }
        }

        $bd = new Database();

        $parametros = [
            ':id_produto' => $codigo_produto
        ];

        $produto = $bd->select("SELECT * FROM produtos WHERE id_produto = :id_produto", $parametros);

        $data = [
            'produto' => $produto[0]
        ];

        if (Store::clientelogado()) {
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'perfil_navegacao',
                'detalhe_produto_loja',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        } else {
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'detalhe_produto_loja',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        }
    }

    //============================================
    public function historico_encomendas_detalhe()
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

        $id_encomenda = null;
        // verifica se o id_encomenda é uma string de 32 caracteres
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

        // verifica se a encomenda pertence a este cliente
        $encomendas = new Encomendas();
        $resultado = $encomendas->verificar_encomenda_cliente($_SESSION['cliente'], $id_encomenda);
        if (!$resultado) {
            Store::redirect();
            return;
        }
        // vamos buscar os dados de detalhe da encomenda
        $detalhe_encomenda = $encomendas->detalhes_de_encomenda($_SESSION['cliente'], $id_encomenda);

        // calcular o valor total da encomenda
        $total = 0;
        //$total_pontos = 0;
        foreach ($detalhe_encomenda['produtos_encomenda'] as $produto) {
            $total += ($produto->quantidade * $produto->preco_unidade);
        }

        $data = [
            'dados_encomenda' => $detalhe_encomenda['dados_encomenda'],
            'produtos_encomenda' => $detalhe_encomenda['produtos_encomenda'],
            'envio' => $detalhe_encomenda['dados_encomenda']->envio,
            'total_encomenda' => $total + $detalhe_encomenda['dados_encomenda']->envio
        ];

        // vamos apresentar a nova view com esses dados

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'encomenda_detalhe',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    /*
    public function pagamento(){
        $codigo_encomenda = '';
        if(!isset($_GET['cod'])){
            return;
        }else{
            $codigo_encomenda = $_GET['cod'];
        }

        // verificar se existe o codigo ativo (PENDENTE)

        $encomenda = new Encomendas();
        $resultado = $encomenda->efetuar_pagamento($codigo_encomenda);

    }*/
    //=============================================
    public function meus_pontos()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        $cliente = new Clientes();
        $info_cliente = $cliente->buscar_dados_cliente($id_cliente);

        $encomenda = new Encomendas();
        $info_encomendas = $encomenda->buscar_historico_encomendas_concluidas($id_cliente);

        $bd = new Database();
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
        $total_pontos = ($info_cliente->pontos_cliente - $info_cliente->pontos_usados);
        $premios = $bd->select("SELECT * FROM premios_register WHERE id_cliente = :id_cliente", $parametros);

        $favorito = new Favorito();
        $info = $favorito->cargar_favorito($id_cliente);


        if (empty($info[0])) {
            $verif = $info;
        } else {
            $verif = $info[0];
        }

        $data = [
            'total_pontos' => $total_pontos,
            'info_encomendas' => $info_encomendas,
            'premios' => $premios,
            'favorito' => $verif
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'pontos_panel',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function sorteios()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        $cliente = new Clientes();
        $info_cliente = $cliente->buscar_dados_cliente($id_cliente);
        $total_pontos = ($info_cliente->pontos_cliente - $info_cliente->pontos_usados);
        $premio = new Premios();
        $sorteio = $premio->buscar_premios_por_ids(3);

        $data = [
            'id_cliente' => $id_cliente,
            'total_pontos' => $total_pontos,
            'sorteio' => $sorteio[0]
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'sorteios',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function partecipar()
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

        $id_cliente = null;
        // verifica se o id_cliente é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $id_cliente = Store::aesDesencriptar($_GET['id']);
            if (empty($id_cliente)) {
                Store::redirect();
                return;
            }
        }

        $sorteio = new Sorteios();
        $cliente_sorteio = $sorteio->sorteio_ativo($id_cliente);


        if ($cliente_sorteio == false) {

            // verificar se veio indicado um id_encomenda (encriptado)
            if (!isset($_GET['e'])) {
                Store::redirect();
                return;
            }


            $id_premio = null;
            // verifica se o id_cliente é uma string de 32 caracteres
            if (strlen($_GET['e']) != 32) {
                Store::redirect();
                return;
            } else {
                $id_premio = Store::aesDesencriptar($_GET['e']);
                if (empty($id_premio)) {
                    Store::redirect();
                    return;
                }
            }

            $p = new Premios();

            $preco_premio = $p->preco_premio($id_premio);

            $s = new Sorteios();
            $s->inscribir($id_cliente, $id_premio, $preco_premio[0]->preco);

            Store::redirect('sorteios');
        }else{
            Store::redirect('sorteios');
        }
    }

    public function detalhe_sorteio()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];

        // verificar se veio indicado um id_encomenda (encriptado)
        if (!isset($_GET['e'])) {
            Store::redirect();
            return;
        }

        $id_premio = null;
        // verifica se o id_cliente é uma string de 32 caracteres
        if (strlen($_GET['e']) != 32) {
            Store::redirect();
            return;
        } else {
            $id_premio = Store::aesDesencriptar($_GET['e']);
            if (empty($id_premio)) {
                Store::redirect();
                return;
            }
        }

        $p = new Premios();

        $premio = $p->buscar_premios_por_ids($id_premio);

        $data = [
            'premio' => $premio[0]
        ];


        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'detalhe_sorteio',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function meu_aniversario()
    {
        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $cliente = new Clientes();
        $id_cliente = $_SESSION['cliente'];

        $aniversario = $cliente->obter_aniversario($id_cliente);

        $data = [
            'id_cliente' => $id_cliente
        ];

        if ($aniversario == '') {

            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'perfil_navegacao',
                'meu_aniversario_vazio',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        } else {

            $data = [
                'id_cliente' => $id_cliente,
                'aniversario' => $aniversario
            ];


            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'perfil_navegacao',
                'meu_aniversario',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        }
    }

    public function definir_aniversario()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        $aniversario = $_POST['fechaNacimento'];
        $id_cliente = $_SESSION['cliente'];

        $ano_aniv = '';
        $ano_aniv .= $aniversario[0];
        $ano_aniv .= $aniversario[1];
        $ano_aniv .= $aniversario[2];
        $ano_aniv .= $aniversario[3];


        $mes_aniv = '';
        $mes_aniv .= $aniversario[5];
        $mes_aniv .= $aniversario[6];

        $dia_aniv = '';
        $dia_aniv .= $aniversario[8];
        $dia_aniv .= $aniversario[9];

        $info = [
            'dia' => $dia_aniv,
            'mes' => $mes_aniv,
            'ano' => $ano_aniv
        ];

        $serialized = serialize($info);

        $cliente = new Clientes();

        $cliente->adicionar_aniversario($id_cliente, $serialized);

        $this->meu_aniversario();
    }

    public function meus_intereses()
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




        $id_cliente = null;
        // verifica se o id_cliente é uma string de 32 caracteres
        if (strlen($_GET['id']) != 32) {
            Store::redirect();
            return;
        } else {
            $id_cliente = Store::aesDesencriptar($_GET['id']);
            if (empty($id_cliente)) {
                Store::redirect();
                return;
            }
        }



        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

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


        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];

        $resultados = $bd->select("SELECT * FROM clientes WHERE id_cliente = :id_cliente", $parametros);

        $pontos_interes += $resultados[0]->pontos_cliente;

        // parametros
        $parametros = [
            ':id_cliente' => $id_cliente,
            ':intereses' => $interes,
            ':pontos_cliente' => $pontos_interes
        ];

        $bd->update("UPDATE clientes
            SET 
              intereses = :intereses,
              pontos_cliente = :pontos_cliente
            WHERE id_cliente = :id_cliente
          ", $parametros);

        Store::redirect('perfil');
    }

    public function parabens_premio_adq()
    {
        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        $bd = new Database();

        $parametros = [
            ':id_cliente' => $id_cliente
        ];


        $dados_cliente = $bd->select('SELECT * FROM clientes WHERE id_cliente = :id_cliente', $parametros);



        $dados = [
            'cliente' => $dados_cliente[0],
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'parabens_premio_adq',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    //============================================================
    public function sugerencia_add()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];

        $sugerencia = $_POST['sugerencia'];

        $model = new Sugerencias();

        $model->sugerencia_guardar($id_cliente, $sugerencia);

        Store::redirect('loja');
    }

    //============================================================
    public function sugerencia_add_perfil()
    {

        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        // verifica se existiu submissão de formulario
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];

        $sugerencia = $_POST['sugerencia'];

        $model = new Sugerencias();

        $model->sugerencia_guardar($id_cliente, $sugerencia);

        Store::redirect('minhas_sugerencias');
    }

    public function  minhas_sugerencias()
    {


        // verifica se existe um utilizador logado
        if (!Store::clientelogado()) {
            Store::redirect();
            return;
        }

        $id_cliente = $_SESSION['cliente'];
        $sugerencias = new Sugerencias();

        $dados = [
            'sugerencias' => $sugerencias->sugerencias_cargar($id_cliente)
        ];

        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'perfil_navegacao',
            'minhas_sugerencias',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    public function meu_favorito_add()
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
        // verifica se o id_cliente é uma string de 32 caracteres
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
        $favorito = new Favorito();


        $favorito->guardar_favorito($id_cliente, $id_premio);

        Store::redirect('meus_pontos');
    }
    
    public function contactos(){

    Store::Layout([
        'layouts/html_header',
        'layouts/header',
        'contactos',
        'layouts/footer',
        'layouts/html_footer',
    ]);

    }
}
