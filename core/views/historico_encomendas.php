<div class="container-fluid hide">
    <div class="row mb-5">
        <div class="col-12 gold_text fade_in_effect">

            <h3 class="text-center letra" style="font-size: 30pt;">Historico de encomendas:</h3>

            <?php

            use core\classes\Store;

            if (count($historico_encomendas) == 0) : ?>
                <br>
                <p class="text-center" style="font-size: 20pt; font-style:oblique;">Não existem encomendas registradas.</p>
            <?php else : ?>
                <table class="table gold_text">
                    <thead class="table-dark">
                        <tr class="gold_text letra" style="font-size: 20pt;">
                            <th>Data de encomenda:</th>
                            <th>Código encomenda</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historico_encomendas as $encomenda) : ?>
                            <?php $data = new DateTime($encomenda->data_encomenda) ?>
                            <tr>
                                <td><?= $data->format('d/m/Y') ?></td>
                                <td><?= $encomenda->codigo_encomenda ?></td>
                                <?php if ($encomenda->status == 'AGENDADA') : ?>
                                    <td class="status_agendada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'PENDENTE') : ?>
                                    <td class="status_pendente"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'EM PROCESSAMENTO') : ?>
                                    <td class="status_processamento"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'ENVIADA') : ?>
                                    <td class="status_enviada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'CANCELADA') : ?>
                                    <td class="status_cancelada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'CONCLUIDA') : ?>
                                    <td class="status_concluida"><b><?= $encomenda->status ?></b></td>
                                <?php endif; ?>
                                <td>
                                    <a href="?a=detalhe_encomenda&id=<?= Store::aesEncriptar($encomenda->id_encomenda) ?>">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="text-end">Total encomendas: <strong><?= count($historico_encomendas) ?></strong></p>

            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Celular -->
<div class="container-fluid show">
    <div class="row mb-5">
        <div class="col-12 gold_text fade_in_effect">

            <h3 class="text-center letra" style="font-size: 25pt; padding-top: 25px;">Historico de encomendas:</h3>

            <?php if (count($historico_encomendas) == 0) : ?>
                <br>
                <p class="text-center" style="font-size: 20pt; font-style:oblique; padding-top: 30px;">Não existem encomendas registradas.</p>
            <?php else : ?>
                <table class="table gold_text" align="center">
                    <thead class="table-dark">
                        <tr class="gold_text letra" style="font-size: 20pt;">
                            <th>Data</th>
                            <th>Código</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historico_encomendas as $encomenda) : ?>
                            <?php $data = new DateTime($encomenda->data_encomenda) ?>
                            <tr>
                                <td><?= $data->format('d/m/y') ?></td>
                                <td><?= $encomenda->codigo_encomenda ?></td>
                                <?php if ($encomenda->status == 'AGENDADA') : ?>
                                    <td class="status_agendada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'PENDENTE') : ?>
                                    <td class="status_pendente"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'EM PROCESSAMENTO') : ?>
                                    <td class="status_processamento"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'ENVIADA') : ?>
                                    <td class="status_enviada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'CANCELADA') : ?>
                                    <td class="status_cancelada"><b><?= $encomenda->status ?></b></td>
                                <?php elseif ($encomenda->status == 'CONCLUIDA') : ?>
                                    <td class="status_concluida"><b><?= $encomenda->status ?></b></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <a href="?a=detalhe_encomenda&id=<?= Store::aesEncriptar($encomenda->id_encomenda) ?>">Detalhes</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <p class="text-end">Total encomendas: <strong><?= count($historico_encomendas) ?></strong></p>

            <?php endif; ?>
        </div>
    </div>
</div>

<!--////////////////////////////////////////////////////////////////-->