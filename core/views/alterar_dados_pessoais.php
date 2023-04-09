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
            <form action="?a=alterar_dados_pessoais_submit" method="post">

                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" maxlength="50" name="text_nome_completo" class="form-control" required value="<?= $dados_pessoais->nome_completo ?>">
                </div>

                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="text_cep" placeholder="Ej. 12345-678" required>
                </div>

                <div class="form-group">
                    <label>Cidade:</label>
                    <input type="text" maxlength="50" name="text_cidade" class="form-control" required value="<?= $dados_pessoais->cidade ?>">
                </div>

                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="number" minlength="6" maxlength="20" name="text_telefone" class="form-control" required value="<?= $dados_pessoais->telefone ?>">
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
            <form action="?a=alterar_dados_pessoais_submit" method="post">

                <div class="form-group">
                    <label>Nome Completo:</label>
                    <input type="text" maxlength="50" name="text_nome_completo" class="form-control" required value="<?= $dados_pessoais->nome_completo ?>">
                </div>

                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="text_cep" placeholder="Ej. 12345-678" required>
                </div>

                <div class="form-group">
                    <label>Cidade:</label>
                    <input type="text" maxlength="50" name="text_cidade" class="form-control" required value="<?= $dados_pessoais->cidade ?>">
                </div>

                <div class="form-group">
                    <label>Telefone:</label>
                    <input type="number" minlength="6" maxlength="20" name="text_telefone" class="form-control" required value="<?= $dados_pessoais->telefone ?>">
                </div>

                <div class="text-center my-4">
                    <input type="submit" value="Salvar" class="btn btn-success btn-100">
                    <a href="?a=perfil" class="btn btn-danger btn-100">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Celular -->
    <div style="padding-bottom: 50px;"></div>
</div>

<!--////////////////////////////////////////////////////////-->