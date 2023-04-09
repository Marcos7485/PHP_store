<div class="container">
    <div class="row my-5 fade_in_effect gold_text hide">
        <div class="col-sm-6 offset-sm-3">
            <br>
            <br>
            <h3 class="text-center titulos">Recuperação de senha:</h3>
            <form action="?a=recuperar_senha_submit" method="post">
                <!-- email -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email_recup" placeholder="Email" class="form-control" required>
                </div>
                <!-- summit -->
                <div class="my-4 text-center">
                    <input type="submit" value="Recuperar" class="btn btn-warning" id="boton_1">
                </div>
            </form>
        </div>
    </div>

    <!--CELULAR//////////////////////////////////////-->


    <div class="row my-5 fade_in_effect gold_text show">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center titulos" style="padding-top: 120px;">Recuperação de senha:</h3>
            <form action="?a=recuperar_senha_submit" method="post">
                <!-- email -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email_recup" placeholder="Email" class="form-control" required>
                </div>
                <!-- summit -->
                <div class="my-4 text-center">
                    <input type="submit" value="Recuperar" class="btn btn-warning" id="boton_1">
                </div>
            </form>
        </div>
    </div>


    <!--///////////////////////////////////////////////-->

    <?php if (isset($_SESSION['erro'])) : ?>
        <div class='row'>
            <div class="alert alert-danger text-center p-2">
                <?= $_SESSION['erro'] ?>
                <?php unset($_SESSION['erro']) ?>
            </div>
        </div>
    <?php endif; ?>
</div>