<div class="container-fluid text-center">
    <div class="row">
        <div class="col-2">
            <table>
                <thead>
                    <tr>
                        <div class="galeria_1">
                            <img class="foto" src="https://llicorellapriorato.store/public/assets//images/Imagens//Inicio/1.png" />
                        </div>
                    </tr>
                    <tr>
                        <div class="galeria_2">
                            <img class="foto_2" src="https://llicorellapriorato.store/public/assets/images/Imagens/Inicio/cestas/1.jpg" />
                        </div>
                    </tr>
                    <tr>
                        <div class="galeria_3">
                            <img class="foto" src="https://llicorellapriorato.store/public/assets/images/Imagens/Inicio/alimentos/1.jpg" />
                        </div>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="row hide">
        <img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" class="logo_inicio" id="logo_loja"><a href="?a=loja">
            <p id="texto_inicio">Store!</p>
        </a>
    </div>


    <!-- NAV MENU CEL -->


    <div class="menu_cel show fade_in_effect">
        <div class="toggle"><img src="https://llicorellapriorato.store/public/assets/images/icons/Logo.jpg" class="logo_menu_cel"><p id="start_init">Click!</p></div>

        <li style="--i:0;">
            <?php

            use core\classes\Store;

            if (Store::clientelogado()) : ?>
                <a onclick="logout_cel()">
                    <div><i class="fa-solid fa-right-from-bracket"></i></div>
                </a>
            <?php else : ?>
                <a href="?a=login"><i class="fa-solid fa-xmark"></i></a>
            <?php endif; ?>
        </li>

        <li style="--i:1;">
            <?php if (Store::clientelogado()) : ?>
                <a href="?a=perfil"><p>Perfil</p></a>
            <?php else : ?>
                <a href="?a=login"><p>Login</p></a>
            <?php endif; ?>
        </li>

        <li style="--i:2;">
            <a href="?a=loja"><p>Loja</p></a>
        </li>

        <li style="--i:3;">
            <?php if (Store::clientelogado()) : ?>
                <a href="?a=loja_premios"><p>Prêmios</p></a>
            <?php else : ?>
                <a href="?a=loja_premios"><p>Prêmios</p></a>
            <?php endif; ?>
        </li>

        <li style="--i:4;">
            <?php if (Store::clientelogado()) : ?>
                <a href="?a=historico_encomendas"><p>Histórico</p></a>
            <?php else : ?>
                <a href="?a=cestas"><p>Cestas</p></a>
            <?php endif; ?>
        </li>

        <li style="--i:5;">
            <?php if (Store::clientelogado()) : ?>
                <a href="?a=minhas_sugerencias"><p>Sugestões</p></a>
            <?php else : ?>
                <a href="?a=login"><i class="fa-solid fa-xmark"></i></a>
            <?php endif; ?>
        </li>

    </div>


    <script>
        let toggle = document.querySelector('.toggle');
        let menu = document.querySelector('.menu_cel');

        toggle.onclick = function() {
            menu.classList.toggle('active');
        }
    </script>


    <!-- ///////////////////////////////////////// -->


    <div class="show">
        <a href="https://www.instagram.com/llicorellapriorato/" target="blank"><img src="https://llicorellapriorato.store/public/assets/images/icons/InstaIcon.png" class="InstaIcon_cel"></a>
        <a href="?a=contactos"><img src="https://llicorellapriorato.store/public/assets/images/icons/ws.png" class="Centrowsp_cel"></a>
    </div>
    <div class="row hide">
        <div class="col-2"></div>
    </div>
</div>




<script>
    let textoInicio = document.getElementById("texto_inicio");
    /*let textoInicio_2 = document.querySelector("texto_inicio");*/
    let logo = document.getElementById("logo_loja");

    logo.addEventListener("mouseover", function() {
        logo.style.opacity = "90%";
    });

    textoInicio.addEventListener("mouseover", function() {

        logo.style.opacity = "90%";
    });

    logo.addEventListener("mouseleave", function() {

        logo.style.opacity = "100%";
    });

    textoInicio.addEventListener("mouseleave", function() {

    });
</script>


<!-- ////////////////////CELULAR///////////////////// -->
<!-- Modal -->
<div class="modal fade" id="logoutModal_cel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header gold_text letra" style="background-color: black;">
                <h1 class="modal-title fs-7" id="exampleModalLabel">Fazer Logout?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-footer" style="background-color: black;">
                <button type="button" class="btn btn-success"><a href="?a=logout" style="text-decoration: none; color:antiquewhite;">Logout</a></button>
                <button type="button" class="btn btn-danger text-center" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function logout_cel() {
        var modalStatus = new bootstrap.Modal(document.getElementById('logoutModal_cel'));
        modalStatus.show();
    }
    
    ///////////////////////////////////////////////

    var init_text = document.getElementById('start_init');

    init_text.addEventListener('click', function(){
    init_text.style.display = 'none';
    });

///////////////////////////////////////////////
</script>

<!-- ///////////////////////////////////////// -->