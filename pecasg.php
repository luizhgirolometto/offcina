<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdpeca = $_POST["cdpeca"];
	$depeca = $_POST["depeca"];
	$qtpeca = $_POST["qtpeca"];
	$vlpeca = $_POST["vlpeca"];

	$vlpeca= str_replace(".","",$vlpeca);
	$vlpeca= str_replace(",",".",$vlpeca);
	$dtcada = date('Y-m-d');
	$Flag = true;

	// $aPeca = ConsultarDados("", "", "","select * from pecas where cdpeca = "."'{$cdpeca}'");

	// if (count($aPeca) > 0) {
	// 	$demens = "Código da peça já cadastrado!";
	// 	$detitu = "GiroMecânicas&copy; | Cadastro de Peças";
	// 	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
	// 	$Flag=false;
	// }

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();

		$aNomes[]= "cdpeca";
		$aNomes[]= "depeca";
		$aNomes[]= "qtpeca";
		$aNomes[]= "vlpeca";
		$aNomes[]= "codempresa";
		$aNomes[]= "dtcada";
		$aNomes[]= "flativ";
		

		//dados da tabela
		$aDados=array();
		$aDados[]= $cdpeca;
		$aDados[]= $depeca;
		$aDados[]= $qtpeca;
		$aDados[]= $vlpeca;
		$aDados[]= $_POST["codempresa"];
		$aDados[]= $dtcada;
		$aDados[]= $flativ;		
		

		IncluirDados("pecas", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "GiroMecânicas&copy; | Cadastro de Peças";
		$devolt = "pecas.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>