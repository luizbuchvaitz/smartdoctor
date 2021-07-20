<?php

	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";
	date_default_timezone_set('America/Sao_Paulo');

	$cdusua = $_POST["cdusua"];
	$deusua = $_POST["deusua"];
	$demail = $_POST["demail"];
	$defotoa = $_POST["defotoa"];
	$nrcelu = $_POST["nrcelu"];
	$nrtele = $_POST["nrtele"];
	$deobse = $_POST["deobse"];
	$dtcada = date('Y-m-d');
	$flativ	= $_POST["flativ"];

	$Flag = true;

	if (strlen(trim($cdusua)) < 15){
		$cdusua=RetirarMascara($cdusua,"cpf");
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");
	}

    if (isset($_COOKIE['demail'])) {
        $demailant = $_COOKIE['demail'];
    }

	$Flag=true;

	if (trim($demail) !== trim($demailant)) {

		if (empty($demail) == true ) {
			$demens = "É obrigatório informar o e-mail!";
			$detitu = "Smart Doctor | Meus Dados";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
			$Flag=false;
		} Else {

			$aUsua=ConsultarDados("usuarios", "demail", $demail);

			if (count($aUsua) > 0 ){
				$demens = "E-Mail já cadastrado!";
				$detitu = "Smart Doctor | Meus Dados";
				header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
				$Flag=false;
			}
		}
	}

	if ($Flag == true) {

		// tratando o upload da foto
		$uploaddir = 'img/'.$cdusua;
		$uploadfile = $uploaddir . basename($_FILES['defoto']['name']);
	
		$defoto1=basename($_FILES['defoto']['name']);
		if (empty($defoto1) == true) {
			$defoto = $defotoa;
		} Else {
			$defoto= $uploadfile;
			// upload do arquivo da foto
			move_uploaded_file($_FILES['defoto']['tmp_name'], $uploadfile);
		}

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "deusua";
		$aNomes[]= "demail";
		$aNomes[]= "defoto";
		$aNomes[]= "cdusua";
		$aNomes[]= "nrcelu";
		$aNomes[]= "nrtele";
		$aNomes[]= "deobse";
		$aNomes[]= "dtcada";
		$aNomes[]= "flativ";
		$aNomes[]= "deende";
		$aNomes[]= "nrende";
		$aNomes[]= "decomp";
		$aNomes[]= "debair";
		$aNomes[]= "decida";
		$aNomes[]= "cdesta";
		$aNomes[]= "nrcepi";

		//dados da tabela
		$aDados=array();
		$aDados[]= $deusua;
		$aDados[]= $demail;
		$aDados[]= $defoto;
		$aDados[]= $cdusua;
		$aDados[]= $nrcelu;
		$aDados[]= $nrtele;
		$aDados[]= $deobse;
		$aDados[]= $dtcada;
		$aDados[]= $flativ;
		$aDados[]= $_POST["deende"];
		$aDados[]= $_POST["nrende"];
		$aDados[]= $_POST["decomp"];
		$aDados[]= $_POST["debair"];
		$aDados[]= $_POST["decida"];
		$aDados[]= $_POST["cdesta"];
		$aDados[]= $_POST["nrcepi"];

		AlterarDados("usuarios", $aDados, $aNomes, "cdusua", $cdusua);

		setcookie("cdusua",$cdusua);
		setcookie("deusua",$deusua);
		setcookie("defoto",$defoto);
		setcookie("demail",$demail);
		setcookie("flativ",$flativ);
		setcookie("dtcada",$dtcada);

		$demens = "Cadastro atualizado com sucesso :)";
		$detitu = "Smart Doctor | Meus Dados";
		$devolt = "index.php";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

?>