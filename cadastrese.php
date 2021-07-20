<?php

	include "banco.php";
	include "util.php";

	$cdusua = $_POST["cdusua"];
	$deusua = $_POST["deusua"];
	$nrtele = $_POST["nrtele"];
	$demail = $_POST["demail"];
	$desenh = $_POST["desenh"];

	$dtcada = date('Y-m-d');
	$flativ	= "S";
	$cdtipo = "P";
	$defoto = "img/semfoto.jpg";
	$nrcelu = "";
	$deobse	= "Cadastro efetuado pelo próprio paciente.";

	$Flag=true;

	$cdusua=RetirarMascara($cdusua,"cpf");

	if ( validaCPF($cdusua) == false) {
		$demens = "CPF inválido...";
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	$aTrab = ConsultarDados("usuarios", "demail", $demail);
	if ( count($aTrab) > 0) {
		$demens = "E-Mail já cadastrado!";
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	$aTrab = ConsultarDados("usuarios", "cdusua", $cdusua);
	if ( count($aTrab) > 0) {
		$demens = "CPF já cadastrado...";
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdusua";
		$aNomes[]= "deusua";
		$aNomes[]= "desenh";
		$aNomes[]= "demail";
		$aNomes[]= "nrtele";
		$aNomes[]= "nrcelu";
		$aNomes[]= "cdtipo";
		$aNomes[]= "defoto";
		$aNomes[]= "deobse";
		$aNomes[]= "dtcada";
		$aNomes[]= "flativ";
	
		//dados da tabela
		$aDados=array();
		$aDados[]= $cdusua;
		$aDados[]= $deusua;
		$aDados[]= md5($desenh);
		$aDados[]= $demail;
		$aDados[]= $nrtele;
		$aDados[]= $nrcelu;
		$aDados[]= $cdtipo;
		$aDados[]= $defoto;
		$aDados[]= $deobse;
		$aDados[]= $dtcada;
		$aDados[]= $flativ;

		IncluirDados("usuarios", $aDados, $aNomes);

		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		$devolt = "index.html";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>