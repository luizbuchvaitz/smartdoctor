<?php

    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    // identificando dispositivo
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");

    //======
    $server = $_SERVER['SERVER_NAME'];
    $endereco = $_SERVER ['REQUEST_URI'];
    $onde="http://" . $server . $endereco;

    $eMovel="N";

    if ($iphone || $ipad || $android == true) {
        $eMovel="S";
    }

    // incluindo bibliotecas de apoio
    include_once "banco.php";
    include_once "util.php";

    //$cdusua=RetirarMascara($cdusua,"cpf");

    $paraquem= 'sdsuporte@smartdoctor.com';
    $dequem = "";
    $assunto = "SmartDoctor";
    $corpo="Olá, <br /> segue conforme solicitado: <br />".$onde;
    
    EnviarEmail($paraquem, $dequem, $assunto, $corpo);
    //======

    $cdusua = '00000000191';
    $deusua = 'Desconhecido ERR';
    $defoto = 'img/semfoto.jpg';
    $cdtipo = 'Demonstração';
    $demail = 'd@d.com';
    $cdusua = "00000000000";

    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    if (isset($_COOKIE['deusua'])) {
        $deusua = $_COOKIE['deusua'];
    }

    if (isset($_COOKIE['defoto'])) {
        $defoto = $_COOKIE['defoto'];
    }

    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    }

    if (isset($_COOKIE['demail'])) {
        $demail = $_COOKIE['demail'];
    }

    if (isset($_COOKIE['flativ'])) {
        $flativ = $_COOKIE['flativ'];
    }

    $detipo=TrazTipo($cdtipo);

    $deusua1=$deusua;
    $deusua = substr($deusua, 0,25);

    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        echo 'Dados dos parâmetros não foram cadastrados.';
        die();
    }

    $aMens=array();
    $qtmens = count($aMens);
    $dtatua = date("Y-m-d");
    $cdnive = "00";

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Doctor</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include_once "menulateral.php" ;?>
        <br>
        <br>
        <div id="page-wrapper" class="gray-bg">
            <?php include_once "menulateral1.php" ;?>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                            class="fa fa-home"></i> Menu Principal 
                                </button>
                            </div>
                            <br>
                            <div class="ibox-content">
                                <div class="m-b-sm">
                                    <center> 
                                    <img alt="image" class="img-circle img-responsive" src="img/logo.png"
                                    style="width: 100px">
                                    </center>
                                </div>
                                <strong>Suporte</strong><br>
                                <small><?php echo $aPara[0]['demail']; ?></small><br>
                                <small><?php echo $aPara[0]['nrtele']; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="js/plugins/jeditable/jquery.jeditable.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <script>
            $("body").addClass('fixed-sidebar');
            $('.sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });

            if (localStorageSupport){
                localStorage.setItem("fixedsidebar",'on');
            }
    </script>

</body>
</html>
