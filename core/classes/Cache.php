<?php

namespace core\classes;


class Cache
{

    public function guardar($id_cliente, $info)
    {

        $directorio_cache = "cache";
        if (!file_exists($directorio_cache)) {
            mkdir($directorio_cache);
        }

        $archivo_cache = "cache/info_$id_cliente.txt";

        file_put_contents($archivo_cache, serialize($info));
    }

    // =========================================================
    public function cargar($id_cliente)
    {
        $directorio_cache = "cache";
        $archivo_cache = "cache/info_$id_cliente.txt";

        if (!file_exists($directorio_cache) && !file_exists($archivo_cache)) {
            die('ERRO NAO EXISTE ARCHIVO DESSE CLIENTE');
        }

        // Si el archivo de caché existe y es reciente, obtener las encomiendas de él
        if (file_exists($archivo_cache) && (time() - filemtime($archivo_cache)) < 3600) {
            $resultado = file_get_contents($archivo_cache);
        }else{
            echo "A INFORMAÇÂO EXPIROU";
        }

        $info = unserialize($resultado);

        return $info;
    }


}
