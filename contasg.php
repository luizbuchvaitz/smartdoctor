<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$data = date('Y-m-d');
	$vlcont = $_POST["vlcont"];
	$vlpago = $_POST["vlpago"];

	$vlcont= str_replace(".","",$vlcont);
	$vlcont= str_replace(",",".",$vlcont);
	$vlpago= str_replace(".","",$vlpago);
	$vlpago= str_replace(",",".",$vlpago);

	$flativ = 'S';

	$Flag = true;

	if ( $vlcont <= 0 ){
		$demens = "Valor não pode ser zero!";
		$detitu = "Smart Doctor | Contas Receber / Pagar";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "decont";
		$aNomes[]= "dtcont";
		$aNomes[]= "vlcont";
		$aNomes[]= "cdtipo";
		$aNomes[]= "vlpago";
		$aNomes[]= "dtpago";
		$aNomes[]= "cdquem";
		$aNomes[]= "cdorig";
		$aNomes[]= "deobse";
		$aNomes[]= "flativ";
		$aNomes[]= "dtcada";

		//dados da tabela
		$aDados=array();
		$aDados[]= $_POST["decont"];
		$aDados[]= $_POST["dtcont"];
		$aDados[]= $vlcont;
		$aDados[]= $_POST["cdtipo"];
		$aDados[]= $vlpago;
		$aDados[]= $_POST["dtpago"];
		$aDados[]= $_POST["cdquem"];
		$aDados[]= $_POST["cdorig"];
		$aDados[]= $_POST["deobse"];
		$aDados[]= "S";
		$aDados[]= date("Y-m-d");

		IncluirDados("contas", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Smart Doctor | Cadastro de Contas a Receber/Pagar";
		$devolt = "contas.php";

		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>