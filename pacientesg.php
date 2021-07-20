<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdusua = $_POST["cdusua"];
	$deusua = $_POST["deusua"];
	$cdtipo = $_POST["cdtipo"];
	$desenh = substr($_POST["cdusua"], 0, 3);
	$demail = $_POST["demail"];
	$defotoa = $_POST["defotoa"];
	$cdusua = $_POST["cdusua"];
	$nrcelu = $_POST["nrcelu"];
	$nrtele = $_POST["nrtele"];
	$deobse = $_POST["deobse"];
	$dtcada = date('Y-m-d');

	$Flag = true;

	if (strlen(trim($cdusua)) < 12 ){
		$cdusua=RetirarMascara($cdusua,"cpf");

		if ( validaCPF($cdusua) == false) {
			$demens = "CPF do Usuário é inválido!";
			$detitu = "Smart Doctor | Cadastro de Pacientes";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");

		if ( validaCNPJ($cdusua) == false) {
			$demens = "CNPJ do usuário é inválido!";
			$detitu = "Smart Doctor | Cadastro de Pacientes";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		}		
	}

	if ( empty($demail) == true) {
		$demens = "É obrigatório informar o E-Mail!";
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
		if (strlen(trim($cdusua)) < 12 ){
			$demens = "CPF já cadastrado!";
		} Else {
			$demens = "CNPJ já cadastrado!";
		}

		$detitu = "Smart Doctor | Cadastro de Pacientes";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if ($Flag == true) {

		//uploads
		$uploaddir = 'img/'.$cdusua."_";
		$uploadfile1 = $uploaddir . basename($_FILES['defotom']['name']);

	    #Move o arquivo para o diretório de destino
	    move_uploaded_file( $_FILES["defotom"]["tmp_name"], $uploadfile1 );

		$defoto1=basename($_FILES['defotom']['name']);
		//$desenh=substr($_POST["cdusua"], 0,3);

		if (empty($defoto1) == true){
		  $defoto="img/semfoto.jpg";
		} Else {
		  $defoto = $uploadfile1;
		}

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdusua";
		$aNomes[]= "deusua";
		$aNomes[]= "cdtipo";
		$aNomes[]= "desenh";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "nrcelu";
		$aNomes[]= "nrtele";
		$aNomes[]= "deobse";
		$aNomes[]= "dtcada";
		$aNomes[]= "deende";
		$aNomes[]= "nrende";
		$aNomes[]= "decomp";
		$aNomes[]= "debair";
		$aNomes[]= "decida";
		$aNomes[]= "cdesta";
		$aNomes[]= "nrcepi";
	
		//dados da tabela
		$aDados=array();
		$aDados[]= $cdusua;
		$aDados[]= $deusua;
		$aDados[]= $cdtipo;
		$aDados[]= md5($desenh);
		$aDados[]= $demail;
		$aDados[]= $defoto;
		$aDados[]= $nrcelu;
		$aDados[]= $nrtele;
		$aDados[]= $deobse;
		$aDados[]= $dtcada;
		$aDados[]= $_POST["deende"];
		$aDados[]= $_POST["nrende"];
		$aDados[]= $_POST["decomp"];
		$aDados[]= $_POST["debair"];
		$aDados[]= $_POST["decida"];
		$aDados[]= $_POST["cdesta"];
		$aDados[]= $_POST["nrcepi"];

		IncluirDados("usuarios", $aDados, $aNomes);


		$demens = "Cadastro efetuado com sucesso!";
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		$devolt = "pacientes.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>