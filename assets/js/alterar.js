$(document).ready(function () {
    $("#bt_alterar").click(function () {
        if (validar()) {
            $(this).hide();
            notificar("aguarde", "Aguarde, carregando...");
            $.ajax({
                type: "POST",
                url: urlTrataAlterar,
                dataType: 'json',
                data: $('#frmAlterar').serialize(),
                success: function(retorno) {
                    $('#bt_alterar').show();
                    if (retorno.status == "ok") {
                        notificar("ok", retorno.msg);
                        setTimeout(function () {
                            window.history.back();
                        }, 1500);
                        $(this).show();
                    } else if (retorno.status == "validacao") {
                        notificar("alerta", retorno.msg);
                    } else {
                        notificar("erro", retorno.msg);
                    }
                    $(this).show();
                },
                error: function(retorno){
                //    alert(retorno); 
                    console.log(retorno);
                    $('#bt_alterar').show();
                    notificar("erro", "Ocorreu um erro ao tentar cadastrar, tente novamente mais tarde ou informe ao administrador.");
                }
            });
        }
        return false;
    });
});