<?php

use core\classes\Store;

?>
<div class="container-fluid espaco_fundo fade_in_effect hide">


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 35pt;">Descrição do prêmio:</h3>
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
                <td><img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_ID"></td>
                <td><?= $premio->descricao ?></td>
                <td class="texto_pontos p-5 letra" style="font-size: 45pt; position:relative; top:10px;">Sorteio!!</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <div class="p-2 badge bg-warning text-dark" id="boton_1"><a class="link" style="color: black;" href="?a=sorteios">Voltar</a></div>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>


<!-- CELULAR/////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 35pt; padding-top: 30px;">Descrição do prêmio:</h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center letra gold_text"></h1>
        </thead>

        <tbody class="text-center">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="4"><img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_ID"></td>
            </tr>
            <tr>
                <td colspan="4" style="font-size: 20pt;"><?= $premio->descricao ?></td>
            </tr>
            <tr>
                <td class="texto_pontos p-5 letra" colspan="4" style="font-size: 35pt;">Sorteio!!</td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <div class="p-2 badge bg-warning text-dark" id="boton_1"><a class="link" style="color: black;" href="?a=sorteios">Voltar</a></div>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>

<!-- CELULAR/////////////////////////////////-->