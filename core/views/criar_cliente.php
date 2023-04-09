<div class="container">
    
    <!-- ERRORS///////////////////////////////////////-->
    
    <?php if (isset($_SESSION['erro'])) : ?>
        <div class='row' style="padding-top: 60px;">
            <div class="alert alert-danger text-center p-2">
            <?= $_SESSION['erro'] ?>
            <?php unset($_SESSION['erro']) ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- ERRORS///////////////////////////////////////-->
    
    <div class="row my-5 fade_in_effect hide">
        <div class="col-sm-6 offset-sm-3 gold_text">
            <h3 class="text-center titulos">Registro de novo cliente</h3>

            <form action="?a=criar_cliente" method="post">
                <!-- email -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" required>
                </div>

                <!-- senha_1 -->
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" minlength="6" required>
                </div>

                <!-- senha_2 -->
                <div class="my-3">
                    <label>Repetir a Senha</label>
                    <input type="password" name="text_senha_2" placeholder="Repetir a Senha" class="form-control" required>
                </div>

                <!-- nome_completo -->
                <div class="my-3">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome completo" class="form-control" required>
                </div>

                <!-- morada -->
                <div class="my-3">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="text_cep" placeholder="Ej. 12345-678" required>
                </div>

                <!-- cidade -->
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="Cidade" class="form-control" required>
                </div>

                <!-- telefone -->
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="Telefone" class="form-control" required>
                </div>
                <table class="table gold_text">
                    <thead>
                        <p class="text-center letra" style="font-size: 20pt;">Intereses: (Preencha e ganhe 10 pontos!)</p>
                    </thead>
                    <tr>
                        <td><input type="checkbox" name="c_Vinho_dia_a_dia" value="Vinho_dia_a_dia"><label class="p-1"> Vinho dia a dia</label></td>
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
                <table>
                    <tr>
                        <td colspan="2"><label class="text-center p-3" style="color:red;"><input type="checkbox" name="declaro" value="18+" required> Declaro ter mais de 18 anos e estar em idade legal para compra de bebida alcóolica <i class="fa-solid fa-ban"></i></label></td>
                    </tr>
                </table>

                <!-- summit -->
                <div class="my-4 text-center">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                        <p>Recomendado por:</p>
                        <select id="select_vendedor" name="recomendado_por" class="form-select">
                            <option value=""></option>
                            <option value="google">Google</option>
                            <option value="instagram">Instagram</option>
                            <option value="1">Vendedor Centro</option>
                            <option value="2">Vendedor Jurerê</option>
                            <option value="otro">Outro</option>
                        </select>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <br>
                    <div class="row">
                        <input type="submit" value="Criar conta" class="btn btn-warning" id="new_client">
                        <p class="criar_cliente gold_text letra">welcome...! :) <i class="fa-solid fa-star"></i></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!--CELULAR//////////////////////////////-->
    <div class="row my-5 fade_in_effect show">
        <div class="col-sm-6 offset-sm-3 gold_text">
            <h3 class="text-center titulos" style="padding-top: 60px;">Registro de novo cliente</h3>

            <form action="?a=criar_cliente_cel" method="post">
                <!-- email -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email_cel" placeholder="Email" class="form-control" required>
                </div>

                <!-- senha_1 -->
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1_cel" placeholder="Senha" class="form-control" minlength="6" required>
                </div>

                <!-- senha_2 -->
                <div class="my-3">
                    <label>Repetir a Senha</label>
                    <input type="password" name="text_senha_2_cel" placeholder="Repetir a Senha" class="form-control" required>
                </div>

                <!-- nome_completo -->
                <div class="my-3">
                    <label>Nome completo</label>
                    <input type="text" name="text_nome_completo_cel" placeholder="Nome completo" class="form-control" required>
                </div>

                <!-- morada -->
                <div class="my-3">
                    <label for="cep">CEP:</label>
                    <input style="color: purple; text-shadow: 0px 1px 2px black;" type="text" id="cep" name="text_cep_cel" placeholder="Ej. 12345-678" required>
                </div>

                <!-- cidade -->
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade_cel" placeholder="Cidade" class="form-control" required>
                </div>

                <!-- telefone -->
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone_cel" placeholder="Telefone" class="form-control" required>
                </div>
                <table class="table gold_text">
                    <thead>
                        <p class="text-center letra" style="font-size: 20pt;">Intereses:</p>
                        <p class="text-center texto_pontos" style="font-size: 15pt;"> (Preencha e ganhe 10 pontos!)</p>
                    </thead>
                    <tr>
                        <td><input type="checkbox" name="c_Vinho_dia_a_dia" value="Vinho_dia_a_dia"><label class="p-1"> Vinho dia a dia</label></td>
                        <td><input type="checkbox" name="c_Tintos" value="Tintos"><label class="p-1"> Tintos</label></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" name="c_Brancos" value="Brancos"><label class="p-1"> Brancos</label></td>
                        <td><input type="checkbox" name="c_Roses" value="Roses"><label class="p-1"> Roses</label></td>
                    </tr>
                    <tr>
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
                <table>
                    <tr>
                        <td colspan="2"><label class="text-center p-3" style="color:red;"><input type="checkbox" name="declaro" value="18+" required> Declaro ter mais de 18 anos e estar em idade legal para compra de bebida alcóolica <i class="fa-solid fa-ban"></i></label></td>
                    </tr>
                </table>
                <!-- summit -->
                <div class="my-4 text-center">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                        <p>Recomendado por:</p>
                        <select id="select_vendedor" name="recomendado_por" class="form-select">
                            <option value=""></option>
                            <option value="google">Google</option>
                            <option value="instagram">Instagram</option>
                            <option value="1">Vendedor Centro</option>
                            <option value="2">Vendedor Jurerê</option>
                            <option value="otro">Outro</option>
                        </select>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <br>
                    <div class="row">
                        <input type="submit" value="Criar conta" class="btn btn-warning" id="new_client">
                        <p class="criar_cliente gold_text letra">welcome...! :) <i class="fa-solid fa-star"></i></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!--CELULAR//////////////////////////////-->
    <div style="padding-top: 50px">
    </div>
</div>


