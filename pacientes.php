<?php

    // identificando dispositivo
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");

    $eMovel="N";
    if ($iphone || $ipad || $android || $palmpre == true) {
        $eMovel="S";
    }

    // incluindo bibliotecas de apoio
    include "banco.php";
    include "util.php";
    date_default_timezone_set('America/Sao_Paulo');

    //codigo do usuario
    if (isset($_COOKIE['cdusua'])) {
        $cdusua = $_COOKIE['cdusua'];
    }

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

    if ($cdtipo == 'A' or $cdtipo == 'F'){
        $sql = "select * from usuarios where cdtipo = 'P'";
    } Else {
        $sql = "select * from usuarios where cdusua = '{$cdusua}'";
    }
    $aUsua= ConsultarDados("", "", "", $sql);

    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        $demens = "Parâmetros do sistema não foram cadastrados!";
        $detitu = "Smart Doctor | Cadastro de Pacientes";
        header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
    }

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

        <div id="page-wrapper" class="gray-bg">
        <?php include_once "menulateral1.php" ;?>

            <div class="wrapper wrapper-content">
                <!--div class="col-lg-12"-->
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                        class="fa fa-male"></i> Pacientes
                            </button>
                        </div>

                        <div class="ibox-content">
                            <div class="pull-left">
                                <a onclick="#" href="pacientesi.php" class="btn btn-info ">Incluir</a>
                            </div>
                            <br>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th><center>CPF</center></th>
                                            <th><center>Nome</center></th>
                                            <th><center>Foto</center></th>
                                            <th><center>Tipo</center></th>
                                            <th><center>Telefone</center></th>
                                            <th><center>Celular</center></th>
                                            <th><center>E-Mail</center></th>
                                            <th class="text-right" data-sort-ignore="true"><center>Ação</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($f =0; $f <= (count($aUsua)-1); $f++) { ?>
                                            <tr class="gradeX">

                                                <?php $coluna1 = $aUsua[$f]["cdusua"]; ?>
                                                <?php $coluna2 = $aUsua[$f]["deusua"]; ?>
                                                <?php $coluna3 = $aUsua[$f]["defoto"]; ?>
                                                <?php $coluna4 = TrazTipo($aUsua[$f]["cdtipo"]); ?>
                                                <?php $coluna5 = $aUsua[$f]["nrtele"]; ?>
                                                <?php $coluna6 = $aUsua[$f]["nrcelu"]; ?>
                                                <?php $coluna7 = $aUsua[$f]["demail"]; ?>

                                                <?php $ver = "pacientesa.php?acao=ver&chave=".$coluna1; ?>
                                                <?php $edita = "pacientesa.php?acao=edita&chave=".$coluna1; ?>
                                                <?php $apaga = "pacientesa.php?acao=apaga&chave=".$coluna1; ?>

                                                <td><center><?php print $coluna1; ?></center></td>
                                                <td><center><?php print $coluna2; ?></center></td>
                                                <td><center><img src="<?php print $coluna3; ?>" alt="foto" width="60px" heigth="60px" class="img-responsive"></center></td>
                                                <td><center><?php print $coluna4; ?></center></td>
                                                <td><center><?php print $coluna5; ?></center></td>
                                                <td><center><?php print $coluna6; ?></center></td>
                                                <td><center><?php print $coluna7; ?></center></td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="fa fa-eye btn-white btn btn-xs fa-1x" name="ver" type="button" onclick="window.open('<?php echo $ver;?>','_parent')"></button>
                                                        <button class="fa fa-edit btn-white btn btn-xs fa-1x" name="edita" type="button" onclick="window.open('<?php echo $edita;?>','_parent')"></button>
                                                        <button class="fa fa-trash btn-white btn btn-xs fa-1x" name="apaga" type="button" onclick="window.open('<?php echo $apaga;?>','_parent')"></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }; ?>    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><center>CPF</center></th>
                                            <th><center>Nome</center></th>
                                            <th><center>Foto</center></th>
                                            <th><center>Tipo</center></th>
                                            <th><center>Telefone</center></th>
                                            <th><center>Celular</center></th>
                                            <th><center>E-Mail</center></th>
                                            <th class="text-right" data-sort-ignore="true"><center>Ação</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                <!--/div-->
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

        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Pacientes'},
                    {extend: 'pdf', title: 'Pacientes'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            /* Inicia tabelas */
            var oTable = $('#editable').DataTable();

            /* Aplica manipuladores */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

    </script>
</body>
</html>
