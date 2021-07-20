<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdusua = $_POST["cdusua"];
	$deusua = $_POST["deusua"];
	$cdtipo = $_POST["cdtipo"];
	//$desenh = substr($_POST["cdusua"], 0, 3);
	$demail = $_POST["demail"];
	$defoto = "";
	$cdusua = $_POST["cdusua"];
	$nrcelu = $_POST["nrcelu"];
	$nrtele = $_POST["nrtele"];
	$deobse = $_POST["deobse"];
	$defotoa = $_POST["defotoa"];
	$demaila = $_POST["demaila"];
	$dtcada = date('Y-m-d');

	$Flag = true;

	if (strlen(trim($cdusua)) < 15){
		$cdusua=RetirarMascara($cdusua,"cpf");
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");
	}

	switch (get_post_action('edita','apaga')) {
    case 'edita':

		if ($demaila !== $demail) {
			$aTrab = ConsultarDados("usuarios", "demail", $demail);
			if ( count($aTrab) > 0) {
				$demens = "E-Mail informado já cadastrado...";
				$detitu = "Smart Doctor | Cadastro de Pacientes";
				header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
				$Flag=false;
			}
		}

		if ($Flag == true){
			//uploads
			$uploaddir = 'img/'.$cdusua."_";
			$uploadfile1 = $uploaddir . basename($_FILES['defoto']['name']);

		    #Move o arquivo para o diretório de destino
		    move_uploaded_file( $_FILES["defoto"]["tmp_name"], $uploadfile1 );

			$defoto=basename($_FILES['defoto']['name']);

			if (empty($defoto) == true) {
				$defoto= $defotoa;
			} Else {
				$defoto= $uploadfile1;
			}

			$demens = "Atualização efetuada com sucesso :)";

			//campos da tabela
			$aNomes=array();
			$aNomes[]= "cdusua";
			$aNomes[]= "deusua";
			$aNomes[]= "cdtipo";
			//$aNomes[]= "desenh";
			$aNomes[]= "demail";
			$aNomes[]= "defoto";
			$aNomes[]= "cdusua";
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
			//$aDados[]= md5($desenh);
			$aDados[]= $demail;
			$aDados[]= $defoto;
			$aDados[]= $cdusua;
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

			AlterarDados("usuarios", $aDados, $aNomes,"cdusua", $cdusua);

		}

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso :)";

		ExcluirDados("usuarios", "cdusua", $cdusua);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão.";
	}

	if ($Flag == true) {
		$detitu = "Smart Doctor | Cadastro de Pacientes";
		$devolt = "pacientes.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>