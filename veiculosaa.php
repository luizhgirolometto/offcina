<?php

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	
	$codempresa = $_POST["codempresa"];

	$pos = strpos($_POST["cdclie"], "-");
	$cdclie = trim(substr($_POST["cdclie"],0,$pos));


	$Flag = true;

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
            $aNomes=array();

            //$aNomes[]= "cdveic";
            $aNomes[]= "deplac";
            $aNomes[]= "deanof";
            $aNomes[]= "deanom";
            $aNomes[]= "demarc";
            $aNomes[]= "demode";
            $aNomes[]= "decor";
            $aNomes[]= "cdclie";
            $aNomes[]= "flativ";
            $aNomes[]= "dtcada";
            $aNomes[]= "codempresa";

            //dados da tabela
            $aDados=array();
            //$aDados[]= $_POST["cdveic"];
            $aDados[]= $_POST["deplac"];
            $aDados[]= $_POST["deanof"];
            $aDados[]= $_POST["deanom"];
            $aDados[]= $_POST["demarc"];
            $aDados[]= $_POST["demode"];
            $aDados[]= $_POST["decor"];
            $aDados[]= $cdclie;
            $aDados[]= "S";
            $aDados[]= $data;
            $aDados[]= $codempresa;

			AlterarDados("m_veiculos", $aDados, $aNomes,"cdveic", $_POST["cdveic"]);
			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("m_veiculos", "cdveic", $_POST["cdveic"]);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "GiroMecânicas&copy; | Cadastro de Veículos";
			$devolt = "contas.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>