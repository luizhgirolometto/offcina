<?php

	include "banco.php";
	include "util.php";

	$cdorde = $_POST["cdorde"];
	$pos = strpos($_POST["cdclie"], "-");
	$cdclie = trim(substr($_POST["cdclie"],0,$pos));

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		$demens = "OS atualizada com sucesso!";

		$cdorde = $_POST["cdorde"];
		$dtpago = $_POST["dtpago"];
		$vlpago = $_POST["vlpago"];
		$deobse = $_POST["deobse"];
		$cdsitu = $_POST["cdsitu"];

		$vlpago = str_replace(".","",$vlpago);
		$vlpago = str_replace(",",".",$vlpago);

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "dtpago";
		$aNomes[]= "vlpago";
		$aNomes[]= "deobse";
		$aNomes[]= "cdsitu";

		//dados da tabela
		$aDados=array();
		$aDados[]= $_POST["dtpago"];
		$aDados[]= $vlpago;
		$aDados[]= $_POST["deobse"];
		$aDados[]= $_POST["cdsitu"];

		AlterarDados("ordem", $aDados, $aNomes, "cdorde", $cdorde);

		$detitu = "GiroMecânicas&copy; | Cadastro de OS";
		$devolt = "fechaordem.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		ExcluirDados("ordem", "cdorde", $cdorde);
		ExcluirDados("ordemi", "cdorde", $cdorde);
		ExcluirDados("", "", "","delete from contas where cdtipo ='Receber' and cdorig = '{$cdorde}'");

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
	}

?>