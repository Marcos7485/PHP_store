<?php

namespace core\classes;


class horario
{

    public function aberto()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $current_time = date('H:i'); // Obtiene la hora actual del servidor en formato de 24 horas

        // Define los horarios de apertura y cierre de tu negocio
        $opening_time = '12:00';
        $closing_time = '20:00';

        // Compara la hora actual con los horarios de apertura y cierre
        if ($current_time >= $opening_time && $current_time < $closing_time && date('w') != 1) {
            // Si el negocio está abierto
            return 'true';
        } else {
            // Si el negocio está cerrado
            return 'false';

        }
    }
}
