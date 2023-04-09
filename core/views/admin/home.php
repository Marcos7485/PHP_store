<div class="container-fluid">
    <div class="row mt-3 mb-5 fade_in_effect">

        <div class="col-md-2">
            <?php include(__DIR__ . '/Layouts/admin_menu.php') ?>
        </div>

        <div class="col-md-8 mb-5 gold_text">

            <!-- Apresenta informações sobre o total de encomendas AGENDADAS -->
            <h4 class="text-center">Encomendas Agendadas</h4>
            <?php if ($total_encomendas_agendadas != 0) : ?>
                <div class="alert alert-violeta p2 text-center">
                    <span class="me-3">Existem encomendas agendadas: <strong><?= $total_encomendas_agendadas ?></strong></span>
                    <a href="?a=lista_encomendas&f=agendada">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-violeta p2 text-center">
                    <span class="me-3">Não existem encomendas Agendadas</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de encomendas PENDENTE -->
            <h4 class="text-center">Encomendas Pendentes</h4>
            <?php if ($total_encomendas_pendentes != 0) : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3">Existem encomendas pendentes: <strong><?= $total_encomendas_pendentes ?></strong></span>
                    <a href="?a=lista_encomendas&f=pendente">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3 text-muted">Não existem encomendas pendentes</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de encomendas EM PROCESSAMENTO -->
            <h4 class="text-center">Encomendas em processamento</h4>
            <?php if ($total_encomendas_em_processamento != 0) : ?>
                <div class="alert alert-warning text-center">
                    <span class="me-3">Existem encomendas em processamento: <strong><?= $total_encomendas_em_processamento ?></strong></span>
                    <a href="?a=lista_encomendas&f=em_processamento">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3 text-muted">Não existem encomendas em processamento</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de encomendas ENVIADA -->
            <h4 class="text-center">Encomendas enviadas</h4>
            <?php if ($total_encomendas_enviadas != 0) : ?>
                <div class="alert alert-warning text-center">
                    <span class="me-3">Existem encomendas enviadas: <strong><?= $total_encomendas_enviadas ?></strong></span>
                    <a href="?a=lista_encomendas&f=enviada">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3 text-muted">Não existem encomendas enviadas</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de encomendas CANCELADA -->
            <h4 class="text-center">Encomendas canceladas</h4>
            <?php if ($total_encomendas_canceladas != 0) : ?>
                <div class="alert alert-danger text-center">
                    <span class="me-3">Encomiendas canceladas: <strong><?= $total_encomendas_canceladas ?></strong></span>
                    <a href="?a=lista_encomendas&f=cancelada">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3 text-muted">Não existem encomendas canceladas</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de encomendas CONCLUIDA -->
            <h4 class="text-center">Encomendas concluidas</h4>
            <?php if ($total_encomendas_concluidas != 0) : ?>
                <div class="alert alert-success text-center">
                    <span class="me-3">Encomiendas concluidas: <strong><?= $total_encomendas_concluidas ?></strong></span>
                    <a href="?a=lista_encomendas&f=concluida">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info p2 text-center">
                    <span class="me-3 text-muted">Não existem encomendas concluidas</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de PREMIOS PENDENTES -->
            <h4 class="text-center">Premios reclamados</h4>
            <?php if (true) : ?>
                <div class="alert alert-warning text-center">
                    <span class="me-3">Premios reclamados (PENDENTES): <strong><?= $total_premios_pendentes ?></strong></span>
                    <a href="?a=lista_premios&f=pendente">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-warning p2 text-center">
                    <span class="me-3 text-muted">Não existem premios reclamados pendentes</span>
                </div>
            <?php endif; ?>

            <!-- Apresenta informações sobre o total de PREMIOS RECEBIDOS -->
            <h4 class="text-center">Premios recebidos</h4>
            <?php if (true) : ?>
                <div class="alert alert-warning text-center">
                    <span class="me-3">Premios reclamados (RECEBIDOS): <strong><?= $total_premios_recebidos ?></strong></span>
                    <a href="?a=lista_premios&f=recebido">Ver</a>
                </div>
            <?php else : ?>
                <div class="alert alert-warning p2 text-center">
                    <span class="me-3 text-muted">Não existem premios reclamados recebidos</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-2">

        </div>
    </div>
</div>