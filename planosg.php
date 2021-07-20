<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdplan = $_POST["cdplan"];
	$deplan = $_POST["deplan"];
	$dtcada = date('Y-m-d');
	$flativ = 'S';

	$Flag = true;

	if (empty($cdplan)==true ){
		$demens = "Código não pode ficar em branco!";
		$detitu = "Smart Doctor | Cadastro de Planos";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	$cdplan = str_pad($cdplan, 2, '0', STR_PAD_LEFT);

	$aTrab = ConsultarDados("planos", "cdplan", $cdplan);
	if ( count($aTrab) > 0) {
		$demens = "Código já cadastrado!";
		$detitu = "ProntMed | Cadastro de Planos";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

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

		IncluirDados("planos", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Smart Doctor | Cadastro de Planos";
		$devolt = "planos.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>