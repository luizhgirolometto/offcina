<?php

	include "banco.php";
	include "util.php";

	$cdorde = $_POST["cdorde"];
	$codempresa= $_POST["codempresa"]; 
	$qtform = $_POST["qtform"];
	$cdclie= GetClieOrdem($cdorde, $codempresa);
    

	// $pos = strpos($_POST["cdclie"], "-");
	// $cdclie = trim(substr($_POST["cdclie"],0,$pos));

	switch (get_post_action('confirma','apaga')) {
    case 'confirma':

		$demens = "Atualização efetuada com sucesso!";

//		ExcluirDados("ordem", "cdorde", $cdorde);
//		ExcluirDados("ordemi", "cdorde", $cdorde);
//		ExcluirDados("", "", "","delete from contas where cdtipo ='Pagar' and cdorig = '{$cdorde}'");

		$dtcada = date('Y-m-d');
		$Flag = true;
		
		$vlpago = $_POST["vlpago"];
		$vlparc = $_POST["vlparc"]; 

		
		$vlpago = str_replace(".","",$vlpago);
		$vlpago = str_replace(",",".",$vlpago);

		$vlparc = str_replace(".","",$vlparc);
		$vlparc = str_replace(",",".",$vlparc);		

		if ($Flag == true) {

			//campos da tabela
			$aNomes=array();
			$aNomes[]= "cdsitu";
			$aNomes[]= "dtpago";
			$aNomes[]= "qtform";
			$aNomes[]= "vlpago";
			

			//dados da tabela
			$aDados=array();
			$aDados[]= "Fechada";//$_POST["cdsitu"];
			$aDados[]= $dtcada;//$_POST["cdclie"];
			$aDados[]= $_POST["qtform"];
			$aDados[]= $vlpago;
			
			AlterarDados("ordem", $aDados, $aNomes,"cdorde", $cdorde);


            if ($vlpago > 0){ //lanca a entrada
				$aNomesE=array();				
				$aNomesE[]= "decont";
				$aNomesE[]= "dtcont";
				$aNomesE[]= "vlcont";
				$aNomesE[]= "cdtipo";
				$aNomesE[]= "vlpago";
				$aNomesE[]= "dtpago";
				$aNomesE[]= "cdquem";
				$aNomesE[]= "cdorig";
				$aNomesE[]= "deobse";
				$aNomesE[]= "flativ";
				$aNomesE[]= "dtcada";
				$aNomesE[]= "codempresa";

				$aDadosE=array();
				$aDadosE[]= "Valor recebido de entrada referente a OS " .strval($cdorde);				
				$aDadosE[]= date("Y-m-d");
				$aDadosE[]= $vlpago;
				$aDadosE[]= 'Recebida';
				$aDadosE[]= $vlpago;
				$aDadosE[]= date("Y-m-d");
				$aDadosE[]= $cdclie;
				$aDadosE[]= $cdorde;
				$aDadosE[]= '';
				$aDadosE[]= "S";
				$aDadosE[]= date("Y-m-d");
				$aDadosE[]= $codempresa;				

				IncluirDados("contas", $aDadosE, $aNomesE);            

            }    
            for ($f =1; $f <= $qtform; $f++) {
                $dtcont=strtotime($dtorde . "+ {$f} months");
		        $dtcont=date("Y-m-d", $dtcont);
				
                $aNomesP=array();
				$aNomesP[]= "decont";
				$aNomesP[]= "dtcont";
				$aNomesP[]= "vlcont";
				$aNomesP[]= "cdtipo";
				$aNomesP[]= "vlpago";
				$aNomesP[]= "dtpago";
				$aNomesP[]= "cdquem";
				$aNomesP[]= "cdorig";
				$aNomesP[]= "deobse";
				$aNomesP[]= "flativ";
				$aNomesP[]= "dtcada";
				$aNomesP[]= "codempresa";

                $aDadosP=array();
				
				$aDadosP[]= "Parcela ". strval($f)." referente a OS ".strval($cdorde);
				$aDadosP[]= $dtcont;
				$aDadosP[]= $vlparc;
				$aDadosP[]= 'Receber';
				$aDadosP[]= $vlparc;
				$aDadosP[]= date("Y-m-d");
				$aDadosP[]= $cdclie;
				$aDadosP[]= $cdorde;
				$aDadosP[]= '';
				$aDadosP[]= "S";
				$aDadosP[]= date("Y-m-d");
				$aDadosP[]= $codempresa;	

				IncluirDados("contas", $aDadosP, $aNomesP);                  
            }    
			if ($_POST['provret'] == 'Sim'){
				$aNomesA=array();
				$aNomesA[]= "cdclie";
				$aNomesA[]= "motivo";
				$aNomesA[]= "cdorde";
				$aNomesA[]= "dtret";
				$aNomesA[]= "dtcada";
				$aNomesA[]= "codempresa";				

				$aDadosA=array();
				$aDadosA[]= $cdclie;
				$aDadosA[]= $_POST['motret'];
				$aDadosA[]= $cdorde;
				$aDadosA[]= $_POST['dtret'];
				$aDadosA[]= date("Y-m-d");
				$aDadosA[]= $codempresa;				

				IncluirDados("agendamentos", $aDadosA, $aNomesA); 
			}

			$demens = "Alteração efetuada com sucesso!";
			$detitu = "GiroMecânicas&copy; | Cadastro de OS";
			$devolt = "fechaordem.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}

		break;
    case 'apaga':
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o suporte!";
	}

	if ($flag2 == false) {
		$detitu = "GiroMecânicas&copy; | Cadastro de OS";
		$devolt = "fechaordem.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>