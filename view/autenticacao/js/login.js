$(document).ready(function () {
    $("#btLogin").click(function () {
        if (validar()) {
            notificar("aguarde", "Aguarde, carregando...");

            $.ajax({
                type: "POST",
                url: BASE_URL + "/ajax/autenticacao/trata.logar.php",
                dataType: 'json',
                data: $('#frmLogin').serialize(),
                success: function(retorno) {

                    console.log(retorno);
                    if (retorno.status == "ok") {
                        notificar("ok", retorno.msg);
                        window.location.href = BASE_URL;
                    } else if (retorno.status == "trocarSenha") {
                        $("#escondeForm").hide();
                        notificar("erro", retorno.msg);
                    } else {
                        if (retorno.status == "validacao") {
                            notificar("alerta", retorno.msg);
                        } else if (retorno.status == "erro") {
                            notificar("erro", retorno.msg);
                        }

                    }
                },
                error: function(retorno){
                //    alert(retorno);
                   console.log(retorno);
                   
                }
            });
        }

        return false;
    });
});