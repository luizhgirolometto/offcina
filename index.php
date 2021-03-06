<?php

    // identificando dispositivo
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

    $eMovel="N";
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $eMovel="S";
    }

    // incluindo bibliotecas de apoio
    include "banco.php";
    include "util.php";

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    } Else {
        header('Location: index.html');
    }

    if (isset($_COOKIE['codempresa'])) {
        $codempresa = $_COOKIE['codempresa'];
    } Else {
        header('Location: index.html');
    }

    if (isset($_COOKIE['nomeempresa'])) {
        $nomeempresa = $_COOKIE['nomeempresa'];
    } Else {
        header('Location: index.html');
    }    
    if (isset($_COOKIE['codempresa'])) {
        $codempresa = $_COOKIE['codempresa'];
    } Else {
        header('Location: index.html');
    }

    if (isset($_COOKIE['nomeempresa'])) {
        $nomeempresa = $_COOKIE['nomeempresa'];
    } Else {
        header('Location: index.html');
    }     

    // nome do usuario
    if (isset($_COOKIE['deusua'])) {
        $deusua = $_COOKIE['deusua'];
    } Else {
        header('Location: index.html');
    }

    //tipo de usuario
    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    } Else {
        header('Location: index.html');
    }

    //localização da foto
    if (isset($_COOKIE['defoto'])) {
        $defoto = $_COOKIE['defoto'];
    }

    //tipo de usuario
    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    }

    //email de usuario
    if (isset($_COOKIE['demail'])) {
        $demail = $_COOKIE['demail'];
    }

    $detipo="Tipo Não Identificado";
    if ($cdtipo == "A") {
        $detipo="Administrador";
    }
    if ($cdtipo == "F") {
        $detipo="Funcionário";
    }
    if ($cdtipo == "O") {
        $detipo="Oficina";
    }
    if ($cdtipo == "M") {
        $detipo="Mecânico";
    }
    if ($cdtipo == "C") {
        $detipo="Cliente";
    }
    if ($cdtipo == "S") {
        $detipo="Suporte";
    }

    // reduzir o tamanho do nome do usuario
    $deusua1=$deusua;
    $deusua = substr($deusua, 0,15);

    $demails="marlon.pilonetto@gmail.com";
    $deteles="(46) 98412 1475";
    // $totClie = GetTotalClients($codempresa);
    // $totForn = GetTotalForn($codempresa);
    // $totCars = GetTotalCars($codempresa);
    // $totPedi = GetTotalPedi($codempresa);
    $totalOrc = GetTotalOrc($codempresa);
    $totalOsPen = GetTotalOsPen($codempresa);
    $totalOsAnd = GetTotalOsAnd($codempresa);
    $totalOsFecHJ = GetTotalOsFecHJ($codempresa);
    $aCont= ConsultarDados("", "", "","select contas.*,clientes.declie from contas INNER join clientes on clientes.cdclie = contas.cdquem where WEEKOFYEAR(dtcont) = WEEKOFYEAR(CURDATE()) and contas.codempresa = "."'{$codempresa}'"." order by dtcont");
    $aAge= ConsultarDados("","","", "select agendamentos.*,clientes.declie, clientes.nrtele from agendamentos INNER join clientes on clientes.cdclie = agendamentos.cdclie where WEEKOFYEAR(dtret) = WEEKOFYEAR(CURDATE()) and agendamentos.codempresa = "."'{$codempresa}'"." order by dtret");

?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>GiroMecanicas&copy; | Principal </title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/AdminLTE.min.css" rel="stylesheet">

        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">

    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                <img alt="foto" width="80" height="80" class="img-circle" src="<?php echo $defoto; ?>" />
                                 </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $deusua; ?></strong>
                                 </span> <span class="text-muted text-xs block"><?php echo $detipo; ?><b class="caret"></b></span> </span>
                                </a>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="meusdados.php">Atualizar Meus Dados</a></li>
                                    <li><a href="minhasenha.php">Alterar Minha Senha</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.html">Sair</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- <li class="special_link"> 
                    <li>
                        <a href="cliente.php"><i class="fa fa-user"></i> <span class="nav-label">Cadastrar Clientes</span></a>
                    </li> -->

                        <li>
                            <a href="index.php"><i class="fa fa-user"></i> <span class="nav-label">Clientes</span><span class="caret"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="cliente.php">Cadastros de Clientes</a></li>
                                <li><a href="veiculos.php">Cadastros de Veículos</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="index.php"><i class="fa fa-edit"></i> <span class="nav-label">Ordens de Serviço</span><span class="caret"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="ordemi.php">Abrir</a></li>
                                <li><a href="agenda.php">Abertas</a></li>
                                <li><a href="fechaordem.php">Fechar</a></li>

                                <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                                    <li><a href="ordem.php">Gerenciamento de Ordens de Serviço</a></li>
                                    <?php }?>
                            </ul>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-edit"></i> <span class="nav-label">Produtos/Serviços</span><span class="caret"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="pecas.php">Cadastros de Produtos</a></li>
                                <li><a href="servicos.php">Cadastros de Serviços</a></li>
                            </ul>
                        </li>

                        <!-- <li>
                    <li>
                        <a href="ordem.php"><i class="fa fa-edit"></i><span class="nav-label">Ordem de Serviços</span></a>
                    </li>

                        <a href="veículos.php"><i class="fa fa-car"></i><span class="nav-label">Cadastrar Veículos</span></a>
                    </li> -->

                        <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                            <li>
                                <a href="fornecedores.php"><i class="fa fa-user"></i><span class="nav-label">Cadastros de Fornecedores</span></a>
                            </li>

                            <li>
                                <a href="pedidos.php"><i class="fa fa-user"></i><span class="nav-label">Cadastrar Pedidos</span></a>
                            </li>
                            <?php }?>

                                <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                                    <!-- <li class="special_link"> -->
                                    <li>
                                        <a href="contas.php"><i class="fa fa-money"></i> <span class="nav-label">Contas a Pagar/Receber</span></a>
                                    </li>
                                    <?php }?>

                                        <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                                            <li>
                                                <a href="index.php"><i class="fa fa-calculator"></i> <span class="nav-label">Fluxo de Caixa</span><span class="caret"></span></a>
                                                <ul class="nav nav-second-level">
                                                    <li><a href="fluxo.php">Pagar/Receber Resumido</a></li>
                                                    <li><a href="fluxof.php">Receber por Forma de Pagamento</a></li>
                                                </ul>
                                            </li>
                                            <?php }?>

                                                <!--

                    <li>
                        <a href="agenda.php"><i class="fa fa-calendar"></i> <span class="nav-label">Agenda</span></a>
                    </li> -->

                                                <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                                                    <!-- <li class="special_link"> -->
                                                    <li>
                                                        <a href="parametros.php"><i class="fa fa-key"></i> <span class="nav-label">Minha Oficina</span></a>
                                                    </li>
                                                    <?php }?>

                                                        <?php if (($cdtipo == 'A') || ($cdtipo == 'S')){?>
                                                            <!--  <li>
                            <a href="historico.php"><i class="fa fa-eye"></i> <span class="nav-label">Histórico</span></a>
                        </li> -->
                                                            <?php }?>

                                                                <?php if (($cdtipo == 'A') || ($cdtipo == 'S')) {?>
                                                                    <li>
                                                                        <a href="usuarios.php"><i class="fa fa-users"></i> <span class="nav-label">Cadastrar Usuários</span></a>
                                                                    </li>
                                                                    <!--             
                        <li>
                            <a href="pecas.php"><i class="fa fa-wrench"></i><span class="nav-label">Cadastrar Peças</span></a>
                        </li>

                        <li>
                            <a href="servicos.php"><i class="fa fa-car"></i> <span class="nav-label">Cadastrar Serviços</span></a>
                        </li> -->
                                                                    <?php }?>
                                                                        <?php if ($cdtipo == 'S'){?>
                                                                            <li class="special_link">
                                                                                <a href="oficinas.php"><i class="fa fa-key"></i> <span class="nav-label">Cadastrar Empresas</span></a>
                                                                            </li>
                                                                            <?php }?>

                    </ul>
                </div>
            </nav>
            <br>
            <br>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-warning " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-left">
                            <br>
                            <li>
                                <?php if (strlen($cdusua) == 14 ) {;?>
                                    <h3><?php echo  $codempresa." - ";?></h3>
                                    <?php } Else {?>
                                        <h3><?php echo  $codempresa." - ";?></h3>
                                        <?php }?>
                            </li>
                            <li>
                                <h3><?php echo  $nomeempresa ;?></h3>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Bem-vindo ao <strong>GiroMecanicas&copy;</strong></span>
                            </li>
                            <li>
                                <a href="index.html">
                                    <i class="fa fa-sign-out"></i> Sair
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!--   <div class="wrapper-content">
                <section class="content">
                <div class="panel panel-warning">
                     <div class="panel-heading">
                             <h3> Informações de cadastros </h3>   
                      </div>
                 <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3> <?php echo $totClie ?> </h3>

                                        <p>Total de Clientes</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person"></i>
                                    </div>
                                    <a href="cliente.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3> <?php echo $totCars ?> </h3>

                                        <p>Total de Veículos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-model-s"></i>
                                    </div>
                                    <a href="veículos.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><?php echo $totForn ?></h3>

                                        <p>Total de Fornecedores </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-stalker"></i>
                                    </div>
                                    <a href="fornecedores.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>                    

                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                    <h3> <?php echo $totPedi ?> </h3> 

                                        <p>Total de Pedidos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-compose"></i>
                                    </div>
                                    <a href="veículos.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                          </div>
                        </div>                        
                    </div>  -->
                <!-- Iniico Quadro de OSs -->
                <div class="col-lg-12 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3> Ordens de serviço </h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                        <h3><?php echo $totalOrc ?></h3>

                                        <p>Orçamentos</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-cash"></i>
                                    </div>
                                    <a href="agenda.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                        <h3><?php echo $totalOsPen ?></h3>

                                        <p>Ordens abertas </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-clock"></i>
                                    </div>
                                    <a href="agenda.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><?php echo $totalOsAnd ?></h3>

                                        <p>Em andamento </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-speedometer"></i>
                                    </div>
                                    <a href="agenda.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xs-6">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3><?php echo $totalOsFecHJ ?></h3>

                                        <p>Fechadas hoje </p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-thumbsup"></i>
                                    </div>
                                    <a href="agenda.php" class="small-box-footer">Mais informações <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Final Quadro de OSs -->
                <!-- Inicio Avisos -->
                <!--   <div class="panel panel-warning">
                     <div class="panel-heading">
                          <h3> Avisos </h3>   
                     </div>
                     <div class="panel-body"> -->
                <!-- Vencimento de contas hoje - INICIO -->
                <div class="col-lg-6 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <center>
                                <h4> Contas a receber que vencem na semana </h4>
                                <center>
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cliente/Fornecedor</th>
                                            <th>Histórico</th>

                                            <th>Valor(R$)</th>
                                            <th>Vencimento</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($f =0; $f <= (count($aCont)-1); $f++) { ?>
                                            <tr class="gradeX">
                                                <?php $datac = strtotime($aCont[$f]["dtcont"]) ;?>
                                                    <?php $datap = strtotime($aCont[$f]["dtpago"]) ;?>
                                                        <?php $datah = strtotime(date("d-m-Y")) ;?>

                                                            <?php $coluna1 = trim($aCont[$f]["cdcont"]); ?>
                                                                <?php $coluna2 = trim($aCont[$f]["cdquem"]) .'-'. $aCont[$f]["declie"]; ?>
                                                                    <?php $coluna3 = trim($aCont[$f]["decont"]); ?>

                                                                        <?php $coluna5 = number_format($aCont[$f]["vlcont"],2,',','.'); ?>
                                                                            <?php $coluna6 = ""; ?>
                                                                                <?php $coluna7 = ""; ?>

                                                                                    <?php if ( empty($datac) !== true and strtotime($aCont[$f]["dtcont"]) !== '-62169984000' and $aCont[$f]["dtcont"] !== '1969-12-31' ){ ?>
                                                                                        <?php $coluna6 = date("d-m-Y", $datac); ?>
                                                                                            <?php }?>

                                                                                                <?php $ver = "contasa.php?acao=ver&chave=".$coluna1; ?>
                                                                                                    <?php $edita = "contasa.php?acao=edita&chave=".$coluna1; ?>
                                                                                                        <?php $apaga = "contasa.php?acao=apaga&chave=".$coluna1; ?>
                                                                                                            <?php $imprime = "contasp.php?acao=imprime&chave=".$coluna1; ?>

                                                                                                                <td>
                                                                                                                    <?php print $coluna1; ?>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <?php print $coluna2; ?>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <?php print $coluna3; ?>
                                                                                                                </td>

                                                                                                                <td>
                                                                                                                    <?php print $coluna5; ?>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <?php print $coluna6; ?>
                                                                                                                </td>

                                            </tr>
                                            <?php }; ?>
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- vencimento de contas hoje - FIM -->
                <div class="col-lg-6 col-xs-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <center>
                                <h4> Retornos agendados para a semana</h4>
                                <center>
                        </div>
                        <div class="panel-body">
                            <?php if (count($aAge) > 0) { ?>                        
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Motivo</th>
                                                <th>Data prevista</th>
                                                <th>Telefone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($f =0; $f <= (count($aAge)-1); $f++) { ?>
                                                <tr class="gradeX">

                                                    <?php $datah =  strtotime($aAge[$f]["dtret"]);?>

                                                        <?php $coluna1 = trim($aAge[$f]["declie"]); ?>
                                                            <?php $coluna2 = trim($aAge[$f]["motivo"]); ?>
                                                                <?php $coluna3 = date("d-m-Y", $datah); ?>

                                                                    <?php $coluna4 = trim($aAge[$f]["nrtele"]);?>

                                                                        <?php $ver = "contasa.php?acao=ver&chave=".$coluna1; ?>
                                                                            <?php $edita = "contasa.php?acao=edita&chave=".$coluna1; ?>
                                                                                <?php $apaga = "contasa.php?acao=apaga&chave=".$coluna1; ?>
                                                                                    <?php $imprime = "contasp.php?acao=imprime&chave=".$coluna1; ?>

                                                                                        <td>
                                                                                            <?php print $coluna1; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php print $coluna2; ?>
                                                                                        </td>
                                                                                        <td>
                                                                                            <?php print $coluna3; ?>
                                                                                        </td>

                                                                                        <td>
                                                                                            <?php print $coluna4; ?>
                                                                                        </td>

                                                </tr>
                                                <?php }; ?>
                                        </tbody>

                                    </table>
                                </div>
                            <?php } else { ?>
                            <center>
                              <h3> Sem retornos agendados ;( </h3>
                            </center>    
                            <?php }; ?>
                        </div>
                    </div>
                </div>
                <!--                             
                     </div>
                   </div> -->
                <!-- Final Avisos -->

            </div>
        </div>
        </div>
        <!-- Mainly scripts -->
        <script src="js/jquery-2.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Flot -->
        <script src="js/plugins/flot/jquery.flot.js"></script>
        <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="js/plugins/flot/jquery.flot.pie.js"></script>
        <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
        <script src="js/plugins/flot/jquery.flot.time.js"></script>

        <!-- Peity -->
        <script src="js/plugins/peity/jquery.peity.min.js"></script>
        <script src="js/demo/peity-demo.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>

        <!-- jQuery UI -->
        <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- Jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

        <!-- EayPIE -->
        <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

        <!-- Sparkline demo data  -->
        <script src="js/demo/sparkline-demo.js"></script>

    </body>

    </html>