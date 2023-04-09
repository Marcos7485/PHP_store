<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">
        
        <div class="col-md-2">
            <?php

use core\classes\Store;

 include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 gold_text">
            <h3 class="text-center">Lista de clientes</h3>
            <hr>

            <?php if(count($clientes) == 0): ?>
                <p class="text-center text-muted">Não existem clientes registrados.</p>
            <?php else: ?>
                <!-- Apresenta a tabela de clientes -->
                <table class="table table-sm gold_text" id="tabela-clientes">
                    <thead class="table-dark">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <!-- ativo / inativo -->
                            <th class="text-center">Encomendas</th>
                            <th class="text-center">Criado em</th>
                            <th class="text-center">Ativo</th>
                            <th class="text-center">Eliminado</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($clientes as $cliente): ?>
                            <tr>
                                <td>
                                    <a href="?a=detalhe_cliente&c=<?= Store::aesEncriptar($cliente->id_cliente)?>"><?= $cliente->nome_completo ?></a>
                                </td>
                                <td><?= $cliente->email ?></td>
                                <td><?= $cliente->telefone ?></td>
                                <td class="text-center">
                                    <?php if($cliente->total_encomendas == 0): ?>
                                        -
                                    <?php else: ?>
                                        <a href="?a=lista_encomendas&c=<?= Store::aesEncriptar($cliente->id_cliente) ?>"><?= $cliente->total_encomendas ?></a>    
                                    <?php endif; ?> 
                                </td>
                                
                                <td class="text-center"><?= $cliente->created_at ?></td>
                                <!-- ativo -->
                                <td class="text-center">
                                    <?php if($cliente->activo == 1): ?>
                                        <i class="text-success fas fa-check-circle"></i>
                                    <?php else: ?>
                                        <i class="text-danger fas fa-times-circle"></i>
                                    <?php endif; ?>
                                </td>
                                <!-- eliminado -->
                                <td class="text-center">
                                    <?php if($cliente->deleted_at == null): ?>
                                        <i class="text-danger fas fa-times-circle"></i>
                                    <?php else: ?>
                                        <?= $cliente->deleted_at ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <?php ?>

        </div>

    </div>
</div>

<!-- tabela-clientes -->
<script>
    $(document).ready(function() {
        $('#tabela-clientes').DataTable({
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
</script>