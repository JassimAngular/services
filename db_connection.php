<?php
error_reporting(E_ALL ^ E_DEPRECATED);

   error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE);


   
    $$link = mysql_connect('localhost', 'colandbe_jassim', 'Colan#20o4');

    $db_selected = mysql_select_db('colandbe_sohorepro', $link);
    
    $base_url="http://".$_SERVER['SERVER_NAME']."";

if (!$db_selected) {
    die('Database not connected : ' . mysql_error());
}
echo mysql_error();


?>
