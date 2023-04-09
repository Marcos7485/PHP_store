<?php

use core\models\Sorteios;
use core\classes\Store;

$s = new Sorteios();

$cliente_no_sorteio = $s->sorteio_ativo($_SESSION['cliente']);

if ($cliente_no_sorteio == true) {
    $data_sorteio = $s->data_sorteio($_SESSION['cliente']);
}

?>

<div class="container-fluid fade_in_effect hide">
    <div class="row">
        <h1 class="gold_text text-center letra" style="font-size: 35pt;">Participe dos sorteios!</h1>
    </div>
    <div class="row">
        <h1 class="texto_pontos text-center letra">Pontos: <?= $total_pontos ?></h1>
    </div>
    <?php if ($cliente_no_sorteio == false) : ?>
        <div class="row text-center gold_text mt-3" style="padding-bottom: 70px;">
            <?php if ($total_pontos < 50) : ?>
                <div class="col-4"><br><br>Pontos: <?= $total_pontos ?>/50<br>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?= ($total_pontos * 2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                    </div><br><button class="btn btn-danger btn-sm"><i class="fa-solid fa-face-sad-cry"></i> Pontos insuficientes!</button>
                </div>
            <?php else : ?>
                <div class="col-4"><br><br><br><br><button onclick="concorrer()" type="button" class="btn btn-warning pontos_suf" id="boton_1"> Participar!</button></div>
            <?php endif; ?>
            <div class="col-4"><?= $sorteio->nome_premio ?><br><img src="assets/images/premios/<?= $sorteio->imagem ?>" class="img-fluid premio_imag pontos_suf"><br>Concorra por 50 Pontos!<br><a href="?a=detalhe_sorteio&e=<?= Store::aesEncriptar($sorteio->id_premio) ?>"><i class="fa-solid fa-circle-info"></i>Info do sorteio</a>
            </div>
        </div>
    <?php else : ?>
        <div class="row text-center" style="padding-top: 30px;">
            <div class="col gold_text" style="font-style: oblique;">
                <h1>Já participa de un sorteio activamente!!!</h1><br>
                <h3>Inscrito na data: <?= $data_sorteio[0]->created_at ?></h3><br>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- CELULAR/////////////////////////////////////-->

<div class="container-fluid text-center fade_in_effect show">
    <div class="row">
        <h1 class="gold_text text-center letra" style="font-size: 35pt; padding-top: 20px;">Participe dos sorteios!</h1>
    </div>
    <div class="row">
        <h1 class="texto_pontos text-center letra" style="font-size: 25pt;">Pontos: <?= $total_pontos ?></h1>
    </div>
    <?php if ($cliente_no_sorteio == false) : ?>
    <div class="row gold_text" style="padding-left: 10px;">
        <div class="col-12 text-center"><?= $sorteio->nome_premio ?><br><img src="assets/images/premios/<?= $sorteio->imagem ?>" class="img-fluid premio_imag pontos_suf"><br>Concorra por 50 Pontos!<br><a href="?a=detalhe_sorteio&e=<?= Store::aesEncriptar($sorteio->id_premio) ?>"><i class="fa-solid fa-circle-info"></i>Info do sorteio</a>
        </div>
            <div class="row text-center gold_text mt-3" style="padding-bottom: 70px;">
                <?php if ($total_pontos < 50) : ?>
                    <div class="col-12" style="padding-left: 40px;"><br><br>Pontos: <?= $total_pontos ?>/50<br>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= ($total_pontos * 2) . "%" ?>;"><i class="fa-solid fa-wine-bottle text-end"></i></div>
                        </div><br><button class="btn btn-danger btn-sm"><i class="fa-solid fa-face-sad-cry"></i> Pontos insuficientes!</button>
                    </div>
                <?php else : ?>
                    <div class="col-12 text-center" style="margin-left: 10px;"><br><br><br><button onclick="concorrer()" type="button" class="btn btn-warning pontos_suf" id="boton_1"> Participar!</button></div>
                <?php endif; ?>
            </div>
    </div>
<?php else : ?>
    <div class="row text-center" style="padding-top: 30px;">
        <div class="col gold_text" style="font-style: oblique;">
            <h1>Já participa de un sorteio activamente!!!</h1><br>
            <h3>Inscrito na data: <?= $data_sorteio[0]->created_at ?></h3>
            <br>
            <br>
            <br>
        </div>
    </div>
<?php endif; ?>
</div>

<!-- CELULAR////////////////////////////////////-->

<!-- Modal -->
<div class="modal fade" id="concorrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Deseja participar?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center texto_pontos ">
                    Coste: 50 pontos.<br>
                    (Não tem devolução).
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=partecipar&id=<?= Store::aesEncriptar($id_cliente) ?>&e=<?= Store::aesEncriptar($sorteio->id_premio) ?>" style="text-decoration: none; color:antiquewhite;">Participar!</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function concorrer() {
        var modalStatus = new bootstrap.Modal(document.getElementById('concorrer'));
        modalStatus.show();
    }
</script>