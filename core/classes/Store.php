<?php

namespace core\classes;

use Exception;
use JetBrains\PhpStorm\ExpectedValues;

class Store{
    // ================================
    public static function Layout($estruturas, $dados = null){
        // verifica se estruturas é um array
        if(!is_array($estruturas)){
            throw new Exception("Coleção de estruturas inválida");
        }
        // variáveis
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }

        // apresentar as views da aplicação
        foreach($estruturas as $estrutura){
            include("../core/views/$estrutura.php");
        }

    }

    // ================================
    public static function Layout_admin($estruturas, $dados = null){
        // verifica se estruturas é um array
        if(!is_array($estruturas)){
            throw new Exception("Coleção de estruturas inválida");
        }
        // variáveis
        if(!empty($dados) && is_array($dados)){
            extract($dados);
        }


        // apresentar as views da aplicação
        foreach($estruturas as $estrutura){
            include("../../core/views/$estrutura.php");
        }

    }
    
    // ================================
    public static function Layout_vendedor($estruturas, $dados = null)
    {
        // verifica se estruturas é um array
        if (!is_array($estruturas)) {
            throw new Exception("Coleção de estruturas inválida");
        }
        // variáveis
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }


        // apresentar as views da aplicação
        foreach ($estruturas as $estrutura) {
            include("../../core/views/$estrutura.php");
        }
    }


    //===================================
    public static function clientelogado(){
        //verifica se existe um cliente com sessao
        return isset($_SESSION['cliente']);
    }

    //===================================
    public static function adminLogado(){
        //verifica se existe um admin com sessao
        return isset($_SESSION['admin']);
    }
    
    //===================================
    public static function vendedorLogado()
    {
        //verifica se existe um admin com sessao
        return isset($_SESSION['vendedor']);
    }

    //======================================

    public static function criarHash($num_caracteres = 12){

        //criar bases
        $chars= '01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0 ,  $num_caracteres);
    }

    //======================================
    public static function redirect($rota = '', $admin = false){

        // faz o redirecionamento para a URL desejada (rota)
        if(!$admin){
            header("Location: ".BASE_URL."?a=$rota");
        }else{
            header("Location: ".BASE_URL."/admin?a=$rota"); 
        }
    }
    
    //======================================
    public static function redirect_vendedor($rota = '')
    {
        header("Location: " . BASE_URL . "/vendedor?a=$rota");
    }

    //======================================
    public static function gerarCodigoEncomenda(){
        // gerar um codigo de encomenda
        $codigo = "";
        // A - Z
        // 100000 999999
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codigo .= substr(str_shuffle($chars),0,2);
        $codigo .= rand(100000, 999999);
        return $codigo;
    }

    //======================================
    //Encriptação
    //======================================
    public static function aesEncriptar($valor){
        return bin2hex(openssl_encrypt($valor, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    //======================================
    public static function aesDesencriptar($valor){
        return openssl_decrypt(hex2bin($valor), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
    }


    //======================================
    public static function printData($data, $die = true){

        if(is_array($data) || is_object($data)){
            echo '<pre>';
            print_r($data);
        }else{
            echo '<pre>';
            echo $data;
        }
        if($die){
            die('<br>TERMINADO');
        }
    }
}
