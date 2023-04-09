<?php 


namespace core\classes; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{
    

    // ================================================
    public function enviar_email_confirmacao_novo_cliente($email_cliente, $purl){


        // Envia um email para o novo cliente, para confirmar um email.
        
        // constroi o purl (link para validação do email)
        $link = BASE_URL.'?a=confirmar_email&purl='.$purl;

        $mail = new PHPMailer(true);

        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';

            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient

            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Confirmação de email.';
            // mensagem
            $html = '<p>Seja bem-vindo à nossa loja ' . APP_NAME . '.</p>';
            $html .= '<p>Para poder concluir seu cadastro, precisa confirmar seu email.</p>';
            $html .= '<p>Para confirmar o email, click no link abaixo</p>';
            $html .= '<p><a href="'.$link.'">Confirmar seu e-mail</a></p>';
            $html .= '<p><i><small>'.APP_NAME.'</small></i></p>';
            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // ================================================
    public function enviar_email_confirmacao_encomenda($email_cliente, $dados_encomenda){

    
        $mail = new PHPMailer(true);
  
        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';
    
            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient
    
            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Confirmação da compra - '.$dados_encomenda['dados_pagamento']['codigo_encomenda'];
            // mensagem
            $html = '<p>Este email serve para confirmar a sua encomenda</p>';
            $html .= '<p>Dados da encomenda:</p>';
            
            // lista dos produtos
            $html .= '<ul>';
            foreach($dados_encomenda['lista_produtos'] as $produto){
                $html .= "<li>$produto</li>";
            }
            $html .= '</ul>';
            
            // total
            $html .= '<hr>';
            $html .= '<p>DADOS DE PAGAMENTO: </p>';
            $html .= '<p>Pontos da encomenda: <strong>'.$dados_encomenda['pontos'].'</strong></p>';
            $html .= '<p>Código da encomenda: <strong>'.$dados_encomenda['codigo_encomenda'].'</strong></p>';
            $html .= '<p>Valor a pagar (+Envio): <strong>'.$dados_encomenda['total_com_envio'].'</strong></p>';
            $html .= '<hr>';

            // nota importante
            $html .= '<p>NOTA: Em breve nos comunicaremos via WhatsApp para continuar o processo de sua encomenda.</p>';
            $html .= '<p>Cualquier duvida consulte a nosso whatsapp de atendimento direto, <a href="https://wa.me/message/ZAS5UNZSSMUJL1">Fale com nosso</a></p>';

            $mail->Body = $html;
    

            $mail->send();
            return true;
    } catch (Exception $e) {
            return false;
    }   
    }

     // ================================================
     public function enviar_email_confirmacao_encomenda_agendada($email_cliente, $dados_encomenda){

    
        $mail = new PHPMailer(true);
  
        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';
    
            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient
    
            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Compra agendada com Sucesso! - '.$dados_encomenda['dados_pagamento']['codigo_encomenda'];
            // mensagem
            $html = '<p>Este email serve para confirmar a sua encomenda agendada</p>';
            $html .= '<p>Dados da encomenda:</p>';
            
            // lista dos produtos
            $html .= '<ul>';
            foreach($dados_encomenda['lista_produtos'] as $produto){
                $html .= "<li>$produto</li>";
            }
            $html .= '</ul>';
            
            // total
            $html .= '<hr>';
            $html .= '<p>DADOS DE PAGAMENTO: </p>';
            $html .= '<p>Pontos da encomenda: <strong>'.$dados_encomenda['pontos'].'</strong></p>';
            $html .= '<p>Código da encomenda: <strong>'.$dados_encomenda['codigo_encomenda'].'</strong></p>';
            $html .= '<p>Valor a pagar (+Envio): <strong>'.$dados_encomenda['total_com_envio'].'</strong></p>';
            $html .= '<hr>';
            // nota importante
            $html .= '<p>NOTA: A sua encomenda só será processada após horario da apertura da nossa loja.</p>';
            $html .= '<p>Cualquier duvida consulte a nosso whatsapp de atendimento direto, <a href="https://wa.me/message/ZAS5UNZSSMUJL1">Fale com nosso</a></p>';

            $mail->Body = $html;
    

            $mail->send();
            return true;
    } catch (Exception $e) {
            return false;
    }   
    }


    //===============================================================
    public function enviar_email_recuperacao($email_cliente, $id_cliente){

        // Envia um email para o novo cliente, para confirmar um email.
        
        // constroi o purl (link para validação do email)
        $link = BASE_URL.'?a=recuperacao_email_confirmar&user='.$id_cliente;

        $mail = new PHPMailer(true);

        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';

            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient

            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Recuperação de senha.';
            // mensagem
            $html = '<p>Recuperação de senha -' . APP_NAME . '.</p>';
            $html .= '<p>Para reiniciar sua senha, porfavor faz click no link abaixo</p>';
            $html .= '<p><a href="'.$link.'">Reiniciar senha</a></p>';
            $html .= '<p><i><small>'.APP_NAME.'</small></i></p>';
            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false; // trocar para false para funcionalidade real
        }
    }

    // ================================================
    public function enviar_email_confirmacao_premio($email_cliente, $dados_premio){

    
        $mail = new PHPMailer(true);
  
        try {
            // opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_SMTP;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->CharSet    = 'UTF-8';
    
            //Emisor e recetor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     //Add a recipient
    
            // assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - ' . 'Confirmação do premio! - '.$dados_premio['produto'];
            // mensagem
            $html = '<p>Este email serve para confirmar seu premio reclamado</p>';
            $html .= '<p>Dados do premio:</p>';
            
            // lista dos produtos
            $html .= '<br>';
            $html .= $dados_premio['decricao'];
            $html .= '<br>';
            
            // total
            $html .= '<p>Total: <strong>'.$dados_premio['coste'].'</strong></p>';

            // dados de pagamento
            $html .= '<hr>';
            $html .= '<p>Código do premio: <strong>'.$dados_premio['codigo'].'</strong></p>';
            $html .= '<hr>';

            // nota importante
            $html .= '<p>NOTA: Deverá apresentar o codigo do premio para sua aquisição.</p>';

            $mail->Body = $html;
    

            $mail->send();
            return true;
    } catch (Exception $e) {
            return false; //modificar para false
    }   
    }

    
}