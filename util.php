<?php

//Google Maps API Key -> AIzaSyCiasjUHakX1PM14d3IlBLJRMtNiwDS2IM 

function preparar_corpo_email_novasenha()
{
    ob_start();
    include_once "template_email_novasenha.php";

    $corpo = ob_get_contents();

    ob_end_clean();

    return $corpo;
}

function preparar_corpo_email_c()
{
    ob_start();
    include_once "template_email_c.php";

    $corpo = ob_get_contents();

    ob_end_clean();

    return $corpo;
}

function preparar_corpo_email($corpo="")
{
    ob_start();
    //Inclui "template_email_c.php";

    echo "<html lang='pt-BR'>";
    echo "<body>";
    echo "</body>";
    echo "</html>";
    echo "<p>".$corpo."</p>";

    $corpo1 = ob_get_contents();

    ob_end_clean();

    return $corpo1;
}



function montar_email() {
    
    $corpo = "
        <html>
            <head>
                <meta charset=\"utf-8\" />
                <title>Gerenciador de Tarefas</title>
                <link rel=\"stylesheet\" href=\"tarefas.css\" type=\"text/css\" />
            </head>
            <body>
                <h1>Tarefa: {$tarefa['nome']}</h1>

                <p><strong>Concluída:</strong> " . traduz_concluida($tarefa['concluida']) . "</p>
                <p><strong>Descrição:</strong> " . nl2br($tarefa['descricao']) . "</p>
                <p><strong>Prazo:</strong> " . traduz_data_para_exibir($tarefa['prazo']) . "</p>
                <p><strong>Prioridade:</strong> " . traduz_prioridade($tarefa['prioridade']) . "</p>

                {$tem_anexos}

            </body>
        </html>
    ";
}

function formatar ($string, $tipo = "")
{
    //$string = ereg_replace("[^0-9]", "", $string);
    $string = preg_replace("/[^0-9]/", "", $string);

    if (!$tipo)
    {
        switch (strlen($string))
        {
            case 10:    $tipo = 'fone';     break;
            case 8:     $tipo = 'cep';      break;
            case 11:    $tipo = 'cpf';      break;
            case 14:    $tipo = 'cnpj';     break;
        }
    }
    switch ($tipo)
    {
        case 'fone':
            $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) . 
                '-' . substr($string, 6);
        break;
        case 'cep':
            $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
        break;
        case 'cpf':
            $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) . 
                '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
        break;
        case 'cnpj':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
                '.' . substr($string, 5, 3) . '/' . 
                substr($string, 8, 4) . '-' . substr($string, 12, 2);
        break;
        case 'rg':
            $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) . 
                '.' . substr($string, 5, 3);
        break;
    }
    return $string;
}    

function getIp()
{
 
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
 
        $ip = $_SERVER['HTTP_CLIENT_IP'];
 
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
 
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 
    }
    else{
 
        $ip = $_SERVER['REMOTE_ADDR'];
 
    }
 
    return $ip;
 
}

Function Busca_ultimo_dia_mes($mes,$ano) {
    date_default_timezone_set('America/Sao_Paulo');

    $mes++;
    If ($mes < 10) {
        $mes = "0".$mes;
    }

    $data1 = $ano."-".$mes."-01";
    $data2 = date('Y-m-d', strtotime("-1 days",strtotime($data1)));
    $aData = explode("-", $data2); 
    $dia =$aData[2]; 
    return ($dia);
}

function mask($val, $mask)
{
     $maskared = '';
     $k = 0;
     for($i = 0; $i<=strlen($mask)-1; $i++)
     {
     if($mask[$i] == '#')
     {
     if(isset($val[$k]))
     $maskared .= $val[$k++];
     }
     else
     {
     if(isset($mask[$i]))
     $maskared .= $mask[$i];
     }
     }
     return $maskared;
}

function get_post_action($name)
{
    $aDados=array();
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}

function Traz_Data_Por_Extenso($hoje=null) {
    date_default_timezone_set('America/Sao_Paulo');

    if (empty($hoje)) {
       $hoje = getdate();
    }

    $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

    $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");

    //$hoje = getdate();

    $dia = $hoje["mday"];

    $mes = $hoje["mon"];

    $nomemes = $meses[$mes];

    $ano = $hoje["year"];

    $diadasemana = $hoje["wday"];

    $nomediadasemana = $diasdasemana[$diadasemana];

    $data= "$nomediadasemana, $dia de $nomemes de $ano";

    return ($data);
}

function Traz_Mes_Data($hoje=null) {
    date_default_timezone_set('America/Sao_Paulo');

    $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

    if (empty($hoje)) {
       $hoje = getdate();
    }

    $dia = $hoje["mday"];

    $mes = $hoje["mon"];

    $nomemes = $meses[$mes];

    return($nomemes);
}

function validaCPF($cpf)
{   // Verifiva se o número digitado contém todos os digitos
    //$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
    $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
    
    // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
    {
    return false;
    }
    else
    {   // Calcula os números para verificar se o CPF é verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
 
            $d = ((10 * $d) % 11) % 10;
 
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }
}

function validaCNPJ ( $cnpj ) {
    // Deixa o CNPJ com apenas números
    $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );
    
    // Garante que o CNPJ é uma string
    $cnpj = (string)$cnpj;
    
    // O valor original
    $cnpj_original = $cnpj;
    
    // Captura os primeiros 12 números do CNPJ
    $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );
    
    /**
     * Multiplicação do CNPJ
     *
     * @param string $cnpj Os digitos do CNPJ
     * @param int $posicoes A posição que vai iniciar a regressão
     * @return int O
     *
     */
    if ( ! function_exists('multiplica_cnpj') ) {
        function multiplica_cnpj( $cnpj, $posicao = 5 ) {
            // Variável para o cálculo
            $calculo = 0;
            
            // Laço para percorrer os item do cnpj
            for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
                // Cálculo mais posição do CNPJ * a posição
                $calculo = $calculo + ( $cnpj[$i] * $posicao );
                
                // Decrementa a posição a cada volta do laço
                $posicao--;
                
                // Se a posição for menor que 2, ela se torna 9
                if ( $posicao < 2 ) {
                    $posicao = 9;
                }
            }
            // Retorna o cálculo
            return $calculo;
        }
    }
    
    // Faz o primeiro cálculo
    $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );
    
    // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
    // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
    $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );
    
    // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
    // Agora temos 13 números aqui
    $primeiros_numeros_cnpj .= $primeiro_digito;
 
    // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );
    $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );
    
    // Concatena o segundo dígito ao CNPJ
    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;
    
    // Verifica se o CNPJ gerado é idêntico ao enviado
    if ( $cnpj === $cnpj_original ) {
        return true;
    }
}

function GerarSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%*-';
    $retorno = '';
    $caracteres = '';
    $caracteres .= $lmin;
    if ($maiusculas) $caracteres .= $lmai;
    if ($numeros) $caracteres .= $num;
    if ($simbolos) $caracteres .= $simb;
    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand-1];
    }
    return $retorno;
}

function EnviarEmail($paraquem, $dequem, $assunto, $corpo,$anexos=array()) {

    include_once "lib/PHPMailer/class.phpmailer.php";
    include_once "lib/PHPMailer/class.smtp.php";
    date_default_timezone_set('America/Sao_Paulo');

    //Requer 'lib/PHPMailer/PHPMailerAutoload.php';

    $aPara = ConsultarDados("", "", "","select * from parametros"); 
    $deserve=$aPara[0]["desere"];
    $demaile=$aPara[0]["demaie"];
    $desenhe=$aPara[0]["desene"];

    $email = new PHPMailer();
    $email->CharSet = 'UTF-8';
    $email->isSMTP();

    if (empty($dequem)){
        $dequem = $demaile;
    }

    $email->Host = $deserve;
    $email->SMTPAuth = true;
    $email->Port = 587;
    $email->Username = $demaile;
    $email->Password = $desenhe;
    $email->SMTPSecure = 'TSL';
    $email->addAddress($paraquem);
    $email->Subject = $assunto;
    $email->setFrom($dequem,"Smart Doctor");

    foreach($anexos as $key => $value) 
    {
       $email->AddAttachment($value);
    }

    $email->msgHTML($corpo);

    //$email->send();
    if ($email->send()){
        //echo "enviado";
    }
    else {
        //echo "Mensagem de erro: " . $email->ErrorInfo;
    }
    return;
}

function RetirarMascara($key,$tipo) {
    if (empty($key) == false) {
        //$key=str_replace(".","",$key);
        //$key=str_replace("/","",$key);
        //$key=str_replace("-","",$key);
        if ($tipo == "cpf") {
            $key = str_pad(preg_replace('/[^0-9]/', '', $key), 11, '0', STR_PAD_LEFT);
            //$key=str_pad($key, 11, "0", STR_PAD_LEFT);
        } Else {
            $key = str_pad(preg_replace('/[^0-9]/', '', $key), 14, '0', STR_PAD_LEFT);
        }
    }
    return ($key);
}

function GravarLog($cdusua, $delog) {
    date_default_timezone_set('America/Sao_Paulo');

    $dtlog=date('Y-m-d H:i:s');
    $iplog=getIp();

    $aNomes=array();
    $aNomes[]="cdusua";
    $aNomes[]="dtlog";
    $aNomes[]="delog";
    $aNomes[]="iplog";

    $aDados=array();
    $aDados[]= $cdusua;
    $aDados[]= $dtlog;
    $aDados[]= $delog;
    $aDados[]= $iplog;

    IncluirDadosLOG("log", $aDados, $aNomes);

    return;
}

Function Coordenadas($endereco, $cidade, $estado, $pais){
    date_default_timezone_set('America/Sao_Paulo');
    $aRetorno=array();

    $endereco = str_replace(" ","+",$endereco);
    $cidade = str_replace(" ","+",$cidade);
    $estado = str_replace(" ","+",$estado);
    $pais = str_replace(" ","+",$pais);

    $address = $endereco.",".$cidade.",".$estado.",".$pais;
    $address = strtolower($address);
    //echo $address;
    //$address = 'rua+gonçalves+chaves,rs,pelotas,brasil';

    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');

    $output= json_decode($geocode);

    $aRetorno[] = $output->results[0]->geometry->location->lat;
    $aRetorno[] = $output->results[0]->geometry->location->lng;

    return ($aRetorno);
}

Function TrazNomeArquivo($tabela="") {
    switch ($tabela) {
        case 'log':
            $xtabela="LOG / TRILHA DE AUDITORIA";
            break;
        case 'parametros':
            $xtabela = "PARÂMETROS";
            break;
        case 'usuarios':
            $xtabela = "USUÁRIOS";
            break;
        case 'menus':
            $xtabela = "MENUS";
            break;
        case 'niveis':
            $xtabela = "NIVEIS";
            break;
        case 'acessos':
            $xtabela = "ACESSOS";
            break;
        default:
            $xtabela = "";
            break;
    }

    return ($xtabela);
}

function TrazTipo($cdtipo="O"){
    $cdtipo=substr($cdtipo, 0,1);
    $cdtipo=strtoupper($cdtipo);
    $detipo="Não Identificado";
    if ($cdtipo == "A") {
        $detipo="Administrador";
    }
    if ($cdtipo == "P") {
        $detipo="Paciente";
    }
    if ($cdtipo == "F") {
        $detipo="Funcionário";
    }
    if ($cdtipo == "M") {
        $detipo="Médico";
    }
    return ($detipo);
}


function get_coordinates($city, $street, $province)
      {
          $address = urlencode($city.','.$street.','.$province);
          $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Brazil";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($ch);
          curl_close($ch);
          $response_a = json_decode($response);
          $status = $response_a->status;

          if ( $status == 'ZERO_RESULTS' )
          {
              return FALSE;
          }
          else
          {
              $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
              return $return;
          }
      }

function GetDrivingDistance($lat1, $lat2, $long1, $long2)
      {
          $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=pt-BR&key=AIzaSyAZifXfEKCOCubfUJcPJOV-IjmXSow1b1E";
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          $response = curl_exec($ch);
          curl_close($ch);
          $response_a = json_decode($response, true);
          $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
          $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

          return array('distance' => $dist, 'time' => $time);
      }

function traduz_data_para_exibir($data)
{
    if ($data == "" OR $data == "00-00-0000") {
        return "";
    }

    $dados = explode("-", $data);

    $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

    return $data_exibir;
}

?>