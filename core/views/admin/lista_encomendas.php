<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php

use core\classes\Store;

 include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 gold_text">

            <h3 class="text-center">Lista de encomendas <?= $filtro != '' ? $filtro : '' ?></h3>
            <hr>

            <div class="row">
                <div class="col text-center">
                    <a href="?a=lista_encomendas" class="btn btn-primary btn-sm">Ver todas as encomendas</a>
                </div>
                <div class="col">
                    <div class="d-inline-flex">
                        <?php
                        $f = '';
                        if (isset($_GET['f'])) {
                            $f = $_GET['f'];
                        }
                        ?>

                        <div class="d-inline-flex">
                            <div><span>Escolher estado:</span></div>
                            <select id="combo-status" onchange="definir_filtro()">
                                <option value="" <?= $f == '' ? 'selected' : '' ?>></option>
                                <option value="pendente" <?= $f == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                <option value="em_processamento" <?= $f == 'em_processamento' ? 'selected' : '' ?>>Em processamento</option>
                                <option value="enviada" <?= $f == 'enviada' ? 'selected' : '' ?>>Enviada</option>
                                <option value="cancelada" <?= $f == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
                                <option value="concluida" <?= $f == 'concluida' ? 'selected' : '' ?>>Concluida</option>
                            </select>
                        </div>


                    </div>

                </div>
            </div>


            <?php if (count($lista_encomendas) == 0) : ?>
                <hr>
                <p class="gold_text">Não existem encomendas registradas. </p>

            <?php else : ?>
                <small>
                    <table class="table gold_text" id="tabela-encomendas">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Código</th>
                                <th>Nome do cliente</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Pontos</th>
                                <th>Atualizado em</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($lista_encomendas as $encomenda) : ?>
                                <tr>
                                    <td><?= $encomenda->data_encomenda ?></td>
                                    <td><?= $encomenda->codigo_encomenda ?></td>
                                    <td><?= $encomenda->nome_completo ?></td>
                                    <td><?= $encomenda->email ?></td>
                                    <td><?= $encomenda->telefone ?></td>
                                    <td><a href="?a=detalhe_encomenda&e=<?= Store::aesEncriptar($encomenda->id_encomenda) ?>"><?= $encomenda->status ?></a></td>
                                    <td class="texto_pontos"><b><?= $encomenda->pontos ?></b></td>
                                    <td><?= $encomenda->updated_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </small>
            <?php endif; ?>
            <hr>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#tabela-encomendas').DataTable({
            language: {
                lengthMenu: "Ver _MENU_ por página",
                zeroRecords: "Não foram encontradas informações",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "Não existem informações disponíveis",
                infoFiltered: "(Filtrado de _MAX_ totais)",
                paginate: {
                    first: "Primeira",
                    last: "Última",
                    next: "Seguinte",
                    previous: "Anterior"
                }
            }
        });
    });

    function definir_filtro() {
        var filtro = document.getElementById("combo-status").value;
        // reload pagina com filtro
        window.location.href = window.location.pathname + "?" + $.param({
            'a': 'lista_encomendas',
            'f': filtro
        });

    }
</script>