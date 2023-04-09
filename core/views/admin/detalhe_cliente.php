<div class="container-fluid">
    <div class="row mt-3">

        <div class="col-md-2">
            <?php

use core\classes\Store;

 include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-10 gold_text fade_in_effect">
            <h3 class="text-center">Detalhe do cliente</h3>
            <hr>

            <div class="row mt-3">
                <!-- Nome completo -->
                <div class="col-3 text-end fw-bold">Nome completo:</div>
                <div class="col-9"><?= $dados_cliente->nome_completo ?></div>
                <!-- Morada -->
                <div class="col-3 text-end fw-bold">Endereço:</div>
                <div class="col-9"><?= $dados_cliente->morada ?></div>
                <!-- Cidade -->
                <div class="col-3 text-end fw-bold">Cidade:</div>
                <div class="col-9"><?= $dados_cliente->cidade ?></div>
                <!-- Telefone -->
                <div class="col-3 text-end fw-bold">Telefone:</div>
                <div class="col-9"><?= $dados_cliente->telefone ?></div>
                <!-- Email -->
                <div class="col-3 text-end fw-bold">Email:</div>
                <div class="col-9"><a href="mailto:"><?= $dados_cliente->email ?></a></div>
                <!-- Ativo -->
                <div class="col-3 text-end fw-bold">Estado:</div>
                <div class="col-9 fw-bold"><?= $dados_cliente->activo == 0 ? '<span class="text-danger">Inativo</span>' : '<span class="text-success">Ativo</span>' ?></div>
                <!-- Criado em -->
                <div class="col-3 text-end fw-bold">Cliente desde:</div>
                <?php
                $data = DateTime::createFromFormat('Y-m-d H:i:s', $dados_cliente->created_at);
                ?>
                <div class="col-9"><?= $data->format('d-m-y') ?></div>
            </div>
            <div class="row mt-3">
                <div class="col-6 offset-3">
                    <?php if ($total_encomendas == 0) : ?>
                        <div class="col text-center">
                            <p class="alert alert-info p2 text-center text-muted">Não existem encomendas deste cliente.</p>
                        </div>
                    <?php else : ?>
                        <a href="?a=cliente_historico_encomendas&c=<?= Store::aesEncriptar($dados_cliente->id_cliente) ?>" class="btn btn-primary">Ver encomendas completas...</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>



    </div>
</div>