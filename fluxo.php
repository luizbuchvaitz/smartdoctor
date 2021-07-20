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

    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        $demens = "Parâmetros do sistema não foram cadastrados!";
        $detitu = "Smart Doctor | Fluxo de Caixa";
        header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
    }

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Smart Doctor | Home</title>

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
                                                        class="fa fa-money"></i> Fluxo de Caixa
                            </button>
                        </div>

                        <div class="row">
                            <br>
                            <div class="col-md-4">
                                <div class="ibox-content">
                                    <?php $vlp = SomaContas(1,'P'); ?>
                                    <?php $vlr = SomaContas(1,'R'); ?>
                                    <span class="label label-danger">Pagar</span>
                                    <span class="label label-success">Receber</span>
                                    <br>
                                    <br>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Janeiro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(2,'P'); ?>
                                    <?php $vlr = SomaContas(2,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Fevereiro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(3,'P'); ?>
                                    <?php $vlr = SomaContas(3,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Março/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(4,'P'); ?>
                                    <?php $vlr = SomaContas(4,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Abril/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ibox-content">
                                    <?php $vlp = SomaContas(5,'P'); ?>
                                    <?php $vlr = SomaContas(5,'R'); ?>
                                    <span class="label label-danger">Pagar</span>
                                    <span class="label label-success">Receber</span>
                                    <br>
                                    <br>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Maio/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(6,'P'); ?>
                                    <?php $vlr = SomaContas(6,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Junho/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(7,'P'); ?>
                                    <?php $vlr = SomaContas(7,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Julho/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(8,'P'); ?>
                                    <?php $vlr = SomaContas(8,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Agosto/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="ibox-content">
                                    <?php $vlp = SomaContas(9,'P'); ?>
                                    <?php $vlr = SomaContas(9,'R'); ?>
                                    <span class="label label-danger">Pagar</span>
                                    <span class="label label-success">Receber</span>
                                    <br>
                                    <br>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Setembro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(10,'P'); ?>
                                    <?php $vlr = SomaContas(10,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Outubro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(11,'P'); ?>
                                    <?php $vlr = SomaContas(11,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Novembro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>
                                    <?php $vlp = SomaContas(12,'P'); ?>
                                    <?php $vlr = SomaContas(12,'R'); ?>
                                    <div>
                                        <div>
                                            <span><strong><?php echo 'Dezembro/'.date("Y");?></strong></span>
                                            <small class="pull-right">R$</small>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-danger"><strong><?php echo number_format($vlp,2,',','.'); ?></strong></div>
                                        </div>
                                        <div class="progress progress-medium">
                                            <div style="width: 100%;" class="progress-bar progress-bar-success"><strong><?php echo number_format($vlr,2,',','.'); ?></strong></div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
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
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

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

            /* Inicia as tabelas */
            var oTable = $('#editable').DataTable();

            /* Aplica os manipuladores */
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
