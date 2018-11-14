<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$path = get_include_path();
$newPath = sprintf("%s;%s",$path,$libDir);
set_include_path($newPath);
require_once $confDir."ads.savona.conf.php";
require_once 'WSSoapClient.php';


$dbh = new PDO(DSN);

$client = new WSSoapClient(WSDL_URL, Array("login" => SERVICE_USER, "password"=>SERVICE_PASSWD,"trace" => true));

var_dump($client->__getFunctions()); 
?>