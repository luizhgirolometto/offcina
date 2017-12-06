<?php

	include "banco.php";
	include "util.php";

	$codempresa = $_POST["codempresa"];

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		$demens = "Atualização efetuada com sucesso!";

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "nomeempresa";
		$aNomes[]= "ativo";
		
		//dados da tabela
		$aDados=array();
		$aDados[]= $_POST["nomeempresa"];
        if ($_POST["ativo"] == 'Sim'){
		    $aDados[]= 1;
        } else {
            $aDados[]= 0;
        }    

		AlterarDados("oficinas", $aDados, $aNomes,"codempresa", $codempresa);

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		//ExcluirDados("h_oficinas", "cdofic", $cdofic);

		//ExcluirDados("h_usuarios", "cdusua", $cdofic);


		//AlterarDados("usuarios", $aDados, $aNomes,"cdusua", $cdusua);
		ExcluirDados("oficinas", "codempresa", $codempresa);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
	}

	//gravar log
	//GravarIPLog($cdusua, "Alterar Meus Dados:");
	if ($flag2 == false) {
		$detitu = "GiroMecânicas&copy; | Cadastro de Empresas";
		$devolt = "oficinas.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>