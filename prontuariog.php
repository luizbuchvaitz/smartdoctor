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

	if ($Flag == true) {

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

		IncluirDados("prontuario", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Smart Doctor | Cadastro de Prontuário";
		$devolt = "prontuario.php";

		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>