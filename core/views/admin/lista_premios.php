<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php

use core\classes\Store;

 include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 gold_text">

            <h3 class="text-center">Lista de premios <?= $filtro != '' ? $filtro : '' ?></h3>
            <hr>

            <div class="row">
                <div class="col text-center">
                    <a href="?a=lista_premios" class="btn btn-primary btn-sm">Ver todos os premios</a>
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
                            <select id="combo-status" onchange="definir_filtro_premios()">
                                <option value="" <?= $f == '' ? 'selected' : '' ?>></option>
                                <option value="pendente" <?= $f == 'pendente' ? 'selected' : '' ?>>Pendente</option>
                                <option value="recebida" <?= $f == 'recebida' ? 'selected' : '' ?>>Recebida</option>
                            </select>
                        </div>


                    </div>

                </div>
            </div>


            <?php if (count($lista_premios) == 0) : ?>
                <hr>
                <p class="gold_text">Não existem premios registradas. </p>

            <?php else : ?>
                <small>
                    <table class="table gold_text" id="tabela-premios">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Codigo</th>
                                <th>Nome do cliente</th>
                                <th>ID cliente</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Preco</th>
                                <th>Criada em</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($lista_premios as $premio) : ?>
                                <tr>
                                    <td><?= $premio->id_premio ?></td>
                                    <td><?= $premio->codigo ?></td>
                                    <td><?= $premio->nome_completo ?></td>
                                    <td><?= $premio->id_cliente ?></td>
                                    <td><?= $premio->telefone ?></td>
                                    <td><a href="?a=detalhe_premio&p=<?= Store::aesEncriptar($premio->id_peticao) ?>"><?= $premio->status ?></a></td>
                                    <td class="texto_pontos"><b><?= $premio->coste ?></b></td>
                                    <td><?= $premio->created_at ?></td>
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
        $('#tabela-premios').DataTable({
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

    function definir_filtro_premios() {
        var filtro = document.getElementById("combo-status").value;
        // reload pagina com filtro
        window.location.href = window.location.pathname + "?" + $.param({
            'a': 'premios',
            'f': filtro
        });

    }
</script>