<?php

use Src\Controllers\ControladorUsuario;
use Src\Helpers\Permissao\Permissao;
use Src\Helpers\Permissao\Constantes;
use Src\Helpers\Config;

if (!ControladorUsuario::estaLogado()) {
    Config::redirecionar("autenticacao");
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <title><?php echo TITULO_PROJETO; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/sweetalert/css/sweetalert.css">


    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/notification/notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/animate.css/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/chart/radial/css/radial.css" media="all">

    <?php /* <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"> */ ?>

    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/offline-theme-slide.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/offline-language-portuguese-brazil.css" />

    <!-- notify js Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.brighttheme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.buttons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.history.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.mobile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/pnotify/notify.css">


    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.table2excel.js"></script>
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

        var run = function(){
            var req = new XMLHttpRequest();
            req.timeout = 5000;
            req.open('GET', '<?php echo BASE_URL; ?>', true);
            req.send();
        }
        setInterval(run, 3000);

        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>    
</head>

<body>
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="<?php echo BASE_URL; ?>" <?php (strpos($_SERVER['HTTP_USER_AGENT'],'Mobile') == true) && (strpos($_SERVER['HTTP_USER_AGENT'],'Safari') == true) ? print('') : print('style="position: absolute; left: 15%;"'); ?>>
                            <!-- <img class="img-fluid" style="width: 60px;" src="<?php echo BASE_URL; ?>/assets/images/logo.png" /> -->
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo BASE_URL; ?>/assets/images/user.jpg" class="img-radius" alt="User-Profile-Image">
                                        <span><?php echo ControladorUsuario::usuarioCockpit()->getName(); ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a href="<?php echo BASE_URL; ?>/usuario/logout">
                                                <i class="feather icon-log-out"></i> Sair
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">