<?php

use core\classes\Store;
?>

<div class="container">
    <div class="row my-5 fade_in_effect gold_text hide">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">


            <form action="?a=reiniciar_senha_submit&u=<?= Store::aesEncriptar($id_cliente) ?>" method="post">
                <br>
                <br>
                <div>
                    <h1 class="text-center gold_text letra">Reiniciar senha:</h1>
                </div>
                <div class="form-group">
                    <label>Nova senha:</label>
                    <input type="password" minlength="6" maxlength="30" name="text_nova_senha_r" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Repetir nova senha:</label>
                    <input type="password" minlength="6" maxlength="30" name="text_repetir_nova_senha_r" class="form-control" required>
                </div>

                <div class="text-center my-4">
                    <input type="submit" value="Salvar" id="boton_1" class="btn btn-warning btn-100">
                </div>


            </form>
        </div>
    </div>

    <!--CELULAR///////////////////////////////-->


    <div class="row my-5 fade_in_effect gold_text show">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1">


            <form action="?a=reiniciar_senha_submit&u=<?= Store::aesEncriptar($id_cliente) ?>" method="post">
                <br>
                <br>
                <div>
                    <h1 class="text-center gold_text letra" style="font-size: 25pt; padding-top: 60px;">Reiniciar senha:</h1>
                </div>
                <div class="form-group">
                    <label>Nova senha:</label>
                    <input type="password" minlength="6" maxlength="30" name="text_nova_senha_r" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Repetir nova senha:</label>
                    <input type="password" minlength="6" maxlength="30" name="text_repetir_nova_senha_r" class="form-control" required>
                </div>

                <div class="text-center my-4">
                    <input type="submit" value="Salvar" id="boton_1" class="btn btn-warning btn-100">
                </div>


            </form>
        </div>
    </div>
    <!--CELULAR///////////////////////////////-->

    <!--ERRORS///////////////////////////////-->
    <?php if (isset($_SESSION['erro'])) : ?>
        <div class='row'>
            <div class="alert alert-danger text-center p-2">
                <?= $_SESSION['erro'] ?>
                <?php unset($_SESSION['erro']) ?>
            </div>
        </div>
    <?php endif; ?>
    <!--ERRORS///////////////////////////////-->

</div>