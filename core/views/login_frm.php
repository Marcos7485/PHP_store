<div class="container">

    <div class="row my-5 hide">
        <div class="col-sm-4 offset-sm-4 gold_text fade_in_effect">

            <div>
                <h3 class="text-center titulos mt-5">LOGIN</h3>

                <form action="?a=login_submit" method="post">

                    <div class="my-3">
                        <label>Usuario</label>
                        <input type="email" name="text_usuario" placeholder="Usuario" required class="form-control">
                    </div>

                    <div class="my-3">
                        <label>Senha:</label>
                        <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                    </div>

                    <div class="my-3 text-center">
                        <input type="submit" value="Entrar" class="btn btn-warning" id="boton_1">
                    </div>

                </form>
                <div class="col-5">
                    <a href="?a=novo_cliente" class="gold_text">Criar conta</a>
                </div>
                <div class="col-5">
                    <a href="?a=recuperar_senha" class="gold_text">Esqueci minha senha</a>
                </div>
            </div>
        </div>
    </div>
    <!--//////////CELULAR////////////////////---->

    <div class="row my-5 show">
        <div class="col-sm-4 offset-sm-4 gold_text fade_in_effect">
            <div>
                <h3 class="text-center titulos" style="padding-top: 80px;">LOGIN</h3>

                <form action="?a=login_submit" method="post">

                    <div class="my-3">
                        <label>Usuario</label>
                        <input type="email" name="text_usuario" placeholder="Usuario" required class="form-control">
                    </div>

                    <div class="my-3">
                        <label>Senha:</label>
                        <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                    </div>

                    <div class="my-3 text-center">
                        <input type="submit" value="Entrar" class="btn btn-warning" id="boton_1">
                    </div>

                </form>
                <div class="col-5">
                    <a href="?a=novo_cliente" class="gold_text">Criar conta</a>
                </div>
                <div class="col-5">
                    <a href="?a=recuperar_senha" class="gold_text">Esqueci minha senha</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ERRORS ///////////////////-->
    <?php if (isset($_SESSION['erro'])) : ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION['erro'] ?>
            <?php unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>
    <!-- ERRORS ///////////////////-->

    <!--///////////////////////////////////-->
</div>