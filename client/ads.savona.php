<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$baseDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;
$libDir = $baseDir."lib".DIRECTORY_SEPARATOR;
$confDir = $baseDir."config".DIRECTORY_SEPARATOR;

$path = get_include_path();
$newPath = sprintf("%s;%s",$path,$libDir);
set_include_path($newPath);
require_once $confDir."ads.savona.conf.php";
//require_once $libDir.'WSSoapClient.php';

$xml = <<<EOT
<![CDATA[
    <ROOT>
        <CLASS_COD></CLASS_COD>
        <DESCRIZIONE>prova</DESCRIZIONE>
        <UTENTE>AGSPRWS</UTENTE>
    </ROOT>
]]>
EOT;
//$dbh = new PDO(DSN);
$logClient = new SoapClient(WSDL_LOGIN_URL);
$DST="Dlk8pcIwqrfcaX4mdVMrJoD8R03ouP9ZAIuTg7vdCxkHa08IDkutEMyqkLv4MLAIgrlhti8wb72BURsla2vaUlpZVFR68146";
$res = $logClient->__soapCall('login', Array(CODICE_ENTE,SERVICE_USER,SERVICE_PASSWD));
print_r($res);
die();
$client = new WSSoapClient(WSDL_PROTEXT_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true));
$res = $client->__soapCall('getClassifiche', Array("user"=>SERVICE_USER,"DST"=>$DST,"xml"=>$xml));
var_dump($res); 
?>