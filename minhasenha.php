<?php

    // identificando dispositivo
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $symbian =  strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");

    $eMovel="N";
    if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
        $eMovel="S";
    }

    // incluindo bibliotecas de apoio
    include "banco.php";
    include "util.php";

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

    // nome do usuario
    if (isset($_COOKIE['deusua'])) {
        $deusua = $_COOKIE['deusua'];
    }

    //localização da foto
    if (isset($_COOKIE['defoto'])) {
        $defoto = $_COOKIE['defoto'];
    }

    //tipo de usuario
    if (isset($_COOKIE['cdtipo'])) {
        $cdtipo = $_COOKIE['cdtipo'];
    }

    //email de usuario
    if (isset($_COOKIE['demail'])) {
        $demail = $_COOKIE['demail'];
    }

    $cdnive = "00";
    $denive = "Err";

    $detipo=TrazTipo($cdtipo);

    // reduzir o tamanho do nome do usuario
    $deusua1=$deusua;
    $deusua = substr($deusua, 0,25);

    $aUsua = ConsultarDados('usuarios','cdusua',$cdusua);

    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        echo 'Dados dos parâmetros não foram cadastrados.';
        die();
    }

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clínicas OnLine&copy; | Principal </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <?php include_once "menulateral.php" ;?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once "menulateral1.php" ;?>

            <div class="wrapper wrapper-content">

                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                        class="fa fa-lock"></i> Minha Senha - <small>Atualização</small>
                            </button>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="minhasenhag.php">

                                  <div>
                                    <center>
                                        <!--button class="btn btn-sm btn-warning " type="button" onclick="window.open('index1c.php','_parent')"><strong>Cancelar</strong></button-->
                                        <button class="btn btn-sm btn-info " type="submit"><strong>Salvar</strong></button>
                                        <button class="btn btn-sm btn-warning " type="button" onClick="window.open('index.php','_parent')"><strong>Retornar</strong></button>
                                    </center>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">CPF/CNPJ</label>
                                    <div class="col-md-3">
                                        <?php if (strlen(trim($cdusua)) < 12) {?>
                                            <input id="cdusua" name="cdusua" type="text" value="<?php echo formatar($aUsua[0]["cdusua"],'cpf') ;?>" onkeypress="mascara(this, cpf)" placeholder="" class="form-control" maxlength = "20" autofocus  readonly="">
                                        <?php }?>
                                        <?php if (strlen(trim($cdusua)) > 12) {?>
                                            <input id="cdusua" name="cdusua" type="text" value="<?php echo formatar($aUsua[0]["cdusua"],'cnpj') ;?>" onkeypress="mascara(this, cnpj)" placeholder="" class="form-control" maxlength = "20" autofocus readonly="">
                                        <?php }?>
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Nome</label>  
                                    <div class="col-md-6">
                                        <input id="deusua" name="deusua" value="<?php echo $deusua1; ?>" type="text" placeholder="" class="form-control" maxlength = "100" readonly="">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Senha Atual</label>
                                    <div class="col-md-4">
                                        <input id="desenh" name="desenh" type="password" placeholder="" class="form-control" maxlength = "100" required="">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Digite Nova Senha</label>
                                    <div class="col-md-4">
                                        <input id="desenha" name="desenha" type="password" placeholder="" class="form-control" maxlength = "100" required="">
                                    </div>
                                  </div>

                                  <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Redigite Nova Senha</label>
                                    <div class="col-md-4">
                                        <input id="desenhb" name="desenhb" type="password" placeholder="" class="form-control" maxlength = "100" required="">
                                    </div>
                                  </div>

                            </form>
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

</body>
</html>
