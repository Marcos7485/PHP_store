<div class="container hide">
    <div class="row my-5 fade_in_effect">

        <div class="col-3 gold_text position_table">
            <?php

            use core\classes\Store;

            if ($dados_cliente['Intereses'] == '') : ?>
                <!-- FORM -->
                <form action="?a=intereses&id=<?= Store::aesEncriptar($_SESSION['cliente']) ?>" method="post">
                    <table class="gold_text panel_intereses" style="text-shadow: 1px 1px 1px black;">
                        <thead>
                            <p class="text-center letra" style="font-size: 20pt;">Intereses:</p>
                            <p class="text-center texto_pontos letra" style="font-size: 18pt; text-shadow: 1px 1px 1px black;">(Preencha e ganhe 10 pontos!)</p>
                        </thead>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_Vinho_dia_a_dia" value="Vinho_dia_a_dia"><label class="p-1"> Vinho dia a dia</label></td>

                        <tr>
                            <td><input type="checkbox" name="c_Tintos" value="Tintos"><label class="p-1"> Tintos</label></td>
                            <td><input type="checkbox" name="c_Brancos" value="Brancos"><label class="p-1"> Brancos</label></td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="c_Roses" value="Roses"><label class="p-1"> Roses</label></td>
                            <td><input type="checkbox" name="c_Espumantes" value="Espumantes"><label class="p-1"> Espumantes</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_V_mundo" value="V_mundo"><label class="p-1"> Velho mundo (Europa)</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_N_mundo" value="N_mundo"><label class="p-1"> Novo mundo (Arg,Chi,Uru,etc)</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_L_cost" value="L_cost"><label class="p-1"> Low-cost (Até R$100)</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_M_price" value="M_price"><label class="p-1"> Mid-price (De R$100 - R$250)</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="checkbox" name="c_Premium" value="Premium"><label class="p-1"> Premium (R$250++)</label></td>
                        </tr>
                    </table>

                    <!-- summit -->
                    <div class="my-4 text-center">
                        <input type="submit" value="Me interesa!" class="btn btn-warning" id="interes">
                    </div>
                    <!-- END FORM -->
                <?php else : ?>

                <?php endif; ?>
        </div>

        <div class="col-6">
            <table class="table gold_text">
                <?php foreach ($dados_cliente as $key => $value) : ?>
                    <tr>
                        <td class="text-end" width="40%"><?= $key ?>:</td>
                        <td width="60%"><strong><?= $value ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>



<!-- Celular /////////////////////////////////////////////////////////////////////-->
<div class="container show">
    <div class="row gold_text letra text-center" style="font-size: 35pt;">
        <div class="col-2"></div>
        <div class="col-8">
            Perfil
        </div>
        <?php if ($dados_cliente['Intereses'] == '') : ?>
        <!--BOTON SUB E BAIX -->
        <div class="col-2">
            <a href="#end" id="scroll-icon-down">
                <i class="fas fa-chevron-down"></i>
            </a>
            <a href="#top" id="scroll-icon-up" class="hidden">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
        <a href="#top" id="scroll-to-top"></a>
        <!--BOTON SUB E BAIX -->
        <?php endif ?>
    </div>

    <div class="row fade_in_effect">
        <div class="col">
            <table class="table gold_text">
                <?php foreach ($dados_cliente as $key => $value) : ?>
                    <tr>
                        <td class="text-end" width="40%"><?= $key ?>:</td>
                        <td width="60%"><strong><?= $value ?></strong></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <div class="col-12 gold_text" style="padding-bottom: 80px;">
        <?php if ($dados_cliente['Intereses'] == '') : ?>
            <!-- FORM -->
            <form action="?a=intereses&id=<?= Store::aesEncriptar($_SESSION['cliente']) ?>" method="post">
                <table class="gold_text panel_intereses" align="center" style="text-shadow: 1px 1px 1px black;">
                    <thead>
                        <p class="text-center letra" style="font-size: 20pt;">Intereses:</p>
                        <p class="text-center texto_pontos" style="font-size: 18pt; text-shadow: 1px 1px 1px black;">(Preencha e ganhe 10 pontos!)</p>
                    </thead>
                    <tr>
                        <td><input type="checkbox" name="c_Vinho_dia_a_dia" value="Vinho_dia_a_dia"><label class="p-1"> Vinho dia a dia</label></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="c_Tintos" value="Tintos"><label class="p-1"> Tintos</label></td>
                        <td><input type="checkbox" name="c_Brancos" value="Brancos"><label class="p-1"> Brancos</label></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="c_Roses" value="Roses"><label class="p-1"> Roses</label></td>
                        <td><input type="checkbox" name="c_Espumantes" value="Espumantes"><label class="p-1"> Espumantes</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="c_V_mundo" value="V_mundo"><label class="p-1"> Velho mundo (Europa)</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="c_N_mundo" value="N_mundo"><label class="p-1"> Novo mundo (Arg,Chi,Uru,etc)</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="c_L_cost" value="L_cost"><label class="p-1"> Low-cost (Até R$100)</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="c_M_price" value="M_price"><label class="p-1"> Mid-price (De R$100 - R$250)</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="c_Premium" value="Premium"><label class="p-1"> Premium (R$250++)</label></td>
                    </tr>
                </table>

                <!-- summit -->
                <div class="my-4 text-center" id="end">
                    <input type="submit" value="Me interesa!" class="btn btn-warning" id="interes">
                </div>

                <!-- END FORM -->
            <?php else : ?>

            <?php endif; ?>

    </div>

</div>
<!-- Celular /////////////////////////////////////////////////////////////////////-->

<script src="assets/js/scroll.js"></script>