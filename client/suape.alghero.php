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

$key = "pratica-id";


$baseDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;
$libDir = $baseDir."lib".DIRECTORY_SEPARATOR;
$confDir = $baseDir."config".DIRECTORY_SEPARATOR;



print date("d/m/Y H:i:s")."\n";

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
 /*
$sql = "SELECT DISTINCT pratica FROM suape.procedimenti ORDER BY 1;";
$stmt = $dbh->prepare($sql);
if(!$stmt->execute()){
    $err = $stmt->errorInfo();
    $mess = sprintf("%s) %s\n",$i,$err);
}
else{
    $pratiche = $stmt->fetchAll();
}
*/
$pratiche = Array(Array("pratica"=>285280),Array("pratica"=>285424));
for($j=0;$j<count($pratiche);$j++){
    $pr = $pratiche[$j]["pratica"];
    $anno = 2017;
    $docDir = $baseDir."documenti".DIRECTORY_SEPARATOR."pe".DIRECTORY_SEPARATOR.$anno.DIRECTORY_SEPARATOR.$pr.DIRECTORY_SEPARATOR."allegati".DIRECTORY_SEPARATOR;
    print "$j) Pratica $pr\n";
    try {
        $mess = sprintf("\t%s) Chiamata al WS per la pratica %s delle %s\n",$j,$pr,date("d/m/Y H:i:s"));
        print $mess;
        $res = $client->getPraticaDettaglioEtWs(Array("pratica-id"=>$pr));
        $mess = sprintf("\t%s) Uscita dal WS per la pratica %s delle %s\n",$j,$pr,date("d/m/Y H:i:s"));
        print $mess;
    } 
    catch (Exception $e) {
        print $e->getMessage() . "\n";        
        continue;
    }
    $rr = objectToArray($res);
/*    print count($rr["pratica-to-modulistica-ho-list"]["pratica-to-modulistica-ho-v"])."\n";
    print_r($rr["pratica-to-modulistica-ho-list"]["pratica-to-modulistica-ho-v"]);
    die();*/
    
    $sql = "SELECT FROM suape.";
    $anno = 2017;
    $docDir = $baseDir."documenti".DIRECTORY_SEPARATOR."pe".DIRECTORY_SEPARATOR.$anno.DIRECTORY_SEPARATOR.$pr.DIRECTORY_SEPARATOR."allegati".DIRECTORY_SEPARATOR;
/********************   Inserimento dei dati della pratica   ******************/
    $procedimento = $rr["pratica-view-ho"];
    $pratica = $procedimento["pratica-id"];
    $data = json_encode($procedimento);
    $sql = "INSERT INTO suape.pratica(pratica,data) VALUES(?,?);";
    $stmt = $dbh->prepare($sql);
    if(!$stmt->execute(Array($pratica,$data))){
        $err = $stmt->errorInfo();
        $mess = sprintf("\t%s)Errore inserimento procedimento $s: %s\n",$i,$pr,$err);
    }
    else{
        $mess = sprintf("\t%s) Record Procedimento Pratica $pr OK\n",$j,$pr);
    }
    print $mess;
/*******************   Inserimento dei dati dell'ubicazione   *****************/
    $ubicazione = $rr["pratica-ubicazione-view-ho"];
    $sql = "INSERT INTO suape.ubicazione(pratica,data) VALUES(?,?);";
    $data = json_encode($ubicazione);
    $stmt = $dbh->prepare($sql);
    if(!$stmt->execute(Array($pratica,$data))){
        $err = $stmt->errorInfo();
        $mess = sprintf("\t%s)Errore inserimento ubicazione pratica %s : %s\n",$j,$pr,$err);
    }
    else{
        $mess = sprintf("\t%s)Record Ubicazione Pratica %s OK\n",$j,$pr);
    }
    print $mess;    
    
/**********************   Inserimento dei dati catastali   ********************/    
    $catasto = $rr["pratica-ubicazione-catastale-ho-list"]["pratica-ubicazione-catastale-ho-v"];
    $Keys = array_keys($catasto);
    if (array_key_exists($key,$catasto)){
        $mex = sprintf("\t\tFound %s in %s\n",$key,implode(',',$Keys));
        //print $mex;
        $catasto = Array($catasto);
    }
    $sql = "INSERT INTO suape.catasto(pratica,data) VALUES(?,?);";
    for($i=0;$i<count($catasto);$i++){
        $data = json_encode($catasto[$i]);
        $stmt = $dbh->prepare($sql);
        if(!$stmt->execute(Array($pratica,$data))){
            $err = $stmt->errorInfo();
            $mess = sprintf("\t%s)Errore inserimento catasto pratica %s : %s\n",$i,$pr,$err);
        }
        else{
            $mess = sprintf("\t%s)Record Catasto Pratica %s OK\n",$i,$pr);
        }
     
       print $mess;
    }

/********************     Inserimento delle comunicazioni    ******************/
    $comunicazioni = $rr["pratica-comunicazione-ho-list"]["pratica-comunicazione-v-ho"];
    $Keys = array_keys($comunicazioni);
    $sql = "INSERT INTO suape.comunicazioni(pratica,data) VALUES(?,?);";
    if (array_key_exists($key,$comunicazioni)){
        $mex = sprintf("Found %s in %s\n",$key,implode(',',$Keys));
        print $mex;
        $comunicazioni = Array($comunicazioni);
    }
    for($i=0;$i<count($comunicazioni);$i++){
        $data = json_encode($comunicazioni[$i]);
        $stmt = $dbh->prepare($sql);
        if(!$stmt->execute(Array($pratica,$data))){
            $err = $stmt->errorInfo();
            $mess = sprintf("\t%s)Errore inserimento comunicazioni pratica %s : %s\n",$i,$pr,$err);
        }
        else{
            $mess = sprintf("\t%s)Record Comunicazioni Pratica %s OK\n",$i,$pr);
        }
     
       print $mess;
    }

/********************     Inserimento degli allegati         ******************/
    $allegati = $rr["pratica-to-doc-rich-ho-list"]["pratica-to-docrich-ho-v"];
    $Keys = array_keys($allegati);
    $sql = "INSERT INTO suape.documenti(pratica,data) VALUES(?,?);";
    if (array_key_exists($key,$allegati)){
        $mex = sprintf("Found %s in %s\n",$key,implode(',',$Keys));
        //print $mex;
        $allegati = Array($allegati);
    }
    for($i=0;$i<count($allegati);$i++){
        $allegati[$i]["tabella"] = "docrich";
        $data = json_encode($allegati[$i]);
        $stmt = $dbh->prepare($sql);
        if(!$stmt->execute(Array($pratica,$data))){
            $err = $stmt->errorInfo();
            $mess = sprintf("\t%s)Errore inserimento record allegati pratica %s : %s\n",$i,$pr,$err);
            print $mess;
        }
        else{
            $mess = sprintf("\t%s)Record Allegati Pratica %s OK\n",$i,$pr);
            $docId = $allegati[$i]["file-doc-id"];
            $filename = $allegati[$i]["filename"];
            print $mess;
            $mess = sprintf("\t\t-)Chiamata al WS per il File %s della pratica %s alle %s\n",$filename,$pr,date("d/m/Y H:i:s"));
            print $mess;
            try {
                $res = $client->getPraticaFileEtWs(Array("pratica-id"=>$pr,"file-doc-id"=>$docId));
                $mess = sprintf("\t\t-)Uscita dal WS alle %s\n",date("d/m/Y H:i:s"));
                print $mess;
                $result = objectToArray($res);
                $text = $result["bytes"];
                $f = fopen($docDir.$filename,'w');
                fwrite($f,$text);
                fclose($f);
            } 
            catch (Exception $e) {
                $mess = sprintf("\t\t-)Errore nella chiamata al WS getPraticaFileEtWs alle %s: %s\n",date("d/m/Y H:i:s"),$e->getMessage());
                print $mess;
            }   
        }
    }

    $modulistica = $rr["pratica-to-modulistica-ho-list"]["pratica-to-modulistica-ho-v"];
    $Keys = array_keys($modulistica);
    $sql = "INSERT INTO suape.documenti(pratica,data) VALUES(?,?);";
    if (array_key_exists($key,$modulistica)){
        $mex = sprintf("Found %s in %s\n",$key,implode(',',$Keys));
        print $mex;
        $modulistica = Array($modulistica);
    }
    for($i=0;$i<count($modulistica);$i++){
        $modulistica[$i]["tabella"] = "modulistica";
        $data = json_encode($modulistica[$i]);
        $stmt = $dbh->prepare($sql);
        if(!$stmt->execute(Array($pratica,$data))){
            $err = $stmt->errorInfo();
            $mess = sprintf("\t%s)Errore inserimento allegati modulistica pratica %s: %s\n",$i,$pr,$err);
            print $mess;
        }
        else{
            $mess = sprintf("\t%s)Record Allegati Modulistica pratica %s OK\n",$i,$pr);
            $docId = $modulistica[$i]["file-doc-id"];
            $filename = $modulistica[$i]["filename"];
            print $mess;
            $mess = sprintf("\t\t-)Chiamata al WS per il File %s della pratica %s alle %s\n",$filename,$pr,date("d/m/Y H:i:s"));
            print $mess;
            try {
                $res = $client->getPraticaFileEtWs(Array("pratica-id"=>$pr,"file-doc-id"=>$docId));
                $mess = sprintf("\t\t-)Uscita dal WS alle %s\n",date("d/m/Y H:i:s"));
                print $mess;
                $result = objectToArray($res);
                $text = $result["bytes"];
                $f = fopen($docDir.$filename,'w');
                fwrite($f,$text);
                fclose($f);
            } 
            catch (Exception $e) {
                $mess = sprintf("\t\t-)Errore nella chiamata al WS getPraticaFileEtWs alle %s: %s\n",date("d/m/Y H:i:s"),$e->getMessage());
                print $mess;
            }  
        }
    }    
}    
print "Done\n";
print date("d/m/Y H:i:s")."\n";
die();

?>