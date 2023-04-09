<div class="container-fluid espaco_fundo fade_in_effect hide">
    <?php

    use core\classes\Store;

    ?>
    <!-- Titulo da pagina -->
    <div class="row hide">
        <div class="col-2 my-3">
            <?php if (Store::clientelogado()) : ?>
                <div class="btn btn-cestas" onclick="sugerencia_modal()"><i class="fa-solid fa-feather"></i> <b>Sugerir produto!</b></div>
            <?php endif; ?>
        </div>
        <div class="col-8 text-center my-3">
            <a href="?a=loja&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
            <?php foreach ($categorias as $categoria) : ?>
                <a href="?a=loja&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                    <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="col-2 my-3">
            <a href="?a=cestas" class="btn btn-cestas"><i class="fa-solid fa-gift"></i> <b>Cestas de presente</b></a>
        </div>
    </div>


    <!-- Produtos -->
    <div class="row hide">
        <?php if (count($produtos) == 0) : ?>
            <div class="text-center my-5">
                <h3>Não existem produtos disponiveis.</h3>
            </div>
        <?php else : ?>
            <!-- ciclo de apresentação dos produtos -->
            <?php foreach ($produtos as $produto) : ?>

                <div class="col-sm-3 col-6 p-1 tam_box_produto">
                    <a class="link" style="color: ocean;" href="?a=detalhe_produto&id=<?= Store::aesEncriptar($produto->id_produto) ?>">
                        <div class="text-center p-5 box-produto">
                            <img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid produto_imag">
                            <p class="produto_nome"><?= $produto->nome_produto ?></p>
                            <h2 class="produto_preco">R$
                                <?= preg_replace("/\./", ",", $produto->preco) ?>
                            </h2>
                            <!--<p class="produto_descricao"><small><?= $produto->descricao ?></small></p>-->
                            <p class="produto_pontos"><b>Pontos: <?= $produto->pontos ?></b></p>
                            <div>
                                <i class="fa-solid fa-circle-info"></i>Descrição
                    </a>
                    <p></p>
                    <?php if ($produto->stock > 0) : ?>
                        <button class="btn btn-luciana btn-sm adic_carrinho p-1" style="width: 180px;" onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><i class="fas fa-shopping-cart me-2"></i>Adicionar ao carrinho</button>
                        <p></p>
                        <button class="btn btn-warning btn-sm adic_carrinho p-1" onclick="adicionar_carrinho_presente(<?= $produto->id_produto ?>)"><i class="fa-solid fa-gift"></i>Adicionar embalagem presente</button>
                    <?php else : ?>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-shopping-cart me-2"></i>Sem stock</button>
                    <?php endif; ?>
                </div>
    </div>

</div>
<?php endforeach; ?>
<?php endif; ?>
</div>
</div>


<!-- Celular /////////////////////////////////////////////////-->

<div class="container-fluid fade_in_effect show">
    <!-- Titulo da pagina CEL-->
    <div class="row" style="padding-top: 20px;">
        <?php if (Store::clientelogado()) : ?>
            <div class="col-6 my-3">
                <div class="btn btn-cestas" onclick="sugerencia_modal_cel()"><i class="fa-solid fa-feather"></i> <b>Sugestões</b></div>
            </div>
            <div class="col-6 my-3 text-end">
                <div><a href="?a=cestas" class="btn btn-cestas" id="cest_button"><i class="fa-solid fa-gift"></i> <b>Cestas</b></a></div>
            </div>
        <?php else : ?>
            <div class="col-12 my-3 text-end">
                <div><a href="?a=cestas" class="btn btn-cestas" id="cest_button"><i class="fa-solid fa-gift"></i> <b>Cestas</b></a></div>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <?php if (Store::clientelogado()) : ?>
            <div class="col-12 text-center" style="padding-top: 15px;">
            <?php else : ?>
                <div class="col-12 text-center" style="padding-top: 60px;">
                <?php endif; ?>
                <a href="?a=loja&c=todos" class="btn btn-warning" id="boton_1">Todos</a>
                <?php foreach ($categorias as $categoria) : ?>
                    <a href="?a=loja&c=<?= $categoria ?>" class="btn btn-warning" id="boton_1">
                        <?= ucfirst(preg_replace("/\_/", " ", $categoria)) ?>
                    </a>
                <?php endforeach; ?>
                </div>
            </div>

           <!-- Produtos -->
            <div class="row"  style="margin-top: 40px;">
                <?php if (count($produtos) == 0) : ?>
                    <div class="text-center my-5">
                        <h3>Não existem produtos disponiveis.</h3>
                    </div>
                <?php else : ?>
                    <!-- ciclo de apresentação dos produtos -->
                    <?php foreach ($produtos as $produto) : ?>

                            <div class="table-responsive">
                               
                                <table class="box-produto text-center w-100">
                                    <thead>
                                        <tr>
                                            <td>
                                                <p class="produto_nome"><?= $produto->nome_produto ?></p>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a class="link" href="?a=detalhe_produto&id=<?= Store::aesEncriptar($produto->id_produto) ?>"><img src="assets/images/produtos/<?= $produto->imagem ?>" class="img-fluid produto_imag"></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h2 class="produto_preco">
                                                    R$<?= preg_replace("/\./", ",", $produto->preco) ?>
                                                </h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="produto_pontos"><b>Pontos: <?= $produto->pontos ?></b></p>
                                            </td>
                                        </tr>
                                        <?php if ($produto->stock > 0) : ?>
                                            <tr>
                                                <td>
                                                    <button class="btn btn-luciana btn-sm adic_carrinho p-1" style="width: 180px;" onclick="adicionar_carrinho(<?= $produto->id_produto ?>)"><i class="fas fa-shopping-cart me-2"></i>Adicionar ao carrinho</button>
                                                    <p></p>
                                                    <button class="btn btn-warning btn-sm adic_carrinho p-1" onclick="adicionar_carrinho_presente(<?= $produto->id_produto ?>)"><i class="fa-solid fa-gift"></i>Adicionar embalagem presente</button>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <td><button class="btn btn-danger btn-sm"></i>Promo indisponivel</button>
                                            </tr
                                        <?php endif; ?>
                                        <tr>
                                            <td>&nbsp</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        <div style='margin-bottom: 70px;'></div>
    </div>
</div>

<!--//////////////////////////////////////////////////////////-->

<!-- Modal sugerencia -->
<div class="modal fade" id="sugerencia_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header letra" style="background-color: black; color: goldenrod;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Contanos, que o procuraremos!!<br></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <form action="?a=sugerencia_add_perfil" method="post">
                        <textarea id="sugerencia" name="sugerencia" rows="5" cols="50" maxlength="500"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <span id="counter" class="gold_text"></span>
                <p class="gold_text">/500</p>
                <input type="submit" value="Sugerir!" class="btn btn-warning">
                </form>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal sugerencia CEL-->
<div class="modal fade" id="sugerencia_modal_cel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header letra" style="background-color: black; color: goldenrod;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Contanos, que o procuraremos!!<br></h1>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <form action="?a=sugerencia_add_perfil" method="post">
                        <textarea id="sugerencia_cel" name="sugerencia" rows="5" cols="30" maxlength="500"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <span id="counter_cel" class="gold_text"></span>
                <p class="gold_text">/500</p>
                <input type="submit" value="Sugerir!" class="btn btn-warning">
                </form>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="assets/css/toastr.min.css">
<script src="assets/js/jquery-1.9.1.js"></script>
<script src="assets/js/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('.adic_carrinho').click(function() {
            toastr.success("Agregado ao carrinho!");
        });
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "5",
            "hideDuration": "1",
            "timeOut": "1200",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    });


    function sugerencia_modal() {
        var modalStatus = new bootstrap.Modal(document.getElementById('sugerencia_modal'));
        modalStatus.show();
    }

    function sugerencia_modal_cel() {
        var modalStatus = new bootstrap.Modal(document.getElementById('sugerencia_modal_cel'));
        modalStatus.show();
    }

    var input = document.getElementById('sugerencia');
    var input_cel = document.getElementById('sugerencia_cel');
    var counter = document.getElementById('counter');
    var counter_cel = document.getElementById('counter_cel');

    input.addEventListener('input', function() {
        counter.textContent = input.maxLength - input.value.length;
    });

    input_cel.addEventListener('input', function() {
        counter_cel.textContent = input_cel.maxLength - input_cel.value.length;
    });
</script>