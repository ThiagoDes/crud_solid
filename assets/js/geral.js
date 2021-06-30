/* Funcoes para validar os campos do formulario */
function validar() {
    try {
        /* Inicio das validações */
        /* Validação de campos obrigatorios - class='required' */
        camposObrigatorios();
        /* Validação de email - class='valid_email' */
        emailValido();
        /* Validação de cpf - class='valid_cpf' */
        cpfValido();
        /* Validação de data - class='valid_date' */
        dataValido();
        /* Validação de Hora - class='valid_hora' */
        horaValida();
        /* Fim das validações */
        return true;
    } catch (strMsg) {
        notificar("alerta", strMsg);
        return false;
    }
}

/* Funcoes que mostra o carregando */
function ajaxLoading(divId) {
    $(divId).html("<center>Carregando ...</center>");
}


function feedback(status, msg)
{
    switch (status) {
        case 'ok' :
            notificar("ok", msg);
            break;
        case 'erro' :
            notificar("erro", msg);
            break;
        case 'alerta' :
            notificar("alerta", msg);
            break;
        case 'aguarde' :
            notificar("aguarde", msg);
            break;
    }
}

function hidefeedback() {
    toastr.remove()
    toastr.clear()
}

/* Funcoes auxiliares do validar() */

function camposObrigatorios() {
    var strMsg = "";
    $(".required").each(function () {
        if ($(this).val() == "" || $(this).val() == undefined) {
            marcarCampo($(this));
            strMsg = "Preencha os campos obrigatórios";
        } else {
            desmarcarCampo($(this));
        }
    });
    if (strMsg) {
        throw strMsg;
    }
}

function emailValido() {
    var strMsg = "";
    $(".valid_email").each(function () {

        var email = $(this).val();
        var exclude = /[^@\-\.\w]|^[_@\.\-]|[\._\-]{2}|[@\.]{2}|(@)[^@]*\1/;
        var check = /@[\w\-]+\./;
        var checkend = /\.[a-zA-Z]{2,3}$/;
        if (((email.search(exclude) != -1) || (email.search(check)) == -1) || (email.search(checkend) == -1)) {
            marcarCampo($(this));
            strMsg = "E-mail inválido";
        } else {
            desmarcarCampo($(this));
        }
    });
    if (strMsg) {
        throw strMsg;
    }
}

function cpfValido() {
    var strMsg = "";
    $(".valid_cpf").each(function () {
        var erro = 0;
        var valor = $(this).val();
        var soma = 0;
        var r = new RegExp('[./-]', 'g');
        var valorInput = valor.replace(r, '');
        if (valorInput.length != 11 || valorInput == "00000000000" || valorInput == "11111111111" ||
                valorInput == "22222222222" || valorInput == "33333333333" || valorInput == "44444444444" ||
                valorInput == "55555555555" || valorInput == "66666666666" || valorInput == "77777777777" ||
                valorInput == "88888888888" || valorInput == "99999999999") {
            marcarCampo($(this));
            strMsg = "CPF inválido";
            erro++;
        }
// Se já ocorreu um erro não faço mais testes
        if (erro <= 0) {

            for (i = 0; i < 9; i ++)
                soma += parseInt(valorInput.charAt(i)) * (10 - i);
            var resto = 11 - (soma % 11);
            if (resto == 10 || resto == 11)
                resto = 0;
            if (resto != parseInt(valorInput.charAt(9)))
                erro++;
            soma = 0;
            for (i = 0; i < 10; i ++)
                soma += parseInt(valorInput.charAt(i)) * (11 - i);
            resto = 11 - (soma % 11);
            if (resto == 10 || resto == 11)
                resto = 0;
            if (resto != parseInt(valorInput.charAt(10))) {
                marcarCampo($(this));
                strMsg = "CPF inválido";
                erro++;
            }
        }

        if(erro == 0){
            desmarcarCampo($(this));
        }

    });
    if (strMsg) {
        throw strMsg;
    }
}

function dataValido() {
    var strMsg = "";
    $(".valid_date").each(function () {
        var string = $(this).val();
        var err = 0;
        // var valid = "0123456789/";
        var valid = "0123456789-";
        var ok = "yes";
        var temp;
        for (var i = 0; i < string.length; i++) {

            temp = "" + string.substring(i, i + 1);
            if (valid.indexOf(temp) == "-1")
                err = 1;
        }

        if (string.length != 10)
            err = 1

        f = string.substring(0, 4)	// year

        c = string.substring(4, 5)      // '/'

        b = string.substring(5, 7)      // month

        e = string.substring(7, 8)      // '/'

        d = string.substring(8, 10)      // day 


        // b = string.substring(3, 5)      // month

        // c = string.substring(2, 3)      // '/'

        // d = string.substring(0, 2)      // day 

        // e = string.substring(5, 6)      // '/'

        // f = string.substring(6, 10) // year

        if (b < 1 || b > 12)
            err = 1

        // if (c != '/')
        //     err = 1

        if (c != '-')
            err = 1

        if (d < 1 || d > 31)
            err = 1

        if (e != '-')
            err = 1

        // if (e != '/')
        //     err = 1        

        if (f < 1850 || f > 2050)
            err = 1

        if (b == 4 || b == 6 || b == 9 || b == 11) {

            if (d == 31)
                err = 1

        }

        if (b == 2) {

            var g = parseInt(f / 4)

            if (isNaN(g)) {

                err = 1

            }

            if (d > 29)
                err = 1

            if (d == 29 && ((f / 4) != parseInt(f / 4)))
                err = 1

        }
        if (err == 1) {
            marcarCampo($(this));
            strMsg = "Formato de Data Inválido";
        } else {
            desmarcarCampo($(this));
        }
    });
    if (strMsg) {
        throw strMsg;
    }
}

function horaValida() {
    var strMsg = "";
    $(".valid_hora").each(function () {
        strHora = $(this).val();
        //separar os campos da hora
        arrHora = strHora.split(":");
        //verificar se veio ao menos a hora e minutos
        if ((arrHora.length < 2) || (arrHora.length > 3)) {
            marcarCampo($(this));
            strMsg = "Hora inválido";
        }

//valodar a hora
        if ((isNaN(arrHora[0])) || (arrHora[0] > 23) || (arrHora[0] < 0)) {
            marcarCampo($(this));
            strMsg = "Hora inválido";
        }

        for (inti = 1; inti < arrHora.length; inti++) {
            if ((isNaN(arrHora[inti])) || (arrHora[inti] > 59) || (arrHora[0] < 0)) {
                marcarCampo($(this));
                strMsg = "Hora inválido";
            }
        }

    });
    if (strMsg) {
        throw strMsg;
    }
}

function marcarCampo(elemento) {
    elemento.css('background', '#FFFFCC');
    elemento.css('border', '1px solid #F4D18C');
}

function desmarcarCampo(elemento) {
    elemento.css('background', '');
    elemento.css('border', '');
}


function iniciarToast() {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-bottom-full-width",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
}


function iniciarWysiwyg() {
    if (!jQuery().summernote) {
        return;
    }

    $('.editor').summernote({
        height: 300,
        lang: 'pt-BR',
        toolbar: [
            ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            //  ['fontname', ['fontname']],
            //  ['fontsize', ['fontsize']],
            //  ['color', ['color']],
            //['para', ['ul', 'ol', 'paragraph']],
            ['para', ['ul', 'ol']],
            //['height', ['height']],
            ['table', ['table']],
            //['insert', ['link', 'picture', 'video', 'hr', 'readmore']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['group', ['hello']]
                    //['help', ['help']]
        ],
        onChange: function (e) {
            $('#editor').val($('.editor').code());
        },
        onImageUpload: function (files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        }
    });
}

function modalInfo(msg){
    swal("Detalhe do Log", msg);
}

function calcularIdade(data) {
    var d = new Date(data);
    var dataAtual = new Date();
    var anoAtual = dataAtual.getFullYear();
    var bTY = new Date(anoAtual, d.getMonth(), d.getDate());
    var idade = anoAtual - d.getFullYear();

    if(bTY > dataAtual){
          idade--;
    }
      return idade;
}


$(document).ready(function(){
    $(".cpfCNPJ").inputmask({mask: ['999.999.999-99', '99.999.999/9999-99'], keepStatic: true });
     $(".maskCPF").inputmask({mask: ['999.999.999-99'], keepStatic: true });
     $(".maskCEP").inputmask({mask: ['99999-999'], keepStatic: true });
     $(".telefone").inputmask({mask: ["(99) 9999-9999", "(99) 99999-9999", ], keepStatic: true });

     $(".valor").inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: '',            
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: false
    });

    $('.btnImprimir').click(function(){
        $('#pcoded').attr('vertical-nav-type', 'offcanvas');
        window.print();
    });
});

 function val_CEP(strCEP, blnVazio)
        {
            // Caso o CEP não esteja nesse formato ele é inválido!
            var objER = /^[0-9]{2}.[0-9]{3}-[0-9]{3}$/;
 
            strCEP = Trim(strCEP)
            if(strCEP.length > 0)
                {
                    if(objER.test(strCEP))
                        return true;
                    else
                        return false;
                }
            else
                return blnVazio;
        }
