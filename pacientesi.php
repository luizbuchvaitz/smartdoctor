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
    $deusua = substr($deusua, 0,15);

    $defotom="img/semfoto.jpg";
 
    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        $demens = "Parâmetros do sistema não foram encontrados!";
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

    <script type="text/javascript" src="js/jquery-1.6.4.js"></script>

</head>

<body>
    <div id="wrapper">
        <?php include_once "menulateral.php" ;?>

        <div id="page-wrapper" class="gray-bg">
            <?php include_once "menulateral1.php" ;?>

            <div class="wrapper wrapper-content">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                    class="fa fa-male"></i> Cadastro de Pacientes - Inclusão
                        </button>
                    </div>

                    <div class="ibox-content">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="pacientesg.php">
                            <div>
                                <center>
                                    <button class="btn btn-sm btn-info " type="submit"><strong>Salvar</strong></button>
                                    <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                                </center>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div id="image-holder" class="m-b-sm">
                                        <img alt="image" class="img-square" src="<?php echo $defotom; ?>"
                                             style="width: 100px">
                                    </div>

                                    <div class="m-b-sm">
                                        <input type=hidden name="defotoa" value="<?php echo $defotom; ?>">
                                        <label title="Alterar Foto" for="defotom" class="btn btn-success">
                                            <input type="file" accept="img/*" name="defotom" id="defotom" class="hide">
                                            Alterar foto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-lg-14">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">CPF</label>
                                        <div class="col-md-3">
                                            <input id="cdusua" name="cdusua" type="text" value="" placeholder="" class="form-control" maxlength = "14" autofocus required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Nome</label>
                                        <div class="col-md-8 ">
                                            <input id="deusua" name="deusua" value="" type="text" placeholder="" class="form-control" maxlength = "100" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">E-mail</label>
                                        <div class="col-md-8 ">
                                            <input id="demail" name="demail" value="" type="email" placeholder="" class="form-control" maxlength = "255" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Telefone</label>
                                        <div class="col-md-3">
                                            <input id="nrtele" name="nrtele" value="" type="text" placeholder="(11) 2345-9876" onkeypress="mascara(this, telefone)" class="form-control" maxlength = "14" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Celular</label>
                                        <div class="col-md-3">
                                            <input id="nrcelu" name="nrcelu" value="" type="text" placeholder="(11) 9-1234-5678" onkeypress="mascara(this, celular)" class="form-control" maxlength = "16" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Tipo</label>
                                        <div class="col-md-4">
                                            <select name="cdtipo" id="cdtipo">
                                                <option value ='P'>Paciente</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Observações</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="deobse" wrap="physical" cols=50 rows=3 name="deobse" placeholder=""></textarea>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">CEP</label>
                                        <div class="col-md-2">
                                            <input id="nrcepi" name="nrcepi" value="" onblur="pesquisacep(this.value);" type="text" placeholder="" class="form-control" maxlength = "08">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Endereço</label>
                                        <div class="col-md-8">
                                            <input id="deende" name="deende" value="" type="text" placeholder="" class="form-control" maxlength = "100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Número</label>
                                        <div class="col-md-2">
                                            <input id="nrende" name="nrende" value="" type="number" placeholder="" class="form-control" maxlength = "10">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Complemento</label>
                                        <div class="col-md-4">
                                            <input id="decomp" name="decomp" value="" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Bairro</label>
                                        <div class="col-md-4">
                                            <input id="debair" name="debair" value="" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Cidade</label>
                                        <div class="col-md-5">
                                            <input id="decida" name="decida" value="" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textinput">Estado</label>
                                        <div class="col-md-1">
                                            <input id="cdesta" name="cdesta" value="" type="text" placeholder="" class="form-control" maxlength = "02">
                                        </div>
                                    </div>

                                </div>
                                <br>
                            </div>

                        </form>
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
        $("#defotom").on('change', function () {

            var imgPath = $(this)[0].value;
            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                if (typeof (FileReader) != "undefined") {

                    var image_holder = $("#image-holder");
                    image_holder.empty();

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                                "class": "thumb-image img-square",
                                "style" : "width: 200px"
                        }).appendTo(image_holder);

                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                    alert("Esse browser não suporta Preview de Imagem");
                }
            } else {
                alert("Por favor, selecione apenas imagens.");
            }
        });
    </script>

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

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
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

    <script type="text/javascript" >
    
        function limpa_formulário_cep() {
                //Limpa valores do formulário de cep.
                document.getElementById('deende').value=("");
                document.getElementById('debair').value=("");
                document.getElementById('decida').value=("");
                document.getElementById('cdesta').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('deende').value=(conteudo.logradouro);
                document.getElementById('debair').value=(conteudo.bairro);
                document.getElementById('decida').value=(conteudo.localidade);
                document.getElementById('cdesta').value=(conteudo.uf);
            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
        
        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('deende').value="...";
                    document.getElementById('debair').value="...";
                    document.getElementById('decida').value="...";
                    document.getElementById('cdesta').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);

                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>

    <script>

        function mascara(o,f){
            v_obj=o
            v_fun=f
            setTimeout("execmascara()",1)
        }

        function execmascara(){
            v_obj.value=v_fun(v_obj.value)
        }

        function leech(v){
            v=v.replace(/o/gi,"0")
            v=v.replace(/i/gi,"1")
            v=v.replace(/z/gi,"2")
            v=v.replace(/e/gi,"3")
            v=v.replace(/a/gi,"4")
            v=v.replace(/s/gi,"5")
            v=v.replace(/t/gi,"7")
            return v
        }

        function soNumeros(v){
            return v.replace(/\D/g,"")
        }

        function celular(v){
            v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
            v=v.replace(/^(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o segundo e o terceiro dígitos
            v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
            return v
        }

        function telefone(v){
            v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
            v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
            return v
        }

        function cpf(v){
            v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
            v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
            v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                                     //de novo (para o segundo bloco de números)
            v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
            return v
        }

        function cep(v){
            v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
            v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Coloca hífen entre o quarto e o quinto dígitos
            return v
        }

        function cnpj(v){
            v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
            v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
            v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
            v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
            v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
            return v
        }

        function romanos(v){
            v=v.toUpperCase()             //Maiúsculas
            v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que não for I, V, X, L, C, D ou M
            //Referência: http://www.diveintopython.org/refactoring/refactoring.html
            while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")
                v=v.replace(/.$/,"")
            return v
        }

        function site(v){
            //Esse sem comentarios para que você entenda sozinho ;-)
            v=v.replace(/^http:\/\/?/,"")
            dominio=v
            caminho=""
            if(v.indexOf("/")>-1)
                dominio=v.split("/")[0]
                caminho=v.replace(/[^\/]*/,"")
            dominio=dominio.replace(/[^\w\.\+-:@]/g,"")
            caminho=caminho.replace(/[^\w\d\+-@:\?&=%\(\)\.]/g,"")
            caminho=caminho.replace(/([\?&])=/,"$1")
            if(caminho!="")dominio=dominio.replace(/\.+$/,"")
            v="http://"+dominio+caminho
            return v
        }
    </script>

</body>
</html>
