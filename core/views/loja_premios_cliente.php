<div class="container-fluid espaco_fundo fade_in_effect hide">

    <div class="row">
        <div class="col-4">
            <p class="texto_pontos letra" style="font-size: 30pt;">Meus pontos: <?= ($cliente->pontos_cliente - $cliente->pontos_usados) ?></p>
        </div>
        <div class="col-4 mt-3">
            <div class="alert alert-violeta p2 text-center">
                <span class="me-3"><i class="fa-regular fa-star gold_text"></i>Marque seu premio favorito e veja o progreso no seu panel de pontos!      <i class="fa-solid fa-star" style="color:blue;" id="star_1"></i></span>
            </div>
        </div>
    </div>

    <!-- Titulo da pagina -->
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja_premios_cliente&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
            <?php

            use core\classes\Store;

            foreach ($categorias as $categoria) : ?>
                <a href="?a=loja_premios_cliente&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Premios -->
    <div class="row">


        <?php if (count($premios) == 0) : ?>
            <div class="text-center my-5 gold_text">
                <h3>Não existem premios disponiveis.</h3>
            </div>
        <?php else : ?>
            <!-- ciclo de apresentação dos premios -->
            <?php foreach ($premios as $premio) : ?>
                <div class="col-sm-3 col-6 p-1 tam_box_produto">

                    <div class="text-center p-2 box-premio">

                        <img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag">

                        <p class="produto_nome"><?= $premio->nome_premio ?> <a href="?a=meu_favorito_add&id=<?= Store::aesEncriptar($premio->id_premio) ?>">
                                <?php if (empty($favorito) || ($favorito != $premio->id_premio)) : ?>
                                    <i class="fa-regular fa-star gold_text"></i>
                                <?php else : ?>
                                    <i class="fa-solid fa-star" id="star_1"></i>
                                <?php endif; ?>
                            </a></p>

                        <h2 class="produto_preco texto_pontos">
                            <p class="letra"><?= $premio->preco ?> Pontos</p>
                        </h2>

                        <div>
                            <?php if ($premio->preco <= ($cliente->pontos_cliente - $cliente->pontos_usados)) : ?>
                                <a href="?a=adquirir_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>"><button class="btn btn-warning btn-sm pontos_suf"><i class="fa-solid fa-face-grin-stars"></i> Reclamar!</button></a>
                            <?php else : ?>
                                <a href="?a=detalhe_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>"><button class="btn btn-success btn-sm"><i class="fa-solid fa-circle-info"></i> Detalles</button></a>
                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-face-sad-cry"></i> Pontos insuficientes!</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>

<!-- Celular /////////////////////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">

    <div class="row" style="padding-top: 60px;">
        <div class="col-12">
            <p class="texto_pontos letra" style="font-size: 25pt;">Meus pontos: <?= ($cliente->pontos_cliente - $cliente->pontos_usados) ?></p>
        </div>
        <div class="col-12 mt-3">
            <div class="alert alert-violeta p2 text-center">
                <span class="me-3"><i class="fa-regular fa-star gold_text" style="font-size: 15pt;"></i>Marque seu premio favorito e veja o progreso no seu panel de pontos!      <i class="fa-solid fa-star" style="color:blue;" id="star_1"></i></span>
            </div>
        </div>
    </div>

    <!-- Titulo da pagina -->
    <div class="row">
        <div class="col-12 text-center my-3">
            <a href="?a=loja_premios_cliente&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
            <?php foreach ($categorias as $categoria) : ?>
                <a href="?a=loja_premios_cliente&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- Premios -->
    <div class="row">
        <?php if (count($premios) == 0) : ?>
            <div class="text-center my-5 gold_text">
                <h3>Não existem premios disponiveis.</h3>
            </div>
        <?php else : ?>
            <!-- ciclo de apresentação dos premios -->
            <?php foreach ($premios as $premio) : ?>
                <div class="col-sm-3 p-1 tam_box_produto">

                    <div class="text-center p-2 box-premio">

                        <img src="assets/images/premios/<?= $premio->imagem ?>" class="img-fluid premio_imag">

                        <p class="produto_nome"><?= $premio->nome_premio ?> <a href="?a=meu_favorito_add&id=<?= Store::aesEncriptar($premio->id_premio) ?>">
                                <?php if (empty($favorito) || ($favorito != $premio->id_premio)) : ?>
                                    <i class="fa-regular fa-star gold_text"></i>
                                <?php else : ?>
                                    <i class="fa-solid fa-star" id="star_1"></i>
                                <?php endif; ?>
                            </a></p>

                        <h2 class="produto_preco texto_pontos">
                            <p class="letra"><?= $premio->preco ?> Pontos</p>
                        </h2>

                        <div>
                            <?php if ($premio->preco <= ($cliente->pontos_cliente - $cliente->pontos_usados)) : ?>
                                <a href="?a=adquirir_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>"><button class="btn btn-warning btn-sm pontos_suf"><i class="fa-solid fa-face-grin-stars"></i> Reclamar!</button></a>
                            <?php else : ?>
                                <a href="?a=detalhe_premio&id=<?= Store::aesEncriptar($premio->id_premio) ?>"><button class="btn btn-success btn-sm"><i class="fa-solid fa-circle-info"></i> Detalles</button></a>
                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-face-sad-cry"></i> Pontos insuficientes!</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>


<!--//////////////////////////////////////////////////////////-->