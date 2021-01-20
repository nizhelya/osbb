<?php
include_once './yis_config.php';

class QueryKassa
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $id;
	protected $what;
	protected $nomer;
	protected $type;
	protected $base = BASE;
	protected $raion_id = RAION;
	protected $street_id = STREET;
	protected $house_id = HOUSE;
	protected $voda = VODA;
	protected $stoki = STOKI;
	protected $podogrev = PODOGREV;
	protected $otoplenie = OTOPLENIE;
	protected $kvartplata = KVARTPLATA;
	protected $tbo = TBO;
	protected $energy = ENERGY;
	protected $gas = GAS;
	protected $vaxta = VAXTA;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $kub;
	protected $t; 
	protected $data=NULL;
	protected $res=array();	
	public	  $results=array();
	
	/*public function connect($this->login,$this->password)
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
		
		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}
		$_db->set_charset("utf8");
    
		return $_db;
	}*/
	
	public function connect($login,$password)
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', $login ,$password, 'YISGRAND');
		if ($_db->connect_error) {
			return false;
		} else {		
		$_db->set_charset("utf8");    
		return $_db;
		}
	}



	public function getResults(stdClass $params)
	{


		if(isset($params->login) && ($params->login)) {
		  $this->login= addslashes($params->login);
		} else {
		   $this->login= null;
		}
		
		if(isset($params->password) && ($params->password)) {
		  $this->password= $params->password;
		} else {
		   $this->password= null;
		}


		$_db = $this->connect($this->login,$this->password);

		
		if(isset($params->what) && ($params->what)) {
		 $this->what = $_db->real_escape_string($params->what);
		} else {
		  $this->what = null;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->org_id) && ($params->org_id)) {
		  $this->org_id = (int) $params->org_id;
		} else {
		  $this->org_id = 0;
		}
		if(isset($params->raion_id) && ($params->raion_id)) {
		  $this->raion_id = (int) $params->raion_id;
		} else {
		  $this->raion_id = 0;
		}
		if(isset($params->data) && ($params->data)) {
		  $this->data =$params->data;
		 // $this->data =preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params->data);
		} else {
		  $this->data= date("Ymd");
		}
		if(isset($params->what_id) && ($params->what_id)) {
		  $this->id = (int) $params->what_id;
		} else {
		  $this->id = 0;
		}
		$this->t= date('Ymd');
		
		switch ($this->what) {

			case "OplataApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.OPLATA WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.OPLATA.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "OtoplenieApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.OTOPLENIE WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.OTOPLENIE.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "OtoplenieAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.OTOPLENIE WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.OTOPLENIE.`data` DESC' ;
			     // print_r($this->sql); 
			break;
			case "PodogrevApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.PODOGREV WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.PODOGREV.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "PodogrevAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.PODOGREV WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.PODOGREV.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "VodaApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.VODA WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.VODA.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "VodaAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.VODA WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.VODA.`data` DESC' ;
			     // print_r($this->sql); 
			break;
			case "StokiApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.STOKI WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.STOKI.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "StokiAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.STOKI WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.STOKI.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "KvartplataApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.KVARTPLATA WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.KVARTPLATA.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "KvartplataAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.KVARTPLATA WHERE `address_id` = '.$this->address_id.' ORDER BY '.$this->base.'.KVARTPLATA.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "TboApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.TBO WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.TBO.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "TboAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.TBO WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.TBO.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "EnergyApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.ENERGY WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.ENERGY.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "EnergyAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.ENERGY WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.ENERGY.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "GasApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.GAS WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.GAS.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "GasAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.GAS WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.GAS.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "VaxtaApp":			
			      $this->sql='SELECT * FROM '.$this->base.'.VAXTA WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.VAXTA.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "VaxtaAppAll":			
			      $this->sql='SELECT * FROM '.$this->base.'.VAXTA WHERE `address_id` = '.$this->address_id.'  ORDER BY '.$this->base.'.VAXTA.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			
			case "LgotaNachVoda":			
			      $this->sql='SELECT * FROM '.$this->base.'.BVODA WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BVODA.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachVodaData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BVODA WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BVODA.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachStoki":			
			      $this->sql='SELECT * FROM '.$this->base.'.BSTOKI WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BSTOKI.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachStokiData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BSTOKI WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BSTOKI.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachPodogrev":			
			      $this->sql='SELECT * FROM '.$this->base.'.BPODOGREV WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BPODOGREV.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachPodogrevData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BPODOGREV WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BPODOGREV.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachOtoplenie":			
			      $this->sql='SELECT * FROM '.$this->base.'.BOTOPLENIE WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BOTOPLENIE.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachOtoplenieData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BOTOPLENIE WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BOTOPLENIE.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachKvartplata":			
			      $this->sql='SELECT * FROM '.$this->base.'.BKVARTPLATA WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BKVARTPLATA.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachKvartplataData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BKVARTPLATA WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BKVARTPLATA.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachTbo":			
			      $this->sql='SELECT * FROM '.$this->base.'.BTBO WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BTBO.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachTboData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BTBO WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BTBO.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachEnergy":			
			      $this->sql='SELECT * FROM '.$this->base.'.BENERGY WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BENERGY.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachEnergyData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BENERGY WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BENERGY.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachGas":			
			      $this->sql='SELECT * FROM '.$this->base.'.BGAS WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BGAS.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachGasData":			
			      $this->sql='SELECT * FROM '.$this->base.'.BGAS WHERE `address_id` = '.$this->address_id.'  AND '.$this->base.'.BGAS.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			
			case "TekNachAllApp":	
			$where= " WHERE ";
			$period= "";
			$zadol= "";
			$sum_zadol= "";
			$oplacheno= "";
			$sum_oplacheno= "";
			$nachisleno= "";
			$sum_nachisleno= "";
			$subs= "";
			$sum_subs= "";
			$subsidia= "";
			$sum_subsidia= "";
			$budjet= "";
			$sum_budjet= "";
			$dolg= "";
			$sum_dolg= "";
			$from= " FROM ";
			IF ($this->voda){ 
			$where =$where.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t1.mec,t1.god) as period1 ,';
			$zadol = $zadol.'IFNULL(t1.zadol,0) as zadol1 ,';
			$nachisleno = $nachisleno.'IFNULL(t1.nachisleno,0) as nachisleno1,';
			$oplacheno = $oplacheno.'IFNULL(t1.oplacheno,0) as oplacheno1 ,';
			$subsidia = $subsidia.'IFNULL(t1.subsidia,0) as subsidia1 ,';
			$subs = $subs.'IFNULL(t1.subs,0) as subs1 ,';
			$budjet = $budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0) as budjet1 ,';
			$dolg = $dolg.'IFNULL(t1.dolg,0) as dolg1 ,';
			$sum_zadol = $sum_zadol.'IFNULL(t1.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'IFNULL(t1.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'IFNULL(t1.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'IFNULL(t1.subsidia,0)';
			$sum_subs = $sum_subs.'IFNULL(t1.subs,0)';
			$sum_budjet = $sum_budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)';
			$sum_dolg = $sum_dolg.'IFNULL(t1.dolg,0)';
			$from= $from.$this->base.'.VODA as t1'; 
			}
			IF ($this->stoki){ 
			$where =$where.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t2.mec,t2.god) as period2 ,';
			$zadol = $zadol.'IFNULL(t2.zadol,0) as zadol2 ,';
			$nachisleno = $nachisleno.'IFNULL(t2.nachisleno,0) as nachisleno2,';
			$oplacheno = $oplacheno.'IFNULL(t2.oplacheno,0) as oplacheno2 ,';
			$subsidia = $subsidia.'IFNULL(t2.subsidia,0) as subsidia2 ,';
			$subs = $subs.'IFNULL(t2.subs,0) as subs2 ,';
			$budjet = $budjet.'IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0) as budjet2 ,';
			$dolg = $dolg.'IFNULL(t2.dolg,0) as dolg2 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t2.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t2.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t2.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t2.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t2.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t2.dolg,0)';
			$from= $from.','.$this->base.'.STOKI as t2'; 

			}
			IF ($this->podogrev){ 
			$where =$where.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t3.mec,t3.god) as period3 ,';
			$zadol = $zadol.'IFNULL(t3.zadol,0) as zadol3 ,';
			$nachisleno = $nachisleno.'IFNULL(t3.nachisleno,0) as nachisleno3,';
			$oplacheno = $oplacheno.'IFNULL(t3.oplacheno,0) as oplacheno3 ,';
			$subsidia = $subsidia.'IFNULL(t3.subsidia,0) as subsidia3 ,';
			$subs = $subs.'IFNULL(t3.subs,0) as subs3 ,';
			$budjet = $budjet.'IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0) as budjet3 ,';
			$dolg = $dolg.'IFNULL(t3.dolg,0) as dolg3 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t3.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t3.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t3.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t3.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t3.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t3.dolg,0)';
			$from= $from.','.$this->base.'.PODOGREV as t3'; 

			}
			IF ($this->otoplenie){ 
			$where =$where.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t4.mec,t4.god) as period4 ,';
			$zadol = $zadol.'IFNULL(t4.zadol,0) as zadol4 ,';
			$nachisleno = $nachisleno.'IFNULL(t4.nachisleno,0) as nachisleno4,';
			$oplacheno = $oplacheno.'IFNULL(t4.oplacheno,0) as oplacheno4 ,';
			$subsidia = $subsidia.'IFNULL(t4.subsidia,0) as subsidia4 ,';
			$subs = $subs.'IFNULL(t4.subs,0) as subs4 ,';
			$budjet = $budjet.'IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0) as budjet4 ,';
			$dolg = $dolg.'IFNULL(t4.dolg,0) as dolg4 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t4.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t4.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t4.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t4.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t4.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t4.dolg,0)';
			$from= $from.','.$this->base.'.OTOPLENIE as t4'; 

			}
			IF ($this->kvartplata){ 
			$where =$where.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t5.mec,t5.god) as period5 ,';
			$zadol = $zadol.'IFNULL(t5.zadol,0) as zadol5 ,';
			$nachisleno = $nachisleno.'IFNULL(t5.nachisleno,0) as nachisleno5,';
			$oplacheno = $oplacheno.'IFNULL(t5.oplacheno,0) as oplacheno5 ,';
			$subsidia = $subsidia.'IFNULL(t5.subsidia,0) as subsidia5 ,';
			$subs = $subs.'IFNULL(t5.subs,0) as subs5 ,';
			$budjet = $budjet.'IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0) as budjet5 ,';
			$dolg = $dolg.'IFNULL(t5.dolg,0) as dolg5 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t5.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t5.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t5.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t5.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t5.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t5.dolg,0)';
			$from= $from.','.$this->base.'.KVARTPLATA as t5'; 

			}
			IF ($this->tbo){ 
			$where =$where.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t6.mec,t6.god) as period6 ,';
			$zadol = $zadol.'IFNULL(t6.zadol,0) as zadol6 ,';
			$nachisleno = $nachisleno.'IFNULL(t6.nachisleno,0) as nachisleno6,';
			$oplacheno = $oplacheno.'IFNULL(t6.oplacheno,0) as oplacheno6 ,';
			$subsidia = $subsidia.'IFNULL(t6.subsidia,0) as subsidia6 ,';
			$subs = $subs.'IFNULL(t6.subs,0) as subs6 ,';
			$budjet = $budjet.'IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0) as budjet6 ,';
			$dolg = $dolg.'IFNULL(t6.dolg,0) as dolg6 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t6.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t6.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t6.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t6.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t6.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t6.dolg,0)';
			$from= $from.','.$this->base.'.TBO as t6'; 
			}
			IF ($this->energy){ 
			$where =$where.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t7.mec,t7.god) as period7,';
			$zadol = $zadol.'IFNULL(t7.zadol,0) as zadol7 ,';
			$nachisleno = $nachisleno.'IFNULL(t7.nachisleno,0) as nachisleno7,';
			$oplacheno = $oplacheno.'IFNULL(t7.oplacheno,0) as oplacheno7 ,';
			$subsidia = $subsidia.'IFNULL(t7.subsidia,0) as subsidia7 ,';
			$subs = $subs.'IFNULL(t7.subs,0) as subs7 ,';
			$budjet = $budjet.'IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0) as budjet7 ,';
			$dolg = $dolg.'IFNULL(t7.dolg,0) as dolg7 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t7.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t7.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t7.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t7.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t7.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t7.dolg,0)';
			$from= $from.','.$this->base.'.ENERGY as t7'; 

			}
			IF ($this->gas){ 
			$where =$where.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t8.mec,t8.god) as period8 ,';
			$zadol = $zadol.'IFNULL(t8.zadol,0) as zadol8 ,';
			$nachisleno = $nachisleno.'IFNULL(t8.nachisleno,0) as nachisleno8,';
			$oplacheno = $oplacheno.'IFNULL(t8.oplacheno,0) as oplacheno8 ,';
			$subsidia = $subsidia.'IFNULL(t8.subsidia,0) as subsidia8 ,';
			$subs = $subs.'IFNULL(t8.subs,0) as subs8 ,';
			$budjet = $budjet.'IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0) as budjet8 ,';
			$dolg = $dolg.'IFNULL(t8.dolg,0) as dolg8 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t8.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t8.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t8.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t8.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t8.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t8.dolg,0)';
			$from= $from.','.$this->base.'.GAS as t8'; 

			}
			IF ($this->vaxta){ 
			$where =$where.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			$period = $period.'CONCAT_WS(" ",t9.mec,t9.god) as period9 ,';
			$zadol = $zadol.'IFNULL(t9.zadol,0) as zadol9 ,';
			$nachisleno = $nachisleno.'IFNULL(t9.nachisleno,0) as nachisleno9,';
			$oplacheno = $oplacheno.'IFNULL(t9.oplacheno,0) as oplacheno9 ,';
			$subsidia = $subsidia.'IFNULL(t9.subsidia,0) as subsidia9 ,';
			$subs = $subs.'IFNULL(t9.subs,0) as subs9 ,';
			$budjet = $budjet.'IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0) as budjet9 ,';
			$dolg = $dolg.'IFNULL(t9.dolg,0) as dolg9 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t9.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t9.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t9.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t9.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t9.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t9.dolg,0)';
			$from= $from.','.$this->base.'.VAXTA as t9'; 

			}
			 $this->sql='SELECT '.$period.$zadol.$oplacheno.$nachisleno.$subs.$subsidia.$budjet.$dolg				  
					      .$sum_zadol.' as zadol,'.$sum_nachisleno.' as nachisleno,'.$sum_budjet.' as budjet,'.$sum_oplacheno.' as oplacheno,'
					      .$sum_subsidia.' as subsidia,'.$sum_subs.' as subs,'.$sum_dolg.' as dolg '.$from.$where.'';
					// print($this->sql);   

		    break;
		    case "TekNachAllApp1":	
		    $where= " WHERE ";
			$period= "";
			$zadol= "";
			$sum_zadol= "";
			$oplacheno= "";
			$sum_oplacheno= "";
			$nachisleno= "";
			$sum_nachisleno= "";
			$subs= "";
			$sum_subs= "";
			$subsidia= "";
			$sum_subsidia= "";
			$budjet= "";
			$sum_budjet= "";
			$dolg= "";
			$sum_dolg= "";
			$from= " FROM ";
			IF ($this->voda){ 
			$where =$where.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t1.mec,t1.god) as period1 ,';
			$zadol = $zadol.'IFNULL(t1.zadol,0) as zadol1 ,';
			$nachisleno = $nachisleno.'IFNULL(t1.nachisleno,0) as nachisleno1,';
			$oplacheno = $oplacheno.'IFNULL(t1.oplacheno,0) as oplacheno1 ,';
			$subsidia = $subsidia.'IFNULL(t1.subsidia,0) as subsidia1 ,';
			$subs = $subs.'IFNULL(t1.subs,0) as subs1 ,';
			$budjet = $budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0) as budjet1 ,';
			$dolg = $dolg.'IFNULL(t1.dolg,0) as dolg1 ,';
			$sum_zadol = $sum_zadol.'IFNULL(t1.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'IFNULL(t1.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'IFNULL(t1.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'IFNULL(t1.subsidia,0)';
			$sum_subs = $sum_subs.'IFNULL(t1.subs,0)';
			$sum_budjet = $sum_budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)';
			$sum_dolg = $sum_dolg.'IFNULL(t1.dolg,0)';
			$from= $from.$this->base.'.VODA as t1'; 
			}
			IF ($this->stoki){ 
			$where =$where.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t2.mec,t2.god) as period2 ,';
			$zadol = $zadol.'IFNULL(t2.zadol,0) as zadol2 ,';
			$nachisleno = $nachisleno.'IFNULL(t2.nachisleno,0) as nachisleno2,';
			$oplacheno = $oplacheno.'IFNULL(t2.oplacheno,0) as oplacheno2 ,';
			$subsidia = $subsidia.'IFNULL(t2.subsidia,0) as subsidia2 ,';
			$subs = $subs.'IFNULL(t2.subs,0) as subs2 ,';
			$budjet = $budjet.'IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0) as budjet2 ,';
			$dolg = $dolg.'IFNULL(t2.dolg,0) as dolg2 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t2.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t2.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t2.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t2.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t2.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t2.dolg,0)';
			$from= $from.','.$this->base.'.STOKI as t2'; 

			}
			IF ($this->podogrev){ 
			$where =$where.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t3.mec,t3.god) as period3 ,';
			$zadol = $zadol.'IFNULL(t3.zadol,0) as zadol3 ,';
			$nachisleno = $nachisleno.'IFNULL(t3.nachisleno,0) as nachisleno3,';
			$oplacheno = $oplacheno.'IFNULL(t3.oplacheno,0) as oplacheno3 ,';
			$subsidia = $subsidia.'IFNULL(t3.subsidia,0) as subsidia3 ,';
			$subs = $subs.'IFNULL(t3.subs,0) as subs3 ,';
			$budjet = $budjet.'IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0) as budjet3 ,';
			$dolg = $dolg.'IFNULL(t3.dolg,0) as dolg3 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t3.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t3.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t3.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t3.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t3.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t3.dolg,0)';
			$from= $from.','.$this->base.'.PODOGREV as t3'; 

			}
			IF ($this->otoplenie){ 
			$where =$where.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t4.mec,t4.god) as period4 ,';
			$zadol = $zadol.'IFNULL(t4.zadol,0) as zadol4 ,';
			$nachisleno = $nachisleno.'IFNULL(t4.nachisleno,0) as nachisleno4,';
			$oplacheno = $oplacheno.'IFNULL(t4.oplacheno,0) as oplacheno4 ,';
			$subsidia = $subsidia.'IFNULL(t4.subsidia,0) as subsidia4 ,';
			$subs = $subs.'IFNULL(t4.subs,0) as subs4 ,';
			$budjet = $budjet.'IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0) as budjet4 ,';
			$dolg = $dolg.'IFNULL(t4.dolg,0) as dolg4 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t4.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t4.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t4.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t4.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t4.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t4.dolg,0)';
			$from= $from.','.$this->base.'.OTOPLENIE as t4'; 

			}
			IF ($this->kvartplata){ 
			$where =$where.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t5.mec,t5.god) as period5 ,';
			$zadol = $zadol.'IFNULL(t5.zadol,0) as zadol5 ,';
			$nachisleno = $nachisleno.'IFNULL(t5.nachisleno,0) as nachisleno5,';
			$oplacheno = $oplacheno.'IFNULL(t5.oplacheno,0) as oplacheno5 ,';
			$subsidia = $subsidia.'IFNULL(t5.subsidia,0) as subsidia5 ,';
			$subs = $subs.'IFNULL(t5.subs,0) as subs5 ,';
			$budjet = $budjet.'IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0) as budjet5 ,';
			$dolg = $dolg.'IFNULL(t5.dolg,0) as dolg5 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t5.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t5.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t5.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t5.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t5.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t5.dolg,0)';
			$from= $from.','.$this->base.'.KVARTPLATA as t5'; 

			}
			IF ($this->tbo){ 
			$where =$where.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t6.mec,t6.god) as period6 ,';
			$zadol = $zadol.'IFNULL(t6.zadol,0) as zadol6 ,';
			$nachisleno = $nachisleno.'IFNULL(t6.nachisleno,0) as nachisleno6,';
			$oplacheno = $oplacheno.'IFNULL(t6.oplacheno,0) as oplacheno6 ,';
			$subsidia = $subsidia.'IFNULL(t6.subsidia,0) as subsidia6 ,';
			$subs = $subs.'IFNULL(t6.subs,0) as subs6 ,';
			$budjet = $budjet.'IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0) as budjet6 ,';
			$dolg = $dolg.'IFNULL(t6.dolg,0) as dolg6 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t6.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t6.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t6.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t6.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t6.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t6.dolg,0)';
			$from= $from.','.$this->base.'.TBO as t6'; 
			}
			IF ($this->energy){ 
			$where =$where.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t7.mec,t7.god) as period7,';
			$zadol = $zadol.'IFNULL(t7.zadol,0) as zadol7 ,';
			$nachisleno = $nachisleno.'IFNULL(t7.nachisleno,0) as nachisleno7,';
			$oplacheno = $oplacheno.'IFNULL(t7.oplacheno,0) as oplacheno7 ,';
			$subsidia = $subsidia.'IFNULL(t7.subsidia,0) as subsidia7 ,';
			$subs = $subs.'IFNULL(t7.subs,0) as subs7 ,';
			$budjet = $budjet.'IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0) as budjet7 ,';
			$dolg = $dolg.'IFNULL(t7.dolg,0) as dolg7 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t7.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t7.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t7.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t7.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t7.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t7.dolg,0)';
			$from= $from.','.$this->base.'.ENERGY as t7'; 

			}
			IF ($this->gas){ 
			$where =$where.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t8.mec,t8.god) as period8 ,';
			$zadol = $zadol.'IFNULL(t8.zadol,0) as zadol8 ,';
			$nachisleno = $nachisleno.'IFNULL(t8.nachisleno,0) as nachisleno8,';
			$oplacheno = $oplacheno.'IFNULL(t8.oplacheno,0) as oplacheno8 ,';
			$subsidia = $subsidia.'IFNULL(t8.subsidia,0) as subsidia8 ,';
			$subs = $subs.'IFNULL(t8.subs,0) as subs8 ,';
			$budjet = $budjet.'IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0) as budjet8 ,';
			$dolg = $dolg.'IFNULL(t8.dolg,0) as dolg8 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t8.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t8.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t8.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t8.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t8.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t8.dolg,0)';
			$from= $from.','.$this->base.'.GAS as t8'; 

			}
			IF ($this->vaxta){ 
			$where =$where.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t9.mec,t9.god) as period9 ,';
			$zadol = $zadol.'IFNULL(t9.zadol,0) as zadol9 ,';
			$nachisleno = $nachisleno.'IFNULL(t9.nachisleno,0) as nachisleno9,';
			$oplacheno = $oplacheno.'IFNULL(t9.oplacheno,0) as oplacheno9 ,';
			$subsidia = $subsidia.'IFNULL(t9.subsidia,0) as subsidia9 ,';
			$subs = $subs.'IFNULL(t9.subs,0) as subs9 ,';
			$budjet = $budjet.'IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0) as budjet9 ,';
			$dolg = $dolg.'IFNULL(t9.dolg,0) as dolg9 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t9.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t9.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t9.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t9.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t9.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t9.dolg,0)';
			$from= $from.','.$this->base.'.VAXTA as t9'; 

			}
			 $this->sql='SELECT '.$period.$zadol.$oplacheno.$nachisleno.$subs.$subsidia.$budjet.$dolg				  
					      .$sum_zadol.' as zadol,'.$sum_nachisleno.' as nachisleno,'.$sum_budjet.' as budjet,'.$sum_oplacheno.' as oplacheno,'
					      .$sum_subsidia.' as subsidia,'.$sum_subs.' as subs,'.$sum_dolg.' as dolg '.$from.$where.'';
					// print($this->sql);   

		    break;
			
case "TekNachAllApp2":	
 $where= " WHERE ";
			$period= "";
			$zadol= "";
			$sum_zadol= "";
			$oplacheno= "";
			$sum_oplacheno= "";
			$nachisleno= "";
			$sum_nachisleno= "";
			$subs= "";
			$sum_subs= "";
			$subsidia= "";
			$sum_subsidia= "";
			$budjet= "";
			$sum_budjet= "";
			$dolg= "";
			$sum_dolg= "";
			$from= " FROM ";
			IF ($this->voda){ 
			$where =$where.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t1.mec,t1.god) as period1 ,';
			$zadol = $zadol.'IFNULL(t1.zadol,0) as zadol1 ,';
			$nachisleno = $nachisleno.'IFNULL(t1.nachisleno,0) as nachisleno1,';
			$oplacheno = $oplacheno.'IFNULL(t1.oplacheno,0) as oplacheno1 ,';
			$subsidia = $subsidia.'IFNULL(t1.subsidia,0) as subsidia1 ,';
			$subs = $subs.'IFNULL(t1.subs,0) as subs1 ,';
			$budjet = $budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0) as budjet1 ,';
			$dolg = $dolg.'IFNULL(t1.dolg,0) as dolg1 ,';
			$sum_zadol = $sum_zadol.'IFNULL(t1.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'IFNULL(t1.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'IFNULL(t1.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'IFNULL(t1.subsidia,0)';
			$sum_subs = $sum_subs.'IFNULL(t1.subs,0)';
			$sum_budjet = $sum_budjet.'IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)';
			$sum_dolg = $sum_dolg.'IFNULL(t1.dolg,0)';
			$from= $from.$this->base.'.VODA as t1'; 
			}
			IF ($this->stoki){ 
			$where =$where.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t2.mec,t2.god) as period2 ,';
			$zadol = $zadol.'IFNULL(t2.zadol,0) as zadol2 ,';
			$nachisleno = $nachisleno.'IFNULL(t2.nachisleno,0) as nachisleno2,';
			$oplacheno = $oplacheno.'IFNULL(t2.oplacheno,0) as oplacheno2 ,';
			$subsidia = $subsidia.'IFNULL(t2.subsidia,0) as subsidia2 ,';
			$subs = $subs.'IFNULL(t2.subs,0) as subs2 ,';
			$budjet = $budjet.'IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0) as budjet2 ,';
			$dolg = $dolg.'IFNULL(t2.dolg,0) as dolg2 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t2.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t2.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t2.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t2.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t2.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t2.dolg,0)';
			$from= $from.','.$this->base.'.STOKI as t2'; 

			}
			IF ($this->podogrev){ 
			$where =$where.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t3.mec,t3.god) as period3 ,';
			$zadol = $zadol.'IFNULL(t3.zadol,0) as zadol3 ,';
			$nachisleno = $nachisleno.'IFNULL(t3.nachisleno,0) as nachisleno3,';
			$oplacheno = $oplacheno.'IFNULL(t3.oplacheno,0) as oplacheno3 ,';
			$subsidia = $subsidia.'IFNULL(t3.subsidia,0) as subsidia3 ,';
			$subs = $subs.'IFNULL(t3.subs,0) as subs3 ,';
			$budjet = $budjet.'IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0) as budjet3 ,';
			$dolg = $dolg.'IFNULL(t3.dolg,0) as dolg3 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t3.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t3.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t3.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t3.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t3.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t3.dolg,0)';
			$from= $from.','.$this->base.'.PODOGREV as t3'; 

			}
			IF ($this->otoplenie){ 
			$where =$where.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t4.mec,t4.god) as period4 ,';
			$zadol = $zadol.'IFNULL(t4.zadol,0) as zadol4 ,';
			$nachisleno = $nachisleno.'IFNULL(t4.nachisleno,0) as nachisleno4,';
			$oplacheno = $oplacheno.'IFNULL(t4.oplacheno,0) as oplacheno4 ,';
			$subsidia = $subsidia.'IFNULL(t4.subsidia,0) as subsidia4 ,';
			$subs = $subs.'IFNULL(t4.subs,0) as subs4 ,';
			$budjet = $budjet.'IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0) as budjet4 ,';
			$dolg = $dolg.'IFNULL(t4.dolg,0) as dolg4 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t4.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t4.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t4.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t4.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t4.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t4.dolg,0)';
			$from= $from.','.$this->base.'.OTOPLENIE as t4'; 

			}
			IF ($this->kvartplata){ 
			$where =$where.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t5.mec,t5.god) as period5 ,';
			$zadol = $zadol.'IFNULL(t5.zadol,0) as zadol5 ,';
			$nachisleno = $nachisleno.'IFNULL(t5.nachisleno,0) as nachisleno5,';
			$oplacheno = $oplacheno.'IFNULL(t5.oplacheno,0) as oplacheno5 ,';
			$subsidia = $subsidia.'IFNULL(t5.subsidia,0) as subsidia5 ,';
			$subs = $subs.'IFNULL(t5.subs,0) as subs5 ,';
			$budjet = $budjet.'IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0) as budjet5 ,';
			$dolg = $dolg.'IFNULL(t5.dolg,0) as dolg5 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t5.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t5.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t5.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t5.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t5.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t5.dolg,0)';
			$from= $from.','.$this->base.'.KVARTPLATA as t5'; 

			}
			IF ($this->tbo){ 
			$where =$where.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t6.mec,t6.god) as period6 ,';
			$zadol = $zadol.'IFNULL(t6.zadol,0) as zadol6 ,';
			$nachisleno = $nachisleno.'IFNULL(t6.nachisleno,0) as nachisleno6,';
			$oplacheno = $oplacheno.'IFNULL(t6.oplacheno,0) as oplacheno6 ,';
			$subsidia = $subsidia.'IFNULL(t6.subsidia,0) as subsidia6 ,';
			$subs = $subs.'IFNULL(t6.subs,0) as subs6 ,';
			$budjet = $budjet.'IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0) as budjet6 ,';
			$dolg = $dolg.'IFNULL(t6.dolg,0) as dolg6 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t6.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t6.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t6.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t6.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t6.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t6.dolg,0)';
			$from= $from.','.$this->base.'.TBO as t6'; 
			}
			IF ($this->energy){ 
			$where =$where.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t7.mec,t7.god) as period7,';
			$zadol = $zadol.'IFNULL(t7.zadol,0) as zadol7 ,';
			$nachisleno = $nachisleno.'IFNULL(t7.nachisleno,0) as nachisleno7,';
			$oplacheno = $oplacheno.'IFNULL(t7.oplacheno,0) as oplacheno7 ,';
			$subsidia = $subsidia.'IFNULL(t7.subsidia,0) as subsidia7 ,';
			$subs = $subs.'IFNULL(t7.subs,0) as subs7 ,';
			$budjet = $budjet.'IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0) as budjet7 ,';
			$dolg = $dolg.'IFNULL(t7.dolg,0) as dolg7 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t7.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t7.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t7.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t7.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t7.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t7.dolg,0)';
			$from= $from.','.$this->base.'.ENERGY as t7'; 

			}
			IF ($this->gas){ 
			$where =$where.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t8.mec,t8.god) as period8 ,';
			$zadol = $zadol.'IFNULL(t8.zadol,0) as zadol8 ,';
			$nachisleno = $nachisleno.'IFNULL(t8.nachisleno,0) as nachisleno8,';
			$oplacheno = $oplacheno.'IFNULL(t8.oplacheno,0) as oplacheno8 ,';
			$subsidia = $subsidia.'IFNULL(t8.subsidia,0) as subsidia8 ,';
			$subs = $subs.'IFNULL(t8.subs,0) as subs8 ,';
			$budjet = $budjet.'IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0) as budjet8 ,';
			$dolg = $dolg.'IFNULL(t8.dolg,0) as dolg8 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t8.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t8.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t8.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t8.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t8.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t8.dolg,0)';
			$from= $from.','.$this->base.'.GAS as t8'; 

			}
			IF ($this->vaxta){ 
			$where =$where.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			$period = $period.'CONCAT_WS(" ",t9.mec,t9.god) as period9 ,';
			$zadol = $zadol.'IFNULL(t9.zadol,0) as zadol9 ,';
			$nachisleno = $nachisleno.'IFNULL(t9.nachisleno,0) as nachisleno9,';
			$oplacheno = $oplacheno.'IFNULL(t9.oplacheno,0) as oplacheno9 ,';
			$subsidia = $subsidia.'IFNULL(t9.subsidia,0) as subsidia9 ,';
			$subs = $subs.'IFNULL(t9.subs,0) as subs9 ,';
			$budjet = $budjet.'IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0) as budjet9 ,';
			$dolg = $dolg.'IFNULL(t9.dolg,0) as dolg9 ,';
			$sum_zadol = $sum_zadol.'+IFNULL(t9.zadol,0) ';
			$sum_nachisleno = $sum_nachisleno.'+IFNULL(t9.nachisleno,0)';
			$sum_oplacheno = $sum_oplacheno.'+IFNULL(t9.oplacheno,0)';
			$sum_subsidia = $sum_subsidia.'+IFNULL(t9.subsidia,0)';
			$sum_subs = $sum_subs.'+IFNULL(t9.subs,0)';
			$sum_budjet = $sum_budjet.'+IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)';
			$sum_dolg = $sum_dolg.'+IFNULL(t9.dolg,0)';
			$from= $from.','.$this->base.'.VAXTA as t9'; 

			}
			 $this->sql='SELECT '.$period.$zadol.$oplacheno.$nachisleno.$subs.$subsidia.$budjet.$dolg				  
					      .$sum_zadol.' as zadol,'.$sum_nachisleno.' as nachisleno,'.$sum_budjet.' as budjet,'.$sum_oplacheno.' as oplacheno,'
					      .$sum_subsidia.' as subsidia,'.$sum_subs.' as subs,'.$sum_dolg.' as dolg '.$from.$where.'';
					// print($this->sql);   

		    break;
			
			
		
			case "AppTekOplata":
			 $this->sql='SELECT t1.*,CASE WHEN t1.data = "'.$this->t.'" AND t1.operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM '.$this->base.'.OPLATA as t1 WHERE t1.address_id='.$this->id.' ORDER BY t1.data DESC LIMIT 1';
			// print($this->sql);   
		    break;
	    case "AppTekOplataFive":
			 $this->sql='SELECT t1.*,CASE WHEN t1.data = "'.$this->t.'" AND t1.operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM '.$this->base.'.OPLATA as t1 WHERE t1.address_id='.$this->id.' ORDER BY t1.data DESC LIMIT 5';
			// print($this->sql);   
		    break;
			case "AppVodomerKassa"://применяется
				  $this->sql='SELECT t2.*,t1.vodomer_id FROM '.$this->base.'.AVODOMER as t1 LEFT JOIN '.$this->base.'.VODOMER  as t2 USING (vodomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=0  AND t2.out=0 ';
					// print($this->sql); 
			break;

			case "TekPokTeplomerov":			
			      $this->sql='SELECT '.$this->base.'.VODOMER.address_id,'.$this->base.'.VODOMER.type,UCASE('.$this->base.'.VODOMER.place) as place,'.$this->base.'.VODOMER.nomer,'.$this->base.'.VODOMER.model,DATE_FORMAT(max('.$this->base.'.WATER.data),"%d-%m-%Y") as fdate,'
				      .'max('.$this->base.'.WATER.pred) as pred,max('.$this->base.'.WATER.tek) as tek,'.$this->base.'.WATER.operator FROM '.$this->base.'.VODOMER,'.$this->base.'.WATER  WHERE '.$this->base.'.VODOMER.address_id='.$this->id.' AND '.$this->base.'.VODOMER.nomer= '.$this->base.'.WATER.nomer AND '
				      .''.$this->base.'.WATER.address_id='.$this->id.' GROUP BY '.$this->base.'.VODOMER.nomer,data ORDER BY '.$this->base.'.WATER.data DESC ';
			       //print_r($this->sql); 
			break;
		} // End of Switch ($what)
		
	
		

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}

public function newOplata(stdClass $params)
	{

		if(isset($params->login) && ($params->login)) {
		  $this->login= addslashes($params->login);
		} else {
		   $this->login= null;
		}		
		if(isset($params->password) && ($params->password)) {
		  $this->password= $params->password;
		} else {
		   $this->password= null;
		}

		$_db = $this->connect($this->login,$this->password);

		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		if(isset($params->cbDo1) && ($params->cbDo1)) {
		  $this->cbDo1 = (int) $params->cbDo1;
		} else {
		  $this->cbDo1 = 0;
		}
		if(isset($params->cbDo2) && ($params->cbDo2)) {
		  $this->cbDo2 = (int) $params->cbDo2;
		} else {
		  $this->cbDo2 = 0;
		}
		if(isset($params->cbDo3) && ($params->cbDo3)) {
		  $this->cbDo3 = (int) $params->cbDo3;
		} else {
		  $this->cbDo3 = 0;
		}
		if(isset($params->cbDo4) && ($params->cbDo4)) {
		  $this->cbDo4 = (int) $params->cbDo4;
		} else {
		  $this->cbDo4 = 0;
		}
		if(isset($params->cbDo5) && ($params->cbDo5)) {
		  $this->cbDo5 = (int) $params->cbDo5;
		} else {
		  $this->cbDo5 = 0;
		}
		if(isset($params->cbDo6) && ($params->cbDo6)) {
		  $this->cbDo6 = (int) $params->cbDo6;
		} else {
		  $this->cbDo6 = 0;
		}
		if(isset($params->cbDo7) && ($params->cbDo7)) {
		  $this->cbDo7 = (int) $params->cbDo7;
		} else {
		  $this->cbDo7 = 0;
		}
		if(isset($params->cbDo8) && ($params->cbDo8)) {
		  $this->cbDo8 = (int) $params->cbDo8;
		} else {
		  $this->cbDo8 = 0;
		}
		if(isset($params->cbDo9) && ($params->cbDo9)) {
		  $this->cbDo9 = (int) $params->cbDo9;
		} else {
		  $this->cbDo9 = 0;
		}
		if(isset($params->cbNext1) && ($params->cbNext1)) {
		  $this->cbNext1 = (int) $params->cbNext1;
		} else {
		  $this->cbNext1 = 0;
		}
		if(isset($params->cbNext2) && ($params->cbNext2)) {
		  $this->cbNext2 = (int) $params->cbNext2;
		} else {
		  $this->cbNext2 = 0;
		}
		if(isset($params->cbNext3) && ($params->cbNext3)) {
		  $this->cbNext3 = (int) $params->cbNext3;
		} else {
		  $this->cbNext3 = 0;
		}
		if(isset($params->cbNext4) && ($params->cbNext4)) {
		  $this->cbNext4 = (int) $params->cbNext4;
		} else {
		  $this->cbNext4 = 0;
		}
		if(isset($params->cbNext5) && ($params->cbNext5)) {
		  $this->cbNext5 = (int) $params->cbNext5;
		} else {
		  $this->cbNext5 = 0;
		}
		if(isset($params->cbNext6) && ($params->cbNext6)) {
		  $this->cbNext6 = (int) $params->cbNext6;
		} else {
		  $this->cbNext6 = 0;
		}
		if(isset($params->cbNext9) && ($params->cbNext9)) {
		  $this->cbNext9 = (int) $params->cbNext9;
		} else {
		  $this->cbNext9 = 0;
		}
		if(isset($params->cbNext8) && ($params->cbNext8)) {
		  $this->cbNext8 = (int) $params->cbNext8;
		} else {
		  $this->cbNext8 = 0;
		}
		if(isset($params->cbNext7) && ($params->cbNext7)) {
		  $this->cbNext7 = (int) $params->cbNext7;
		} else {
		  $this->cbNext7 = 0;
		}
		if(isset($params->zadol1) && ($params->zadol1)) {
		  $this->zadol1 =  $params->zadol1;
		} else {
		  $this->zadol1 = 0;
		}
		if(isset($params->zadol2) && ($params->zadol2)) {
		  $this->zadol2 =  $params->zadol2;
		} else {
		  $this->zadol2 = 0;
		}
		if(isset($params->zadol3) && ($params->zadol3)) {
		  $this->zadol3 =  $params->zadol3;
		} else {
		  $this->zadol3 = 0;
		}
		if(isset($params->zadol4) && ($params->zadol4)) {
		  $this->zadol4 =  $params->zadol4;
		} else {
		  $this->zadol4 = 0;
		}
		if(isset($params->zadol5) && ($params->zadol5)) {
		  $this->zadol5 =  $params->zadol5;
		} else {
		  $this->zadol5 = 0;
		}
		if(isset($params->zadol6) && ($params->zadol6)) {
		  $this->zadol6 =  $params->zadol6;
		} else {
		  $this->zadol6 = 0;
		}
		if(isset($params->zadol7) && ($params->zadol7)) {
		  $this->zadol7 =  $params->zadol7;
		} else {
		  $this->zadol7 = 0;
		}
		if(isset($params->zadol8) && ($params->zadol8)) {
		  $this->zadol8 =  $params->zadol8;
		} else {
		  $this->zadol8 = 0;
		}
		if(isset($params->zadol9) && ($params->zadol9)) {
		  $this->zadol9 =  $params->zadol9;
		} else {
		  $this->zadol9 = 0;
		}
		if(isset($params->dolg1) && ($params->dolg1)) {
		  $this->dolg1 =  $params->dolg1;
		} else {
		  $this->dolg1 = 0;
		}
		if(isset($params->dolg2) && ($params->dolg2)) {
		  $this->dolg2 =  $params->dolg2;
		} else {
		  $this->dolg2 = 0;
		}
		if(isset($params->dolg3) && ($params->dolg3)) {
		  $this->dolg3 =  $params->dolg3;
		} else {
		  $this->dolg3 = 0;
		}
		if(isset($params->dolg4) && ($params->dolg4)) {
		  $this->dolg4 =  $params->dolg4;
		} else {
		  $this->dolg4 = 0;
		}
		if(isset($params->dolg5) && ($params->dolg5)) {
		  $this->dolg5 =  $params->dolg5;
		} else {
		  $this->dolg5 = 0;
		}
		if(isset($params->dolg6) && ($params->dolg6)) {
		  $this->dolg6 =  $params->dolg6;
		} else {
		  $this->dolg6 = 0;
		}
		if(isset($params->dolg7) && ($params->dolg7)) {
		  $this->dolg7 =  $params->dolg7;
		} else {
		  $this->dolg7 = 0;
		}
		if(isset($params->dolg8) && ($params->dolg8)) {
		  $this->dolg8 =  $params->dolg8;
		} else {
		  $this->dolg8 = 0;
		}
		if(isset($params->dolg9) && ($params->dolg9)) {
		  $this->dolg9 =  $params->dolg9;
		} else {
		  $this->dolg9 = 0;
		}
		if(isset($params->newOplata) && ($params->newOplata)) {
		  $this->newOplata =  $params->newOplata;
		} else {
		  $this->newOplata = 0;
		}
		if(isset($params->newOplataOrg) && ($params->newOplataOrg)) {
		  $this->newOplataOrg =  $params->newOplataOrg;
		} else {
		  $this->newOplataOrg = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->prixod_id) && ($params->prixod_id)) {
		  $this->prixod_id = (int) $params->prixod_id;
		} else {
		  $this->prixod_id = 0;
		}
		if(isset($params->user_id) && ($params->user_id)) {
		  $this->user_id = (int) $params->user_id;
		} else {
		  $this->user_id = 0;
		}
		if(isset($params->date_oplata) && ($params->date_oplata)) {
		  $this->date_oplata= $params->date_oplata;
		} else {
		   $this->date_oplata='';
		}	
		
		switch ($this->what) {

			case "AppTekOplata":			
			      $this->sql='CALL '.$this->base.'.newOplataApp("'
					.$this->address_id.'","'					
					.$this->cbDo1.'","'
					.$this->cbDo2.'","'
					.$this->cbDo3.'","'
					.$this->cbDo4.'","'
					.$this->cbDo5.'","'
					.$this->cbDo6.'","'
					.$this->cbDo7.'","'
					.$this->cbDo8.'","'
					.$this->cbDo9.'","'
					.$this->cbNext1.'","'
					.$this->cbNext2.'","'
					.$this->cbNext3.'","'
					.$this->cbNext4.'","'
					.$this->cbNext5.'","'
					.$this->cbNext6.'","'
					.$this->cbNext7.'","'
					.$this->cbNext8.'","'
					.$this->cbNext9.'","'
					.$this->zadol1.'","'
					.$this->zadol2.'","'
					.$this->zadol3.'","'
					.$this->zadol4.'","'
					.$this->zadol5.'","'
					.$this->zadol6.'","'
					.$this->zadol7.'","'
					.$this->zadol8.'","'
					.$this->zadol9.'","'
					.$this->dolg1.'","'
					.$this->dolg2.'","'
					.$this->dolg3.'","'
					.$this->dolg4.'","'
					.$this->dolg5.'","'
					.$this->dolg6.'","'
					.$this->dolg7.'","'
					.$this->dolg8.'","'
					.$this->dolg9.'","'
					.$this->newOplata.'","'
					.$this->user_id.'","'
					.$this->prixod_id.'","'
					.$this->date_oplata.'",'
					.' @success, @msg)';
			break;
			
		}
//print( $this->sql);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;
	      }
public function delOplata(stdClass $params)
	{

		if(isset($params->login) && ($params->login)) {
		  $this->login= addslashes($params->login);
		} else {
		   $this->login= null;
		}		
		if(isset($params->password) && ($params->password)) {
		  $this->password= $params->password;
		} else {
		   $this->password= null;
		}

		$_db = $this->connect($this->login,$this->password);


		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$_db->real_escape_string($value);}
		  }
		}
		$this->sql='';
		switch ($this->what) {
			case "delOplataApp":
			      $this->sql='CALL '.$this->base.'.delOplataApp('.$this->rec_id.',@success, @msg)';

			break;
			
			}
	
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;
	      }
	    public function getRaspechatka(stdClass $params)
	{

		if(isset($params->login) && ($params->login)) {
		  $this->login= addslashes($params->login);
		} else {
		   $this->login= null;
		}		
		if(isset($params->password) && ($params->password)) {
		  $this->password= $params->password;
		} else {
		   $this->password= null;
		}

		$_db = $this->connect($this->login,$this->password);
		
		
		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$_db->real_escape_string($value);}
		  }
		}
		$this->sql='';
		
		switch ($this->what) {
			case "raspechatkaOplataApp":
			     
				      $this->sql='CALL '.$this->base.'.raspechatkaOplataApp("'.$this->address_id.'",@success,@content)';
			break;
			case "AktSubsUtszn":
				      $this->sql='CALL '.$this->base.'.AktSubsUtszn('.$this->rec_id.',@success,@content)';
			 //   print_r($this->sql); 
			break;
			case "AktLgotaUtszn":
				      $this->sql='CALL '.$this->base.'.AktLgotaUtszn('.$this->rec_id.',@success,@content)';
			 //   print_r($this->sql); 
			break;
			case "AktLgotaUtsznAll":
				      $this->sql='CALL '.$this->base.'.AktLgotaUtsznAll(@success,@content)';
			 //   print_r($this->sql); 
			break;
			case "AktSubsUtsznAll":
				      $this->sql='CALL '.$this->base.'.AktSubsUtsznAll(@success,@content)';
			 //   print_r($this->sql); 
			break;
			
			}
	
		

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @content,@success';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error >>>  ' . $_db->connect_errno . '  <<< ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['content'] = $this->row['@content'];
			$this->results['success'] = $this->row['@success'];
			$this->results['sql'] = $this->sql;
		}
		return $this->results;




}

}