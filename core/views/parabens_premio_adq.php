<?php $total_pontos =  $cliente->pontos_cliente - $cliente->pontos_usados ?>
<div class="container-fluid espaco_fundo fade_in_effect hide">

    <div class="row">
        <div class="col-2">
            <p class="texto_pontos letra" style="font-size: 30pt;">Seus pontos:</p>
        </div>
        <div class="col-2">
            <h1 class="texto_pontos letra text-start mt-2" id="number_panel"><?= $total_pontos ?></h1>
        </div>
        <div class="col-4 text-center mt-4 gold_text">
            <i class="fa-solid fa-star" id="star_1"></i>
        </div>
    </div>

    <div class="row fade_in_effect">
        <div class="col-sm-6 offset-sm-3 text-center gold_text">
            <br>
            <h1 class="text-center gold_text letra mt-5">Prêmio adquirido com sucesso!</h1>
            <p>Pode visualizar seu prêmio no seu panel de pontos do usuario!</p>
            <p>A confirmação do prêmio adquirido foi enviada pelo email, junto com seu código do Prêmio</p>
            <div class="my-5"><a href="?a=loja_premios" class="btn btn-warning" id="boton_1">Continuar</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-2 text-center mt-4 gold_text">
            <i class="fa-solid fa-star" id="star_1"></i>
        </div>
        <div class="col-8"></div>
        <div class="col-2 text-center mt-4 gold_text">
            <i class="fa-solid fa-star" id="star_1"></i>
        </div>
    </div>

</div>

<!-- CELULAR///////////////////////////////////////////////////-->

<div class="container-fluid espaco_fundo fade_in_effect show">
    <div class="row" style="padding-top: 50px">
        <div class="col-12 text-center">
            <p class="texto_pontos  letra" style="font-size: 25pt;">Seus pontos:</p><h1 class="texto_pontos letra" style="font-size: 25pt;" id="number_panel"><?= $total_pontos ?></h1>
        </div>
    </div>
    <div class="col-12 text-center mt-4 gold_text">
        <i class="fa-solid fa-star" id="star_1"></i>
    </div>
    <div class="row fade_in_effect">
        <div class="col-sm-6 offset-sm-3 text-center gold_text">
            <br>
            <h1 class="text-center gold_text letra" style="font-size: 25pt;">Prêmio adquirido com sucesso!</h1>
            <p>Pode visualizar seu prêmio no seu panel de pontos do usuario!</p>
            <p>A confirmação do prêmio adquirido foi enviada pelo email, junto com seu código do Prêmio</p>
            <div class="my-5"><a href="?a=loja_premios" class="btn btn-warning" id="boton_1">Continuar</a></div>
        </div>
    </div>
    <div class="row">
        <div class="col-2 text-center mt-4 gold_text">
            <i class="fa-solid fa-star" id="star_1"></i>
        </div>
        <div class="col-8"></div>
        <div class="col-2 text-center mt-4 gold_text">
            <i class="fa-solid fa-star" id="star_1"></i>
        </div>
    </div>

</div>

<!--//////////////////////////////////////////////////////////-->

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
</script>