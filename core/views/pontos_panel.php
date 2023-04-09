<div class="container-fluid hide">
    <div class="row mb-5 fade_in_effect">
        <?php if (empty($favorito->id_premio)) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/Imagens/box_incog.png" class="img_premio_favorito pontos_suf"></a>
            </div>
        <?php elseif ($favorito->id_premio == 1) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.0834) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.0834 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_1.jpg" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_1.jpg" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 2) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.067) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.06667 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets//images/premios/premio_2.jpg" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_2.jpg" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 3) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.2 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_3.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_3.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 6) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.2 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_4.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_4.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 7) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_5.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_5.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 8) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_6.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_6.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 9) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_7.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_7.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 10) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.06667) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.06667 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_8.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_8.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php endif; ?>





        <div class="row">
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_1"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_2"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_3"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_4"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_5"></i></div>
        </div>


        <div class="row">
            <hr>
        </div>

        <div class="row gold_text">
            <div class="col-4">

                <table class="table gold_text">

                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Pontos por encomenda concluída:</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        use core\classes\Store;

                        $resumen = 0; ?>
                        <?php foreach ($info_encomendas as $encomenda) : ?>
                            <tr>
                                <th><?= $encomenda->codigo_encomenda ?></th>
                                <th class="texto_pontos"><?= $encomenda->pontos ?></th>
                                <?php $resumen += $encomenda->pontos ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th style="font-style:oblique">Total pontos:</th>
                            <th class="texto_pontos"><?= $resumen ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-4">
                <table class="table gold_text">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Prêmios reclamados:</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $resumen = 0; ?>
                        <?php foreach ($premios as $premio) : ?>
                            <tr>
                                <th><a class="link" style="color: ocean;" href="?a=detalhe_p_cliente&id=<?= Store::aesEncriptar($premio->codigo) ?>"><i class="fa-solid fa-circle-info"></i></a> <?= $premio->codigo ?></th>
                                <th style="color: red; text-shadow: 1px 1px 1px brown;">-<?= $premio->coste ?></th>
                                <?php $resumen += $premio->coste ?>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th style="font-style:oblique">Total pontos:</th>
                            <th style="color: red; text-shadow: 1px 1px 1px brown;">-<?= $resumen ?></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-4">
                <h1 class="text-center letra" style="font-size: 80pt; color: goldenrod;">Pontos:</h1>
                <h1 class="text_pontos_panel letra" id="number_panel"><?= $total_pontos ?></h1>
            </div>
        </div>

    </div>
</div>


<!--///////////////Celular////////////////////-->

<div class="container-fluid show">
    <div class="row mb-5 fade_in_effect">
        <?php if (empty($favorito->id_premio)) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/Imagens/box_incog.png" class="img_premio_favorito pontos_suf"></a>
            </div>
        <?php elseif ($favorito->id_premio == 1) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.0834) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.0834 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_1.jpg" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_1.jpg" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 2) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.067) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.06667 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_2.jpg" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_2.jpg" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 3) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.2 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_3.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_3.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 6) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.2 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_4.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_4.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 7) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_5.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_5.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 8) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_6.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_6.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 9) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.1) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.1 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_7.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_7.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php elseif ($favorito->id_premio == 10) : ?>
            <div class="col-10 mt-5">
                <div class="progress">
                    <div class="progress-bar" style="width: <?= ($total_pontos * 0.06667) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                </div>
            </div>
            <div class="col-2">
                <?php if ($total_pontos * 0.06667 < 100) : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_8.png" class="img_premio_favorito"></a>
                <?php else : ?>
                    <a href="?a=loja_premios"><img src="https://llicorellapriorato.store/public/assets/images/premios/premio_8.png" class="img_premio_favorito pontos_suf"></a>
                <?php endif ?>
            </div>
        <?php endif; ?>





        <div class="row">
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_1"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_2"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_3"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_4"></i></div>
            <div class="col-2 text-center" style="color: goldenrod"><i class="fa-solid fa-star" id="star_5"></i></div>
        </div>


        <div class="row">
            <hr>
        </div>

        <div class="row gold_text text-center" style="padding-top: 10px;">
            <!-- desliz////////////////////-->
            <div id="wrapper">
                <input type="radio" name="content" id="radio1" checked>
                <input type="radio" name="content" id="radio2">
                <div class="text-center gold_text" id="content1" style="left: 30px; padding-top: 20px">
                    <div class="col-10">
                        <table class="table gold_text">

                            <thead>
                                <tr>
                                    <th class="text-center" style="font-style:oblique" colspan="2">Pontos por encomenda concluída:</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $resumen = 0; ?>
                                <?php foreach ($info_encomendas as $encomenda) : ?>
                                    <tr>
                                        <th><?= $encomenda->codigo_encomenda ?></th>
                                        <th class="texto_pontos"><?= $encomenda->pontos ?></th>
                                        <?php $resumen += $encomenda->pontos ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="font-style:oblique">Total pontos:</th>
                                    <th class="texto_pontos"><?= $resumen ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-center gold_text" id="content2" style="left: 30px; padding-top: 20px">
                    <div class="col-10">
                        <table class="table gold_text">
                            <thead>
                                <tr>
                                    <th class="text-center" style="font-style:oblique" colspan="2">Prêmios reclamados:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $resumen = 0; ?>
                                <?php foreach ($premios as $premio) : ?>
                                    <tr>
                                        <th><a class="link" style="color: ocean;" href="?a=detalhe_p_cliente&id=<?= Store::aesEncriptar($premio->codigo) ?>"><i class="fa-solid fa-circle-info"></i></a> <?= $premio->codigo ?></th>
                                        <th style="color: red; text-shadow: 1px 1px 1px brown;">-<?= $premio->coste ?></th>
                                        <?php $resumen += $premio->coste ?>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th style="font-style:oblique">Total pontos:</th>
                                    <th style="color: red; text-shadow: 1px 1px 1px brown;">-<?= $resumen ?></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- desliz////////////////////-->
            <div class="col-xs-3 text-center" style="padding-bottom: 60px;">
                <h1 class="letra" style="font-size: 80pt; color: goldenrod">Pontos:</h1>
                <h1 class="text_pontos_panel letra" id="number_panel" ><?= $total_pontos ?></h1>
            </div>
        </div>
    </div>
</div>

<!--///////////////////////////////////Celular-->


<script>
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

    number = document.getElementById("number_panel");
    animateValue(number, 0, <?= $total_pontos ?>, 1500);
    number_cel = document.getElementById("number_panel_cel");
    animateValue(number_cel, 0, <?= $total_pontos ?>, 1500);
</script>