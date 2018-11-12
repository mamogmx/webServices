<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$baseDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;
$libDir = $baseDir."lib".DIRECTORY_SEPARATOR."nusoap".DIRECTORY_SEPARATOR;
$confDir = $baseDir."config".DIRECTORY_SEPARATOR;

require_once $confDir."pw.spezia.conf.php";
require_once $libDir.'nusoap.php';

$client = new nusoap_client(WSDL_URL, false);
$client->soap_defencoding = 'UTF-8';
$params = Array(
    "pratica" => 507031,
    "id" => 108490,
    "tipo" => 1
);
$result = $client->call("leggiDocumento", $params);
if ($client->fault) {
	echo '<h2>Fault</h2><pre>'; print_r($result); echo '</pre>';
} else {
	$err = $client->getError();
	if ($err) {
		echo '<h2>Error</h2><pre>' . $err . '</pre>';
	} else {
		echo '<h2>Result</h2><pre>'; print_r($result); echo '</pre>';
	}
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->getDebug(), ENT_QUOTES) . '</pre>';

?>