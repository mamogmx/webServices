<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function objectToArray($d) 
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}


$baseDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;
$libDir = $baseDir."lib".DIRECTORY_SEPARATOR;
$confDir = $baseDir."config".DIRECTORY_SEPARATOR;



$path = get_include_path();
$newPath = sprintf("%s;%s",$path,$libDir);
set_include_path($newPath);
require_once $confDir."suape.alghero.conf.php";
require_once 'WSSoapClient.php';

$dbh = new PDO(DSN);

$client = new WSSoapClient(WSDL_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true));

//var_dump($client->__getFunctions()); 
$client->__setUsernameToken(WS_USER, md5(WS_PASSWD), 'PasswordText');
$headers = Array();
$headers[] = new SoapHeader('http://suap.intra.demo.sardegnait.it', 'Authorization','Basic c3VhcDptb25pQ1dYUTEyMA==');
$client->__setSoapHeaders($headers);
$res = $client->getPraticaListEtWs(Array("pratica-ultima-modifica-posteriore"=>"01/10/2018"));
$rr = objectToArray($res);

var_dump($rr);die();
$i=1;
$sql = "INSERT INTO suape.procedimenti(data) VALUES(?);";
$stmt = $dbh->prepare($sql);
foreach($rr as $r){
    
    $data = json_encode($r);
    if(!$stmt->execute(Array($data))){
        $err = $stmt->errorInfo();
        $mess = sprintf("%s) %s\n",$i,$err[1]);
    }
    else{
        $mess = sprintf("%s) Record OK\n",$i);
    }
    print $mess;
    $i+=1;
}
die();

var_dump($res);
die();

?>