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


$method = $argv[1];

$xml = <<<EOT
<xml>
<![CDATA[
    <ROOT>
        <DESCRIZIONE>prova</DESCRIZIONE>
        <UTENTE>AGSPRWS</UTENTE>
    </ROOT>
]]>
</xml>
EOT;


/******************************************  PARAMETRI DEI WEB SERVICES *******************************************************/

/******************************************************************************************************************************/
//$dbh = new PDO(DSN);
$logClient = new SoapClient(WSDL_LOGIN_URL);
$res = $logClient->login( Array("strCodEnte"=>CODICE_ENTE,"strUserName"=>SERVICE_USER,"strPassword"=>SERVICE_PASSWD));
$r = json_decode(json_encode($res), true);
if ($r["LoginResult"]["lngErrNumber"]===0){
    $mex = sprintf("Login effettuato con successo DST : %s\n",$r["LoginResult"]["strDST"]);
    $DST = $r["LoginResult"]["strDST"];
}
elseif($r["LoginResult"]["lngErrNumber"]==0){
    $mex = sprintf("Login effettuato con successo ma restituito come stringa DST : %s\n",$r["LoginResult"]["strDST"]);
    $DST = $r["LoginResult"]["strDST"];
}
else{
    $mex = sprintf("Login fallito : %s\n",$r["LoginResult"]["strErrString"]);
    die($mex);
}

switch ($method){
    case "creaLettera":
        $client = new SoapClient(WSDL_PROT_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true));
        $params[] = new SoapVar('gmacario',XSD_STRING,null,null,'operatore.utenteAd4');
        $params[] = new SoapVar(13,XSD_LONG,null,null,'ente');
        $params[] = new SoapVar('PARTENZA',XSD_STRING,null,null,'movimento');
        $params[] = new SoapVar('999',XSD_STRING,null,null,'tipo');
        $params[] = new SoapVar('03',XSD_STRING,null,null,'schema');
        $params[] = new SoapVar('03',XSD_STRING,null,null,'classificazione');
        $params[] = new SoapVar(FALSE,XSD_BOOLEAN,null,null,'riservato');
        $params[] = new SoapVar('03',XSD_STRING,null,null,'numeroFascicolo');
        $params[] = new SoapVar(2018,XSD_LONG,null,null,'annoFascicolo');
        $params[] = new SoapVar('TEST INSERIMENTO',XSD_STRING,null,null,'oggetto');
        $params[] = new SoapVar('INSERIMENTO DOCUMENTO DI TEST CON METODO CREA LETTERA',XSD_STRING,null,null,'note');

/********************************************* PARAMETRI ALLEGATO PRINCIPALE *******************************************************/
        $mimeType = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $fName = "test.docx";
        $f = fopen($fName,'r');
        $text = fread($f,filesize($fName));
        fclose($fName);
        $b64File = base64encode($text);
        $allegato[] = new SoapVar($mimeType,XSD_STRING,null,null,'contentType');
        $allegato[] = new SoapVar('test.docx',XSD_STRING,null,null,'nomeFile');
        $allegato[] = new SoapVar($b64File,XSD_BASE64BINARY,null,null,'file');
        $params[] = new SoapVar($allegato,SOAP_ENC_OBJECT,null,null,'allegatoPrincipale');
/********************************************* PARAMETRI UNITA PROTOCOLLANTE *******************************************************/
        $UProt[] = new SoapVar('03',XSD_STRING,null,null,'codice');
        $params[] = new SoapVar($UProt,SOAP_ENC_OBJECT,null,null,'unitaProtocollante');
/********************************************* PARAMETRI CORRISPONDENTI *******************************************************/

/********************************************* PARAMETRI SMISTAMENTI *******************************************************/

/********************************************* PARAMETRI ALLEGATI *******************************************************/

/********************************************* CHIAMATA AL SERVIZIO *******************************************************/
        $res = $client->creaLettera(new SoapVar($params,SOAP_ENC_OBJECT));
        break;
    case "getClassifiche":
	$client = new SoapClient(WSDL_PROTEXT_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true));

	$params[] = new SoapVar(SERVICE_USER,XSD_STRING,null,null,'user');
	$params[] = new SoapVar($DST,XSD_STRING,null,null,'DST');
	$params[] = new SoapVar($xml,XSD_ANYXML,null,null,'xml');

        $res = $client->getClassifiche(new SoapVar($params,SOAP_ENC_OBJECT));
        break;
    case default:
       die("Metodo \"$method\" non supportato!");
       break;
}
//$res = $client->getClassifiche(new SoapVar($params,SOAP_ENC_OBJECT));
$rr = json_decode(json_encode($res), true);
$r = simplexml_load_string($rr["return"]);
$res = json_decode(json_encode($r), TRUE);
print_r($res);
?>
