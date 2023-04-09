<div class="container hide">
    <div class="row my-5 text-center gold_text fade_in_effect">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center letra" style="font-size: 40pt; padding-top: 60px;">Compra Agendada!</h3>
            <p style="font-size: 15pt; color: gold;">Muito obrigado por sua compra!</p>

            <div class="my-2">
                <h4>Dados de Pagamento:</h4>
                <p style="font-size: 20pt; color: white;">A primeira hora nos comunicaremos com voce via WhatsApp para processar o pagamento</p>
                <p><i class="fa-brands fa-pix"></i> Pix</p>
                <p><i class="fa-regular fa-credit-card"></i> Cartão de crédito</p>
                <p><i class="fa-solid fa-credit-card"></i> Cartão de débito</p>
                <p style="font-size: 15pt; color: gold;">Código da encomenda: <br><strong><?= $codigo_encomenda ?></strong></p>
                <p style="font-size: 15pt; color: gold;">Valor dos produtos: <br><strong>R$ <?= number_format($total_encomenda, 2, ',', '.') ?></strong></p>
                <p style="font-size: 15pt; color: gold;">Total da encomenda (+ Envio): <br><strong>R$ <?= number_format($total_com_envio, 2, ',', '.') ?></strong></p>
            </div>

            <p style="font-size: 15pt; color: gold;">
                -Vai receber um email com a confirmação da sua compra.
                <br>
                -A sua encomenda só será processada após nosso horario de apertura.
                <br>
            </p>
            <p><small>Verifique se o email aparece na sua conta ou se foi para a pasta do SPAM.</small></p>
            <div class="my-5"><a href="?a=reset_carrinho" class="btn btn-warning" id="boton_1">Voltar</a></div>

        </div>
    </div>
</div>


<!-- CELULAR////////////////////////////////////////////-->

<div class="container show">
    <div class="row my-5 text-center gold_text fade_in_effect">
        <div class="col-sm-6 offset-sm-3">
            <h3 class="text-center letra" style="font-size: 40pt; padding-top: 60px;">Compra Agendada!</h3>
            <p style="font-size: 15pt; color: gold;">Muito obrigado por sua compra!</p>

            <div class="my-2">
                <h4>Dados de Pagamento:</h4>
                <p style="font-size: 20pt; color: white;">A primeira hora nos comunicaremos com voce via WhatsApp para processar o pagamento</p>
                <p><i class="fa-brands fa-pix"></i> Pix</p>
                <p><i class="fa-regular fa-credit-card"></i> Cartão de crédito</p>
                <p><i class="fa-solid fa-credit-card"></i> Cartão de débito</p>
                <p style="font-size: 15pt; color: gold;">Código da encomenda: <br><strong><?= $codigo_encomenda ?></strong></p>
                <p style="font-size: 15pt; color: gold;">Valor dos produtos: <br><strong>R$ <?= number_format($total_encomenda, 2, ',', '.') ?></strong></p>
                <p style="font-size: 15pt; color: gold;">Total da encomenda (+ Envio): <br><strong>R$ <?= number_format($total_com_envio, 2, ',', '.') ?></strong></p>
            </div>

            <p style="font-size: 15pt; color: gold;">
                -Vai receber um email com a confirmação da sua compra.
                <br>
                -A sua encomenda só sera processada após nosso horario de apertura.
                <br>
            </p>
            <p><small>Verifique se o email aparece na sua conta ou se foi para a pasta do SPAM.</small></p>
            <div class="my-5"><a href="?a=reset_carrinho" class="btn btn-warning" id="boton_1">Voltar</a></div>

        </div>
    </div>
</div>

<!-- CELULAR////////////////////////////////////////////-->