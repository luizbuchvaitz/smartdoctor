<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdplan = $_POST["cdplan"];
	$deplan = $_POST["deplan"];
	$dtcada = date('Y-m-d');
	$flativ = "S";

	$Flag = true;

	$cdplan = str_pad($cdplan, 2, '0', STR_PAD_LEFT);

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		if ($Flag == true){

			$demens = "Atualização efetuada com sucesso!";

			//campos da tabela
			$aNomes=array();
			$aNomes[]= "cdplan";
			$aNomes[]= "deplan";
			$aNomes[]= "flativ";
			$aNomes[]= "dtcada";
		
			//dados da tabela
			$aDados=array();
			$aDados[]= $cdplan;
			$aDados[]= $deplan;
			$aDados[]= $flativ;
			$aDados[]= $dtcada;

			AlterarDados("planos", $aDados, $aNomes,"cdplan", $cdplan);

		}

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		ExcluirDados("planos", "cdplan", $cdplan);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão.";
	}

	if ($Flag == true) {
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		$devolt = "planos.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>