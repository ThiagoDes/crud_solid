<?php

use Src\Helpers\Permissao\Permissao;
use Src\Helpers\Permissao\Constantes;
?>


<div class="pcoded-wrapper ">
    <nav class="pcoded-navbar noprint">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigatio-lavel">Administração</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="">
                    <a href="<?php echo BASE_URL; ?>">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Página Inicial</span>
                    </a>
                </li>
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Usuários</span>
                    </a>
                    <ul class="pcoded-submenu">
                        <li class="">
                            <a href="<?php echo BASE_URL; ?>/usuario/adicionar">
                                <span class="pcoded-mtext">Adicionar</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="<?php echo BASE_URL; ?>/usuario">
                                <span class="pcoded-mtext">Listar</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>