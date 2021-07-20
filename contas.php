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

    if ($cdtipo == 'A' or $cdtipo == 'F' or $cdtipo == 'M'){
        $sql = "select * from contas order by dtcont, cdquem, cdorig";
    } Else {
        $sql = "select * from contas where cdquem = '{$cdusua}' order by dtcont, cdquem, cdorig";
    }
    $aCont= ConsultarDados("", "", "", $sql);

    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        $demens = "Parâmetros do sistema não foram cadastrados!";
        $detitu = "Smart Doctor | Cadastro de Contas Receber/Pagar";
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
                                                        class="fa fa-calculator"></i> Cadastro de Contas a Receber/Pagar
                            </button>
                        </div>
                        <div class="ibox-content">
                            <?php if ($cdtipo == "F" or $cdtipo == "A"){?>
                                <div class="pull-left">
                                    <a onclick="#" href="contasi.php" class="btn btn-info ">Incluir</a>
                                </div>
                                <br>
                            <?php }?>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th style="width=5%">Número de Controle</th>
                                            <th style="width=35%">Paciente/Médico</th>
                                            <th style="width=10%">Tipo</th>
                                            <th style="width=10%">Valor</th>
                                            <th style="width=10%">Vencimento</th>
                                            <th style="width=10%">Pagamento</th>
                                            <th style="width=10%">Situação</th>
                                            <th style="width=10%" class="text-right" data-sort-ignore="true">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for ($f =0; $f <= (count($aCont)-1); $f++) { ?>
                                            <tr class="gradeX">
                                                <?php $datac = strtotime($aCont[$f]["dtcont"]) ;?>
                                                <?php $datap = strtotime($aCont[$f]["dtpago"]) ;?>
                                                <?php $datah = strtotime(date("d-m-Y")) ;?>

                                                <?php $coluna1 = trim($aCont[$f]["cdcont"]); ?>
                                                <?php $coluna2 = trim($aCont[$f]["cdquem"]); ?>
                                                <?php $coluna3 = trim($aCont[$f]["cdtipo"]); ?>
                                                <?php $coluna5 = number_format($aCont[$f]["vlcont"],2,',','.'); ?>
                                                <?php $coluna6 = ""; ?>
                                                <?php $coluna7 = ""; ?>
                                                <?php $coluna8 = "Pendente"; ?>


                                                <?php $aUsua= ConsultarDados("usuarios", "cdusua", $coluna2); ?>
                                                <?php if (count($aUsua)>0){?>
                                                    <?php $coluna2 = $aUsua[0]["cdusua"].' - '.$aUsua[0]["deusua"]; ?>
                                                <?php }?>

                                                <?php if ( empty($datac) !== true and strtotime($aCont[$f]["dtcont"]) !== '-62169984000' and $aCont[$f]["dtcont"] !== '1969-12-31' ){ ?>
                                                    <?php $coluna6 = date("d-m-Y", $datac); ?>
                                                <?php }?>

                                                <?php if ( empty($datap) !== true and strtotime($aCont[$f]["dtpago"]) !== '-62169984000' and $aCont[$f]["dtpago"] !== '1969-12-31' ){ ?>
                                                    <?php $coluna7 = date("d-m-Y", $datap); ?>
                                                <?php }?>

                                                <?php if ( $aCont[$f]["vlpago"] > 0 ){ ?>
                                                    <?php $coluna8 = "Pago"; ?>
                                                <?php }?>

                                                <?php if (  $datac < $datah ){ ?>
                                                    <?php if ( $aCont[$f]["vlpago"] <= 0 ){ ?>
                                                        <?php $coluna8 = "Atrasada"; ?>
                                                    <?php }?>
                                                <?php }?>

                                                <?php if ( $coluna3 == 'R'){?>
                                                    <?php $coluna3 = "Receber"; ?>
                                                <?php }?>

                                                <?php if ( $coluna3 == 'P'){?>
                                                    <?php $coluna3 = "Pagar"; ?>
                                                <?php }?>

                                                <?php $ver = "contasa.php?acao=ver&chave=".$coluna1; ?>
                                                <?php $edita = "contasa.php?acao=edita&chave=".$coluna1; ?>
                                                <?php $apaga = "contasa.php?acao=apaga&chave=".$coluna1; ?>
                                                <?php $imprime = "contasp.php?acao=imprime&chave=".$coluna1; ?>

                                                <td><?php print $coluna1; ?></td>
                                                <td><?php print $coluna2; ?></td>
                                                <td><?php print $coluna3; ?></td>
                                                <td><?php print $coluna5; ?></td>
                                                <td><?php print $coluna6; ?></td>
                                                <td><?php print $coluna7; ?></td>
                                                <td><?php print $coluna8; ?></td>
                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button class="fa fa-eye btn-white btn btn-xs fa-1x" name="ver" type="button" onclick="window.open('<?php echo $ver;?>','_parent')"></button>
                                                        <button class="fa fa-edit btn-white btn btn-xs fa-1x" name="edita" type="button" onclick="window.open('<?php echo $edita;?>','_parent')"></button>
                                                        <button class="fa fa-trash btn-white btn btn-xs fa-1x" name="apaga" type="button" onclick="window.open('<?php echo $apaga;?>','_parent')"></button>
                                                        <!--button class="fa fa-print btn-white btn btn-xs" name="imprime" type="button" onclick="window.open('<?php echo $imprime;?>')"></button-->
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }; ?>    
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width=5%">Número de Controle</th>
                                            <th style="width=35%">Paciente/Médico</th>
                                            <th style="width=10%">Tipo</th>
                                            <th style="width=10%">Valor</th>
                                            <th style="width=10%">Vencimento</th>
                                            <th style="width=10%">Pagamento</th>
                                            <th style="width=10%">Situação</th>
                                            <th style="width=10%" class="text-right" data-sort-ignore="true">Ação</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <caption><strong>* AJUDA</strong></caption>
                                    <thead>
                                        <tr>
                                            <th width=5>Comando</th>
                                            <th width=100>Descrição</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td >Show</td>
                                            <td >Controla a quantidade de linhas a serem apresentadas na tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >entriesSearch</td>
                                            <td >É a pesquisa. Apresenta os dados filtrados conforme o conteúdo digitado.</td>
                                        </tr>
                                        <tr>
                                            <td >Copy</td>
                                            <td >Copia o conteúdo da tabela para a memória (clipboard).</td>
                                        </tr>
                                        <tr>
                                            <td >CSV</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato CSV (arquivo texto com as informações separadas por vírgula).</td>
                                        </tr>
                                        <tr>
                                            <td >Excel</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato EXCEL.</td>
                                        </tr>
                                        <tr>
                                            <td >PDF</td>
                                            <td >Exporta os dados da tabela para um arquivo no formato PDF.</td>
                                        </tr>
                                        <tr>
                                            <td >Print</td>
                                            <td >Imprime os dados da tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >Previous</td>
                                            <td >Retorna uma página da tabela.</td>
                                        </tr>
                                        <tr>
                                            <td >Next</td>
                                            <td >Avança uma página da tabela.</td>
                                        </tr>
                                    </tbody>
                                </table>
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
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Contas'},
                    {extend: 'pdf', title: 'Agenda'},

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

            /* Aplica os manipuladores na tabela */
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
