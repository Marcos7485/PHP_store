<div class="container-fluid hide">
    <?php

    use core\classes\Store; ?>
    <div class="row mt-3 mb-5 fade_in_effect">
        <div class="col-12">
            <h1 class="text-center gold_text letra" style="font-size:45pt;">Lista de Sugestões</h1>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <?php if (count($sugerencias) == 0) : ?>
                    <hr>
                    <p class="gold_text text-center" style="font-size: 25pt;">Não existem sugestões registradas. </p>

                <?php else : ?>
                    <small>
                        <table class="table gold_text" id="tabela-premios">
                            <thead class="table-dark">
                                <tr>
                                    <th>Data</th>
                                    <th>Sugestão</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($sugerencias as $sugerencia) : ?>
                                    <tr>
                                        <td><?= $sugerencia->created_at ?></td>
                                        <td><?= $sugerencia->sugerencia ?></td>
                                        <?php if ($sugerencia->activo == 1) : ?>
                                            <td><i class="fa-solid fa-envelope"> Enviada</i></button></td>
                                        <?php else : ?>
                                            <td><i class="fa-regular fa-envelope-open"> Lido</i></button></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </small>
                <?php endif; ?>
            </div>
            <div class="col-2">
                <div class="btn btn-cestas" onclick="sugerencia_m()"><i class="fa-solid fa-feather"></i> <b>Nova sugestão</b></div>
            </div>
        </div>
    </div>
</div>



<!--CELULAR//////////////////////////////////////-->

<div class="container-fluid show">
    <div class="row mt-3 mb-5 fade_in_effect">
        <div class="col-12">
            <h1 class="text-center gold_text letra" style="font-size:25pt;">Lista de Sugestões</h1>
        </div>
        <div class="row">
            <div class="col-12" style="padding-left: 30px;">
                <?php if (count($sugerencias) == 0) : ?>
                    <hr>
                    <p class="gold_text text-center" style="font-size: 15pt;">Não existem sugestões registradas. </p>

                <?php else : ?>
                    <small>
                    <table class="table gold_text">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Sugestões</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($sugerencias as $sugerencia) : ?>
                                <tr>
                                    <td><?= $sugerencia->created_at ?></td>
                                    <td><?= $sugerencia->sugerencia ?></td>
                                    <?php if ($sugerencia->activo == 1) : ?>
                                        <td><i class="fa-solid fa-envelope">Enviada</i></button></td>
                                    <?php else : ?>
                                        <td><i class="fa-regular fa-envelope-open">Lido</i></button></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </small>
                <?php endif; ?>
            </div>
            <div class="col-12 text-center" style="padding-left: 30px; padding-bottom: 50px;">
                <div class="btn btn-cestas" onclick="sugerencia_modal_cel()"><i class="fa-solid fa-feather"></i> <b>Nova sugestão</b></div>
            </div>
        </div>
    </div>
</div>

<!--CELULAR//////////////////////////////////////-->


<!-- Modal sugerencia -->
<div class="modal fade" id="sugerencia_m" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Contanos, que o procuraremos!!<br></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <form action="?a=sugerencia_add_perfil" method="post">
                        <textarea id="sugerencia" name="sugerencia" rows="5" cols="40" maxlength="500"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <span id="counter" class="gold_text"></span>
                <p class="gold_text">/500</p>
                <input type="submit" value="Sugerir!" class="btn btn-warning">
                </form>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal sugerencia CEL-->
<div class="modal fade" id="sugerencia_modal_cel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Contanos, que o procuraremos!!<br></h1>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <form action="?a=sugerencia_add_perfil" method="post">
                        <textarea id="sugerencia_cel" name="sugerencia" rows="5" cols="30" maxlength="500"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <span id="counter_cel" class="gold_text"></span>
                <p class="gold_text">/500</p>
                <input type="submit" value="Sugerir!" class="btn btn-warning">
                </form>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>



<script>
    function sugerencia_m() {
        var modalStatus = new bootstrap.Modal(document.getElementById('sugerencia_m'));
        modalStatus.show();
    }

    
    function sugerencia_modal_cel() {
        var modalStatus = new bootstrap.Modal(document.getElementById('sugerencia_modal_cel'));
        modalStatus.show();
    }

    var input = document.getElementById('sugerencia');
    var input_cel = document.getElementById('sugerencia_cel');
    var counter = document.getElementById('counter');
    var counter_cel = document.getElementById('counter_cel');

    input.addEventListener('input', function() {
        counter.textContent = input.maxLength - input.value.length;
    });

    input_cel.addEventListener('input', function() {
        counter_cel.textContent = input_cel.maxLength - input_cel.value.length;
    });
</script>