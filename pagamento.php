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

    $acao = $_GET["acao"];
    $chave = trim($_GET["chave"]);

    switch ($acao) {
    case 'fechar':
        $titulo = "Forma de Pagamento";
        break;
    case 'edita':
        $titulo = "Fechamento";
        break;
    case 'apaga':
        $titulo = "Exclusão";
        break;
    default:
        header('Location: fichacadastral.php');
    }

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

    $aOrde= ConsultarDados("", "", "","select ordem.*, clientes.declie from ordem inner join clientes on ordem.cdclie = clientes.cdclie where ordem.codempresa = "."'{$codempresa}'"." and cdorde = "."'{$chave}'"." order by cdorde");
    $aItem = ConsultarDados("ordemi", "cdorde", $chave);
    $aClie = ConsultarDados("", "", "","select * from where codempresa = '{$codempresa}' clientes order by declie");
    $aPeca= ConsultarDados("", "", "","select * from pecas where codempresa = '{$codempresa}' order by depeca");
    $aServ= ConsultarDados("", "", "","select * from servicos where codempresa = '{$codempresa}' order by deserv");
    $aClieOrdem= GetClieOrdem($chave, $codempresa);

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
                            <span class="m-r-sm text-muted welcome-message">Bem-vindo a <strong>GiroMecânicas&copy;</strong></span>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fa fa-sign-out"></i> Sair
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <!--div class="col-lg-12"-->
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                             <h3> Ordens de Serviço - <?php echo $titulo; ?> </h3>   
                         </div>
                        <div class="panel-body">

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="pagamentoaa.php">

                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="hidden" name="codempresa" value="<?php echo $codempresa; ?>">
                                           <!-- <input type="hidden" name="cdorde" value="<?php echo $cdorde; ?>">
                                            <input type="hidden" name="aClieOrdem" value="<?php echo $aClieOrdem; ?>"> -->

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Número da OS</label>
                                                <div class="col-md-4">
                                                    <input id="cdorde" name="cdorde" value="<?php echo $aOrde[0]["cdorde"];?>" type="text" placeholder="" class="form-control" maxlength = "10" readonly="">
                                                </div>
                                            </div>
                                            <!--center><h3><span class="text-warning"><strong>DADOS DO PEDIDO</strong></span></h3></center-->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Cliente</label>
                                                <div class="col-md-4">
                                                    <select name="cdclie" id="cdclie" style="width:250%" disabled="">
                                                        <option selected=""><?php echo str_pad($aOrde[0]["cdclie"],14," ",STR_PAD_LEFT)." - ".$aOrde[0]["declie"];?> </option>
                                                        <?php for($i=0;$i < count($aClie);$i++) { ?>
                                                          <option><?php echo str_pad($aClie[$i]["cdclie"],14," ",STR_PAD_LEFT)." - ".$aClie[$i]["declie"];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--    
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Situação</label>
                                                <div class="col-md-4">
                                                    <select name="cdsitu" id="cdsitu" disabled="">
                                                        <?php if ($aOrde[0]["cdsitu"] == "") {?>
                                                            <option selected="">Orçamento</option>
                                                            <option>Pendente</option>
                                                            <option>Andamento</option>
                                                            <option>Concluído</option>
                                                            <option>Entregue</option>
                                                        <?php }?>
                                                        <?php if ($aOrde[0]["cdsitu"] == "Orçamento") {?>
                                                            <option selected="">Orçamento</option>
                                                            <option>Pendente</option>
                                                            <option>Andamento</option>
                                                            <option>Concluído</option>
                                                            <option>Entregue</option>
                                                        <?php }?>
                                                        <?php if ($aOrde[0]["cdsitu"] == "Pendente") {?>
                                                            <option>Orçamento</option>
                                                            <option selected="">Pendente</option>
                                                            <option>Andamento</option>
                                                            <option>Concluído</option>
                                                            <option>Entregue</option>
                                                        <?php }?>
                                                        <?php if ($aOrde[0]["cdsitu"] == "Andamento") {?>
                                                            <option>Orçamento</option>
                                                            <option>Pendente</option>
                                                            <option selected="">Andamento</option>
                                                            <option>Concluído</option>
                                                            <option>Entregue</option>
                                                        <?php }?>
                                                        <?php if ($aOrde[0]["cdsitu"] == "Concluído") {?>
                                                            <option>Orçamento</option>
                                                            <option>Pendente</option>
                                                            <option>Andamento</option>
                                                            <option selected="">Concluído</option>
                                                            <option>Entregue</option>
                                                        <?php }?>
                                                        <?php if ($aOrde[0]["cdsitu"] == "Entregue") {?>
                                                            <option>Orçamento</option>
                                                            <option>Pendente</option>
                                                            <option>Andamento</option>
                                                            <option>Concluído</option>
                                                            <option selected="">Entregue</option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            -->

                         <!--               <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Data</label>
                                                <div class="col-md-4">
                                                    <input id="dtorde" name="dtorde" value="<?php echo date("Y-m-d");?>" type="date" placeholder="" class="form-control" maxlength = "10" readonly="">
                                                </div>
                                            </div>
                         -->                   



                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Placa do Veículo</label>
                                                <div class="col-md-4">
                                                    <input id="veplac" name="veplac" value="<?php echo $aOrde[0]["veplac"];?>" type="text" placeholder="" class="form-control" maxlength = "7" readonly="">
                                                </div>
                                            </div>
                       <!--                     
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Marca do Veículo</label>
                                                <div class="col-md-4">
                                                    <input id="vemarc" name="vemarc" value="<?php echo $aOrde[0]["vemarc"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Modelo do Veículo</label>
                                                <div class="col-md-4">
                                                    <input id="vemode" name="vemode" value="<?php echo $aOrde[0]["vemode"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Cor do Veículo</label>
                                                <div class="col-md-4">
                                                    <input id="vecorv" name="vecorv" value="<?php echo $aOrde[0]["vecorv"];?>" type="text" placeholder="" class="form-control" maxlength = "50" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Ano Fabricação</label>
                                                <div class="col-md-2">
                                                    <input id="veanof" name="veanof" value="<?php echo $aOrde[0]["veanof"];?>" type="text" placeholder="" class="form-control" maxlength = "04" readonly="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Ano Modelo</label>
                                                <div class="col-md-2">
                                                    <input id="veanom" name="veanom" value="<?php echo $aOrde[0]["veanom"];?>" type="text" placeholder="" class="form-control" maxlength = "04" readonly="">
                                                </div>
                                            </div>
                      -->                      
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Valor Total(R$)</label>
                                                <div class="col-md-4">
                                                    <input id="vlorde" name="vlorde" value="<?php echo number_format($aOrde[0]["vlorde"],2,",",".");?>" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                                </div>
                                            </div>
                                            <!--
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Data de Pagamento</label>
                                                <div class="col-md-4">
                                                    <input id="dtpago" name="dtpago" value="<?php echo $aOrde[0]["dtpago"];?>" type="date" placeholder="" class="form-control" maxlength = "10" readonly="">
                                                </div>
                                            </div>
                                            -->

                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Valor Entrada(R$)</label>
                                                <div class="col-md-4">
                                                    <input id="vlpago" name="vlpago" value="<?php echo number_format($aOrde[0]["vlpago"],2,",",".");?>" type="text" placeholder="" class="form-control" maxlength = "10" onchange="calculaParcelas()" >
                                                </div>
                                            </div>
                                            <!--
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Forma de Pagamento</label>
                                                <div class="col-md-4">
                                                    <select name="cdform" id="cdform" style="width:50%">
                                                        
                                                            <option selected="">Dinheiro</option>
                                                            <option>Prazo</option>                                                            
                                                                                                                
                                                    </select>
                                                </div>
                                            </div>
                                            -->
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Número de Parcelas</label>
                                                <div class="col-md-2">
                                                    <input id="qtform" name="qtform" value="0" type="number" placeholder="" class="form-control" maxlength = "15" min="0" max="12" onchange="calculaValorParcelas()">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label" for="textinput">Valor das Parcelas(R$)</label>
                                                <div class="col-md-4">
                                                    <input id="vlparc" name="vlparc" value="0,00" type="text" placeholder="" class="form-control" maxlength = "15" readonly="">
                                                </div>
                                            </div>                                            
                                            
                                            

                                        </div>
                                        
                                    </div>                                

                                <div>
                                 <button class="btn btn-primary" name = "confirma" type="submit"><strong>Confirmar Pagamento</strong></button>
                                 <button class="btn btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                                
                                </div>

                            </form>
                        </div>
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

        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }

        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }

        function leech(v){
            v=v.replace(/o/gi,"0")
            v=v.replace(/i/gi,"1")
            v=v.replace(/z/gi,"2")
            v=v.replace(/e/gi,"3")
            v=v.replace(/a/gi,"4")
            v=v.replace(/s/gi,"5")
            v=v.replace(/t/gi,"7")
            return v
        }

        function soNumeros(v){
            return v.replace(/\D/g,"")
        }

        function celular(v){
            v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
            v=v.replace(/^(\d{3})(\d)/,"$1-$2")             //Coloca ponto entre o segundo e o terceiro dígitos
            v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
            return v
        }

        function telefone(v){
            v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
            v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
            return v
        }

        function cpf(v){
            v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
            v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
            v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                                     //de novo (para o segundo bloco de números)
            v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
            return v
        }

        function cep(v){
            v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
            v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
            return v
        }

        function cnpj(v){
            v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
            v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
            v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
            return v
        }

        function romanos(v){
            v=v.toUpperCase()             //Maiúsculas
            v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que não for I, V, X, L, C, D ou M
            //Essa é complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html
            while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
                v=v.replace(/.$/,"")
            return v
        }

        function site(v){
            //Esse sem comentarios para que você entenda sozinho ;-)
            v=v.replace(/^http:\/\/?/,"")
            dominio=v
            caminho=""
            if(v.indexOf("/")>-1)
                dominio=v.split("/")[0]
                caminho=v.replace(/[^\/]*/,"")
            dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
            caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
            caminho=caminho.replace(/([\?&])=/,"$1")
            if(caminho!="")dominio=dominio.replace(/\.+$/,"")
            v="http://"+dominio+caminho
            return v
        }

    </script>

    <script language="javascript">

        function formatNumber(number)
        {
            number = number.toFixed(2) + '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? ',' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

        function formatNumberP(number)
        {
            number = number.toFixed(2) + '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        function calcula(){

            //item
            var qt1 = parseInt(document.getElementById('qtitem[1]').value);
            var vl1 = parseFloat(document.getElementById('vlitem[1]').value);
            var n1 = parseInt((qt1 * vl1)*100)/100;

            document.getElementById('vltota[1]').value = formatNumber(n1);

            //item
            var qt2 = parseInt(document.getElementById('qtitem[2]').value);
            var vl2 = parseFloat(document.getElementById('vlitem[2]').value);
            var n2 = parseInt((qt2 * vl2)*100)/100;

            document.getElementById('vltota[2]').value = formatNumber(n2);

            //item
            var qt3 = parseInt(document.getElementById('qtitem[3]').value);
            var vl3 = parseFloat(document.getElementById('vlitem[3]').value);
            var n3 = parseInt((qt3 * vl3)*100)/100;

            document.getElementById('vltota[3]').value = formatNumber(n3);

            //item
            var qt4 = parseInt(document.getElementById('qtitem[4]').value);
            var vl4 = parseFloat(document.getElementById('vlitem[4]').value);
            var n4 = parseInt((qt4 * vl4)*100)/100;

            document.getElementById('vltota[4]').value = formatNumber(n4);

            //item
            var qt5 = parseInt(document.getElementById('qtitem[5]').value);
            var vl5 = parseFloat(document.getElementById('vlitem[5]').value);
            var n5 = parseInt((qt5 * vl5)*100)/100;

            document.getElementById('vltota[5]').value = formatNumber(n5);

            //item
            var qt6 = parseInt(document.getElementById('qtitem[6]').value);
            var vl6 = parseFloat(document.getElementById('vlitem[6]').value);
            var n6 = parseInt((qt6 * vl6)*100)/100;

            document.getElementById('vltota[6]').value = formatNumber(n6);

            //item
            var qt7 = parseInt(document.getElementById('qtitem[7]').value);
            var vl7 = parseFloat(document.getElementById('vlitem[7]').value);
            var n7 = parseInt((qt7 * vl7)*100)/100;

            document.getElementById('vltota[7]').value = formatNumber(n7);

            //item
            var qt8 = parseInt(document.getElementById('qtitem[8]').value);
            var vl8 = parseFloat(document.getElementById('vlitem[8]').value);
            var n8 = parseInt((qt8 * vl8)*100)/100;

            document.getElementById('vltota[8]').value = formatNumber(n8);

            //item
            var qt9 = parseInt(document.getElementById('qtitem[9]').value);
            var vl9 = parseFloat(document.getElementById('vlitem[9]').value);
            var n9 = parseInt((qt9 * vl9)*100)/100;

            document.getElementById('vltota[9]').value = formatNumber(n9);

            //item
            var qt10 = parseInt(document.getElementById('qtitem[10]').value);
            var vl10 = parseFloat(document.getElementById('vlitem[10]').value);
            var n10 = parseInt((qt10 * vl10)*100)/100;

            document.getElementById('vltota[10]').value = formatNumber(n10);

            //item
            var qt11 = parseInt(document.getElementById('qtitem[11]').value);
            var vl11 = parseFloat(document.getElementById('vlitem[11]').value);
            var n11 = parseInt((qt11 * vl11)*100)/100;

            document.getElementById('vltota[11]').value = formatNumber(n11);

            //item
            var qt12 = parseInt(document.getElementById('qtitem[12]').value);
            var vl12 = parseFloat(document.getElementById('vlitem[12]').value);
            var n12 = parseInt((qt12 * vl12)*100)/100;

            document.getElementById('vltota[12]').value = formatNumber(n12);

            //item
            var qt13 = parseInt(document.getElementById('qtitem[13]').value);
            var vl13 = parseFloat(document.getElementById('vlitem[13]').value);
            var n13 = parseInt((qt13 * vl13)*100)/100;

            document.getElementById('vltota[13]').value = formatNumber(n13);

            //item
            var qt14 = parseInt(document.getElementById('qtitem[14]').value);
            var vl14 = parseFloat(document.getElementById('vlitem[14]').value);
            var n14 = parseInt((qt14 * vl14)*100)/100;

            document.getElementById('vltota[14]').value = formatNumber(n14);

            //item
            var qt15 = parseInt(document.getElementById('qtitem[15]').value);
            var vl15 = parseFloat(document.getElementById('vlitem[15]').value);
            var n15 = parseInt((qt10 * vl15)*100)/100;

            document.getElementById('vltota[15]').value = formatNumber(n15);

            //item
            var qt16 = parseInt(document.getElementById('qtitem[16]').value);
            var vl16 = parseFloat(document.getElementById('vlitem[16]').value);
            var n16 = parseInt((qt10 * vl16)*100)/100;

            document.getElementById('vltota[16]').value = formatNumber(n16);

            //item
            var qt17 = parseInt(document.getElementById('qtitem[17]').value);
            var vl17 = parseFloat(document.getElementById('vlitem[17]').value);
            var n17 = parseInt((qt17 * vl17)*100)/100;

            document.getElementById('vltota[17]').value = formatNumber(n17);

            //item
            var qt18 = parseInt(document.getElementById('qtitem[18]').value);
            var vl18 = parseFloat(document.getElementById('vlitem[18]').value);
            var n18 = parseInt((qt18 * vl18)*100)/100;

            document.getElementById('vltota[18]').value = formatNumber(n18);

            //item
            var qt19 = parseInt(document.getElementById('qtitem[19]').value);
            var vl19 = parseFloat(document.getElementById('vlitem[19]').value);
            var n19 = parseInt((qt19 * vl19)*100)/100;

            document.getElementById('vltota[19]').value = formatNumber(n19);

            //item
            var qt20 = parseInt(document.getElementById('qtitem[20]').value);
            var vl20 = parseFloat(document.getElementById('vlitem[20]').value);
            var n20 = parseInt((qt20 * vl20)*100)/100;

            document.getElementById('vltota[20]').value = formatNumber(n20);

            //total
            var nt = n1 + n2 + n3 + n4 + n5 + n6 + n7 + n8 + n9 + n10 + n11 + n12 + n13 + n14 + n15 + n16 + n17 + n18 + n19 + n20;
            var nt = parseInt(nt*100)/100;
            document.getElementById('vlorde').value = formatNumber(nt);

        }

        function calculaParcelas(){
            var valorTot = document.getElementById('vlorde').value; //valor total
            var valorEnt = document.getElementById('vlpago').value; // valor da entrada

		//    $valorTot = str_replace(".","",$valorTot);
		//    $valorTot = str_replace(",",".",$valorTot);

	//	    $valorEnt = str_replace(".","",$valorEnt);
//		    $valorEnt = str_replace(",",".",$valorEnt);            

            valorTot = parseFloat(valorTot);
            valorEnt = parseFloat(valorEnt); 

            if (valorEnt > valorTot){ // se valor da entrada maior que o valor total, o valor da entrada recebe o valor total
                document.getElementById('cditem[1]').value = valotTot;                
            }
            if (valorEnt == valorTot){
                document.getElementById('qtform').value = 0;
                document.getElementById('qtform').readOnly = true;

                document.getElementById('vlparc').value = 0;
                document.getElementById('vlparc').readOnly = true;                
            }
            if (valorEnt < valorTot){
               document.getElementById('qtform').readOnly = false;
               document.getElementById('qtform').value = 1; 

               document.getElementById('vlparc').readOnly = true;
                document.getElementById('vlparc').value = formatNumber(valorTot - valorEnt);
            }

        }
        function calculaValorParcelas(){
            console.log('calculaValorParcelas');
            var valorTot = document.getElementById('vlorde').value; //valor total
            var valorEnt = document.getElementById('vlpago').value; // valor da entrada
            var nroParc = document.getElementById('qtform').value; // valor da entrada            

            valorTot = parseFloat(valorTot);
            valorEnt = parseFloat(valorEnt);
            nroParc = parseInt(nroParc);

            
            if (nroParc > 0){
                document.getElementById('vlparc').readOnly = true;
                document.getElementById('vlparc').value = formatNumber((valorTot - valorEnt)/nroParc );
            } else{
              document.getElementById('qtform').value = 1;  
              document.getElementById('vlparc').readOnly = true;
              document.getElementById('vlparc').value = formatNumber(valorTot - valorEnt);              
            }           
                         
        }    
        

        function colocapreco(){

            var n1 = document.getElementById('cditem[1]').value.split('|');
            var n2 = document.getElementById('cditem[2]').value.split('|');
            var n3 = document.getElementById('cditem[3]').value.split('|');
            var n4 = document.getElementById('cditem[4]').value.split('|');
            var n5 = document.getElementById('cditem[5]').value.split('|');
            var n6 = document.getElementById('cditem[6]').value.split('|');
            var n7 = document.getElementById('cditem[7]').value.split('|');
            var n8 = document.getElementById('cditem[8]').value.split('|');
            var n9 = document.getElementById('cditem[9]').value.split('|');
            var n10 = document.getElementById('cditem[10]').value.split('|');
            var n11 = document.getElementById('cditem[11]').value.split('|');
            var n12 = document.getElementById('cditem[12]').value.split('|');
            var n13 = document.getElementById('cditem[13]').value.split('|');
            var n14 = document.getElementById('cditem[14]').value.split('|');
            var n15 = document.getElementById('cditem[15]').value.split('|');
            var n16 = document.getElementById('cditem[16]').value.split('|');
            var n17 = document.getElementById('cditem[17]').value.split('|');
            var n18 = document.getElementById('cditem[18]').value.split('|');
            var n19 = document.getElementById('cditem[19]').value.split('|');
            var n20 = document.getElementById('cditem[20]').value.split('|');

            document.getElementById('vlitem[1]').value = n1[1];
            //document.getElementById('qtitem[1]').value = 1;

            document.getElementById('vlitem[2]').value = n2[1];
            //document.getElementById('qtitem[2]').value = 1;

            document.getElementById('vlitem[3]').value = n3[1];
            //document.getElementById('qtitem[3]').value = 1;

            document.getElementById('vlitem[4]').value = n4[1];
            //document.getElementById('qtitem[4]').value = 1;

            document.getElementById('vlitem[5]').value = n5[1];
            //document.getElementById('qtitem[5]').value = 1;

            document.getElementById('vlitem[6]').value = n6[1];
            //document.getElementById('qtitem[6]').value = 1;

            document.getElementById('vlitem[7]').value = n7[1];
            //document.getElementById('qtitem[7]').value = 1;

            document.getElementById('vlitem[8]').value = n8[1];
            //document.getElementById('qtitem[8]').value = 1;

            document.getElementById('vlitem[9]').value = n9[1];
            //document.getElementById('qtitem[9]').value = 1;

            document.getElementById('vlitem[10]').value = n10[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[11]').value = n11[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[12]').value = n12[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[13]').value = n13[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[14]').value = n14[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[15]').value = n15[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[16]').value = n16[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[17]').value = n17[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[18]').value = n18[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[19]').value = n19[1];
            //document.getElementById('qtitem[10]').value = 1;

            document.getElementById('vlitem[20]').value = n20[1];
            //document.getElementById('qtitem[10]').value = 1;

            setTimeout("calcula()",1);
        }

    </script>
</body>
</html>
