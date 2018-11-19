<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//define('WSDL_URL',"http://documentale.comune.savona.it/JProtocolloDocArea/services/DOCAREAProtoSoap?WSDL");

//define('WSDL_URL',"http://documentale.comune.savona.it/Atti/services/atti?wsdl");
define('WSDL_URL',"http://documentale.comune.savona.it/agspr/services/DocAresProtoSoap.wsdl");
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