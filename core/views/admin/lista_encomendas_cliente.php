<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 gold_text">

            <h3 class="text-center">Lista de encomendas do cliente</h3>
            <hr>
                <div class="row">
                    <div class="col">Nome: <strong><?= $cliente->nome_completo ?></strong></div>
                    <div class="col">Telefone: <strong><?= $cliente->telefone ?></strong></div>
                    <div class="col">Email: <strong><?= $cliente->email ?></strong></div>
                </div>
                
            <hr>

            <?php if (count($lista_encomendas) == 0) : ?>
                <hr>
                <p>Não existem encomendas registradas. </p>

            <?php else : ?>
                <small>
                    <table class="table gold_text" id="tabela-encomendas">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Endereço</th>
                                <th>Cidade</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Código</th>
                                <th>Status</th>
                                <th>Pontos</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($lista_encomendas as $encomenda) : ?>
                                <tr>
                                    <td><?= $encomenda->data_encomenda ?></td>
                                    <td><?= $encomenda->morada ?></td>
                                    <td><?= $encomenda->cidade ?></td>
                                    <td><?= $encomenda->email ?></td>
                                    <td><?= $encomenda->telefone ?></td>
                                    <td><?= $encomenda->codigo_encomenda ?></td>
                                    <td><?= $encomenda->status ?></td>
                                    <td class="texto_pontos"><b><?= $encomenda->pontos ?></b></td>
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
            language:{
                lengthMenu: "Ver _MENU_ por página",
                zeroRecords: "Não foram encontradas informações",
                info: "Página _PAGE_ de _PAGES_",
                infoEmpty: "Não existem informações disponíveis",
                infoFiltered: "(Filtrado de _MAX_ totais)",
                paginate: {
                first:      "Primeira",
                last:       "Última",
                next:       "Seguinte",
                previous:   "Anterior"
                }
            }
        });
    });

    function definir_filtro(){
        var filtro = document.getElementById("combo-status").value;
        // reload pagina com filtro
        window.location.href = window.location.pathname+"?"+$.param({'a':'lista_encomendas','f': filtro});
        
    }
</script>