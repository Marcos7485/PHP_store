<?php

use core\classes\Store;

?>
<div class="container-fluid espaco_fundo fade_in_effect hide">


    <div class="row">
        <div class="col text-center letra gold_text mt-3">
            <h3 style="font-size: 35pt;"><?= $produto->nome_produto ?></h3>
        </div>
    </div>

    <table class="table gold_text">
        <thead>
            <h1 class="col text-center letra gold_text"></h1>
        </thead>

        <tbody>
            <tr class="letra" style="font-size: 35pt;">
                <td></td>
                <td>Informações</td>
                <td>Preço</td>
                <td>Pontos</td>
            </tr>
            <tr>
                <td><img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid produto_imag_det"></td>
                <td><?= $produto->descricao ?></td>
                <td class="p-5 letra" style="font-size: 35pt; position:relative; top:100px;">R$<?= $produto->preco ?></td>
                <td class="p-5 letra texto_pontos" style="font-size: 40pt; position:relative; top:100px;"><?= $produto->pontos ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">

        <div class="col-12 text-center">
            <a class="link" style="color: black;" href="?a=loja">
                <div class="p-2 badge bg-warning text-dark" id="boton_1">Voltar</div>
            </a>
        </div>

    </div>
    <div class="col-12 text-center mt-5">
        <?php if ($produto->stock > 0) : ?>
            <button class="btn btn-luciana btn-sm adic_carrinho p-1" style="width: 180px;" onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><i class="fas fa-shopping-cart me-2"></i>Adicionar ao carrinho</button>
            <p></p>
            <button class="btn btn-warning btn-sm adic_carrinho p-1" onclick="adicionar_carrinho_presente(<?= $produto->id_produto ?>)"><i class="fa-solid fa-gift"></i>Adicionar embalagem presente</button>
        <?php else : ?>
            <button class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart me-2"></i>Promo indisponivel</button>
        <?php endif; ?>
    </div>
</div>

<!-- CELULAR ///////////////////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">


    <div class="row" style="padding-top: 30px;">
        <div class="col text-center letra gold_text mt-5">
            <h3 style="font-size: 25pt;"><?= $produto->nome_produto ?></h3>
        </div>
    </div>

    <table class="table gold_text text-center">
        <thead>
            <h1 class="col text-center letra gold_text"></h1>
        </thead>
        <tbody>
            <tr class="letra" style="font-size: 35pt;">
                <td><img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid produto_imag_det"></td>
            </tr>
            <tr>
                <td><?= $produto->descricao ?></td>
            </tr>
            <tr>
                <td class="p-5 letra" style="font-size: 35pt;">R$<?= $produto->preco ?></td>
            </tr>
            <tr>
                <td class="p-5 letra texto_pontos" style="font-size: 40pt;">Pontos: <?= $produto->pontos ?></td>
            </tr>
        </tbody>
    </table>

    <div class="row">

        <div class="col-12 text-center">
            <a class="link" style="color: black;" href="?a=loja">
                <div class="p-2 badge bg-warning text-dark" id="boton_1">Voltar</div>
            </a>
        </div>

    </div>
    <div class="col-12 text-center mt-5">
        <?php if ($produto->stock > 0) : ?>
            <button class="btn btn-luciana btn-sm adic_carrinho p-1" style="width: 180px;" onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><i class="fas fa-shopping-cart me-2"></i>Adicionar ao carrinho</button>
            <p></p>
            <button class="btn btn-warning btn-sm adic_carrinho p-1" onclick="adicionar_carrinho_presente(<?= $produto->id_produto ?>)"><i class="fa-solid fa-gift"></i>Adicionar embalagem presente</button>
        <?php else : ?>
            <button class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart me-2"></i>Promo indisponivel</button>
        <?php endif; ?>
    </div>
</div>


<!--////////////////////////////////////////////////////////-->

<link rel="stylesheet" href="assets/css/toastr.min.css">
<script src="assets/js/jquery-1.9.1.js"></script>
<script src="assets/js/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.adic_carrinho').click(function() {
            toastr.success("Agregado ao carrinho!");
        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "5",
            "hideDuration": "1",
            "timeOut": "1200",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });
</script>