<?php 	
	
	include "banco.php";
	include "util.php";
	date_default_timezone_set('America/Sao_Paulo');

	$demail= $_POST ["demail"];
	$desenh= GerarSenha();

	$aDados = ConsultarDados("usuarios", "demail", $demail);
	$demail="99999999999";
	if (count($aDados) > 0 ) {
		$cdusua=$aDados[0]["cdusua"];
		$demail=$aDados[0]["demail"];
	}

	$paraquem= $demail;
	$dequem = "";
	$assunto = "ProntMed : Sua nova senha";
	$corpo="Olá, <br /> segue sua nova senha conforme solicitado: <br />".$desenh.'<br /> Atenciosamente';
	
	EnviarEmail($paraquem, $dequem, $assunto, $corpo);

	$desenh= md5($desenh);
	GravarNovaSenha($demail,$desenh);

	$demens = "Uma nova senha foi enviada para o e-mail informado!";
	$detitu = "ProntMed <br /> Nova Senha";
	$devolt = "index.html";
	header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu.'&devolt='.$devolt);
?>
