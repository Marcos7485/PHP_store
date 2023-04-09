
//===============================================
// adicionar produto ao carrinho
function adicionar_carrinho(id_produto) {

    axios.defaults.withCredentials = true;
    axios.get('?a=adicionar_carrinho&id_produto=' + id_produto)
        .then(function (response) {

            var total_produtos = response.data;
            document.getElementById('carrinho').innerText = total_produtos;

        });
}

function adicionar_carrinho_presente(id_produto) {

    axios.defaults.withCredentials = true;
    axios.get('?a=adicionar_carrinho_presente&id_produto=' + id_produto)
        .then(function (response) {

            var total_produtos = response.data;
            document.getElementById('carrinho').innerText = total_produtos;

        });
}

//===============================================

function limpar_carrinho() {
    // limpar todo o carrinho
    axios.defaults.withCredentials = true;
    axios.get('?a=limpar_carrinho')
        .then(function (response) {
            document.getElementById('carrinho').innerText = 0;
        });
}



function limpar_carrinho_off() {
    var e = document.getElementById("confirm_limpar_carrinho");
    e.style.display = "none";
}

//======================================
function usar_morada_alternativa() {
    // mostrar ou esconder o espaço para a morada alternativa
    var e = document.getElementById('check_morada_alternativa');
    if (e.checked == true) {

        // mostra o quadro para definir a morada alternativa
        document.getElementById('morada_alternativa').style.display = 'block';

    } else {

        // esconde o quadro 
        document.getElementById('morada_alternativa').style.display = 'none';
    }
}

//======================================
function usar_morada_alternativa_cel() {
    // mostrar ou esconder o espaço para a morada alternativa
    var e_cel = document.getElementById('check_morada_alternativa_cel');
    if (e_cel.checked == true) {

        // mostra o quadro para definir a morada alternativa
        document.getElementById('morada_alternativa_cel').style.display = 'block';

    } else {

        // esconde o quadro 
        document.getElementById('morada_alternativa_cel').style.display = 'none';
    }
}

//======================================


// ==================================================


function cep_alternativo() {
    if (document.getElementById("check_morada_alternativa").checked) {
        axios({
            method: 'post',
            url: '?a=estabelecer',
            data: {
                cep_altern: document.getElementById("text_cep_alternativo").value,
            }
        });
    }
}

function cep_alternativo_cel() {
    if (document.getElementById("check_morada_alternativa_cel").checked) {
        axios({
            method: 'post',
            url: '?a=estabelecer_cel',
            data: {
                cep_altern_cel: document.getElementById("text_cep_alternativo_cel").value,
            }
        });
    }
}



function adic_envio() {
    if (document.getElementById("envio_nao").checked) {
        axios({
            method: 'post',
            url: '?a=procura_local',
            data: {
                procura_local: 'procura_no_local',
            }
        });

    } else {

        axios({
            method: 'post',
            url: '?a=cep_alternativo',
            data: {
                adic_envio: 'adic_envio',
            }
        });

    }

}

function adic_envio_cel() {
    if (document.getElementById("envio_nao_cel").checked) {
        axios({
            method: 'post',
            url: '?a=procura_local',
            data: {
                procura_local: 'procura_no_local',
            }
        });

    } else {

        axios({
            method: 'post',
            url: '?a=cep_alternativo',
            data: {
                adic_envio: 'adic_envio',
            }
        });

    }

}



function mostrarMensaje() {
    var $cep = document.getElementById('text_cep_alternativo').value;
    if ($cep == '') {
        return;
    } else {
        alert("CEP destino modificado");
    }
}

// Pontos Panel ///////////////////////////////////////////////////////////


//////////////////// Apertura e fechamento loja ////////////////
// Define os horários de abertura e fechamento
var horarioAbertura = new Date();
horarioAbertura.setHours(12, 0, 0); // Abre às 9h

var horarioFechamento = new Date();
horarioFechamento.setHours(20, 0, 0); // Fecha às 20h

var placa_abert = document.getElementById('placa_abert');
var placa_abert_cel = document.getElementById('placa_abert_cel');
var placa_fech = document.getElementById('placa_fech');
var placa_fech_cel = document.getElementById('placa_fech_cel');

// Obtém a hora atual
var agora = new Date();

// Verifica se a loja está aberta
if (agora >= horarioAbertura && agora < horarioFechamento && agora.getDay() != 1) {
    placa_abert.style.display = 'block';
    placa_abert_cel.style.display = 'block';
    placa_fech.style.display = 'none';
    placa_fech_cel.style.display = 'none';
    //agregar as funcionalidades da loja quando esteja aberta
} else {
    placa_abert.style.display = 'none';
    placa_abert_cel.style.display = 'none';
    placa_fech.style.display = 'block';
    placa_fech_cel.style.display = 'block';
    //limitar as funcionalidades da loja quando esteja fechada

}



var content1 = document.getElementById('content1');
var content2 = document.getElementById('content2');

content1.addEventListener('click', function() {
  content1.style.transform = 'translateX(-100%)';
  content2.style.transform = 'translateX(0)';
});

content2.addEventListener('click', function() {
  content1.style.transform = 'translateX(0)';
  content2.style.transform = 'translateX(100%)';
});

var radio1 = document.getElementById('radio1');
var radio2 = document.getElementById('radio2');

content1.addEventListener('transitionend', function() {
  if (this.style.transform === 'translateX(0px)') {
    radio1.checked = true;
  } else {
    radio2.checked = true;
  }
});