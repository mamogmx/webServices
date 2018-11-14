<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DEBUG_DIR',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."debug".DIRECTORY_SEPARATOR);

class utils{
    static function debug($file,$data,$mode='a+'){
        $now=date("d/m/Y h:m:s");
        $f=fopen(DEBUG_DIR.$file,$mode);
        ob_start();
        echo "------- DEBUG DEL $now -------\n";
        print_r($data);
        $result=ob_get_contents();
        ob_end_clean();
        fwrite($f,$result."\n-------------------------\n");
        fclose($f);
    }
}
?>