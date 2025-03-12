<?php
    Session::init();
    $sth = $this->instanceDB->prepare("SELECT id, nome FROM empresa where id <> 3 ORDER BY nome;");
    ?><!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="javascript:void(0);" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b style="font-size: 30px;">P</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="
    background-image: url(https://premierpet.com.br/wp-content/uploads/2023/10/prm_logo_white.webp);
    background-position: center center;
    background-repeat: no-repeat;
    background-size: contain;
    height: 67px;
    margin: 5px;"><b>&nbsp;</b></span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL . "dashboard/logout"; ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="treeview active">
                <a href="#"><i class="fa fa-book" aria-hidden="true"></i> <span>Gerador</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php              
                        if(Session::get('nivel') == 0) { ?>
                    <li><a href="<?php echo URL . "chave"; ?>">Chave de Acesso</a></li>
                    <li><a href="<?php echo URL . "chave/listar"; ?>">Listar Chaves de Acesso</a></li>
                    <li><a href="<?php echo URL . "chave/emails"; ?>">Listar E-mails</a></li>
                    <?php } ?>
                </ul>
            </li>
            <li class="treeview" style="display: none;">
                <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Relatórios</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php
                        if(Session::get('nivel') == 0) {
                          $sth->execute();
                          $r = $sth->fetchAll();
                          foreach ($r as $value) {
                            // if($value['nome'] == "Premier"){
                            //   $value['nome'] = "Externos";
                            // }                
                            echo ' <li><a href="' . URL . 'chave/relatorio/'.$value['id'].'">'.$value['nome'].'</a></li>';
                          }
                        } ?>
                </ul>
            </li>
            <?php if(Session::get('idUsuario') < 3) { ?>
            <li class="treeview">
                <a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Planilhas</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <?php                        
                        if(Session::get('nivel') == 0) {
                          $sth->execute();
                          $r = $sth->fetchAll();
                          foreach ($r as $value) {
                            echo ' <li class="me'.$value['id'].'"><a href="' . URL . 'chave/exportar/'.$value['id'].'">'.$value['nome'].'</a></li>';
                          }
                        }

                        if(Session::get('idUsuario') == 1) {
                            echo ' <li class="me-1"><a href="' . URL . 'chave/exportar/-1">Censo (Padrão)</a></li>';
                        }                        
                        ?>
                </ul>
            </li>
            <?php } ?>
			<?php if(Session::get('idUsuario') < 3) { ?>
				<li><a href="<?php echo URL . "apuracao"; ?>"><i class="fa fa-asterisk"></i> <span>Apuração Parcial</span></a></li>
				<li><a href="<?php echo URL . "log/listar"; ?>"><i class="fa fa-file-text-o"></i> <span>Log do Sistema</span></a></li>
				<?php if(1==2) { ?>
				<li><a href="<?php echo URL . "email/reenviar"; ?>"><i class="fa fa-envelope"></i> <span>Reenviar Emails</span></a></li>
				<?php } ?>
			<?php } ?>
            <li><a href="<?php echo URL . "dashboard/logout"; ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>