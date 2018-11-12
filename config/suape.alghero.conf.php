<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


define('WSDL_URL',"http://suap.intra.demo.sardegnait.it/ws/etws/praticheetws.wsdl");

define('WS_USER','ws_alghero');
define('WS_PASSWD', 'demoalghero');
define('SERVICE_USER','suap');
define('SERVICE_PASSWD','moniCWXQ120');

/*DATABASE DEFINITION*/
define('DBNAME','gw_alghero');
define('DBHOST','127.0.0.1');
define('DBPORT','5433');
define('DBUSER','postgres');
define('DBPWD','postgres');
$dsn = sprintf("pgsql:dbname=%s; host=%s; port=%s; user=%s; password=%s",DBNAME,DBHOST,DBPORT,DBUSER,DBPWD);
define('DSN',$dsn);
?>