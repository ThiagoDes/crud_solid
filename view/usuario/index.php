<?php

use Src\Helpers\Util;
use Src\Controllers\ControladorUsuario;
use Src\Exception\ValidacaoException;
use Src\Exception\UsuarioException;
use Src\Exception\BancoException;

try {

    (isset($parametro) && $parametro > 1) ? $intPage = $parametro : $intPage = 1;

    $arr = ControladorUsuario::getInstancia()->listarTodos($intPage - 1, $_POST);

    if (isset($_POST['pesquisarUsuario'])) {
        $intQtdUsuarios = count($arr);
    } else {
        $intQtdUsuarios = ControladorUsuario::getInstancia()->contar();
    }

    $intPaginas = ceil($intQtdUsuarios / REGISTROS_POR_PAGINA);
} catch (UsuarioException $e) {
    $arr = null;
} catch (ValidacaoException $e) {
    $arr = null;
} catch (BancoException $e) {
    $arr = null;
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
                                    <h4>Listar Usuários</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="#!"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Usuários</a>
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
                                    <h5>Listar Usuários</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><a href="<?php echo BASE_URL; ?>/usuario/adicionar"><i class="feather icon-plus"></i></a></li>
                                            <li><i class="feather full-card icon-maximize"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <form id="frmPesquisar" name="frmPesquisar" method="post">
                                        <input type="hidden" name="pesquisarUsuario" value="1">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strName">Nome</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" placeholder="Digite um Nome" name="strName" id="strName" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="strCPF">CPF</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round required" placeholder="Digite um CPF" name="strCPF" id="strCPF" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="intStatus">Status</label>
                                            <div class="col-sm-10">
                                                <select id="intStatus" name="intStatus" class="form-control form-control-round">
                                                    <option value="">Todos</option>
                                                    <option value="1">Ativo</option>
                                                    <option value="2">Inativo</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2"></label>
                                            <div class="col-sm-7">
                                                <button class="btn btn-primary btn-round" type="submit" id="bt_pesquisar"><i class="icofont icofont-search"></i> Pesquisar</button>
                                            </div>
                                            <div class="col-sm-3">
                                                <button class="btn btn-success btn-round btnExportarExcel" type="button"><i class="icofont icofont-file-excel"></i> Exportar Dados</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="table-responsive">
                                        <table class="table table-hover" role="grid" id="tabelaDados">
                                            <input type="hidden" id="nomeTabela" value="Lista de Usuários">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th class="delXls">Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (count($arr)) {
                                                    foreach ($arr as $objUsuario) { ?>
                                                        <tr>
                                                            <td><?php echo $objUsuario->getName(); ?></td>
                                                            <td><?php echo $objUsuario->getCpf(); ?></td>
                                                            <td><?php echo $objUsuario->getEmail(); ?></td>
                                                            <td><?php Util::geraBoxStatus($objUsuario->getId(), $objUsuario->getStatus()); ?></td>
                                                            <td class="delXls"><?php Util::geraBoxAcoes($objUsuario->getId()); ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Nome</th>
                                                    <th rowspan="1" colspan="1">CPF</th>
                                                    <th rowspan="1" colspan="1">Email</th>
                                                    <th rowspan="1" colspan="1">Status</th>
                                                    <th rowspan="1" colspan="1" class="delXls">Ações</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <?php if (count($_POST) < 1) Util::gerarPaginacao($intPaginas, $intPage, $intQtdUsuarios, "Usuario"); ?>
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
    var urlTrataExcluir = "<?php echo BASE_URL; ?>/ajax/usuario/trata.excluir.php";
    var urlTrataAlterarStatus = "<?php echo BASE_URL; ?>/ajax/usuario/trata.alterar-status.php";
    var urlAlterar = "<?php echo BASE_URL; ?>/usuario/alterar";

    $('#strName').val('<?php isset($_POST['strName']) ? print($_POST['strName']) : print('') ?>');
    $('#strCPF').val('<?php isset($_POST['strCPF']) ? print($_POST['strCPF']) : print('') ?>');
    $('#intStatus').val('<?php isset($_POST['intStatus']) ? print($_POST['intStatus']) : print('') ?>');
</script>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/listar.js"></script>


<?php include(INCLUDES . "/inc.rodape.php"); ?>