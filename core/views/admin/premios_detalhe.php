<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php

            use core\classes\Store;

            include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 fade_in_effect">

            <div class="row gold_text">
                <div class="col">
                    <h4>DETALHE PREMIO <h5 class="texto_pontos">Coste Pontos: <?= $premio->coste ?></h5>
                    </h4><small><?= $premio->codigo ?></small>
                </div>
                <div class="col text-end">
                    <div class="p-3 badge bg-primary" onclick="apresentarModal_premio()"><?= $premio->status ?></div>
                </div>
            </div>




            <?php $total_valor = 0; ?>
            <hr>

            <div class="row gold_text ">
                <div class="col">
                    <p>Nome cliente:<br><strong><?= $premio->nome_completo ?></strong></p>
                    <p>ID CLiente:<br><strong><?= $premio->id_cliente ?></strong></p>
                    <p>Telefone:<br><strong><?= $premio->telefone ?></strong></p>
                </div>
                <div class="col">
                    <p>Data encomenda:<br><strong><?= $premio->created_at ?></strong></p>
                    <p></p>
                    <p></p>
                </div>
            </div>

            <hr>
            <table class="table gold_text">
                <thead class="table-dark">
                    <th class="text-center">Produto</th>
                    <th class="text-center">Preco</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </thead>
                <tbody>
                    <?php foreach ($lista_premios as $premio) : ?>
                        <tr>
                            <td class="text-center"><?= $premio->id_premio ?></td>
                            <td class="text-center">Pontos: <?= $premio->coste ?></td>
                            <td class="texto_pontos text-center"></td>
                            <td class="text-center"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="col">
            <h4 class="text-end gold_text"></h4>
            <h4 class="text-end gold_text"></h4>
            </div>
        </div>


    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalStatus_premio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar estado do premio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="text-center">
                    <?php foreach (STATUS_PREMIO as $estado) : ?>

                        <?php if ($premio->status == $estado) : ?>
                            <p><?= $estado ?></p>
                        <?php else : ?>
                            <p><a href="?a=premio_alterar_estado&p=<?= Store::aesEncriptar($premio->id_peticao) ?>&s=<?= $estado ?>"><?= $estado ?></a></p>
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
    function apresentarModal_premio() {
        var modalStatus = new bootstrap.Modal(document.getElementById('modalStatus_premio'));
        modalStatus.show();
    }
</script>