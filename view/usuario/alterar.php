<?php

use Src\Controllers\ControladorUsuario;
use Src\Exception\ValidacaoException;
use Src\Exception\UsuarioException;
use Src\Exception\BancoException;

try {
    $intIdUsuario = $parametro;
    $objUsuario = ControladorUsuario::getInstancia()->visualizar($intIdUsuario);
} catch (ValidacaoException $e) {
    die($e->getMessage());
} catch (UsuarioException $e) {
    die($e->getMessage());
} catch (BancoException $e) {
    die($e->getMessage());
}

include(INCLUDES . "/inc.topo.php");

// carregando o menu
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
                                    <h4>Alterar Usuário</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="#!"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Usuário</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Alterar</a>
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
                                    <h5>Alterar Usuário</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather full-card icon-maximize"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form id="frmAlterar" name="frmAlterar" method="post">
                                        <h4 class="sub-title">Dados Pessoais</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strName">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Nome Completo" name="strName" id="strName" value="<?php echo $objUsuario->getName() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCpf">CPF</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required maskCPF valid_cpf" autocomplete="off" placeholder="Informe o CPF" name="strCpf" id="strCpf" value="<?php echo $objUsuario->getCpf() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strPhone">Telefone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required telefone" autocomplete="off" placeholder="Informe o Telefone" name="strPhone" id="strPhone" value="<?php echo $objUsuario->getPhone() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strEmail">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required valid_email" autocomplete="off" placeholder="Informe o Email" name="strEmail" id="strEmail" value="<?php echo $objUsuario->getEmail() ?>">
                                            </div>
                                        </div></br>

                                        <h4 class="sub-title">Dados de Endereço</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strAddress">Endereço</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round " autocomplete="off" placeholder="Informe o Logradouro" name="strAddress" id="strAddress" value="<?php echo $objUsuario->getAddress() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strNumber">Número</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Número" name="strNumber" id="strNumber" value="<?php echo $objUsuario->getNumber() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strDistrict">Bairro</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe o Bairro" name="strDistrict" id="strDistrict" value="<?php echo $objUsuario->getDistrict() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCep">CEP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required maskCEP val_CEP" autocomplete="off" placeholder="Informe o CEP" name="strCep" id="strCep" value="<?php echo $objUsuario->getCep() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCity">Cidade</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" autocomplete="off" placeholder="Informe a Cidade" name="strCity" id="strCity" value="<?php echo $objUsuario->getCity() ?>">
                                            </div>
                                        </div></br>

                                        <h4 class="sub-title">Dados de Acesso</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strLogin">Login</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control form-control-round" id="strLogin" name="strLogin" placeholder="Informe o Login" value="<?php echo $objUsuario->getLogin() ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strPassword">Nova Senha</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control form-control-round" name="strPassword" id="strPassword" placeholder="Informe a Senha">
                                                <span class="m-form__help">* Caso deseje alterar sua senha</span>
                                            </div>
                                        </div>
                                </div>
                                <input type="hidden" name="intId" id="intId" value="<?php echo $objUsuario->getId(); ?>" />
                                <?php include(INCLUDES . "/inc.buttons.edit.php"); ?>
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

<script type="text/javascript">
    var urlTrataAlterar = "<?php echo BASE_URL; ?>/ajax/usuario/trata.alterar.php";
</script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/alterar.js"></script>

<?php include(INCLUDES . "/inc.rodape.php"); ?>