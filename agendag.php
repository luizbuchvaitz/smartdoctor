<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdpron = $_POST["cdpron"];
	$cdmedi = $_POST["cdmedi"];
	$cdusua = $_POST["cdusua"];
	$deespe = $_POST["deespe"];
	$dtpronD = $_POST["dtpronD"];
	$dtpronH = $_POST["dtpronH"];
	$cdplan = $_POST["cdplan"];
	$cdform = $_POST["cdform"];
	$vlcons = $_POST["vlcons"];
	$dedeta = $_POST["dedeta"];

	$vlcons= str_replace(".","",$vlcons);
	$vlcons= str_replace(",",".",$vlcons);

	$flativ = 'S';

	$Flag = true;

	if ( $vlcons <= 0 ){
		$demens = "Valor da Consulta não pode ser zero!";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if (empty($dtpronH)==true ){
		$demens = "Hora não pode ficar em branco!";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}
	if (empty($dtpronD)==true ){
		$demens = "A dData não pode ficar em branco..";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}
	if (horarioEValido($dtpronH) == false){
		$demens = "A consulta deve ser realizada no mínimo 30 minutos após a última deste médico!";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	$dtagen = $dtpronD.' '.$dtpronH.':00';

	if ($Flag == true) {

		//campos da tabela
		$aNomes=array();
		$aNomes[]= "cdusua";
		$aNomes[]= "cdmedi";
		$aNomes[]= "cdform";
		$aNomes[]= "cdplan";
		$aNomes[]= "deespe";
		$aNomes[]= "dedeta";
		$aNomes[]= "dtagen";
		$aNomes[]= "vlcons";
	
		//dados da tabela
		$aDados=array();
		$aDados[]= $cdusua;
		$aDados[]= $cdmedi;
		$aDados[]= $cdform;
		$aDados[]= $cdplan;
		$aDados[]= $deespe;
		$aDados[]= $dedeta;
		$aDados[]= $dtagen;
		$aDados[]= $vlcons;

		IncluirDados("agenda", $aDados, $aNomes);

		$demens = "Seu cadastro foi efetuado com sucesso :)";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		$devolt = "agenda.php";

		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
	}

	function horarioEValido($horario) {

		$cdmedi = $_POST["cdmedi"];

		$ultimoHorario = PegaUltimoHorarioConsultaMedico($cdmedi, "");

		$split1 = explode(":", $ultimoHorario);
		$split2 = explode(":", $horario);

		$horas1 = (int)$split1[0];
		$minutos1 = (int)$split1[1];

		$horas2 = (int)$split2[0];
		$minutos2 = (int)$split2[1];

		$totalMinutos1 = ($horas1 * 60) + $minutos1;
		$totalMinutos2 = ($horas2 * 60) + $minutos2;

		$difMinutos = $totalMinutos2 - $totalMinutos1;

		if ($difMinutos < 30) {
			return false;
		}

		return true;
	}

?>