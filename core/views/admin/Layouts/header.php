<?php

use core\classes\Store;
?>

<div class="container-fluid navegacao fixed-top hide">
    <div class="row textos">
        <div class="col-1 p-3">
            <a href="?a=inicio"><img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" class="logo"></a>
        </div>
        <div class="col-5 p-2" style="position: relative; left: -30px; top: 5px;">
            <a href="?a=inicio">
                <h3 class="titulo_header"><?= APP_NAME ?></h3>
            </a>
        </div>
        <div class="col-1"></div>
        <div class="col-5 p-3 text-end gold_text align-self-center">
            <?php if (Store::adminLogado()) : ?>
                <i class="fas fa-user me-2"></i>
                <?= $_SESSION['admin_usuario'] ?>
                <span class="mx-2">|</span>
                <div class="p-2 badge bg-warning text-dark" onclick="logout_admin()"><i class="fa-solid fa-right-from-bracket"></i></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container-fluid navegacao fixed-top show">
    <div class="row textos">
        <div class="col-1 p-3">
            <a href="?a=inicio"><img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" class="logo"></a>
        </div>
        <div class="col-8 p-1">
            <a href="?a=inicio">
                <h3 class="titulo_header"><?= APP_NAME ?></h3>
            </a>
        </div>
        <div class="col-3 p-1 text-end gold_text">
            <?php if (Store::adminLogado()) : ?>
                <i class="fas fa-user me-2"></i>
                <span class="mx-2">|</span>
                <div class="p-2 badge bg-warning text-dark" onclick="logout_admin()"><i class="fa-solid fa-right-from-bracket"></i></div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="logoutModal_admin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Fazer Logout?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" width="150px" style="border-radius: 50%;">
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=admin_logout" style="text-decoration: none; color:antiquewhite;">Logout</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function logout_admin() {
        var modalStatus = new bootstrap.Modal(document.getElementById('logoutModal_admin'));
        modalStatus.show();
    }
</script>