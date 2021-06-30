  // 'use strict';
// $(document).ready(function() {
   
    /*--------------------------------------
         Notifications & Dialogs
     ---------------------------------------*/
    /*
     * Notifications
     */
    function notify(from, align, icon, type, animIn, animOut, msg){
        $.growl({
            icon: icon,
            title: '  ',
            message: msg,
            url: ''
        },{
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: from,
                align: align
            },
            offset: {
                x: 30,
                y: 30
            },
            spacing: 10,
            z_index: 999999,
            delay: 2500,
            timer: 1000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: animIn,
                exit: animOut
            },
            icon_type: 'class',
            template: '<div data-growl="container" class="alert" role="alert">' +
            '<button type="button" class="close" data-growl="dismiss">' +
            '<span aria-hidden="true">&times;</span>' +
            '<span class="sr-only">Fecha</span>' +
            '</button>' +
            '<span data-growl="icon"></span>' +
            '<span data-growl="title"></span>' +
            '<span data-growl="message"></span>' +
            '<a href="#" data-growl="url"></a>' +
            '</div>'
        });
    };

    $('.notifications .btn').on('click',function(e){
        e.preventDefault();
        var nFrom = $(this).attr('data-from');
        var nAlign = $(this).attr('data-align');
        var nIcons = $(this).attr('data-icon');
        var nType = $(this).attr('data-type');
        var nAnimIn = $(this).attr('data-animation-in');
        var nAnimOut = $(this).attr('data-animation-out');

        notify(nFrom, nAlign, nIcons, nType, nAnimIn, nAnimOut);
    });

    // function notificar(tipo, msg){
    //     var type;
    //     if(tipo == "ok"){
    //         type = "success";
    //     }else if(tipo == "erro"){
    //         type = "danger";
    //     }else if(tipo == "alerta"){
    //         type = "warning";
    //     }else if(tipo == "aguarde"){
    //         type = "primary";
    //     }
    //     notify("bottom", "right", "", type, "animated fadeIn", "animated fadeOut", msg);
    // }


// });

