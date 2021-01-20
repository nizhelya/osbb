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
case "127.0.0.1":
case "10.1.0.104":
#Artushkina
case "195.138.90.24":
#УТиСЗН
case "178.93.2.148":
#Львова
case "10.3.1.70":
case "85.238.106.26";
$house_id="2,87,178";
$osmd_id = "1,33,34";
$voda = 1;
$stoki = 1;
$podogrev = 1;
$otoplenie = 1;
$kvartplata = 1;
$tbo = 1;
$energy = 1;
$gas = 1;
$vaxta = 1;
$base = "OSBB";
break;

}
 
 define('LOGIN',	'cthubq');
 define('PASSWORD',	'hfljyt;crbq');
 define('BASE',$base);
 define('OSMD',$osmd_id);
 define('HOUSE',$house_id); 
 define('VODA',	$voda);
 define('STOKI',$stoki);
 define('PODOGREV',$podogrev);
 define('OTOPLENIE',$otoplenie);
 define('KVARTPLATA',$kvartplata);
 define('TBO',$tbo);
 define('ENERGY',$energy);
 define('GAS',$gas);
 define('VAXTA',$vaxta);

?>