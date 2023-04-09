<?php

use core\classes\Store;
?>
<div class="container-fluid espaco_fundo fade_in_effect hide">

    <div class="row">
        <div class="col">
            <p class="texto_pontos letra" style="font-size: 30pt;">Seus pontos: <?= ($cliente->pontos_cliente - $cliente->pontos_usados) ?></p>
        </div>
    </div>


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 35pt;">Confirmação da adquisição do premio:</h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center letra gold_text"><?= $premio->nome_premio ?></h1>
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
                <td colspan="2"><?= $premio->descricao ?></td>
                <td class="texto_pontos p-5 letra" style="font-size: 45pt; position:relative; top:10px;"><?= $premio->preco ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <div class="p-2 badge bg-warning text-dark" id="boton_1" onclick="adq_premio()"><i class="fa-regular fa-star"></i>Adquirir premio!</div>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>
<!--///////////////////CELULAR/////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">

    <div class="row">
        <div class="col">
            <p class="texto_pontos text-center letra" style="font-size: 30pt; padding-top: 40px;">Seus pontos: <?= ($cliente->pontos_cliente - $cliente->pontos_usados) ?></p>
        </div>
    </div>


    <div class="row">
        <div class="col text-center letra gold_text">
            <h3 style="font-size: 35pt;">Confirmação da adquisição do premio:</h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center gold_text" style="font-style: oblique; padding-top: 20px"><?= $premio->nome_premio ?></h1>
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
                <td colspan="4"><?= $premio->descricao ?></td>
            </tr>
            <tr>
                <td colspan="4" class="texto_pontos p-5 letra" style="font-size: 45pt; position:relative; top:10px;"><?= $premio->preco ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-4 text-center">
            <div class="p-2 badge bg-warning text-dark" id="boton_1" onclick="adq_premio()"><i class="fa-regular fa-star"></i>Adquirir premio!</div>
        </div>
        <div class="col-4 text-center">

        </div>
    </div>
</div>


<!--//////////////////////////////////////////////////////////-->



<!-- Modal -->
<div class="modal fade" id="adq_premio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header letra" style="background-color:black; color:goldenrod;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Tem certeza?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <h1 class="modal-title fs-7" style="font-style: oblique; color:goldenrod;" id="exampleModalLabel">Adquiriendo o premio nao tem devolução</h1>
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=adquirir_premio_confirmacao&id=<?= Store::aesEncriptar($premio->id_premio) ?>" style="text-decoration: none; color:antiquewhite;">O quero!</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function adq_premio() {
        var modalStatus = new bootstrap.Modal(document.getElementById('adq_premio'));
        modalStatus.show();
    }
</script>