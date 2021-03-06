<?php
include(INCLUDES . "/inc.topo.php");
include(INCLUDES . "/inc.menu.php");
?>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Cadastrar Usuario</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="#!"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Usuario</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Adicionar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Cadastrar Usuario</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather full-card icon-maximize"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form id="frmAdicionar" name="frmAdicionar" method="post">
                                        <h4 class="sub-title">Dados Pessoais</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strName">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Nome Completo" name="strName" id="strName" maxlength="100" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCpf">CPF</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required maskCPF valid_cpf" autocomplete="off" placeholder="Informe o CPF" name="strCpf" id="strCpf" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strTelefone">Telefone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required telefone" autocomplete="off" placeholder="Informe o Telefone" name="strPhone" id="strTelefone" required="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strEmail">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required valid_email" autocomplete="off" placeholder="Informe o Email" name="strEmail" id="strEmail" required="">
                                            </div>
                                        </div></br>

                                        <h4 class="sub-title">Dados de Endere??o</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strAddress">Endere??o</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round" autocomplete="off" placeholder="Informe o Endere??o" name="strAddress" id="strAddress" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strNumber">N??mero</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o N??mero" name="strNumber" id="strNumber" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strDistrict">Bairro</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Bairro" name="strDistrict" id="strDistrict" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCep">CEP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required maskCEP val_CEP" autocomplete="off" placeholder="Informe o CEP" name="strCep" id="strCep" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCity">Cidade</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe a Cidade" name="strCity" id="strCity" maxlength="100" required="">
                                            </div>
                                        </div></br>

                                        <h4 class="sub-title">Dados de Acesso</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strLogin">Login</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Login" name="strLogin" id="strLogin" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strPassword">Senha</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control form-control-round required" autocomplete="off" placeholder="Informe a Senha" name="strPassword" id="strPassword" maxlength="100" required="">
                                            </div>
                                        </div>

                                        <?php include(INCLUDES . "/inc.buttons.add.php"); ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var urlTrataAdicionar = "<?php echo BASE_URL; ?>/ajax/usuario/trata.adicionar.php";
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/adicionar.js"></script>
<?php include(INCLUDES . "/inc.rodape.php"); ?>