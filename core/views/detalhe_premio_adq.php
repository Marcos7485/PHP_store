<?php

use core\classes\Store;

$total_pontos = $cliente->pontos_cliente - $cliente->pontos_usados;
?>
<div class="container-fluid espaco_fundo fade_in_effect hide">

    <div class="row">
        <div class="col">
            <p class="texto_pontos letra" style="font-size: 30pt;">Seus pontos: <?= $total_pontos ?></p>
        </div>
    </div>


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 35pt;">Detalhe do prêmio adquirido:</h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center letra gold_text"></h1>
        </thead>

        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag"></td>
                <td><?= $premio->descricao ?></td>
                <td class="p-5" style="font-size: 25pt; position:relative; top:30px;"><?= $codigo_premio ?></td>
                <td class="texto_pontos p-5 letra" style="font-size: 45pt; position:relative; top:10px;"><?= $premio->preco ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <a class="link" style="color: black;" href="?a=meus_pontos">
                <div class="p-2 badge bg-warning text-dark" id="boton_1">Voltar</div>
            </a>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>



<!-- CELULAR //////////////////////////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">

    <div class="row">
        <div class="col">
            <p class="texto_pontos letra" style="font-size: 25pt;">Seus pontos: <?= $total_pontos ?></p>
        </div>
    </div>


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 25pt;">Detalhe do prêmio adquirido:</h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center letra gold_text"></h1>
        </thead>

        <tbody>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td class="text-center"><img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag"></td>
            </tr>
            <tr>
                <td class="text-center" style="font-size: 16pt;"><?= $premio->descricao ?></td>
            </tr>
            <tr>
                <td class="p-5 text-center" style="font-size: 35pt;"><?= $codigo_premio ?></td>
            </tr>
            <tr>
                <td class="texto_pontos text-center p-5 letra" style="font-size: 35pt;"><?= $premio->preco ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <a class="link" style="color: black;" href="?a=meus_pontos">
                <div class="p-2 badge bg-warning text-dark" id="boton_1">Voltar</div>
            </a>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>

<!-- CELULAR //////////////////////////////////////////////////////-->