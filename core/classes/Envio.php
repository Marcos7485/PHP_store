<?php

namespace core\classes;

class Envio
{

    private function cep_info($cep)
    {

        // URL del servicio que consultaremos
        $url = "https://viacep.com.br/ws/$cep/json/";

        // Inicializar cURL
        $curl = curl_init($url);

        // Configurar opciones de cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Ejecutar la consulta a la API
        $response = curl_exec($curl);


        // Verificar si ocurrió algún error
        if (curl_errno($curl)) {
            echo "Error: " . curl_error($curl);
        } else {
            // Decodificar la respuesta JSON
            $data = json_decode($response, true);
            $endereco = "";
            $endereco .= $data['logradouro'];
            $endereco .= " ";
            $endereco .= $data['bairro'];
            $endereco .= " - ";
            $endereco .= $data['localidade'];
            return $endereco;
        }

        // Cerrar la conexión cURL
        curl_close($curl);
    }

    private function geocode($address)
    {

        $apiKey = API_OC_KEY;
        $url = "https://api.opencagedata.com/geocode/v1/json?q=" . urlencode($address) . "&key={$apiKey}&pretty=1";
        $response = json_decode(file_get_contents($url), true);
        return $response['results'][0]['geometry'];
    }

    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1;
        return round($miles * 1.609344, 2);
    }

    public function calcular_envio_J($cep)
    {

        if ($cep != 'procura_no_local') {
            $destination = $this->cep_info($cep);

            $origin = [
                'lat' => LOJA_JURERE_COO_LAT,
                'lng' => LOJA_JURERE_COO_LNG
            ];

            $origin_centro = [
                'lat' => LOJA_CENTRO_COO_LAT,
                'lng' => LOJA_CENTRO_COO_LNG
            ];

            $originCoords = $origin;
            $originCoords_centro = $origin_centro;
            $destinationCoords = $this->geocode($destination);

            $distance = $this->distance($originCoords['lat'], $originCoords['lng'], $destinationCoords['lat'], $destinationCoords['lng']);
            $distance_centro = $this->distance($originCoords_centro['lat'], $originCoords_centro['lng'], $destinationCoords['lat'], $destinationCoords['lng']);

            // return o resultado que de menor distancia ja seia na loja de jurere ou centro.
            if ($distance <= $distance_centro) {
                return $distance;
            } elseif ($distance > $distance_centro) {
                return $distance_centro;
            } else {
                echo "Erro";
            }
        } else {
            return 0;
        }
    }

    public function calcular_coste($distance)
    {
        $coste = 0;
        if($distance == 0){
            $coste = 0;
        }elseif ($distance <= 2) {
            $coste = 6;
        } elseif ($distance <= 3) {
            $coste = 9;
        } elseif ($distance <= 6) {
            $coste = 18;
        } elseif ($distance <= 12) {
            $coste = 22;
        } elseif ($distance <= 20) {
            $coste = 26;
        } else {
            $coste = 'Nos contactaremos em breve para esclarecer o envio';
        }
        return $coste;
    }
}
