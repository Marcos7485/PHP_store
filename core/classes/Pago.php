<?php

namespace core\classes;

class Pago{

    public function cobrar($valor, $currency, $order_id, $card_number, $card_holder_name, $card_expiration_month, $card_expiration_year, $card_security_code){

        // datos de autenticación
        $clientId = CLIENT_GETNET_ID;
        $clientSecret = CLIENT_SECRET_ID;
        $env = "produccion"; // o "homologacion" para pruebas

        /* 
        // datos de la transacción
        $valor = 1000; // en centavos
        $currency = "BRL";
        $order_id = "orden_123"; // identificador único de la orden
        $card_number = "5155901222280001";
        $card_holder_name = "NOMBRE DEL TITULAR DE LA TARJETA";
        $card_expiration_month = "12";
        $card_expiration_year = "25";
        $card_security_code = "123";

        */

        // datos de la tarjeta
        $card_data = array(
            "number" => $card_number,
            "holder_name" => $card_holder_name,
            "expiration_month" => $card_expiration_month,
            "expiration_year" => $card_expiration_year,
            "security_code" => $card_security_code
        );

        // datos de la transacción
        $data = array(
            "seller_id" => $clientId,
            "amount" => $valor,
            "currency" => $currency,
            "order" => array(
                "order_id" => $order_id
            ),
            "customer" => array(),
            "payment" => array(
                "credit" => array(
                    "delayed" => false,
                    "save_card_data" => false,
                    "transaction_type" => "FULL",
                    "number_of_installments" => 1,
                    "card" => $card_data
                )
            )
        );

        // construye la solicitud HTTP
        $url = "https://api.getnet.com.br/v1/payments/credit";
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Basic " . base64_encode($clientId . ":" . $clientSecret)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // realiza la solicitud y captura la respuesta
        $response = curl_exec($ch);
        curl_close($ch);

        // analiza la respuesta
        $result = json_decode($response, true);
        if ($result["status"] == "APPROVED") {
            // transacción aprobada, haz algo aquí
        } else {
            // transacción rechazada, haz algo aquí
        }
    }
}
