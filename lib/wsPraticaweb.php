<?php
require_once DIR."lib/nusoap/nusoap.php";
$schema="iol";
$server = new nusoap_server; 
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL('praticaweb', 'http://195.88.6.158/webservices/sanremo.wsPraticaweb.php?wsdl');


$server->wsdl->addSimpleType('tipopratica','xsd:string','SimpleType','scalar',array_keys($tipoPratica));
$server->wsdl->addSimpleType('tipointervento','xsd:string','SimpleType','scalar',array_keys($tipoIntervento));
$server->wsdl->addComplexType('soggetto','complexType','struct','all','',Array(
        "albo"=>Array("name"=>"albo","type"=>"xsd:string"),
        "albonumero"=>Array("name"=>"albonumero","type"=>"xsd:string"),
        "alboprov"=>Array("name"=>"alboprov","type"=>"xsd:string"),
        "app"=>Array("name"=>"app","type"=>"xsd:string"),
        "cap"=>Array("name"=>"cap","type"=>"xsd:string"),
        "capd"=>Array("name"=>"capd","type"=>"xsd:string"),
        "ccia"=>Array("name"=>"ccia","type"=>"xsd:string"),
        "cciaprov"=>Array("name"=>"cciaprov","type"=>"xsd:string"),
        "cedile"=>Array("name"=>"cedile","type"=>"xsd:string"),
        "cedileprov"=>Array("name"=>"cedileprov","type"=>"xsd:string"),
        "codfis"=>Array("name"=>"codfis","type"=>"xsd:string"),
        "cognome"=>Array("name"=>"cognome","type"=>"xsd:string"),
        "collaudatore"=>Array("name"=>"collaudatore","type"=>"xsd:int"),
        "collaudatore_ca"=>Array("name"=>"collaudatore_ca","type"=>"xsd:int"),
        "comunato"=>Array("name"=>"comunato","type"=>"xsd:string"),
        "comune"=>Array("name"=>"comune","type"=>"xsd:string"),
        "comuned"=>Array("name"=>"comuned","type"=>"xsd:string"),
        "comunicazioni"=>Array("name"=>"comunicazioni","type"=>"xsd:int"),
        "concessionario"=>Array("name"=>"concessionario","type"=>"xsd:int"),
        "datanato"=>Array("name"=>"datanato","type"=>"xsd:date"),
        "direttore"=>Array("name"=>"direttore","type"=>"xsd:boolean"),
        "economia_diretta"=>Array("name"=>"economia_diretta","type"=>"xsd:boolean"),
        "email"=>Array("name"=>"email","type"=>"xsd:string"),
        "esecutore"=>Array("name"=>"esecutore","type"=>"xsd:boolean"),
        "geologo"=>Array("name"=>"geologo","type"=>"xsd:boolean"),
        "inail"=>Array("name"=>"inail","type"=>"xsd:string"),
        "inailprov"=>Array("name"=>"inailprov","type"=>"xsd:string"),
        "indirizzo"=>Array("name"=>"indirizzo","type"=>"xsd:string"),
        "inps"=>Array("name"=>"inps","type"=>"xsd:string"),
        "inpsprov"=>Array("name"=>"inpsprov","type"=>"xsd:string"),
        "nome"=>Array("name"=>"nome","type"=>"xsd:string"),
        "note"=>Array("name"=>"note","type"=>"xsd:string"),
        "pec"=>Array("name"=>"pec","type"=>"xsd:string"),
        "piva"=>Array("name"=>"piva","type"=>"xsd:string"),
        "progettista"=>Array("name"=>"progettista","type"=>"xsd:boolean"),
        "progettista_ca"=>Array("name"=>"Progettista Cementi Armati","type"=>"xsd:boolean"),
        "proprietario"=>Array("name"=>"proprietario","type"=>"xsd:boolean"),
        "prov"=>Array("name"=>"prov","type"=>"xsd:string"),
        "provd"=>Array("name"=>"provd","type"=>"xsd:string"),
        "provnato"=>Array("name"=>"provnato","type"=>"xsd:string"),
        "ragsoc"=>Array("name"=>"ragsoc","type"=>"xsd:string"),
        "richiedente"=>Array("name"=>"richiedente","type"=>"xsd:int"),
        "sede"=>Array("name"=>"sede","type"=>"xsd:string"),
        "sesso"=>Array("name"=>"sesso","type"=>"xsd:string"),
        "sicurezza"=>Array("name"=>"sicurezza","type"=>"xsd:boolean"),
        "telefono"=>Array("name"=>"telefono","type"=>"xsd:string"),
        "titolo"=>Array("name"=>"titolo","type"=>"xsd:string"),
        "titolo_note"=>Array("name"=>"titolo_note","type"=>"xsd:string"),
        "titolod"=>Array("name"=>"titolod","type"=>"xsd:string"),
        "titolod_note"=>Array("name"=>"titolod_note","type"=>"xsd:string"),
        "voltura"=>Array("name"=>"voltura","type"=>"xsd:boolean")
        )
);

$server->wsdl->addComplexType('soggetti','simpleType','array','all','',Array("soggetti"=>Array("name"=>"soggetto","type"=>"tns:soggetto")));
$server->wsdl->addComplexType('particella','simpleType','array','struct','',Array(
        "sezione"=>Array("name"=>"sezione","type"=>"xsd:string"),
        "foglio"=>Array("name"=>"foglio","type"=>"xsd:string"),
        "mappale"=>Array("name"=>"mappale","type"=>"xsd:string"),
        "sub"=>Array("name"=>"sub","type"=>"xsd:string")
    )
);
$server->wsdl->addComplexType('particelleterreni','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));
$server->wsdl->addComplexType('particelleurbano','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));

$server->wsdl->addComplexType('indirizzo','simpleType','array','struct','',Array(
        "sezione"=>Array("name"=>"via","type"=>"xsd:string"),
        "foglio"=>Array("name"=>"civico","type"=>"xsd:string"),
        "mappale"=>Array("name"=>"interno","type"=>"xsd:string")
        
    )
);
$server->wsdl->addComplexType('indirizzi','simpleType','array','all','',Array("particella"=>Array("name"=>"indirizzo","type"=>"tns:indirizzo")));
$server->wsdl->schemaTargetNamespace = 'urn:praticaweb';

$server->register('aggiungiPratica',
    Array(
        "tipo"=>"tns:tipopratica",
        "intervento"=>"tns:tipointervento",
        "oggetto"=>"xsd:string",
        "note"=>"xsd:string",
        "destinazione_uso"=>"xsd:string",
        "soggetti"=>"tsn:soggetti",
        "particelle_terreni"=>"tns:particelleterreni",
        "particelle_urbano"=>"tns:particelleurbano",
        "indirizzi"=>"tns:indirizzi"
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
$server->register('aggiornaPratica',
    Array(
        "pratica"=>"xsd:int",
        "tipo"=>"tns:tipopratica",
        "intervento"=>"tns:tipointervento",
        "oggetto"=>"xsd:string",
        "note"=>"xsd:string",
        "destinazione_uso"=>"xsd:string"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#updatePratica',
    'rpc',
    'encoded',
    'Metodo che aggiorna una istanza di pratica edilizia nel software Praticaweb 2.0'
);
$server->register('aggiungiSoggetto',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tsn:soggetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addSoggetto',
    'rpc',
    'encoded',
    'Metodo che aggiunge un soggetto ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('aggiornaSoggetto',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tsn:soggetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#updateSoggetto',
    'rpc',
    'encoded',
    'Metodo che aggiorna un soggetto di una pratica edilizia nel software Praticaweb 2.0'
);
$server->register('volturaSoggetto',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tsn:soggetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#volturaSoggetto',
    'rpc',
    'encoded',
    'Metodo che voltura un soggetto di una pratica edilizia nel software Praticaweb 2.0'
);
$server->register('rimuoviSoggetto',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tsn:soggetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#deleteSoggetto',
    'rpc',
    'encoded',
    'Metodo che rimuove un soggetto di una pratica edilizia nel software Praticaweb 2.0'
);
$server->register('aggiungiParticellaTerreni',
    Array(
        "pratica"=>"xsd:int",
        "particella"=>"tsn:particellaterreni"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addParticellaTerreni',
    'rpc',
    'encoded',
    'Metodo che aggiunge una particella del catasto terreni ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('rimuoviParticellaTerreni',
    Array(
        "pratica"=>"xsd:int",
        "particella"=>"tsn:particellaterreni"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#deleteParticellaTerreni',
    'rpc',
    'encoded',
    'Metodo che rimuove una particella del catasto terreni di una pratica edilizia nel software Praticaweb 2.0'
);
$server->register('aggiungiParticellaUrbano',
    Array(
        "pratica"=>"xsd:int",
        "particella"=>"tsn:particellaurbano"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addParticellaUrbano',
    'rpc',
    'encoded',
    'Metodo che aggiunge una particella del catasto urbano ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('rimuoviParticellaUrbano',
    Array(
        "pratica"=>"xsd:int",
        "particella"=>"tsn:particellaurbano"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#deleteParticellaUrbano',
    'rpc',
    'encoded',
    'Metodo che rimuove una particella del catasto urbano di una pratica edilizia nel software Praticaweb 2.0'
);
$server->register('aggiungiIndirizzo',
    Array(
        "pratica"=>"xsd:int",
        "indirizzo"=>"tsn:indirizzo"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addIndirizzo',
    'rpc',
    'encoded',
    'Metodo che aggiunge un indirizzo ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('rimuoviIndirizzo',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tsn:indirizzo"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#deleteIndirizzo',
    'rpc',
    'encoded',
    'Metodo che rimuove un indirizzo di una pratica edilizia nel software Praticaweb 2.0'
);
function aggiungiPratica($tipo,$intervento,$oggetto,$note,$destinazione_uso,$soggetti,$particelle_terreni,$particelle_urbano){
    $result=Array();
    $sql="INSERT INTO $schema.avvioproc(tipo,intevento,oggetto,note) values(:tipo,:intervento,:oggetto,:note)";
    $dbh->beginTransaction();
    $stmt=$dbh->prepare($sql);
    $stmt->execute(Array("tipo"=>$tipo,"intervento"=>$intervento,"oggetto"=>$oggetto,"note"=>$note));
    $pratica=$dbh->lastInsertId("pratica");
    return Array("success"=>1,"message"=>"OK","pratica"=>$pratica,"numero_pratica"=>"22222");
    for($i=0;$i<count($soggetti);$i++){
        $res=aggiungiSoggetto($pratica,$soggetti[$i]);
    }
    
    
    if ($errors){
        $dbh->rollBack();
        $result=Array("success"=>"-1","message"=>"");
    }
    else{
        
        
        $dbh->commit();
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