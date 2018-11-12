<?php
$dbh="";
require_once "../config/sanremo.config.php";

$sqlTipoPratica="SELECT id,nome as testo FROM pe.e_tipopratica WHERE enabled=1 order by 1;";
$sqlTipoIntervento="SELECT id,descrizione as testo FROM pe.e_intervento;";
$stmt=$dbh->prepare($sqlTipoPratica);
$stmt->execute();
$result=$stmt->fetchAll();
$tipoPratica=convert($result);
$stmt=$dbh->prepare($sqlTipoIntervento);
$stmt->execute();
$result=$stmt->fetchAll();
$tipoIntervento=convert($result);
require_once "../lib/wsPraticawebBase.php";

?>