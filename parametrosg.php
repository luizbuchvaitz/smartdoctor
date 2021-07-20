<?php

	include "banco.php";
	include "util.php";
	date_default_timezone_set('America/Sao_Paulo');

	$cdpara = $_POST["cdpara"];
	$depara = $_POST["depara"];
	$deende = $_POST["deende"];
	$nrende = $_POST["nrende"];
	$decomp = $_POST["decomp"];
	$debair = $_POST["debair"];
	$decida = $_POST["decida"];
	$cdesta = $_POST["cdesta"];
	$nrcepi = $_POST["nrcepi"];
	$demail=  $_POST["demail"];
	$desere=  $_POST["desere"];
	$demaie=  $_POST["demaie"];
	$desene=  $_POST["desene"];
	$nrtele = $_POST["nrtele"];
	$nrcelu = $_POST["nrcelu"];
	$deobse = $_POST["deobse"];
	$dtcada = date("Y-m-d");
	$flativ = 'S';

	$cdpara=RetirarMascara($cdpara,"cnpj");

	//campos da tabela
	$aNomes=array();
	$aNomes[]= "cdpara";
	$aNomes[]= "depara";
	$aNomes[]= "deende";
	$aNomes[]= "nrende";
	$aNomes[]= "decomp";
	$aNomes[]= "debair";
	$aNomes[]= "decida";
	$aNomes[]= "cdesta";
	$aNomes[]= "nrcepi";
	$aNomes[]= "demail";
	$aNomes[]= "desere";
	$aNomes[]= "demaie";
	$aNomes[]= "desene";
	$aNomes[]= "nrtele";
	$aNomes[]= "nrcelu";
	$aNomes[]= "deobse";
	$aNomes[]= "dtcada";
	$aNomes[]= "flativ";

	//dados da tabela
	$aDados=array();
	$aDados[]= $cdpara;
	$aDados[]= $depara;
	$aDados[]= $deende;
	$aDados[]= $nrende;
	$aDados[]= $decomp;
	$aDados[]= $debair;
	$aDados[]= $decida;
	$aDados[]= $cdesta;
	$aDados[]= $nrcepi;
	$aDados[]= $demail;
	$aDados[]= $desere;
	$aDados[]= $demaie;
	$aDados[]= $desene;
	$aDados[]= $nrtele;
	$aDados[]= $nrcelu;
	$aDados[]= $deobse;
	$aDados[]= $dtcada;
	$aDados[]= $flativ;

	AlterarDados("parametros", $aDados, $aNomes, "cdpara", $cdpara);

	$demens = "Parâmetros atualizados com sucesso :)";
	$detitu = "Smart Doctor | Dados do Sistema";
	$devolt = "index.php";
	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);

?>