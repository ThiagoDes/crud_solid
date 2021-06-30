$(document).ready(function () {
    $(".bt_excluir").on('click', function () {
        var idE = this.id;
        swal({
            title: '<strong>Deseja realmente excluir o registro?</strong>',
            type: 'warning',
            html: 'Deseja realmente excluir o registro?',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }, function(result){
            if (result) {
                excluir(idE);
            }
        });
    });

    $(".bt_alterar").on('click', function () {
        alterar(this.id);
    });

    $(".select_status").on('change', function () {
        var obj = this;
        swal({
            title: '<strong>Deseja realmente alterar o status do registro?</strong>',
            type: 'info',
            html: 'Deseja realmente excluir o registro?',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }, function(result){
            if(result == true){
                alterarStatus(obj.id, obj.value);
            }else{
                if(obj.value == 1){
                    s = 0;
                }else{
                    s = 1;
                }
                $(obj).val(s);
            }
        });
    });

    $(".select_restricao").on('change', function () {
        var obj = this;
        swal({
            title: '<strong>Deseja realmente alterar a restrição do registro?</strong>',
            type: 'info',
            html: 'Deseja realmente alterar restrição?',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }, function(result){
            if(result == true){
                alterarRestricao(obj.id, obj.value);
            }else{
                if(obj.value == 1){
                    s = 0;
                }else{
                    s = 1;
                }
                $(obj).val(s);
            }
        });
    });

     $(".select_roubado").on('change', function () {
        var obj = this;
        swal({
            title: '<strong>Deseja realmente alterar roubado do registro?</strong>',
            type: 'info',
            html: 'Deseja realmente alterar roubado?',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não'
        }, function(result){
            if(result == true){
                alterarRoubado(obj.id, obj.value);
            }else{
                if(obj.value == 1){
                    s = 0;
                }else{
                    s = 1;
                }
                $(obj).val(s);
            }
        });
    });

    $("#btnExporta").on('click', function () {
        var arrId = new Array();
        var validacao = false;
        //Para cada checkbox marcado
        $(".checkItem:checked").each(function (index) {
            validacao = true;
            arrId.push($(this).val());
        });

        if (validacao) {
            window.location.href = urlTrataExporta + '?arrId=' + arrId;
        } else {
            notificar("erro", 'Você deve selecionar algum evento');
        }
    });


    $("#checkTodos").change(function () {
        console.log('chegou aqui');

        if (!$(this).attr('checked')) {
            $(".checkItem").each(function (index) {
                $(this).parent().removeClass('checked');
                $(this).attr('checked', false);
            });
        } else {
            $(".checkItem").each(function (index) {
                $(this).parent().addClass('checked');
                $(this).attr('checked', true);
            });
        }
    });

    $(".btnExportarExcel").click(function () {
        // console.log('chegou aqui');
        $("#tabelaDados").table2excel({
            exclude: ".delXls",
            name: $('#nomeTabela').val(),
            filename: $('#nomeTabela').val(),
            fileext: ".xlsx",
            exclude_img: true,
            exclude_links: true,
            exclude_inputs: true
        });
    });



});

function alterarStatus(intId, intStatus) {
    notificar("aguarde", "Aguarde, carregando...");
    $.ajax({
        type: "POST",
        url: urlTrataAlterarStatus,
        dataType: 'json',
        data: {
            intId: intId,
            intStatus: intStatus
        },
        success: function(retorno) {
            // alert(retorno);
            // console.log(retorno);
            if (retorno.status == "ok") {
                notificar("ok", retorno.msg);
                // setTimeout(function () {
                //     window.location.reload();
                // }, 1500);
            } else {
                notificar("erro", retorno.msg);
                return false;
            }
        },
        error: function(retorno){
            // alert(retorno);
            // console.log(retorno);
            notificar("erro", "Ocorreu um erro ao tentar cadastrar, tente novamente mais tarde ou informe ao administrador.");
        }
    });
}


function alterarRestricao(intId, intRestricao) {
    notificar("aguarde", "Aguarde, carregando...");
    $.ajax({
        type: "POST",
        url: urlTrataAlterarRestricao,
        dataType: 'json',
        data: {
            intId: intId,
            intRestricao: intRestricao
        },
        success: function(retorno) {
            // alert(retorno);
            // console.log(retorno);
            if (retorno.status == "ok") {
                notificar("ok", retorno.msg);
                // setTimeout(function () {
                //     window.location.reload();
                // }, 1500);
            } else {
                notificar("erro", retorno.msg);
                return false;
            }
        },
        error: function(retorno){
            alert(retorno);
            console.log(retorno);
            notificar("erro", "Ocorreu um erro ao tentar alterar restrição, tente novamente mais tarde ou informe ao administrador.");
        }
    });
}

function alterarRoubado(intId, intRoubado) {
    notificar("aguarde", "Aguarde, carregando...");
    $.ajax({
        type: "POST",
        url: urlTrataAlterarRoubado,
        dataType: 'json',
        data: {
            intId: intId,
            intRoubado: intRoubado
        },
        success: function(retorno) {
            // alert(retorno);
            // console.log(retorno);
            if (retorno.status == "ok") {
                notificar("ok", retorno.msg);
                // setTimeout(function () {
                //     window.location.reload();
                // }, 1500);
            } else {
                notificar("erro", retorno.msg);
                return false;
            }
        },
        error: function(retorno){
            alert(retorno);
            console.log(retorno);
            notificar("erro", "Ocorreu um erro ao tentar alterar restrição, tente novamente mais tarde ou informe ao administrador.");
        }
    });
}

function excluir(intId) {
    notificar("aguarde", "Aguarde, carregando...");
    $.ajax({
        type: "POST",
        url: urlTrataExcluir,
        dataType: 'json',
        data: {
            intId: intId,            
        },
        success: function(retorno) {
            // alert(retorno);
            // console.log(retorno);
            if (retorno.status == "ok") {
                notificar("ok", retorno.msg);
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            } else {
                notificar("erro", retorno.msg);
                return false;
            }
        },
        error: function(retorno){
                     // console.log(retorno);
            notificar("erro", "Ocorreu um erro ao tentar cadastrar, tente novamente mais tarde ou informe ao administrador.");
        }
    });
}

function alterar(intId) {
    window.location.href = urlAlterar + "/" + intId;
}