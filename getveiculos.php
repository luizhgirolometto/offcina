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

    if (isset($_COOKIE['codempresa'])) {
        $codempresa = $_COOKIE['codempresa'];
    } Else {
        header('Location: index.html');
    }    

// get the q parameter from URL
$q = $_REQUEST["q"];

$aVeic= ConsultarDados("", "", "","select * from m_veiculos where codempresa = "."'{$codempresa}'"." and cdclie < "."'{$q}'"." order by dtcada desc"); 

for($i=0;$i < count($aVeic);$i++) {
    echo "<option><? " . str_pad($aVeic[$i]["deplac"],14," ",STR_PAD_LEFT)." - ".$aVeic[$i]["demode"]. "</option>";
}

?>