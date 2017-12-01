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

    // reduzir o tamanho do nome do usuario
    $deusua1=$deusua;
    $deusua = substr($deusua, 0,15);

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GiroMecânicas&copy; | Principal </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                                 </span> <span class="text-muted text-xs block"><?php echo $detipo; ?><b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="meusdados.php">Atualizar Meus Dados</a></li>
                                <li><a href="minhasenha.php">Alterar Minha Senha</a></li>
                                <li class="divider"></li>
                                <li><a href="index.html">Sair</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> <span class="nav-label">Menu Principal</span></a>
                    </li>                    

                </ul>
            </div>
        </nav>

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
                                <span><?php echo  $codempresa." - ";?></span>
                            <?php } Else {?>
                                <span><?php echo  $codempresa." - ";?></span>
                            <?php }?>
                        </li>
                        <li>
                            <span><?php echo  $nomeempresa ;?></span>
                        </li>
                    </ul>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bem vindo a <strong>GiroMecânicas&copy;</strong></span>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <button type="button" class="btn btn-warning btn-lg btn-block"><i
                                                    class="fa fa-user"></i> Fluxo de Caixa - Resumo
                        </button>
                    </div>
                    <br>
                    <div>
                        <center>
                            <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                        </center>
                    </div>

                    <div class="row">
                        <br>
                        <div class="col-md-4">
                            <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-frown-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span>Ordem de Serviços </br> <strong>Pendentes</strong> </span>
                                        <h2 class="font-bold"><?php echo ContaOS('P');?></h2>
                                    </div>
                                </div>
                            </div>                              
                        </div>        
                        <div class="col-md-4">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-gavel fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span>Ordem de Serviços </br><strong>Em Andamento</strong></span>
                                        <h2 class="font-bold"><?php echo ContaOS('A');?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-smile-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <span>Ordem de Serviços </br><strong>Concluídas</strong></span>
                                        <h2 class="font-bold"><?php echo ContaOS('C');?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox-content">
                                <?php $vlp = SomaContas(1,'P'); ?>
                                <?php $vlr = SomaContas(1,'R'); ?>
                                <span class="label label-danger">Pagar</span>
                                <span class="label label-success">Receber</span>
                                <br>
                                <br>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Janeiro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(2,'P'); ?>
                                <?php $vlr = SomaContas(2,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Fevereiro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(3,'P'); ?>
                                <?php $vlr = SomaContas(3,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Março/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(4,'P'); ?>
                                <?php $vlr = SomaContas(4,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Abril/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox-content">
                                <?php $vlp = SomaContas(5,'P'); ?>
                                <?php $vlr = SomaContas(5,'R'); ?>
                                <span class="label label-danger">Pagar</span>
                                <span class="label label-success">Receber</span>
                                <br>
                                <br>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Maio/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(6,'P'); ?>
                                <?php $vlr = SomaContas(6,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Junho/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(7,'P'); ?>
                                <?php $vlr = SomaContas(7,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Julho/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(8,'P'); ?>
                                <?php $vlr = SomaContas(8,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Agosto/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="ibox-content">
                                <?php $vlp = SomaContas(9,'P'); ?>
                                <?php $vlr = SomaContas(9,'R'); ?>
                                <span class="label label-danger">Pagar</span>
                                <span class="label label-success">Receber</span>
                                <br>
                                <br>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Setembro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(10,'P'); ?>
                                <?php $vlr = SomaContas(10,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Outubro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(11,'P'); ?>
                                <?php $vlr = SomaContas(11,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Novembro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>
                                <?php $vlp = SomaContas(12,'P'); ?>
                                <?php $vlr = SomaContas(12,'R'); ?>
                                <div>
                                    <div>
                                        <span><strong><?php echo 'Dezembro/'.date("Y");?></strong></span>
                                        <small class="pull-right">R$</small>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                    </div>
                                    <div class="progress progress-medium">
                                        <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <br>
                    <div>
                        <center>
                            <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>

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

    <script>

        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        $(document).ready(function() {
            $('.chart').easyPieChart({
                barColor: '#f29739',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            $('.chart2').easyPieChart({
                barColor: '#1c84c6',
//                scaleColor: false,
                scaleLength: 5,
                lineWidth: 4,
                size: 80
            });

            var data2 = [
                [gd(2016, 1, 1), 400], [gd(2016, 2, 1), 300], [gd(2016, 3, 1), 180], [gd(2016, 4, 1), 150],
                [gd(2016, 5, 1), 88], [gd(2016, 6, 1), 455], [gd(2016, 7, 1), 93]
            ];

            var data3 = [
                [gd(2016, 1, 1), 800], [gd(2016, 2, 1), 500], [gd(2016, 3, 1), 600], [gd(2016, 4, 1), 700],
                [gd(2016, 5, 1), 178], [gd(2016, 6, 1), 555], [gd(2016, 7, 1), 993]
            ];

            var dataset = [
                {
                    label: "Receita Prevista",
                    data: data3,
                    color: "#1ab394",
                    bars: {
                        show: true,
                        align: "center",
                        barWidth: 24 * 60 * 60 * 600,
                        lineWidth:0
                    }

                }, {
                    label: "Receita Realizada",
                    data: data2,
                    yaxis: 2,
                    color: "#1C84C6",
                    lines: {
                        lineWidth:1,
                            show: true,
                            fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.2
                            }, {
                                opacity: 0.4
                            }]
                        }
                    },
                    splines: {
                        show: false,
                        tension: 0.6,
                        lineWidth: 1,
                        fill: 0.1
                    },
                }
            ];


            var options = {
                xaxis: {
                    mode: "time",
                    tickSize: [3, "month"],
                    tickLength: 0,
                    axisLabel: "Date",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 10,
                    color: "#d5d5d5"
                },
                yaxes: [{
                    position: "left",
                    max: 1070,
                    color: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: 'Arial',
                    axisLabelPadding: 3
                }, {
                    position: "right",
                    clolor: "#d5d5d5",
                    axisLabelUseCanvas: true,
                    axisLabelFontSizePixels: 12,
                    axisLabelFontFamily: ' Arial',
                    axisLabelPadding: 67
                }
                ],
                legend: {
                    noColumns: 1,
                    labelBoxBorderColor: "#000000",
                    position: "nw"
                },
                grid: {
                    hoverable: false,
                    borderWidth: 0
                }
            };

            function gd(year, month, day) {
                return new Date(year, month - 1, day).getTime();
            }

            var previousPoint = null, previousLabel = null;

            $.plot($("#flot-dashboard-chart"), dataset, options);

            var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
        });
    </script>
</body>
</html>
