<?php 
function get_client_ip() {
     $ipaddress = '';
     if (isset($_SERVER['HTTP_CLIENT_IP']) AND ($_SERVER['HTTP_CLIENT_IP']))
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND ($_SERVER['HTTP_X_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_X_FORWARDED']) AND ($_SERVER['HTTP_X_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if(isset($_SERVER['HTTP_FORWARDED_FOR']) AND ($_SERVER['HTTP_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_FORWARDED']) AND ($_SERVER['HTTP_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if(isset($_SERVER['REMOTE_ADDR']) AND ($_SERVER['REMOTE_ADDR']))
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = '10.1.0.104';
     return $ipaddress; 
}
$ip = get_client_ip();
switch ($ip) {
#Мой
#Мой
case "127.0.0.1":
case "10.1.0.104":
#Artushkina
case "195.138.87.207":
#УТиСЗН
case "195.5.5.205":
#Львова
case "10.3.1.70":
#ДОБРОБУТ
case "10.0.128.3":
case "10.0.128.22":
case "10.0.128.23":
case "194.143.137.137":
case "195.138.91.135":
#Офис
case "10.3.0.74":
case "78.26.206.155":
case "178.33.149.43":
case "85.238.106.26";
case "85.238.103.44";



$house_id="178,86,87,195,187";
$osmd_id = "33,34,36,38";
$voda = 1;
$stoki = 1;
$podogrev = 0;
$ptn = 1;

$otoplenie = 1;
$kvartplata = 1;
$tbo = 1;
$energy = 1;
$gas = 1;
$vaxta = 1;
break;
#Стр1
case "195.138.65.65":

$house_id="86";
$osmd_id = "34";

$voda = 1;
$stoki = 1;
$podogrev = 0;
$ptn = 1;

$otoplenie = 1;
$kvartplata = 1;
$tbo = 0;
$energy = 0;
$gas = 0;
$vaxta = 0;
break;
#HJK
case "10.0.128.38":
case "10.5.1.72":
case "91.192.131.35":

$house_id="87,195";
$osmd_id = "36";

$voda = 1;
$stoki = 1;
$podogrev = 0;
$ptn = 1;

$otoplenie = 1;
$kvartplata = 1;
$tbo = 1;
$energy = 1;
$gas = 0;
$vaxta = 1;
break;

}

 define('LOGIN',	'cthubq');
 define('PASSWORD',	'hfljyt;crbq');
 define('BASE','OSBB');
 define('OSMD',$osmd_id);
 define('HOUSE',$house_id); 
 define('VODA',	$voda);
 define('STOKI',$stoki);
 define('PODOGREV',$podogrev);
 define('PTN',$ptn);

 define('OTOPLENIE',$otoplenie);
 define('KVARTPLATA',$kvartplata);
 define('TBO',$tbo);
 define('ENERGY',$energy);
 define('GAS',$gas);
 define('VAXTA',$vaxta);

?>