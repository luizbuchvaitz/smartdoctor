<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdpron = $_POST["cdpron"];
	$cdmedi = $_POST["cdmedi"];
	$cdusua = $_POST["cdusua"];
	$deespe = $_POST["deespe"];
	$depron = $_POST["depron"];
	$dtpronD = $_POST["dtpronD"];
	$dtpronH = $_POST["dtpronH"];
	$flativ = 'S';

	$Flag = true;

	if (empty($dtpronH)==true ){
		$demens = "Hora não pode ficar em branco!";
		$detitu = "Smart Doctor | Cadastro de Prontuário";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}
	if (empty($dtpronD)==true ){
		$demens = "Data não pode ficar em branco!";
		$detitu = "Smart Doctor | Cadastro de Prontuário";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	$dtpron = $dtpronD.' '.$dtpronH;
	//$cdplan = str_pad($cdplan, 2, '0', STR_PAD_LEFT);

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		if ($Flag == true){

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();
			$aNomes[]= "cdusua";
			$aNomes[]= "dtpron";
			$aNomes[]= "depron";
			$aNomes[]= "cdmedi";
			$aNomes[]= "deespe";
		
			//dados da tabela
			$aDados=array();
			$aDados[]= $cdusua;
			$aDados[]= $dtpron;
			$aDados[]= $depron;
			$aDados[]= $cdmedi;
			$aDados[]= $deespe;

			AlterarDados("prontuario", $aDados, $aNomes,"cdpron", $cdpron);

		}

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		ExcluirDados("prontuario", "cdpron", $cdpron);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão.";
	}

	if ($Flag == true) {
		$detitu = "Smart Doctor | Cadastro de Prontuário";
		$devolt = "prontuario.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>