<div class="container hide">
    <div class="row">
        <div class="col fade_in_effect">
            <h3 class="text-center my-3 titulos">A sua encomenda</h3>
        </div>
    </div>
</div>


<div class="container fade_in_effect hide">
    <div class="row">
        <div class="col gold_text">

            <?php

            use core\classes\Store;

            if ($carrinho == null) : ?>
                <h1 class="text-center letra" style="position: relative; top:100px;">Sem produtos selecionados</h1>
                <div class="text-center">
                    <a href="?a=loja" class="btn btn-warning" style="position: relative; top:150px;" id="boton_1">Voltar para comprar</a>
                </div>


            <?php else : ?>
                <div style="margin-bottom: 70px;">
                    <table class="table gold_text">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Valor</th>
                                <th class="text-end">Pontos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            $total_rows = count($carrinho);
                            ?>
                            <?php foreach ($carrinho as $produto) : ?>
                                <?php if ($index < $total_rows - 2) : ?>
                                    <!-- Lista dos produtos -->
                                    <tr>
                                        <td><img src="https://llicorellapriorato.store/public/assets/images/produtos/<?= $produto['imagem']; ?>" class="img-fluid produto_imag"></td>
                                        <td class="align-middle"><?= $produto['titulo'] ?></td>
                                        <td class="text-center align-middle letra" style="font-size: 25pt;"><?= $produto['quantidade'] ?></td>
                                        <td class="text-end align-middle" style="font-size: 25pt;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                        <td class="text-end align-middle texto_pontos" style="font-size: 25pt;"><b><?= $produto['pontos'] ?></b></td>
                                        <td class="text-end align-middle">
                                            <a href="?a=adicionar_produto_carrinho&id_produto=<?= Store::aesEncriptar($produto['id_produto']) ?>" class="btn btn-success" style="border-radius: 50%;"><i class="fa-solid fa-plus"></i></button></a>
                                            <a href="?a=remover_produto_carrinho&id_produto=<?= Store::aesEncriptar($produto['id_produto']) ?>" class="btn btn-danger" style="border-radius: 50%;"><i class="fa-solid fa-minus"></i></button></a>
                                        </td>
                                    </tr>

                                <?php else : ?>

                                <?php endif; ?>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Total -->
                    <table class="table gold_text">
                        <thead>
                            <tr>
                                <td><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="100px"></td>
                                <td></td>
                                <td><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px">Crédito/Débito</td>
                                <td class="text-end align-middle letra" style="font-size: 25pt;"><b>Valor total:</b></td>
                                <td class="text-center letra" style="font-size: 20pt;"><b>R$ <?= number_format(($carrinho[$total_rows - 2]), 2, ',', '.') ?></b></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-end align-middle texto_pontos letra" style="font-size: 25pt;"><b>Pontos total:</b></td>
                                <td class="text-center texto_pontos letra" style="font-size: 50pt;border-radius: 10%;" id="number"><b><?= $carrinho[$total_rows - 1] ?></b></td>
                            </tr>
                        </thead>
                    </table>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-sm btn-danger" onclick="limpar_modal()">Limpar carrinho</button>
                        </div>
                        <div class="col text-end">
                            <a href='?a=loja' class="btn btn-sm btn-warning"><i class="fa-solid fa-cart-arrow-down"></i> Continuar comprando</a>
                            <a href="?a=finalizar_encomenda" class="btn btn-sm btn-success">Confirmar compra</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>







<!-- Celular ///////////////////////////////////////////////////-->

<div class="container show">
    <div class="row">
        <div class="col fade_in_effect mt-5">
            <h3 class="text-center my-3 titulos">A sua encomenda</h3>
        </div>
    </div>
</div>

<div class="container fade_in_effect show">
    <div class="row">
        <div class="col gold_text">

            <?php if ($carrinho == null) : ?>
                <h1 class="text-center letra" style="position: relative; top:100px;">Sem produtos selecionados</h1>
                <div class="text-center">
                    <a href="?a=loja" class="btn btn-warning" style="position: relative; top:150px;" id="boton_1">Voltar para comprar</a>
                </div>


            <?php else : ?>
                <div style="margin-bottom: 70px;">
                    <table class="table gold_text">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $index = 0;
                            $total_rows = count($carrinho);
                            ?>
                            <?php foreach ($carrinho as $produto) : ?>
                                <?php if ($index < $total_rows - 2) : ?>
                                    <!-- Lista dos produtos -->
                                    <tr>
                                        <td><img src="https://llicorellapriorato.store/public/assets/images/produtos/<?= $produto['imagem']; ?>" class="img-fluid produto_imag"></td>
                                        <td class="align-middle"><?= $produto['titulo'] ?></td>
                                        <td class="text-center align-middle letra" style="font-size: 25pt;"><?= $produto['quantidade'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end align-middle" colspan="3">
                                            <a href="?a=adicionar_produto_carrinho&id_produto=<?= Store::aesEncriptar($produto['id_produto']) ?>" class="btn btn-success" style="border-radius: 50%;"><i class="fa-solid fa-plus"></i></button></a>
                                            <a href="?a=remover_produto_carrinho&id_produto=<?= Store::aesEncriptar($produto['id_produto']) ?>" class="btn btn-danger" style="border-radius: 50%;"><i class="fa-solid fa-minus"></i></button></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle" colspan="4" style="font-size: 25pt;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center align-middle texto_pontos" colspan="4" style="font-size: 25pt;"><b><?= $produto['pontos'] ?></b></td>
                                    </tr>
                                <?php endif; ?>
                                <?php $index++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- Total -->
                    <table class="table gold_text">
                        <thead>
                            <tr>
                                <td><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="60px"><br><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="30px">Crédito/Débito</td>
                                <td class="text-end align-middle letra" colspan="4" style="font-size: 20pt;"><b>Total: R$ <?= number_format(($carrinho[$total_rows - 2]), 2, ',', '.') ?></b></td>
                            </tr>
                            <tr>
                                <td class="text-end align-middle texto_pontos letra" colspan="2" style="font-size: 25pt;"><b>Pontos total:</b></td>
                                <td class="text-center texto_pontos letra" colspan="3" style="font-size: 50pt;border-radius: 10%;" id="number"><b><?= $carrinho[$total_rows - 1] ?></b></td>
                            </tr>
                        </thead>
                    </table>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-sm btn-danger" onclick="limpar_modal()">Limpar carrinho</button>
                        </div>
                        <div class="col text-end">
                            <a href='?a=loja' class="btn btn-sm btn-warning"><i class="fa-solid fa-cart-arrow-down"></i> Voltar para Loja</a>
                        </div>
                        <div class="row text-center">
                            <div class="col my-3">
                                <a href="?a=finalizar_encomenda" class="btn btn-sm btn-success">Confirmar compra</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!--////////////////////////////////////////////////////////////-->


<!-- Modal -->
<div class="modal fade" id="limparModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Limpar carrinho?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <img src="https://www.llicorellapriorato.store/public/assets/images/icons/Logo.jpg" width="150px" style="border-radius: 50%;">
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=limpar_carrinho" style="text-decoration: none; color:antiquewhite;"> Limpar</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function limpar_modal() {
        var modalStatus = new bootstrap.Modal(document.getElementById('limparModal'));
        modalStatus.show();
    }




    function animateValue(obj, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    number = document.getElementById("number");
    animateValue(number, 0, <?= $carrinho[$total_rows - 1] ?>, 1500);

    number_cel = document.getElementById("number_cel");
    animateValue(number_cel, 0, <?= $carrinho[$total_rows - 1] ?>, 1500);
</script>