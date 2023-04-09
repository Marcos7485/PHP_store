<?php

use core\classes\Store;
// calcula o numero de produtos no carrinho
$total_produtos = 0;
if (isset($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $quantidade) {
        $total_produtos += $quantidade;
    }
}
?>

<div class="container-fluid fixed-top navegacao">
    <div class="row textos">
        <div class="col-1 p-3">
            <a href="?a=inicio"><img src="../public/assets/images/icons/Logo.jpg" class="logo"></a>
        </div>

        <!--Celular-->
        <div class="col-3 p-1 show">
            <a href="?a=inicio">
                <h3 class="titulo_header"><?= APP_NAME ?></h3>
            </a>
        </div>
        <div class="col-2 show">
            <img src="../public/assets//images/status/aberto.png" class="tam_status" id="placa_abert_cel" style="display: none;" onclick="horarios()">
            <img src="../public/assets//images/status/fechado.png" class="tam_status" id="placa_fech_cel" style="display: none;" onclick="horarios()">
        </div>


        <div class="col-3 p-1 show carrinho_cel">
            <a href="?a=carrinho"><i class="fa-solid fa-cart-shopping gold_text"></i></a>
            <span class="badge bg-warning"><?= $total_produtos == 0 ? '' : $total_produtos ?></span>
        </div>
        <!--////////////////////////////////////-->


        <!--Only Web-->
        <div class="col-5 p-2 hide">
            <a href="?a=inicio">
                <h3 class="titulo_header" style="padding-top: 10px;"><?= APP_NAME ?></h3>
            </a>
        </div>

        <div class="col-1 hide">
            <img src="../public/assets//images//status/aberto.png" class="tam_status" id="placa_abert" style="display: none;" onclick="horarios()">
            <img src="../public/assets//images//status//fechado.png" class="tam_status" id="placa_fech" style="display: none;" onclick="horarios()">
        </div>

        <div class="col-5 text-end p-3 gold_text mt-2 hide">
            <a href="https://www.instagram.com/llicorellapriorato/" target="blank"><img src="../public/assets/images/icons/InstaIcon.png" class="InstaIcon"></a>
            <a href="?a=inicio" class="nav-item">Inicio</a>
            <a href="?a=loja" class="nav-item">Loja</a>
            <a href="?a=loja_premios" class="nav-item">Premios</a>

            <!-- Verifica se existe cliente na sessao -->
            <?php if (Store::clientelogado()) : ?>
                <a href="?a=perfil" style="text-decoration: none; color: brown;"><i class="fas fa-user gold_text"></i><?= $_SESSION['nome cliente'] ?></a>
                <div class="p-2 badge bg-warning text-dark" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i></div>
            <?php else : ?>

                <a href="?a=login" class="nav-item">Login</a>
                <a href="?a=novo_cliente" class="nav-item">Criar conta</a>

            <?php endif; ?>
            <a href="?a=carrinho"><i class="fa-solid fa-cart-shopping gold_text"></i></a>
            <span class="badge bg-warning" id="carrinho"><?= $total_produtos == 0 ? '' : $total_produtos ?></span>
        </div>
        <!--Only Web//////////////////////////////////////////////-->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header letra" style="background-color: black;">
                <h1 class="modal-title fs-7" style="color: goldenrod;" id="exampleModalLabel">Fazer Logout?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <img src="../public/assets/images/icons/Logo.jpg" width="150px" style="border-radius: 50%;">
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=logout" style="text-decoration: none; color:antiquewhite;">Logout</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="horarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: black; color: goldenrod;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Horarios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black; font-size: 15pt;">
                <table class="table table-bordered" style="color: goldenrod;">
                    <tbody>
                        <tr>
                            <td>Terça à Domingo</td>
                            <td>12:00 AM à<br>20:00 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success text-center" data-bs-dismiss="modal"> Ok!</button>
            </div>
        </div>
    </div>
</div>


<script>
    function horarios() {
        var modalStatus = new bootstrap.Modal(document.getElementById('horarios'));
        modalStatus.show();
    }

    function logout() {
        var modalStatus = new bootstrap.Modal(document.getElementById('logoutModal'));
        modalStatus.show();
    }
</script>