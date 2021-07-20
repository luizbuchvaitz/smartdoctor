<?php

    // incluindo bibliotecas de apoio
    include "banco.php";
    include "util.php"; 

    $origem = $_GET["origem"];
    $destino = $_GET["destino"];
    //$origem="enviaraviso.php";
    //$destino="enviaraviso.chp";

    echo date("d-m-Y h:i:s")."<br />";

    $aPara= ConsultarDados("", "", "","select * from parametros");
    if (count($aPara) > 0){
    	$cdcnpj = $aPara[0]["cdcnpj"]." - ".$aPara[0]["deraza"];
    } Else {
    	$cdcnpj = '99999999999999';
    }

    rename($origem, $destino);

    $aNomes=array();
    $aNomes[]= "cdusua";
    $aNomes[]= "demens";
    $aNomes[]= "flemai";
    $aNomes[]= "fllido";

    $aDados=array();
    $aDados[]= $cdcnpj;
    $aDados[]= "Smart Doctor";
    $aDados[]= "sdsuporte@smartdoctor.com";
    $aDados[]= "N";

    IncluirDados("avisos", $aDados, $aNomes);

    echo date("d-m-Y h:i:s")."<br />";

?>
