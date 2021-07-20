<?php
	session_start(); // Inicia a sessão
	session_destroy(); // Finaliza a sessão limpando todos os valores salvos
	foreach($_COOKIE as $key=>$ck){
	   setcookie($key, $ck, time()-3600); // Seta o cookie com vencimento no passado, invalidando-o
	}
	header("Location: index.html"); exit; // Redireciona o visitante para a index
?>