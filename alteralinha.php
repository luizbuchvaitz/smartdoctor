<?php
header("Content-Type: text/html; charset=utf8",true);
ini_set('max_execution_time', 0);

$de='href="logout.php"';
$para='href="logout.php"';

$pasta=getcwd()."/";
$arquivos = glob("$pasta{*.php}", GLOB_BRACE);
$aArq=array();
foreach($arquivos as $arq){
	$aArq[]=$arq;
}

echo "Iniciado em ".date('Y-m-d H:i')."<br /><br />";
$qt=1;
for ($i=0; $i <= count($aArq)-1; $i++) {
	$Origem=$aArq[$i];
	$Destino=$aArq[$i];
	$Destino= str_replace(".php",".ph",$Destino);
	echo $qt." -> ".$Origem."<br />";
	$qt++;

	$O = fopen($Origem,'r') or die('Não é possível abrir o arquivo de origem');
	$D = fopen($Destino,'w') or die('Não é possível abrir o arquivo de origem');
	while(!feof($O)) {

		$linha = fgets($O, 4096);
		$linha = str_replace($de,$para,$linha);
		fwrite($D, $linha);

	}

	fclose($O);
	fclose($D);

	unlink($Origem);
	copy($Destino, $Origem);

}
echo "Finalizado em ".date('Y-m-d H:i')."<br /><br />";
// Exibe a mensagem do dia e hora em que foi finalizado
?>