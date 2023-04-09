<div class="container-fluid hide">
    <div class="row">
        <div class="col-12 fade_in_effect gold_text">
            <h1 class="text-center letra">Detalhe da encomenda</h1>

            <div class="row">
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Data da encomenda </strong></span><br>
                        <?= $dados_encomenda->data_encomenda ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Endereço da encomenda</strong></span><br>
                        <?= $dados_encomenda->morada ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Cidade</strong></span><br>
                        <?= $dados_encomenda->cidade ?>
                    </div>
                </div>
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Email</strong></span><br>
                        <?= $dados_encomenda->email ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Telefone</strong></span><br>
                        <?= $dados_encomenda->telefone ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Codigo de encomenda</strong></span><br>
                        <?= $dados_encomenda->codigo_encomenda ?>
                        <!-- !empty($dados_encomenda->telefone) ? $dados_encomenda->telefone : '&nbsp;' -->
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center">
                        Estado
                    </div>
                    <div>
                        <?php

                        use core\classes\Store;

                        if ($dados_encomenda->status == 'AGENDADA') : ?>
                            <h4 class="status_agendada text-center">AGENDADA <div class="p-2 badge bg-danger" style="color:red;" onclick="cancelar_encomenda()"><i class="fa-solid fa-ban"></i></div>
                            </h4>
                        <?php elseif ($dados_encomenda->status == 'PENDENTE') : ?>
                            <h4 class="status_processamento text-center">PENDENTE <div class="p-2 badge bg-danger" style="color:red;" onclick="cancelar_encomenda()"><i class="fa-solid fa-ban"></i></div>
                            </h4>
                        <?php elseif ($dados_encomenda->status == 'EM PROCESSAMENTO') : ?>
                            <h4 class="status_processamento text-center">EM PROCESSAMENTO <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'ENVIADA') : ?>
                            <h4 class="status_enviada text-center">ENVIADA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'CANCELADA') : ?>
                            <h4 class="status_cancelada text-center">CANCELADA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'CONCLUIDA') : ?>
                            <h4 class="status_concluida text-center">CONCLUIDA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center">
                        Pontos
                    </div>
                    <div>
                        <h4 class="text-center texto_pontos"><?= $dados_encomenda->pontos ?></h4>
                    </div>
                </div>
            </div>

            <!-- Dados da encomenda -->
            <div class="row mb-5">
                <div class="col">
                    <table class="table gold_text">
                        <thead class="table-dark">
                            <tr>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center">Pontos / Uni.</th>
                                <th class="text-end">Preço / Uni.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produtos_encomenda as $produto) : ?>
                                <tr>
                                    <td><?= $produto->designacao_produto ?></td>
                                    <td class="text-center"><?= $produto->quantidade ?></td>
                                    <td class="text-center texto_pontos"><b><?= $produto->pontos ?></b></td>
                                    <td class="text-end">R$ <?= number_format($produto->preco_unidade, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td></td>
                                <td class="text-center texto_pontos">Total Pontos: <strong><?= $dados_encomenda->pontos ?></strong></td>
                                <td class="text-end">Envio: <strong>R$ <?= number_format($envio, 2, ',', '.') ?></strong></td>
                                <td class="text-end">Total: <strong>R$ <?= number_format($total_encomenda, 2, ',', '.') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-3"><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="100px"> (Num cel: 48 9990 6903)</div>
                <div class="col-4">(No caso de realizar o pago pelo pix, enviar o comprovante ao nosso atendimento direto para otimizar o processo!)</div>
                <div class="col-5"><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px"> Enviaremos links de pagamento em breve no seu WhatsApp</div>
            </div>

            <div class="row">
                <?php if ($dados_encomenda->status == 'AGENDADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">A loja fechada só permite agendar compras que seram processadas após apertura da loja.<br>Pode conferir os horarios clicando na placa de "FECHADO/ABERTO" da loja.<br>Qualquer dúvida pode se contactar com nosso atendimento direto!<br>Se desea pode cancelar seu agendamento clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'PENDENTE') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta em nosso sistema!<br>Qualquer dúvida pode se contactar com nosso atendimento direto!<br>Se desea cancelar sua encomenda antes que seja processada pode clicar no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'EM PROCESSAMENTO') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta sendo processada!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'ENVIADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta no caminho!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'CANCELADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda foi cancelada!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'CONCLUIDA') : ?>
                    <div class="alert alert-success p2 text-center">
                        <span class="me-3">Sua encomenda foi recebida!<br>Agradecemos sua escolha e sempre estamos pensando en fazer o melhor cada dia para que você continue nos escolhendo!.<br>Muito obrigado!.</span>
                    </div>
                <?php endif; ?>
                <div class="col text-center mb-5">
                    <a href="?a=historico_encomendas" class="btn btn-warning" id="boton_1">Voltar</a>
                </div>
                <div class="mb-3">
                    &nbsp;
                </div>
            </div>
            <!-- Lista de produtos da encomenda -->
        </div>
    </div>
</div>



<!--Celular //////////////////////////////////////////////////////////-->
<div class="container-fluid show">
    <div class="row">
        <div class="col-12 fade_in_effect gold_text">
            <h1 class="text-center letra" style="font-size: 25pt; padding-top: 20px;">Detalhe da encomenda</h1>

            <div class="row text-center">
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Data</strong></span><br>
                        <?= $dados_encomenda->data_encomenda ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Endereço</strong></span><br>
                        <?= $dados_encomenda->morada ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Cidade</strong></span><br>
                        <?= $dados_encomenda->cidade ?>
                    </div>
                </div>
                <div class="col">
                    <div class="p-2 my-3">
                        <span><strong>Email</strong></span><br>
                        <?= $dados_encomenda->email ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Telefone</strong></span><br>
                        <?= $dados_encomenda->telefone ?>
                    </div>
                    <div class="p-2 my-3">
                        <span><strong>Codigo</strong></span><br>
                        <b style="font-size: 20pt; color: white;"><?= $dados_encomenda->codigo_encomenda ?></b>
                        <!-- !empty($dados_encomenda->telefone) ? $dados_encomenda->telefone : '&nbsp;' -->
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center">
                        Estado
                    </div>
                    <div>
                        <?php if ($dados_encomenda->status == 'AGENDADA') : ?>
                            <h4 class="status_agendada text-center">AGENDADA <div class="p-2 badge bg-danger" style="color:red;" onclick="cancelar_encomenda()"><i class="fa-solid fa-ban"></i></div>
                            </h4>
                        <?php elseif ($dados_encomenda->status == 'PENDENTE') : ?>
                            <h4 class="status_processamento text-center">PENDENTE <div class="p-2 badge bg-danger" style="color:red;" onclick="cancelar_encomenda()"><i class="fa-solid fa-ban"></i></div>
                            </h4>
                        <?php elseif ($dados_encomenda->status == 'EM PROCESSAMENTO') : ?>
                            <h4 class="status_processamento text-center">EM PROCESSAMENTO <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'ENVIADA') : ?>
                            <h4 class="status_enviada text-center">ENVIADA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'CANCELADA') : ?>
                            <h4 class="status_cancelada text-center">CANCELADA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php elseif ($dados_encomenda->status == 'CONCLUIDA') : ?>
                            <h4 class="status_concluida text-center">CONCLUIDA <a href="https://wa.me/message/ZAS5UNZSSMUJL1"><i class="fa-regular fa-comment-dots"></i></a></h4>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col align-self-center">
                    <div class="text-center">
                        Pontos
                    </div>
                    <div>
                        <h4 class="text-center texto_pontos" style="font-size: 20pt;"><?= $dados_encomenda->pontos ?></h4>
                    </div>
                </div>
            </div>

            <!-- Dados da encomenda -->
            <div class="row mb-5" style="padding-top: 20px;">
                <div class="col">
                    <table class="table gold_text" align="center">
                        <thead class="table-dark">
                            <tr>
                                <th>Produto</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-center" colspan="2">Preço</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($produtos_encomenda as $produto) : ?>
                                <tr>
                                    <td><?= $produto->designacao_produto ?></td>
                                    <td class="text-center"><?= $produto->quantidade ?></td>
                                    <td class="text-center" colspan="2">R$ <?= number_format($produto->preco_unidade, 2, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td class="text-center texto_pontos">Total Pontos: <strong><?= $dados_encomenda->pontos ?></strong></td>
                                <td class="text-center">Envio: <strong>R$ <?= number_format($envio, 2, ',', '.') ?></strong></td>
                                <td class="text-center" colspan="2">Total: <strong>R$ <?= number_format($total_encomenda, 2, ',', '.') ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row my-5 text-center">
                <div class="col-12"><img src="https://llicorellapriorato.store/public/assets/images/icons/pix.png" width="100px"><br>(Num cel: 48 9990 6903)</div>
                <div class="col-12">(No caso de realizar o pago pelo pix, enviar o comprovante ao nosso atendimento direto para otimizar o processo!)</div>
                <div class="col-12" style="padding-top: 20px;"><img src="https://llicorellapriorato.store/public/assets/images/icons/cartao.png" width="50px"><br>Enviaremos links de pagamento em breve no seu WhatsApp</div>
            </div>
            <div class="text-center">
                
            </div>

            <div class="row">
                <?php if ($dados_encomenda->status == 'AGENDADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">A loja fechada só permite agendar compras que seram processadas após apertura da loja.<br>Pode conferir os horarios clicando na placa de "FECHADO/ABERTO" da loja.<br>Qualquer dúvida pode se contactar com nosso atendimento direto!<br>Se desea puede cancelar seu agendamento clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'PENDENTE') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta em nosso sistema!<br>Qualquer dúvida pode se contactar com nosso atendimento direto!<br>Se desea cancelar sua encomenda antes que seja processada pode clicar no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'EM PROCESSAMENTO') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta sendo processada!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'ENVIADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda esta no caminho!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'CANCELADA') : ?>
                    <div class="alert alert-warning p2 text-center">
                        <span class="me-3">Sua encomenda foi cancelada!<br>Qualquer dúvida pode se contactar com nosso atendimento direto, clicando no icone do lado do estado da encomenda.</span>
                    </div>
                <?php elseif ($dados_encomenda->status == 'CONCLUIDA') : ?>
                    <div class="alert alert-success p2 text-center">
                        <span class="me-3">Sua encomenda foi recebida!<br>Agradecemos sua escolha e sempre estamos pensando en fazer o melhor cada dia para que você continue nos escolhendo!.<br>Muito obrigado!.</span>
                    </div>
                <?php endif; ?>
                <div class="col text-center mb-5">
                    <a href="?a=historico_encomendas" class="btn btn-warning" id="boton_1">Voltar</a>
                </div>
                <div class="mb-3">
                    &nbsp;
                </div>
            </div>
            <!-- Lista de produtos da encomenda -->
        </div>
    </div>
</div>

<!--/////////////////////////////////////////////////////////////////-->


<!-- Modal -->
<div class="modal fade" id="cancelar_encomenda_mod" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Cancelar Encomenda?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color: black;">
                <div class="text-center">
                    <img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" width="150px" style="border-radius: 50%;">
                </div>
            </div>
            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-danger"><a href="?a=cancelar_encomenda&id=<?= Store::aesEncriptar($dados_encomenda->id_encomenda) ?>" style="text-decoration: none; color:antiquewhite;">Cancelar Encomenda</a></button>
                <button type="button" class="btn btn-warning text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Manter</button>
            </div>
        </div>
    </div>
</div>


<script>
    function cancelar_encomenda() {
        var modalStatus = new bootstrap.Modal(document.getElementById('cancelar_encomenda_mod'));
        modalStatus.show();
    }
</script>