<?php
require_once DIR."lib/nusoap/nusoap.php";
$dbh=new PDO(DSN);
$schema="iol";
$server = new nusoap_server; 
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL('praticaweb', 'http://195.88.6.158/webservices/sanremo.wsPraticawebBase.php?wsdl');


$server->wsdl->addSimpleType('tipopratica','xsd:string','SimpleType','scalar',array_keys($tipoPratica));
$server->wsdl->addSimpleType('tipointervento','xsd:string','SimpleType','scalar',array_keys($tipoIntervento));

$server->wsdl->schemaTargetNamespace = 'urn:praticaweb';

$server->register('aggiungiPratica',
    Array(
        "tipo"=>"tns:tipopratica",
        "intervento"=>"tns:tipointervento",
        "oggetto"=>"xsd:string",
        "note"=>"xsd:string",
        "destinazione_uso"=>"xsd:string"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "pratica"=>"xsd:int",
        "numero_pratica"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addPratica',
    'rpc',
    'encoded',
    'Metodo che aggiunge una istanza di pratica edilizia al software Praticaweb 2.0,restituisce la chiave primaria della pratica'
);

function aggiungiPratica($tipo,$intervento,$oggetto,$note){
    $dbh=new PDO(DSN);
    $schema="iol";
    $result=Array();
    $sql="INSERT INTO $schema.avvioproc(tipo,intervento,oggetto,note) values(:tipo,:intervento,:oggetto,:note)";
    //$dbh->beginTransaction();
    $stmt=$dbh->prepare($sql);
    if (!$stmt->execute(Array("tipo"=>$tipo,"intervento"=>$intervento,"oggetto"=>$oggetto,"note"=>$note)))
        $errors=$stmt->errorInfo();
    else
        $pratica=$dbh->lastInsertId();
    
    /*for($i=0;$i<count($soggetti);$i++){
        $res=aggiungiSoggetto($pratica,$soggetti[$i]);
    }*/
    
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        
        
        //$dbh->commit();
        $result = Array("success"=>1,"message"=>"OK","pratica"=>$pratica,"numero_pratica"=>"22222");
    }
    return $result;
}
function aggiornaPratica($pratica,$tipo,$intervento,$oggetto,$note,$destinazione_uso){
    $result=Array();
    return $result;
}
function aggiungiSoggetto($pratica,$soggetto){
    $result=Array();
    $sql="INSERT INTO $schema.soggetti(albo,albonumero,alboprov,app,cap,capd,ccia,cciaprov,cedile,cedileprov,codfis,cognome,collaudatore,collaudatore_ca,comunato,comune,comuned,comunicazioni,concessionario,datanato,denunciante,direttore,economia_diretta,email,esecutore,geologo,idsogge,inail,inailprov,indirizzo,inps,inpsprov,nome,note,pec,piva,progettista,progettista_ca,proprietario,prov,provd,provnato,ragsoc,resp_abuso,richiedente,sede,sesso,sicurezza,telefono,titolo,titolod,titolod_note,titolo_note,voltura) VALUES(:albo,:albonumero,:alboprov,:app,:cap,:capd,:ccia,:cciaprov,:cedile,:cedileprov,:codfis,:cognome,:collaudatore,:collaudatore_ca,:comunato,:comune,:comuned,:comunicazioni,:concessionario,:datanato,:denunciante,:direttore,:economia_diretta,:email,:esecutore,:geologo,:idsogge,:inail,:inailprov,:indirizzo,:inps,:inpsprov,:nome,:note,:pec,:piva,:progettista,:progettista_ca,:proprietario,:prov,:provd,:provnato,:ragsoc,:resp_abuso,:richiedente,:sede,:sesso,:sicurezza,:telefono,:titolo,:titolod,:titolod_note,:titolo_note,:voltura);";
    $dbh->prepare($sql);
    return $result;
}
function aggiornaSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
function volturaSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
function rimuoviSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
function aggiungiParticellaTerreni($pratica,$particella_terreni){
    $result=Array();
    $sql="INSERT INTO $schema.cterreni(foglio,mappale,sezione,sub) VALUES(:foglio,:mappale,:sezione,:sub);";
    return $result;
}
function rimuoviParticellaTerreni($pratica,$particella_terreni){
    $result=Array();
    return $result;
}
function aggiungiParticellaUrbano($pratica,$particella_urbano){
    $result=Array();
    $sql="INSERT INTO $schema.cterreni(foglio,mappale,sezione,sub) VALUES(:foglio,:mappale,:sezione,:sub);";
    return $result;
}
function rimuoviParticellaUrbano($pratica,$particella_urbano){
    $result=Array();
    return $result;
}
function aggiungiIndirizzo($pratica,$indirizzo){
    $result=Array();
    $sql="INSERT INTO $schema.indirizzi(civico,interno,via) VALUES(:civico,:interno,:via);";
    return $result;
}
function rimuoviIndirizzo($pratica,$indirizzo){
    $result=Array();
    return $result;
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>