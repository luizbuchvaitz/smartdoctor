<?php

	// incluindo bibliotecas de apoio
	include "banco.php";
	include "util.php";
	date_default_timezone_set('America/Sao_Paulo');

	// receber as variaveis usuario (e-mail) e senha
    $data		=	date('Y-m-d H:i:s');
	$cdusua  	= 	$_POST["cdusua"];
	$desenh  	= 	$_POST["desenh"];
	$desenha  	= 	$_POST["desenha"];
	$desenhb 	= 	$_POST["desenhb"];

	if (strlen($cdusua) < 15 ) {
		$cdusua=RetirarMascara($cdusua,"cpf");
	} Else {
		$cdusua=RetirarMascara($cdusua,"cnpj");
	}

	$desenh = md5($desenh);
	$Flag = true;
    $aUsua = ConsultarDados('usuarios','cdusua',$cdusua);

    if (count($aUsua) > 0 ){
    	if ( $desenh !== $aUsua[0]["desenh"] ) {
			$demens = "A sua senha atual não confere!";
			$detitu = "Clínicas OnLine&copy; | Alterar Senha";
			$devolt = "minhasenha.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
			$Flag = false;
    	}
    }    

    if ($Flag == true){
		if (empty($desenha) == true) {
			$demens = "É obrigatório informar a nova senha!";
			$detitu = "Clínicas OnLine&copy; | Alterar Senha";
			$devolt = "minhasenha.php";
			header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
		} Else {

			if ($desenha !== $desenhb) {
				$demens = "As senhas informadas estão diferentes! Favor corrigir.";
				$detitu = "Clínicas OnLine&copy; | Alterar Senha";
				$devolt = "minhasenha.php";
				header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
			} Else {
				$aNomes=array();
				$aNomes[]= "desenh";

				$aDados=array();
				$aDados[]= md5($desenha);

				AlterarDados("usuarios",$aDados, $aNomes, "cdusua", $cdusua);

				$delog = "Alteração de senha";
				GravarLog($cdusua, $delog);

				$demens = "Senha atualizada com sucesso!";
				$detitu = "SmartDoctor&copy; | Alterar Senha";
				$devolt = "index.php";
				header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
			}
		}
    }
?>