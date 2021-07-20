<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ProntMed | Esqueceu a Senha</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="white-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <center>
                <img alt="image" class="img-circle img-responsive" src="img/logo.png"
                                                    style="width: 100px">
        </center>
        <h2>Esqueci a senha</h2>
        <p>Entre com seu e-mail cadastrado <br /> e uma nova senha será enviada para você.</p>
        <form class="m-t" role="form" method="post" enctype="multipart/form-data" action="enviarsenha.php">
            <div class="form-group">
                <input id="demail" name = "demail" type="email" class="form-control" placeholder="Digite seu e-mail" required="" maxlength = "255">
            </div>
            <center>
                <button id="button1id" name="button1id" class="btn btn-info" type="submit" value="click">Enviar Nova Senha</button>
                <button id="button2id" name="button2id" class="btn btn-warning" type="button" onclick="window.open('index.html','_parent')">Retornar</button>
            </center>
        </form>
    </div>
</body>

</html>
