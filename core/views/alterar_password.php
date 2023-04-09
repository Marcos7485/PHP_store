<div class="container">


    <!-- ERRORS////////////////////////////////////////////////-->

    <?php if (isset($_SESSION['erro'])) : ?>
        <div class='row'>
            <div class="alert alert-danger text-center p-2">
                <?= $_SESSION['erro'] ?>
                <?php unset($_SESSION['erro']) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- ERRORS////////////////////////////////////////////////-->

    <div class="row fade_in_effect hide">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1 gold_text fade_in_effect">


            <form action="?a=alterar_password_submit" method="post">

                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" maxlength="30" name="text_senha_atual" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nova senha:</label>
                    <input type="password" maxlength="30" name="text_nova_senha" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Repetir nova senha:</label>
                    <input type="password" maxlength="30" name="text_repetir_nova_senha" class="form-control" required>
                </div>

                <div class="text-center my-4">
                    <input type="submit" value="Salvar" class="btn btn-success btn-100">
                    <a href="?a=perfil" class="btn btn-danger btn-100">Cancelar</a>
                </div>
            </form>
        </div>
    </div>


    <!-- Celular -->


    <div class="row fade_in_effect show">
        <div class="col-md-6 offset-md-3 col-sm-8 offset-sm-2 col-10 offset-1 gold_text fade_in_effect">

            <h3 class="text-center gold_text letra" style="font-size:27pt;">Alterar password:</h3>
            <form action="?a=alterar_password_submit" method="post">

                <div class="form-group">
                    <label>Senha:</label>
                    <input type="password" maxlength="30" name="text_senha_atual" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Nova senha:</label>
                    <input type="password" maxlength="30" name="text_nova_senha" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Repetir nova senha:</label>
                    <input type="password" maxlength="30" name="text_repetir_nova_senha" class="form-control" required>
                </div>

                <div class="text-center my-4">
                    <input type="submit" value="Salvar" class="btn btn-success btn-100">
                </div>
                <div class="text-center mb-5">
                    <a href="?a=perfil" class="btn btn-danger btn-100">Cancelar</a>
                </div>
            </form>

            <?php if (isset($_SESSION['erro'])) : ?>
                <div class='row'>
                    <div class="alert alert-danger text-center p-2">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>



    <!--////////////////////////////////////////////////////////-->
</div>