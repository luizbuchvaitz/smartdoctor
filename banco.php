<?php

function ExcluirDados($tabela, $campo, $chave, $sql="") {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($sql)) {
       $sql = "delete from "."{$tabela}"." where "."{$campo}"." = "."'{$chave}'";
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $xtabela = TrazNomeArquivo($tabela);

    if (empty($xtabela) == false) {
        $cdusua="99999999999";
        $delog = "Exclusão dos dados da tabela ["."{$xtabela}"."] para a chave ["."{$chave}"."]";
        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        if ($tabela !== "log") {
            GravarLog($cdusua, $delog);       
        }
    }

    return;
}

function ConsultarDados($tabela, $campo, $chave, $sql="") {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($sql)) {
        $sql = "select * from "."{$tabela}"." where "."{$campo}"." = "."'{$chave}'";
    }

    $aDados=array();

    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $aDados[]=$linha;
        }
    }

    mysqli_close($conexao);
    return ($aDados);
}

function AlterarDados($tabela, $dados, $nomes=null, $campo=null, $chave=null, $sql="") {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($sql) == true) {

        $campos="";
        $total=count($dados)-1;

        $sql="update "."{$tabela}"." set ";
 
        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";
        
            if ($i < $total) {
                $campos=$campos.", ";
            }

        }
        if ($tabela !== "parametros"){
            $sql=$sql.$campos." where  ".$campo." = "."'{$chave}'";
        } Else {
            $sql=$sql.$campos;
        }
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $xtabela = TrazNomeArquivo($tabela);

    if (empty($xtabela) == false) {
        $cdusua="99999999999";
        $delog = "Alteração dos dados da tabela ["."{$xtabela}"."] para a chave ["."{$chave}"."]";
        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        if ($tabela !== "log") {
            GravarLog($cdusua, $delog);       
        }
    }

    return;
}

function IncluirDados($tabela, $dados=null, $nomes=null, $sql="") {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($sql) == true) {

        $sql="insert into "."{$tabela}"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];
        
            if ($i < $total) {
                $campos=$campos.", ";
            }

        }
        
        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";
        
            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }
    }

    $sql=$sql.$campos;

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $xtabela = TrazNomeArquivo($tabela);

    if (empty($xtabela) == false) {
        $cdusua="99999999999";
        $delog = "Inclusão dos dados da tabela ["."{$xtabela}"."] para ["."{$dados[0]}"."]";
        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        if ($tabela !== "log") {
            GravarLog($cdusua, $delog);       
        }
    }

    return;
}

function IncluirDadosLOG($tabela, $dados=null, $nomes=null, $sql="") {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($sql) == true) {

        $sql="insert into "."{$tabela}"." (";
        $campos="";
        $total=count($nomes)-1;

        for ($i=0 ; $i < count($nomes) ; $i++ ) {

            $campos=$campos.$nomes[$i];
        
            if ($i < $total) {
                $campos=$campos.", ";
            }

        }
        
        $sql=$sql.$campos.") values (";

        $campos="";

        for ($x =0 ; $x < count($dados) ; $x++ ) {

            $campo="'".$dados[$x]."'";
        
            if ($x < $total) {
                $campos=$campos.$campo.", ";
            } Else {
                $campos=$campos.$campo.")";
            }
        }
    }

    $sql=$sql.$campos;

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    return;
}

function GravarNovaSenha($demail,$desenh) {
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');

    $sql="update usuarios set desenh = "."'{$desenh}'"." where demail = "."'{$demail}'";

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
    return;
}

function Acesso($cdmenu="00", $cdnive="00"){
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');
    $aDados=array('1','2','3');

    $sql = "select * from acessos where cdmenu = '{$cdmenu}' and cdnive = '{$cdnive}'"; 
    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $aDados[]=$linha;
        }
    }

    mysqli_close($conexao);
    return ($aDados);
}

function AlterarDadosAcessos($nomes,$dados,$nivel,$menu){
    include "conexao.php";
    date_default_timezone_set('America/Sao_Paulo');
    if (empty($sql) == true) {

        $campos="";
        $total=count($dados)-1;

        $sql="update "."{$tabela}"." set ";
 
        for ($i =0 ; $i < count($dados) ; $i++ ) {

            $campos=$campos.$nomes[$i]." = '".$dados[$i]."'";
        
            if ($i < $total) {
                $campos=$campos.", ";
            }

        }
        if ($tabela !== "parametros"){
            $sql=$sql.$campos." where cdmenu = '{$menu}' and cdnive = '{$nivel}'";
        } Else {
            $sql=$sql.$campos;
        }
    }

    mysqli_query($conexao, $sql);
    mysqli_close($conexao);

    $xtabela = TrazNomeArquivo($tabela);

    if (empty($xtabela) == false) {
        $cdusua="99999999999";
        $delog = "Alteração dos dados da tabela ["."{$xtabela}"."] para a chave ["."{$chave}"."]";
        if (isset($_COOKIE['cdusua'])) {
            $cdusua = $_COOKIE['cdusua'];
        }

        if ($tabela !== "log") {
            GravarLog($cdusua, $delog);       
        }
    }

    return;

}

Function SomaContas($mes,$tipo){
    include "conexao.php";
    $valor=0;
    if ($tipo == 'P') {
        $sql = "SELECT sum(vlcont) valor FROM `contas` where cdtipo = 'P' and month(dtcont)= {$mes} and year(dtcont) = year(CURRENT_DATE) and (vlpago is null or vlpago <= 0)";
    } Else {
        $sql = "SELECT sum(vlcont) valor FROM `contas` where cdtipo = 'R' and month(dtcont)= {$mes} and year(dtcont) = year(CURRENT_DATE) and (vlpago is null or vlpago <= 0)";
    }

    $resultado=mysqli_query($conexao, $sql);

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $valor=$linha["valor"];
        }
    }

    mysqli_close($conexao);
    return ($valor);
}

function SolicitaCancelamentoConsulta($chave, $sql=""){
    include "conexao.php";
    $sql="update agenda set cancel = 1 where cdagen = {$chave}";
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
}

function ManterConsulta($chave, $sql=""){
    include "conexao.php";
    $sql="update agenda set cancel = 0 where cdagen = {$chave}";
    mysqli_query($conexao, $sql);
    mysqli_close($conexao);
}

function PegaUltimoHorarioConsultaMedico($chave, $sql=""){

    include "conexao.php";

    $sql = "select time(dtagen) as hora from agenda where cdmedi = {$chave} order by dtagen desc limit 1";

    $resultado = mysqli_query($conexao, $sql);
    $linha = mysqli_fetch_assoc($resultado)['hora'];

    mysqli_close($conexao);

    return ($linha);
}

?>