<?php

use core\classes\Envio;
use core\classes\Horario;

$envio = new Envio();
$horario = new horario();

?>

<div class="container hide">
    <div class="row fade_in_effect">
        <div class="col">
            <h3 class="text-center my-3 titulos">A sua encomenda - Resumo</h3>
            <hr>
        </div>
    </div>
</div>


<!--Celular//////////////////////////////////////////////-->

<div class="container show">
    <div class="row fade_in_effect">
        <div class="col">
            <h3 class="text-center my-3 titulos" style="padding-top: 30px;">A sua encomenda - Resumo</h3>
            <hr>
        </div>
    </div>
</div>
<!--Celular//////////////////////////////////////////////-->

<div class="container">
    <!--ERRORS///////////////////////////////////////////////-->
    <?php if (isset($_SESSION['erro'])) : ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION['erro'] ?>
            <?php unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>
    <!--ERRORS///////////////////////////////////////////////-->
    <!--WEB//////////////////////////////////////////////-->
    <div class="row fade_in_effect hide">
        <div class="col">
            <div style="margin-bottom: 70px;">
                <table class="table gold_text">
                    <thead class="table-dark" style="font-size: 15pt;">
                        <tr>
                            <th>Produto</th>
                            <th class="text-center">Quantidade</th>
                            <th class="text-end">Valor</th>
                            <th class="text-end">Pontos</th>
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
                                    <td class="align-middle"><?= $produto['titulo'] ?></td>
                                    <td class="text-center align-middle"><?= $produto['quantidade'] ?></td>
                                    <td class="text-end align-middle" style="font-size: 25pt;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                    <td class="text-end align-middle texto_pontos"><b><?= $produto['pontos'] ?></b></td>
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
                            <td><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px">Crédito/Débito</td>
                            <td class="text-end align-middle"><b>Valor total:</b></td>
                            <td class="text-center letra" style="font-size: 30pt;"><b>R$ <?= number_format($carrinho[$total_rows - 2], 2, ',', '.') ?></b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-end align-middle texto_pontos"><b>Pontos total:</b></td>
                            <td class="text-center texto_pontos letra" style="font-size: 50pt;"><b><?= $carrinho[$total_rows - 1] ?></b></td>
                        </tr>
                    </thead>
                </table>


                <!-- Dados do cliente -->
                <h5 class="bg-dark text-white p-2">Dados do Cliente</h5>
                <div class="row gold_text">
                    <div class="col">
                        <p>Nome: <strong><?= $cliente->nome_completo ?></strong></p>
                        <p>Destino (CEP): <strong><?= $_SESSION['cep'] ?></strong></p>
                        <p>Cidade: <strong><?= $cliente->cidade ?></strong></p>
                    </div>
                    <div class="col">
                        <p>Email: <strong><?= $cliente->email ?></strong></p>
                        <p>Telefone: <strong><?= $cliente->telefone ?></strong></p>
                    </div>
                </div>

                <!-- Dados de pagamento -->
                <h5 class="bg-dark text-white p-2">Dados do pagamento</h5>
                <div class="row gold_text">
                    <div class="col">
                        <p><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="100px"> (Num cel: 48 9990 6903)</p>
                        <p>(No caso de realizar o pago pelo pix, enviar o comprovante ao nosso atendimento direto para otimizar o processo!)</p>
                        <p><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px"> Cartão de Créito/Débito: Enviaremos links de pagamento em breve no seu WhatsApp</p>
                        <p>Código da encomenda: <strong><?= $_SESSION['codigo_encomenda'] ?></strong></p>
                        <p>Total:<strong> R$ <?= number_format($carrinho[$total_rows - 2], 2, ',', '.') ?></strong></p>
                        <p id="tex_env" style="font-size: 18pt; color:goldenrod; text-shadow: 1px 1px 1px purple;"></p>
                        <p id="tex_tot" style="font-size: 18pt; color:goldenrod; text-shadow: 1px 1px 1px purple;"></p>
                    </div>
                </div>

                <!-- Morada alternativa -->
                <h5 class="bg-dark text-white p-2 gold_text">Dados de entrega</h5>

                <div class="form-check gold_text">
                    <input class="form-check-input" onchange="usar_morada_alternativa(), pres()" type="checkbox" name="check_morada_alternativa" id="check_morada_alternativa">
                    <label class="form-check-label" for="check_morada_alternativa">Definir CEP de entrega diferente: Actual (<?= $_SESSION['cep'] ?>)</label>
                </div>

                <!-- Morada alternativa -->
                <div id="morada_alternativa" style="display: none;">

                    <!-- morada -->
                    <div class="my-3 gold_text">
                        <form action="" method="post">
                            <label for="cep">CEP:</label>
                            <input type="text" id="text_cep_alternativo" name="text_cep_alternativo" placeholder="Ej. 12345-678" required>
                            <input type="submit" class="btn btn-sm btn-success" onclick="cep_alternativo()" value="Estabelecer">
                        </form>
                    </div>

                </div>

                <!-- Loja Aberta -->
                <?php if ($horario->aberto() == 'true') : ?>
                    <div class="row">
                        <div class="col-12 text-center gold_text p-3">
                            <form action="?a=finalizar_compra" method="post">
                                <p class="letra" style="font-size: 23pt; text-shadow: 2px 2px 2px black;">Como gostaria receber o produto?</p><input type="radio" name="envio" value="adicionar_envio" id="envio_sim" onclick="pres(),adic_envio()" required> Adicionar envio <input type="radio" name="envio" value="no_local" id="envio_nao" onchange="pres(),adic_envio()"> Procuro no local
                        </div>
                    </div>

                    <div class="row my-5 gold_text">
                        <div class="col">
                            <a href="?a=carrinho" class="btn btn-danger">Cancelar</a>
                        </div>
                        <div class="col text-end">
                            <input type="submit" class="btn btn-sm btn-success" value="Finalizar compra">
                            </form>
                        </div>
                    </div>
                    <!-- Loja Aberta///////////////-->
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 text-center gold_text p-3">
                            <form action="?a=agendar_compra" method="post">
                                <p class="letra" style="font-size: 23pt; text-shadow: 2px 2px 2px black;">Como gostaria receber o produto?</p><input type="radio" name="envio" value="adicionar_envio" id="envio_sim" onclick="pres(),adic_envio()" required> Adicionar envio <input type="radio" name="envio" value="no_local" id="envio_nao" onclick="pres(),adic_envio()"> Procuro no local
                        </div>
                    </div>

                    <div class="row my-5 gold_text">
                        <div class="alert alert-warning p2 text-center">
                            <span class="me-3">A loja fechada só permite agendar compras que seram processadas após apertura da loja.<br>Pode conferir os horarios clicando na placa de "FECHADO" da loja.<br>Qualquier dúvida pode se contactar com nosso atendimento direto, Obrigado!</span>
                        </div>
                        <div class="col">
                            <a href="?a=carrinho" class="btn btn-danger">Cancelar</a>
                        </div>
                        <div class="col text-end">
                            <input type="submit" class="btn btn-sm btn-success" value="Agendar compra">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!--WEB//////////////////////////////////////////////-->


    <!--CELULAR//////////////////////////////////////////////-->
    <div class="row fade_in_effect show">
        <div class="col">
            <div style="margin-bottom: 70px;">
                <table class="table gold_text">
                    <thead class="table-dark" style="font-size: 15pt;">
                        <tr>
                            <th class="text-center" colspan="3">Produto</th>
                            <th>Qtde</th>
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
                                    <td class="align-middle" colspan="2"><?= $produto['titulo'] ?></td>
                                    <td class="text-center align-middle" style="font-size: 25pt;"><?= $produto['quantidade'] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle" colspan="4" style="font-size: 25pt;">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center align-middle texto_pontos letra" colspan="4" style="font-size: 25pt;"><b>Pontos: <?= $produto['pontos'] ?></b></td>
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
                            <td><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="60px"><br><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="30px">Crédito/Débito</td>
                            <td class="text-end align-middle" colspan="4" style="font-size: 16pt;"><b>Total: R$ <?= number_format(($carrinho[$total_rows - 2]), 2, ',', '.') ?></b></td>
                        </tr>
                        <tr>
                            <td class="text-end align-middle texto_pontos letra" colspan="2" style="font-size: 25pt;"><b>Pontos total:</b></td>
                            <td class="text-center texto_pontos letra" colspan="3" style="font-size: 50pt;border-radius: 10%;" id="number"><b><?= $carrinho[$total_rows - 1] ?></b></td>
                        </tr>
                    </thead>
                </table>


                <!-- Dados do cliente -->
                <h5 class="bg-dark text-white p-2 text-center">Dados do Cliente</h5>
                <div class="row gold_text text-center">
                    <div class="col">
                        <p>Nome: <br><strong><?= $cliente->nome_completo ?></strong></p>
                        <p>Destino (CEP):<br><strong><?= $_SESSION['cep'] ?></strong></p>
                        <p>Cidade: <br><strong><?= $cliente->cidade ?></strong></p>
                    </div>
                    <div class="col">
                        <p>Email: <br><strong><?= $cliente->email ?></strong></p>
                        <p>Telefone: <br><strong><?= $cliente->telefone ?></strong></p>
                    </div>
                </div>

                <!-- Dados de pagamento -->
                <h5 class="bg-dark text-white p-2 text-center">Dados do pagamento</h5>
                <div class="row gold_text">
                    <div class="col text-center">
                        <p><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="100px">
                        <p style="font-size: 15pt;"><strong>(Num cel: 48 9990 6903)</strong></p>
                        </p>
                        <p>No caso de realizar o pago pelo pix, enviar o comprovante ao nosso atendimento direto para otimizar o processo!</p>
                        <p><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px">
                        <p style="font-size: 15pt;"><strong>Cartão de Créito/Débito:</strong></p><br>Enviaremos links de pagamento em breve no seu WhatsApp</p>
                        <p style="font-size: 15pt;"><strong>Código da encomenda:</strong><br><strong><?= $_SESSION['codigo_encomenda'] ?></strong></p>
                        <p style="font-size: 15pt;">Total:<br></Total:br><strong> R$ <?= number_format($carrinho[$total_rows - 2], 2, ',', '.') ?></strong></p>
                        <p id="tex_env_cel" style="font-size: 18pt; color:goldenrod; text-shadow: 1px 1px 1px purple;"></p>
                        <p id="tex_tot_cel" style="font-size: 18pt; color:goldenrod; text-shadow: 1px 1px 1px purple;"></p>
                    </div>
                </div>

                <!-- Morada alternativa -->
                <h5 class="bg-dark text-white p-2 gold_text text-center">Dados de entrega</h5>

                <div class="form-check gold_text">
                    <input class="form-check-input" onchange="usar_morada_alternativa_cel(), pres()" type="checkbox" name="check_morada_alternativa_cel" id="check_morada_alternativa_cel">
                    <label class="form-check-label" for="check_morada_alternativa_cel">Definir CEP de entrega diferente: Actual (<?= $_SESSION['cep'] ?>)</label>
                </div>

                <!-- Morada alternativa -->
                <div id="morada_alternativa_cel" style="display: none;">

                    <!-- morada -->
                    <div class="my-3 gold_text">
                        <form action="" method="post">
                            <label for="cep">CEP:</label>
                            <input type="text" id="text_cep_alternativo_cel" name="text_cep_alternativo_cel" placeholder="Ej. 12345-678" required>
                            <input type="submit" class="btn btn-sm btn-success" onclick="cep_alternativo_cel()" value="Estabelecer">
                        </form>
                    </div>

                </div>

                <!-- Loja Aberta -->
                <?php if ($horario->aberto() == 'true') : ?>
                    <div class="row">
                        <div class="col-12 text-center gold_text p-3">
                            <form action="?a=finalizar_compra" method="post">
                                <p style="font-size: 23pt; text-shadow: 2px 2px 2px black; padding-top: 30px;">Como gostaria receber o produto?</p>
                                <p style="font-size: 18pt;"><br><input type="radio" name="envio" value="adicionar_envio" id="envio_sim_cel" onclick="pres_cel(),adic_envio_cel()" required> Adicionar envio </p>
                                <p style="font-size: 18pt;"><input type="radio" name="envio" value="no_local" id="envio_nao_cel" onchange="pres_cel(),adic_envio_cel()"> Procuro no local</p>
                        </div>
                    </div>

                    <div class="row my-5 gold_text">
                        <div class="col">
                            <a href="?a=carrinho" class="btn btn-danger">Cancelar</a>
                        </div>
                        <div class="col text-end">
                            <input type="submit" class="btn btn-sm btn-success" value="Finalizar compra">
                            </form>
                        </div>
                    </div>
                    <!-- Loja fechada///////////////-->
                <?php else : ?>
                    <div class="row">
                        <div class="col-12 text-center gold_text p-3">
                            <form action="?a=agendar_compra" method="post">
                                <p style="font-size: 23pt; text-shadow: 2px 2px 2px black; padding-top: 30px;">Como gostaria receber o produto?</p>
                                <p style="font-size: 18pt;"><br><input type="radio" name="envio" value="adicionar_envio" id="envio_sim_cel" onclick="pres_cel(),adic_envio_cel()" required> Adicionar envio </p>
                                <p style="font-size: 18pt;"><input type="radio" name="envio" value="no_local" id="envio_nao_cel" onchange="pres_cel(),adic_envio_cel()"> Procuro no local</p>
                        </div>
                    </div>

                    <div class="row my-5 gold_text">
                        <div class="alert alert-warning p2 text-center">
                            <span class="me-3">A loja fechada só permite agendar compras que seram processadas após apertura da loja.<br>Pode conferir os horarios clicando na placa de "FECHADO" da loja.<br>Qualquier dúvida pode se contactar com nosso atendimento direto, Obrigado!</span>
                        </div>
                        <div class="col">
                            <a href="?a=carrinho" class="btn btn-danger">Cancelar</a>
                        </div>
                        <div class="col text-end">
                            <input type="submit" class="btn btn-sm btn-success" value="Agendar compra">
                            </form>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
    <!--CELULAR//////////////////////////////////////////////-->
</div>





<?php
$dist = $envio->calcular_envio_J($_SESSION['cep']);
$coste = $envio->calcular_coste($dist);
?>


<script>
    function pres() {
        if (document.getElementById("envio_sim").checked) {
            if (!document.getElementById('check_morada_alternativa').checked) {
                document.getElementById('tex_env').innerHTML = "+ Envio ao CEP(<?= $_SESSION['cep'] ?>) : R$ <?= $coste ?>";
                document.getElementById('tex_tot').innerHTML = "TOTAL (+ Envio): R$ <?= $carrinho[$total_rows - 2] + $coste ?>";
            } else {
                document.getElementById('tex_env').innerHTML = "+ Envio ao CEP(Novo CEP) : Selecione 'Estabelecer'";
                document.getElementById('tex_tot').innerHTML = "TOTAL (+ Envio): R$ <?= $carrinho[$total_rows - 2] ?>";
            }
        } else if (document.getElementById("envio_nao").checked) {
            document.getElementById('tex_env').innerHTML = "Pocura no local";
            document.getElementById('tex_tot').innerHTML = "TOTAL: R$ <?= $carrinho[$total_rows - 2] ?>";

        }
    }

    function pres_cel() {
        if (document.getElementById("envio_sim_cel").checked) {
            if (!document.getElementById('check_morada_alternativa_cel').checked) {
                document.getElementById('tex_env_cel').innerHTML = "+ Envio ao CEP(<?= $_SESSION['cep'] ?>) : R$ <?= $coste ?>";
                document.getElementById('tex_tot_cel').innerHTML = "TOTAL (+ Envio): R$ <?= $carrinho[$total_rows - 2] + $coste ?>";
            } else {
                document.getElementById('tex_env_cel').innerHTML = "+ Envio ao CEP(Novo CEP) : Selecione 'Estabelecer'";
                document.getElementById('tex_tot_cel').innerHTML = "TOTAL (+ Envio): R$ <?= $carrinho[$total_rows - 2] ?>";
            }
        } else if (document.getElementById("envio_nao_cel").checked) {
            document.getElementById('tex_env_cel').innerHTML = "Pocura no local";
            document.getElementById('tex_tot_cel').innerHTML = "TOTAL: R$ <?= $carrinho[$total_rows - 2] ?>";

        }
    }
</script>