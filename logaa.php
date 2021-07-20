<?php

	date_default_timezone_set('America/Sao_Paulo');

	include "banco.php";
	include "util.php";

	$data = date('Y-m-d');
	$cdlog = $_POST["cdlog"];

	$Flag = true;

	if ($Flag == true) {

		switch (get_post_action('edita','apaga')) {
	    case 'edita':

			break;
	    case 'apaga':
			$demens = "Exclusão efetuada com sucesso!";

			ExcluirDados("log", "cdlog", $cdlog);

			break;
	    default:
			$demens = "Ocorreu um problema na atualização/exclusão. Se persistir contate o Suporte!";
		}

		//gravar log
		//GravarIPLog($cdusua, "Alterar Meus Dados:");
		if ($flag2 == false) {
			$detitu = "Smart Doctor | Histórico de Ações";
			$devolt = "log.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		}
	}

?>