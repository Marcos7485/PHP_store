<div class="container-fluid espaco_fundo fade_in_effect hide">

    <!-- Titulo da pagina -->
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja_premios&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
            <?php

            use core\classes\Store;

            foreach ($categorias as $categoria) : ?>
                <a href="?a=loja_premios&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>



    <!-- Premios -->
    <div class="row">


        <?php if (count($premios) == 0) : ?>
            <div class="text-center my-5">
                <h3>Não existem premios disponiveis.</h3>
            </div>
        <?php else : ?>
            <!-- ciclo de apresentação dos premios -->
            <?php foreach ($premios as $premio) : ?>
                <div class="col-sm-3 col-6 p-1 tam_box_produto">

                    <div class="text-center p-2 box-premio">
                        <img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag">

                        <p class="produto_nome"><?= $premio->nome_premio ?></p>
                        <h2 class="produto_preco texto_pontos">
                            <p class="letra"><?= $premio->preco ?> Pontos</p>
                        </h2>

                        <div>
                            <a href="?a=detalhe_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>"><button class="btn btn-luciana btn-sm"><i class="fa-solid fa-circle-info"></i> Detalles</button></a>
                            <a href="?a=login"><button class="btn btn-warning btn-sm"><i class="fa-solid fa-right-to-bracket"></i> Participar!</button></a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<!-- Celular /////////////////////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">

    <!-- Titulo da pagina -->
    <div class="row">
        <div class="col-12 text-center my-3" style="padding-top: 60px;">
            <a href="?a=loja_premios&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
            <?php foreach ($categorias as $categoria) : ?>
                <a href="?a=loja_premios&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Premios -->
    <div class="row">
        <?php if (count($premios) == 0) : ?>
            <div class="text-center my-5">
                <h3 class="gold_text">Não existem premios disponiveis.</h3>
            </div>
        <?php else : ?>
            <!-- ciclo de apresentação dos premios -->
            <?php foreach ($premios as $premio) : ?>
                <div class="col-sm-3 p-1 tam_box_produto">
                    <a href="?a=detalhe_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>">
                        <div class="text-center p-2 box-premio">
                            <img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag">
                            <p class="produto_nome"><?= $premio->nome_premio ?></p>
                            <h2 class="produto_preco texto_pontos">
                                <p class="letra"><?= $premio->preco ?> Pontos</p>
                            </h2>

                            <div>
                                <button class="btn btn-luciana btn-sm"><i class="fa-solid fa-circle-info"></i> Detalles</button>
                    </a>
                    <a href="?a=login"><button class="btn btn-warning btn-sm"><i class="fa-solid fa-right-to-bracket"></i> Participar!</button></a>
                </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>

<!--//////////////////////////////////////////////////////////-->
