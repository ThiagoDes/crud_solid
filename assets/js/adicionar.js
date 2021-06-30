$(document).ready(function () {
    $("#bt_adicionar").click(function () {
        if (validar()) {
            $(this).hide();
            notificar("aguarde", "Aguarde, carregando...");
            $.ajax({
                type: "POST",
                url: urlTrataAdicionar,
                dataType: 'json',
                data: $('#frmAdicionar').serialize(),
                success: function(retorno) {
                    $('#bt_adicionar').show();                    
                    if (retorno.status == "ok") {
                        $("#frmAdicionar").get(0).reset();

                        notificar("ok", retorno.msg);

                        setTimeout(function () {
                            window.history.back();
                        }, 1500);
                    } else if (retorno.status == "validacao") {
                        notificar("alerta", retorno.msg);
                    } else {
                        notificar("erro", retorno.msg);
                    }
                },
                error: function(retorno){
                //  console.log(retorno);
                    $('#bt_adicionar').show();
                    notificar("erro", "Ocorreu um erro ao tentar cadastrar, tente novamente mais tarde ou informe ao administrador.");
                }
            });
        }
        return false;
    });
});