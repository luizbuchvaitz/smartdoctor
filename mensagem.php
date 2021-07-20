<?php
    //flush();

    $detitu=trim($_GET['detitu']);
    $demens=trim($_GET['demens']);
    $devolt="";
    if (isset($_GET['devolt'])) {
       $devolt=trim($_GET['devolt']);
       $devolt="window.open('"."{$devolt}"."','_parent')";
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

<body class="gray-bg">

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-16">
                <div class="ibox-title">
                    <button type="button" class="btn btn-info btn-lg btn-block"><i
                                                    class="fa fa-envelope"></i> <?php echo $detitu; ?>
                    </button>
                </div>
                <div class="ibox-content">

                    <p>
                        <center>
                            <strong>Atenção : </strong><?php echo $demens; ?> 
                        </center>
                    </p>

                    <div class="row">
                        <?php if (empty($devolt) == true) {?>
                            <center>  <button id="button2id" name="button2id" class="btn btn-warning" type="button"  onClick="history.go(-1)">Retornar </center> 
                        <?php } Else {?>
                           <center>  <button id="button2id" name="button2id" class="btn btn-warning" type="button"  onClick="<?php echo $devolt; ?>">Retornar </center> 
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!--hr/-->
        <div class="row">
            <div class="text-center">
               <small>Smart Doctor</small>
            </div>
        </div>
    </div>

</body>

</html>
