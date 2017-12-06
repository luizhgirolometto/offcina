<?php

	include "banco.php";
	include "util.php";

	$dtcada = date('Y-m-d');
	$flativ	= $_POST["ativo"];;
	$Flag = true;

	// $aTrab = ConsultarDados("usuarios", "cdusua", $cdusua);
	// if ( count($aTrab) > 0) {
	// 	$demens = "Código já cadastrado!";
	// 	$detitu = "GiroMecânicas&copy; | Cadastro de Usuários";
	// 	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
	// 	$Flag=false;
	// }

	if ($Flag == true) {

		//uploads
		if ($flativ = 'S'){
			$ativo = true;
		} else {
			$ativo = false;
		}	

        $aNomesof=array();
        $aNomesof[]= "nomeempresa";
		$aNomesof[]= "ativo";

        $aDadosof=array();
		$aDadosof[]= $_POST["nomeempresa"];
		$aDadosof[]= $ativo;
        
        IncluirDados("oficinas", $aDadosof, $aNomesof);

        $nomeemp = $_POST["nomeempresa"];    
        $aTrab= ConsultarDados("", "", "","select max(codempresa) codempresa from oficinas where nomeempresa = '{$nomeemp}'");
		
        $cdemp = $aTrab[0]["codempresa"];
        $senha =  md5($cdemp);
		//campos da tabela
		$aNomes=array();
//		$aNomes[]= "cdusua";
		$aNomes[]= "deusua";
		$aNomes[]= "desenh";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "cdtipo";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";
		$aNomes[]= "nrtele";
		$aNomes[]= "codempresa";

		//dados da tabela
		$aDados=array();
//		$aDados[]= $cdusua;
		$aDados[]= 'Usuário ' . $_POST["nomeempresa"]  ;
		$aDados[]=  $senha;
		$aDados[]= "mail@mail.com";
		$aDados[]= "";
		$aDados[]= 'Administrador';
		$aDados[]= "Sim";
		$aDados[]= $dtcada;
		$aDados[]= "";
		$aDados[]= $cdemp;

		IncluirDados("usuarios", $aDados, $aNomes);

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");

		$demens = 'Seu Código de acesso é ' . $cdemp . ' e sua senha incial tambem é '. $cdemp . '!' ;
		$detitu = "GiroMecânicas&copy; | Cadastro de empresas";
		$devolt = "oficinas.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>