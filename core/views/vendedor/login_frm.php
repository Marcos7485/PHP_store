<div class="container">
    <div class="row my-5 fade_in_effect hide">
        <div class="col-sm-4 offset-sm-4 gold_text">

        <div>
        <h3 class="text-center" style="padding-top: 100px; color: goldenrod; font-style: oblique;">LOGIN DO VENDEDOR</h3>

            <form action="?a=vendedor_login_submit" method="post">

                <div class="my-3">
                    <label>Vendedor</label>
                    <input type="email" name="text_vendedor" placeholder="Vendedor" required class="form-control">
                </div>

                <div class="my-3">
                    <label>Senha:</label>
                    <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                </div>

                <div class="my-3 text-center">
                    <input type="submit" value="Entrar" class="btn btn-primary">
                </div>

            </form>
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['erro'] ?>
                    <?php unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </div>
    
    <div class="row my-5 fade_in_effect show">
        <div class="col-sm-4 offset-sm-4 gold_text">

        <div>
        <h3 class="text-center" style="padding-top: 100px; color: goldenrod; font-style: oblique;">LOGIN DO VENDEDOR</h3>

            <form action="?a=vendedor_login_submit" method="post">

                <div class="my-3">
                    <label>Vendedor</label>
                    <input type="email" name="text_vendedor" placeholder="Vendedor" required class="form-control">
                </div>

                <div class="my-3">
                    <label>Senha:</label>
                    <input type="password" name="text_senha" placeholder="Senha" required class="form-control">
                </div>

                <div class="my-3 text-center">
                    <input type="submit" value="Entrar" class="btn btn-primary">
                </div>

            </form>
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION['erro'] ?>
                    <?php unset($_SESSION['erro']); ?>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </div>
</div>