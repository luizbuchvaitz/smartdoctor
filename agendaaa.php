<?php

	include "banco.php";
	include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

	$cdagen = $_POST["cdagen"];
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
		$demens = "Consulta não pode ter o valor 0";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}

	if (empty($dtpronH)==true ){
		$demens = "O horário não pode ficar em branco..";
		$detitu = "Smart Doctor | Agendamento de Consultas";
		header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
		$Flag=false;
	}
	if (empty($dtpronD)==true ){
		$demens = "Data não pode ficar em branco!";
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
	//$cdplan = str_pad($cdplan, 2, '0', STR_PAD_LEFT);

	switch (get_post_action('edita','apaga', 'solicCancCons', 'manterCons')) {
    case 'edita':

		if ($Flag == true){

			$demens = "Atualização efetuada com sucesso!";

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

			AlterarDados("agenda", $aDados, $aNomes,"cdagen", $cdagen);

		}

		break;
    case 'apaga':
		$demens = "Exclusão efetuada com sucesso!";

		ExcluirDados("agenda", "cdagen", $cdagen);

		break;
	case 'solicCancCons':
		$demens = "Solicitação de cancelamento efetuada com sucesso!";

		SolicitaCancelamentoConsulta($cdagen);

		break;
	case 'manterCons':
		$demens = "Consulta mantida com sucesso!";

		ManterConsulta($cdagen);

		break;
    default:
		$demens = "Ocorreu um problema na atualização/exclusão..";
	}

	if ($Flag == true) {
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