<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php

            use core\classes\Store;

            include(__DIR__ . '/layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 fade_in_effect">

            <div class="row gold_text">
                <div class="col">
                    <h4>DETALHE ENCOMENDA <h5 class="texto_pontos">Pontos: <?= $encomenda->pontos ?></h5>
                    </h4><small><?= $encomenda->codigo_encomenda ?></small>
                </div>
                <div class="col text-end">
                    <div class="p-3 badge bg-primary" onclick="apresentarModal()"><?= $encomenda->status ?></div>
                </div>
            </div>




            <?php $total_valor = 0; ?>
            <hr>

            <div class="row gold_text ">
                <div class="col">
                    <p>Nome cliente:<br><strong><?= $encomenda->nome_completo ?></strong></p>
                    <p>Email:<br><strong><?= $encomenda->email ?></strong></p>
                    <p>Telefone:<br><strong><?= $encomenda->telefone ?></strong></p>
                </div>
                <div class="col">
                    <p>Data encomenda:<br><strong><?= $encomenda->data_encomenda ?></strong></p>
                    <p>Endereço:<br><strong><?= $encomenda->morada ?></strong></p>
                    <p>Cidade:<br><strong><?= $encomenda->cidade ?></strong></p>
                </div>
            </div>

            <hr>
            <table class="table gold_text">
                <thead class="table-dark">
                    <th class="text-center">Produto</th>
                    <th class="text-center">Preco / Uni.</th>
                    <th class="text-center">Pontos / Uni.</th>
                    <th class="text-center">Quantidade</th>
                </thead>
                <tbody>
                    <?php foreach ($lista_produtos as $produto) : ?>
                        <tr>
                            <?php $total_valor += ($produto->preco_unidade * $produto->quantidade); ?>
                            <td class="text-center"><?= $produto->designacao_produto ?></td>
                            <td class="text-center">R$<?= $produto->preco_unidade ?></td>
                            <td class="texto_pontos text-center"><b><?= $produto->pontos ?></b></td>
                            <td class="text-center"><?= $produto->quantidade ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="col">
            <h4 class="text-end gold_text">Envio: <strong>R$ <?= number_format($encomenda->envio, 2, ',', '.') ?></strong></h4>
            <h4 class="text-end gold_text">Total encomenda: <strong>R$ <?= number_format(($total_valor + $encomenda->envio ), 2, ',', '.') ?></strong></h4>
            </div>
        </div>


    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar estado da encomenda</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="text-center">
                    <?php foreach (STATUS as $estado) : ?>

                        <?php if ($encomenda->status == $estado) : ?>
                            <p><?= $estado ?></p>
                        <?php else : ?>
                            <p><a href="?a=encomenda_alterar_estado&e=<?= Store::aesEncriptar($encomenda->id_encomenda) ?>&s=<?= $estado ?>"><?= $estado ?></a></p>
                        <?php endif; ?>

                    <?php endforeach; ?>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function apresentarModal() {
        var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus'));
        modalStatus.show();
    }
</script>