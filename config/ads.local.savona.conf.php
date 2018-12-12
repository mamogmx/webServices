<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define('WSDL_LOGIN_URL',"http://10.129.67.229:8084/JProtocolloDocArea/services/DOCAREAProtoSoap?WSDL");

define('WSDL_ATTI_URL',"http://10.129.67.229:8084/Atti/services/atti?wsdl");
define('WSDL_PROTEXT_URL',"http://10.129.67.229:8084/agspr/services/ProtocolloExtendedServicePort?wsdl");
//define('WSDL_PROTEXT_URL',"http://10.129.67.229:8084/JProtocolloDocArea/services/ProtocolloExtendedServicePort?wsdl");
define('WSDL_PROT_URL',"http://10.129.67.229:8084/Protocollo/services/protocollo?wsdl");


define('SERVICE_USER','AGSPRWS');
define('SERVICE_PASSWD','password');


define("CODICE_A00","AOOCOMUNESV");
define("CODICE_ENTE","C_I480");


/*DATABASE DEFINITION*/
define('DBNAME','gw_savona');
define('DBHOST','127.0.0.1');
define('DBPORT','5432');
define('DBUSER','postgres');
define('DBPWD','postgres');
$dsn = sprintf("pgsql:dbname=%s; host=%s; port=%s; user=%s; password=%s",DBNAME,DBHOST,DBPORT,DBUSER,DBPWD);
define('DSN',$dsn);
?>

