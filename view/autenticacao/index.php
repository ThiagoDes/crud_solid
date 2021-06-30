<?php 
    if(isset($_SESSION[USUARIO_COCKPIT])){
        header('Location: '.BASE_URL);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <title><?php echo TITULO_PROJETO; ?></title>
    <meta name="description" content="Projeto focado na utilização de princípios sólidos.">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

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


        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/icon/icofont/css/icofont.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/notification/notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/animate.css/css/animate.css">

    <!-- notify js Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.brighttheme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.buttons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.history.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/css/pnotify.mobile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/pages/pnotify/notify.css">
</head>

<body class="fix-menu">
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
                <div class="ring"><div class="frame"></div></div>
            </div>
        </div>
    </div>

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    
                        <form method="post" id="frmLogin" name="frmLogin" class="md-float-material form-material">
                            <div class="text-center">
                                <img class="img-fluid" src="<?php echo BASE_URL; ?>/assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <!-- <h3 class="text-center">Entrar</h3> -->
                                            <!-- <h3 class="form-title text-center"><img alt="" src="<?php echo BASE_URL; ?>/assets/img/logo.png" style="max-width: 250px;" /></h3>       -->
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="text" name="strLogin" id="strLogin" autocomplete="off" class="form-control" required="" placeholder="Usuário">
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="password" name="strSenha" id="strSenha" autocomplete="off" class="form-control" required="" placeholder="Senha">
                                        <span class="form-bar"></span>
                                    </div>
<!--                                     <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Lembrar Senha</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                                <a href="auth-reset-password.html" class="text-right f-w-600"> Esqueceu Senha?</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="button" value="Login" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" id="btLogin" name="btLogin">Login</button>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-inverse text-left m-b-0 text-center"><?php echo date('Y'); ?> &copy; <?php echo INFO_RODAPE; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/modernizr/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/i18next/js/i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js"></script>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/pages/pnotify/notify.js"></script>
    
        <!-- pnotify js -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.desktop.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.buttons.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.confirm.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.callbacks.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.animate.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.history.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.mobile.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/pnotify/js/pnotify.nonblock.js"></script>

    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/jquery-i18next/js/jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/common-pages.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/bower_components/modernizr/js/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/bootstrap-growl.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/pages/notification/notification.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/geral.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/autenticacao/js/login.js"></script>

</body>

</html>
