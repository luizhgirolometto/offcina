<?php

	include "banco.php";
	include "util.php";

	$dtcada = date('Y-m-d');
	$Flag = true;

	$aCditem=$_POST["cditem"];
	$aQtitem=$_POST["qtitem"];
	$aVlitem=$_POST["vlitem"];

	$cdclie = $_POST["cdclie"];
    $pos = strpos($cdclie,"-");
    $cdclie = trim(substr($cdclie, 0, $pos));


	$dtorde = $_POST["dtorde"];
	$vlorde = $_POST["vlorde"];
	$vlpago = 0;//$_POST["vlpago"];
	$dtpago = "";//$_POST["dtpago"];

	if ($dtpago == ""){
		$dtpago = "1969-12-31"; //aberta
	}
	$codempresa= $_POST["codempresa"]; 

	$vlorde = str_replace(".","",$vlorde);
	$vlorde = str_replace(",",".",$vlorde);

	$vlpago = str_replace(".","",$vlpago);
	$vlpago = str_replace(",",".",$vlpago);

	$qtitem = 0;
	for ($f =1; $f <= 20; $f++) {
		$primeiro = $aCditem[$f];
		$aPrimeiro = explode("|", $aCditem[$f]);
		if ($aPrimeiro[0] !== 'X'){
			$qtitem++;
		}
	}

	if ( $qtitem <= 0) {
		$demens = "É preciso informar os itens do fornecedores!";
		$detitu = "GiroMecânicas&copy; | Cadastros de Fornecedoress";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ( empty($cdclie) == true) {
		$demens = "É preciso informar o fornecedor!";
		$detitu = "GiroMecânicas&copy; | Cadastros de Fornecedoress";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ( empty(strtotime($dtorde)) == true) {
		$demens = "É preciso informar a data do fornecedores!";
		$detitu = "GiroMecânicas&copy; | Cadastros de Fornecedoress";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdclie";
		$aNomes[]= "veplac";
		$aNomes[]= "vemarc";
		$aNomes[]= "vemode";
		$aNomes[]= "veanom";
		$aNomes[]= "veanof";
		$aNomes[]= "vecorv";
		$aNomes[]= "cdsitu";
		$aNomes[]= "dtorde";
		$aNomes[]= "vlorde";
		$aNomes[]= "cdform";
		$aNomes[]= "qtform";
		$aNomes[]= "vlpago";
		$aNomes[]= "dtpago";
		$aNomes[]= "deobse";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";
		$aNomes[]= "codempresa";


		//dados da tabela
		$aDados=array();
		$aDados[]= $cdclie;
		$aDados[]= $_POST["veplac"];
		$aDados[]= $_POST["vemarc"];
		$aDados[]= $_POST["vemode"];
		$aDados[]= $_POST["veanom"];
		$aDados[]= $_POST["veanof"];
		$aDados[]= $_POST["vecorv"];
		$aDados[]= $_POST["cdsitu"];
		$aDados[]= $_POST["dtorde"];
		$aDados[]= $vlorde;
		$aDados[]= "Nenhuma";//$_POST["cdform"];
		$aDados[]= 0;//$_POST["qtform"];
		$aDados[]= $vlpago;
		$aDados[]= $dtpago;
		$aDados[]= $_POST["deobse"];
		$aDados[]= 'Sim';
		$aDados[]= $dtcada;
		$aDados[]= $codempresa;
		

		IncluirDados("ordem", $aDados, $aNomes);

		$aTrab= ConsultarDados("", "", "","select max(cdorde) cdorde from ordem where codempresa = '{$codempresa}' and cdclie = '{$cdclie}' and dtorde = '{$dtorde}'");
		$cdorde = $aTrab[0]["cdorde"];
		$nritem=1;
		for ($f =1; $f <= 20; $f++) {
			$primeiro = $aCditem[$f];
			$aPrimeiro = explode("|", $aCditem[$f]);
			if ($aPrimeiro[0] !== 'X'){
				$cdpeca = $aPrimeiro[2];
				$qtpeca = $aQtitem[$f];
				$vlpeca = $aVlitem[$f];

				//$vlpeca = str_replace(".","",$vlpeca);
				//$vlpeca = str_replace(",",".",$vlpeca);

				$vltota = $qtpeca*$vlpeca;

				$aNomes=array();
				$aNomes[]= "cdorde";
				$aNomes[]= "nritem";
				$aNomes[]= "cdpeca";
				$aNomes[]= "qtpeca";
				$aNomes[]= "vlpeca";
				$aNomes[]= "vltota";
				$aNomes[]= "codempresa";

				$aDados=array();
				$aDados[]= $cdorde;
				$aDados[]= $nritem++;
				$aDados[]= $cdpeca;
				$aDados[]= $qtpeca;
				$aDados[]= $vlpeca;
				$aDados[]= $vltota;
				$aDados[]= $codempresa;

				IncluirDados("ordemi", $aDados, $aNomes);
			}
		}

		// $aTrab= ConsultarDados("", "", "","select * from ordem where codempresa = '{$codempresa}' and cdorde = '{$cdorde}'");
		// $dtorde = $aTrab[0]["dtorde"];
		// $qtform = $aTrab[0]["qtform"];

		// for ($f =1; $f <= $qtform; $f++) {
		// 	$vlcont = $aTrab[0]["vlorde"]/$qtform;
		// 	//$vlcont = number_format($vlcont,2,',','.');

		//     $dtcont=strtotime($dtorde . "+ {$f} months");
		//     $dtcont=date("Y-m-d", $dtcont);

		// 	$aNomes=array();
		// 	$aNomes[]= "decont";
		// 	$aNomes[]= "dtcont";
		// 	$aNomes[]= "vlcont";
		// 	$aNomes[]= "cdtipo";
		// 	$aNomes[]= "cdquem";
		// 	$aNomes[]= "cdorig";
		// 	$aNomes[]= "flativ";
		// 	$aNomes[]= "dtcada";
		// 	$aNomes[]= "codempresa";

		// 	$aDados=array();
		// 	$aDados[]= 'Cliente a Receber';
		// 	$aDados[]= $dtcont;
		// 	$aDados[]= $vlcont;
		// 	$aDados[]= 'Receber';
		// 	$aDados[]= $aTrab[0]["cdclie"];
		// 	$aDados[]= $aTrab[0]["cdorde"];
		// 	$aDados[]= 'Sim';
		// 	$aDados[]= $dtcada;
		// 	$aDados[]= $codempresa;

		// 	IncluirDados("contas", $aDados, $aNomes);

		// }

		$demens = "Ordem de serviço aberta com sucesso!";
		$detitu = "GiroMecânicas&copy; | Abertura de OS";
		$devolt = "index.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>