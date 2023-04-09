<div class="container">
    <div class="row my-5 fade_in_effect hide">
        <div class="col-sm-4 offset-sm-4 gold_text">
            <div>
                <h3 class="text-center titulos">LOGIN DO ADMINISTRADOR</h3>
                <form action="?a=admin_login_submit" method="post">
                    <div class="my-3">
                        <label>Administrador</label>
                        <input type="email" name="text_admin" placeholder="Admin" required class="form-control">
                    </div>
                    <div class="my-3">
                        <label>Senha:</label>
                        <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                    </div>
                    <div class="my-3 text-center">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CELULAR/////////////////////////////////-->
    <div class="row my-5 fade_in_effect show">
        <div class="col-sm-4 offset-sm-4 gold_text" style="padding-top: 100px;">
            <div>
                <h3 class="text-center" style="font-size: 20pt; ">LOGIN DO ADMINISTRADOR</h3>
                <form action="?a=admin_login_submit" method="post">
                    <div class="my-3">
                        <label>Administrador</label>
                        <input type="email" name="text_admin" placeholder="Admin" required class="form-control">
                    </div>
                    <div class="my-3">
                        <label>Senha:</label>
                        <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                    </div>
                    <div class="my-3 text-center">
                        <input type="submit" value="Entrar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CELULAR/////////////////////////////////-->
    <!-- ERRORS /////////////////////////-->
    <?php if (isset($_SESSION['erro'])) : ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION['erro'] ?>
            <?php unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>
    <!-- ERRORS /////////////////////////-->
</div>