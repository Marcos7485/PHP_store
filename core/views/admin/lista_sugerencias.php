<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">
        <div class="col-md-2">
            <?php

            use core\classes\Store;

            include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>
        <div class="col-10 hide">
            <h1 class="text-center gold_text letra" style="font-size:45pt;">Lista de Sugerencias</h1>
        </div>
        
        <!--CELULAR/////////////////////////////////////-->
        <div class="col-10 show">
            <h1 class="text-center gold_text letra" style="font-size:25pt;">Lista de Sugerencias</h1>
        </div>
        <!--CELULAR//////////////////////////////////////////////////////-->
        
        <div class="row gold_text">
            <div class="col-2 hide"></div>
            <div class="col-10">
                <?php if (count($lista_sugerencias) == 0) : ?>
                    <hr>
                    <p class="gold_text text-center" style="font-size: 25pt;">Não existem sugerencias registradas. </p>

                <?php else : ?>
                    <small>
                        <table class="table gold_text" id="tabela-sugerencias">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>ID Cliente</th>
                                    <th>Sugerencia</th>
                                    <th>Criada</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($lista_sugerencias as $sugerencia) : ?>
                                    <tr>
                                        <td><?= $sugerencia->id_sugerencia ?></td>
                                        <td><?= $sugerencia->id_cliente ?></td>
                                        <td><?= $sugerencia->sugerencia ?></td>
                                        <td><?= $sugerencia->created_at ?></td>
                                        <?php if($sugerencia->activo == 1): ?>

                                        <td><a href="?a=marcar_lido&id=<?= Store::aesEncriptar($sugerencia->id_sugerencia) ?>"><button style="color:blue; border-radius: 50%;"><i class="fa-solid fa-envelope"></i></button></a></td>
                                        <?php else: ?>
                                            <td><button style="color:green; border-radius: 50%;"><i class="fa-regular fa-envelope-open"></i></button></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </small>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!--CELULAR/////////////////////////////////////-->
   
    <!--CELULAR//////////////////////////////////////////////////////-->
</div>



<script>
    $(document).ready(function() {
        $('#tabela-sugerencias').DataTable({
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
                },
            },
            columnDefs: [{
                type: 'num-fmt',
                targets: 0
            }],
            order: [
                [0, 'desc']
            ]
        });
    });
</script>