<?php
/*
<prat:attivita-id>?</prat:attivita-id>
<prat:numero-interno>?</prat:numero-interno>
<prat:esito-identificativo>?</prat:esito-identificativo>
<prat:data-presentazione-anteriore>?</prat:data-presentazione-anteriore>
<prat:parere-espresso-id>?</prat:parere-espresso-id>
<prat:tipologia-intervento-id>?</prat:tipologia-intervento-id>
<prat:oggetto>?</prat:oggetto>
<prat:mappale-catastale>?</prat:mappale-catastale>
<prat:settore-attivita-id>?</prat:settore-attivita-id>
<prat:subalterno-catastale>?</prat:subalterno-catastale>
<prat:partita-iva-richiedente>?</prat:partita-iva-richiedente>
<prat:provincia-ubicazione-id>?</prat:provincia-ubicazione-id>
<prat:foglio-catastale>?</prat:foglio-catastale>
<prat:data-presentazione-posteriore>?</prat:data-presentazione-posteriore>
<prat:tipologia-catastale-id>?</prat:tipologia-catastale-id>
<prat:comune-ubicazione-id>?</prat:comune-ubicazione-id>
<prat:sportello-suap-id>?</prat:sportello-suap-id>
<prat:cod-univoco-sUAP>?</prat:cod-univoco-sUAP>
<prat:richiedente>?</prat:richiedente>
<prat:tipologia-iter-id>?</prat:tipologia-iter-id>
<prat:indirizzo>?</prat:indirizzo>
<prat:pratica-ultima-modifica-anteriore>?</prat:pratica-ultima-modifica-anteriore>
<prat:pratica-ultima-modifica-posteriore>?</prat:pratica-ultima-modifica-posteriore>
*/
function debug($file,$data,$mode='a+'){
        $now=date("d/m/Y h:m:s");
        $f=fopen($file,$mode);
        ob_start();
        echo "------- DEBUG DEL $now -------\n";
        print_r($data);
        $result=ob_get_contents();
        ob_end_clean();
        fwrite($f,$result."\n-------------------------\n");
        fclose($f);
 }

$prms = Array(
    "attivita-id" => NULL,
    "numero-interno" => NULL,
    "esito-identificativo" => NULL,
    "data-presentazione-anteriore" => NULL,
    "parere-espresso-id" => NULL,
    "tipologia-intervento-id" => 62,
    "oggetto" => NULL,
    "mappale-catastale" => NULL,
    "settore-attivita-id" => NULL,
    "subalterno-catastale" => NULL,
    "partita-iva-richiedente" => NULL,
    "provincia-ubicazione-id" => NULL,
    "foglio-catastale" => NULL,
    "data-presentazione-posteriore" => NULL, //"2017-07-01T00:00:00.000+01:00",
    "tipologia-catastale-id" => NULL,
    "comune-ubicazione-id" => NULL,
    "sportello-suap-id" => NULL,
    "cod-univoco-sUAP" => NULL,
    "richiedente" => NULL,
    "tipologia-iter-id" => NULL,
    "indirizzo" => NULL,
    "pratica-ultima-modifica-anteriore" => NULL,
    "pratica-ultima-modifica-posteriore" => NULL,
    "stato-pratica-list" => NULL
);

$xmlRequest = <<<EOT
<getPraticaListEtWsRequest>
    <data-presentazione-posteriore>2017-07-01T00:00:00.000+01:00</data-presentazione-posteriore>
</getPraticaListEtWsRequest>        
EOT;

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

$client = new WSSoapClient(WSDL_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true,"use"=>SOAP_LITERAL));

//var_dump($client->__getTypes()); 
$client->__setUsernameToken(WS_USER, md5(WS_PASSWD), 'PasswordText');
$headers = Array();
$headers[] = new SoapHeader('http://suap.intra.demo.sardegnait.it', 'Authorization','Basic c3VhcDptb25pQ1dYUTEyMA==');
$client->__setSoapHeaders($headers);
//$res = $client->__soapCall("getPraticaListEtWs",$prms,$headers,$headers );
//$prms = new SoapVar($xmlRequest, XSD_ANYXML);

//print_r($prms);
//$res = $client->getPraticaListEtWs($prms);die();
/*
$res = $client->getPraticaListEtWs();
$rr = objectToArray($res);
$dati = $rr["pratica-parere-et-ho-v-list"]["pratica-parere-et-ho-v"];
$i=1;
for($i=0;$i<count($dati);$i++){
    $data = $dati[$i];
    $sql = "INSERT INTO suape.procedimenti(pratica,data) VALUES(?,?);";
    $stmt = $dbh->prepare($sql);
    $pratica = $data["pratica-id"];
    $data = json_encode($data);
    if(!$stmt->execute(Array($pratica,$data))){
        $err = $stmt->errorInfo();
        $mess = sprintf("%s) %s\n",$i,$err);
    }
    else{
        $mess = sprintf("%s) Record OK\n",$i);
    }
    print $mess;
}
die();
 */ 
 
$sql = "SELECT DISTINCT pratica FROM suape.procedimenti ORDER BY 1;";
$stmt = $dbh->prepare($sql);
if(!$stmt->execute()){
        $err = $stmt->errorInfo();
        $mess = sprintf("%s) %s\n",$i,$err);
    }
    else{
        $pratiche = $stmt->fetchAll();
    }
for($i=0;$i<count($pratiche);$i++){
    $pr = $pratiche[$i]["pratica"];
    
    try {
        $mess = sprintf("%s) Chiamata al WS per la pratica %s delle %s\n",$i,$pr,date("d/m/Y H:i:s"));
        $res = $client->getPraticaDettaglioEtWs(Array("pratica-id"=>$pr));
        print $mess;
    } 
    catch (Exception $e) {
        print $e->getMessage() . "\n"; exit();
    }
    $rr = objectToArray($res);
    $data = $rr["pratica-view-ho"];
    $pratica = $data["pratica-id"];
    $data = json_encode($data);
    $sql = "INSERT INTO suape.pratica(pratica,data) VALUES(?,?);";
    $stmt = $dbh->prepare($sql);
    if(!$stmt->execute(Array($pratica,$data))){
        $err = $stmt->errorInfo();
        $mess = sprintf("%s) %s\n",$i,$err);
    }
    else{
        $mess = sprintf("%s) Record OK\n",$i);
    }
    print $mess;
}

print "Done\n";die();
//echo "REQUEST:\n" . $client->__getLastRequest() . "\n";die();

debug('REQUEST.debug',$client->__getLastRequest(),'w');
debug('RESPONSE.debug',$rr,'w');


$allegati = $data["pratica-comunicazione-ho-list"][""];





//var_dump($rr);
die();
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