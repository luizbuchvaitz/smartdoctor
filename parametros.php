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

    //$acao = $_GET["acao"];
    $acao = "edita";
    //$chave = trim($_GET["chave"]);
    $chave="";

    switch ($acao) {
    case 'ver':
        $titulo = "Consulta";
        break;
    case 'edita':
        $titulo = "Alteração";
        break;
    case 'apaga':
        $titulo = "Exclusão";
        break;
    default:
        header('Location: index.php');
    }

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

    $titulo="Atualização";
    $aPara = ConsultarDados('','','','select * from parametros');
    if (count($aPara) > 0 ){
        $cdpara =   $aPara[0]['cdpara'];
        $depara =   $aPara[0]['depara'];
    } Else {
        $demens = "Parâmetros do sistema não foram cadastrados!";
        $detitu = "ProntMed | Cadastro de Usuários";
        header('Location: mensagem.php?demens='.$demens.'&detitu='.$detitu);
    }

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ProntMed | Principal </title>

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
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                        class="fa fa-edit"></i> Parâmetros do Sistema - <small><?php echo $titulo; ?></small>
                            </button>
                        </div>

                        <div class="ibox-content">
                            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="parametrosg.php">

                                <div>
                                    <center>
                                        <?php if($acao == "edita") {?>
                                            <button class="btn btn-sm btn-info" name = "edita" type="submit"><strong>Salvar</strong></button>
                                        <?php }?>
                                        <?php if($acao == "apaga") {?>
                                            <button class="btn btn-sm btn-danger" name = "apaga" type="submit"><strong>Apagar</strong></button>
                                        <?php }?>
                                        <button class="btn btn-sm btn-warning " type="button" onClick="history.go(-1)"><strong>Retornar</strong></button>
                                    </center>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">CNPJ</label>
                                        <div class="col-md-3">
                                            <input id="cdpara" name="cdpara" value="<?php echo formatar($aPara[0]["cdpara"],'cnpj');?>" type="text" onkeypress="mascara(this, cnpj)" placeholder="" class="form-control" maxlength = "20" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Razão Social</label>
                                        <div class="col-md-8">
                                            <input id="depara" name="depara" value="<?php echo $aPara[0]["depara"];?>" type="text" placeholder="" class="form-control" maxlength = "100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Observações</label>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="deobse" wrap="physical" cols=50 rows=3 name="deobse" placeholder=""><?php echo $aPara[0]["deobse"];?></textarea>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">CEP</label>
                                        <div class="col-md-2">
                                            <input id="nrcepi" name="nrcepi" value="<?php echo $aPara[0]["nrcepi"];?>" onblur="pesquisacep(this.value);" type="text" placeholder="" class="form-control" maxlength = "08">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Endereço</label>
                                        <div class="col-md-8">
                                            <input id="deende" name="deende" value="<?php echo $aPara[0]["deende"];?>" type="text" placeholder="" class="form-control" maxlength = "100">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Número</label>
                                        <div class="col-md-2">
                                            <input id="nrende" name="nrende" value="<?php echo $aPara[0]["nrende"];?>" type="number" placeholder="" class="form-control" maxlength = "10">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Complemento</label>
                                        <div class="col-md-4">
                                            <input id="decomp" name="decomp" value="<?php echo $aPara[0]["decomp"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Bairro</label>
                                        <div class="col-md-4">
                                            <input id="debair" name="debair" value="<?php echo $aPara[0]["debair"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Municipio</label>
                                        <div class="col-md-4">
                                            <input id="decida" name="decida" value="<?php echo $aPara[0]["decida"];?>" type="text" placeholder="" class="form-control" maxlength = "50">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Estado</label>
                                        <div class="col-md-1">
                                            <input id="cdesta" name="cdesta" value="<?php echo $aPara[0]["cdesta"];?>" type="text" placeholder="" class="form-control" maxlength = "2">
                                        </div>
                                    </div>

                                    <hr>
                                    <center><h3>Dados Para Envio de E-mails</h3></center> 
                                    <br>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Servidor Smtp para Enviar Mensagens</label>
                                        <div class="col-md-8">
                                            <input id="desere" name="desere" value="<?php echo $aPara[0]["desere"]; ?>" type="text" placeholder="" class="form-control" maxlength = "100" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">E-Mail Para Enviar Mensagens</label>
                                        <div class="col-md-8">
                                            <input id="demaie" name="demaie" value="<?php echo $aPara[0]["demaie"]; ?>" type="email" placeholder="" class="form-control" maxlength = "100" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Senha do E-Mail Para Enviar Mensagens</label>
                                        <div class="col-md-8">
                                            <input id="desene" name="desene" value="<?php echo $aPara[0]["desene"]; ?>" type="password" placeholder="" class="form-control" maxlength = "100" required="">
                                        </div>
                                    </div>

                                    <hr>
                                    <center><h3>Dados Para Suporte</h3></center> 
                                    <br>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">E-Mail</label>
                                        <div class="col-md-8">
                                            <input id="demail" name="demail" value="<?php echo $aPara[0]["demail"]; ?>" type="email" placeholder="" class="form-control" maxlength = "255">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Telefone</label>
                                        <div class="col-md-2">
                                            <input id="nrtele" name="nrtele" value="<?php echo $aPara[0]["nrtele"]; ?>" type="text" onkeypress="mascara(this, telefone)" placeholder="" class="form-control" maxlength = "14">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Celular</label>
                                        <div class="col-md-2">
                                            <input id="nrcelu" name="nrcelu" value="<?php echo $aPara[0]["nrcelu"]; ?>" type="text" onkeypress="mascara(this, celular)" placeholder="" class="form-control" maxlength = "16">
                                        </div>
                                    </div>
                                </div>        

                            </form>
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

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="js/plugins/flot/jquery.flot.time.js"></script>

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
