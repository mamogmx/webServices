<?php
require_once "../../lib/nusoap/nusoap.php";
$dbh="";
$url="http://195.88.6.158/webservices/sanremo.wsPraticaweb.php?wsdl";
$options = array(
  'cache_wsdl'    => WSDL_CACHE_NONE,
  'encoding'      => 'utf-8',
  'soap_version'  => SOAP_1_1,
  'exceptions'    => true,
  'trace'         => true
);
$client = new soapclient($url,$options);
$res=$client->aggiungiPratica("10000","2","pippo","pluto");
echo "<pre>";print_r($res);echo "</pre>";
?>