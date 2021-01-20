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
			$t= "WHERE";
			IF ($this->voda){ 
			$t =$t.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->stoki){ 
			$t =$t.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->podogrev){ 
			$t =$t.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->otoplenie){ 
			$t =$t.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->kvartplata){ 
			$t =$t.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->tbo){ 
			$t =$t.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->energy){ 
			$t =$t.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->gas){ 
			$t =$t.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			IF ($this->vaxta){ 
			$t =$t.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			}
			 $this->sql='SELECT (CASE '.$this->voda.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t1.mec,t1.god),"")  ELSE "" END) as period1 ,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t2.mec,t2.god),"")  ELSE "" END) as period2 ,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t3.mec,t3.god),"")  ELSE "" END) as period3 ,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t4.mec,t4.god),"")  ELSE "" END) as period4 ,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t5.mec,t5.god),"")  ELSE "" END) as period5 ,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t6.mec,t6.god),"")  ELSE "" END) as period6 ,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t7.mec,t7.god),"")  ELSE "" END) as period7 ,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t8.mec,t8.god),"")  ELSE "" END) as period8 ,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t9.mec,t9.god),"")  ELSE "" END) as period9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.zadol,0)  ELSE "" END) as zadol1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.zadol,0)  ELSE "" END) as zadol2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.zadol,0)  ELSE "" END) as zadol3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.zadol,0)  ELSE "" END) as zadol4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.zadol,0)  ELSE "" END) as zadol5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.zadol,0)  ELSE "" END) as zadol6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.zadol,0)  ELSE "" END) as zadol7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.zadol,0)  ELSE "" END) as zadol8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.zadol,0)  ELSE "" END) as zadol9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.nachisleno,0)  ELSE "" END) as nachisleno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.nachisleno,0)  ELSE "" END) as nachisleno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.nachisleno,0)  ELSE "" END) as nachisleno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.nachisleno,0)  ELSE "" END) as nachisleno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.nachisleno,0)  ELSE "" END) as nachisleno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.nachisleno,0)  ELSE "" END) as nachisleno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.nachisleno,0)  ELSE "" END) as nachisleno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.nachisleno,0)  ELSE "" END) as nachisleno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.nachisleno,0)  ELSE "" END) as nachisleno9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.oplacheno,0)  ELSE "" END) as oplacheno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.oplacheno,0)  ELSE "" END) as oplacheno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.oplacheno,0)  ELSE "" END) as oplacheno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.oplacheno,0)  ELSE "" END) as oplacheno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.oplacheno,0)  ELSE "" END) as oplacheno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.oplacheno,0)  ELSE "" END) as oplacheno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.oplacheno,0)  ELSE "" END) as oplacheno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.oplacheno,0)  ELSE "" END) as oplacheno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.oplacheno,0)  ELSE "" END) as oplacheno9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subsidia,0)  ELSE "" END) as subsidia1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subsidia,0)  ELSE "" END) as subsidia2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subsidia,0)  ELSE "" END) as subsidia3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subsidia,0)  ELSE "" END) as subsidia4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subsidia,0)  ELSE "" END) as subsidia5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subsidia,0)  ELSE "" END) as subsidia6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subsidia,0)  ELSE "" END) as subsidia7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subsidia,0)  ELSE "" END) as subsidia8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subsidia,0)  ELSE "" END) as subsidia9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subs,0)  ELSE "" END) as subs1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subs,0)  ELSE "" END) as subs2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subs,0)  ELSE "" END) as subs3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subs,0)  ELSE "" END) as subs4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subs,0)  ELSE "" END) as subs5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subs,0)  ELSE "" END) as subs6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subs,0)  ELSE "" END) as subs7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subs,0)  ELSE "" END) as subs8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subs,0)  ELSE "" END) as subs9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)  ELSE "" END) as budjet1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)  ELSE "" END) as budjet2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)  ELSE "" END) as budjet3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)  ELSE "" END) as budjet4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)  ELSE "" END) as budjet5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)  ELSE "" END) as budjet6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)  ELSE "" END) as budjet7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)  ELSE "" END) as budjet8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)  ELSE "" END) as budjet9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.dolg,0)  ELSE "" END) as dolg1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.dolg,0)  ELSE "" END) as dolg2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.dolg,0)  ELSE "" END) as dolg3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.dolg,0)  ELSE "" END) as dolg4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.dolg,0)  ELSE "" END) as dolg5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.dolg,0)  ELSE "" END) as dolg6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.dolg,0)  ELSE "" END) as dolg7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.dolg,0)  ELSE "" END) as dolg8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.dolg,0)  ELSE "" END) as dolg9,'
					      .'((CASE '.$this->voda.' WHEN 1 THEN  t1.zadol ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.zadol ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.zadol ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.zadol ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.zadol ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.zadol ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.zadol ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.zadol ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.zadol ELSE 0 END)) as zadol,'
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.nachisleno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.nachisleno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.nachisleno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.nachisleno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.nachisleno ELSE 0 END)) as nachisleno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN t1.budjet+t1.pbudjet ELSE 0 END)+(CASE '.$this->stoki.' WHEN 1 THEN t2.budjet+t2.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN t3.budjet+t3.pbudjet ELSE 0 END)+(CASE '.$this->otoplenie.' WHEN 1 THEN t4.budjet+t4.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN t5.budjet+t5.pbudjet ELSE 0 END)+(CASE '.$this->tbo.' WHEN 1 THEN t6.budjet+t6.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN t7.budjet+t7.pbudjet ELSE 0 END)+(CASE '.$this->gas.' WHEN 1 THEN t8.budjet+t8.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN t9.budjet+t9.pbudjet ELSE 0 END)) as budjet,'					      
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.oplacheno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.oplacheno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.oplacheno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.oplacheno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.oplacheno ELSE 0 END)) as oplacheno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subsidia ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subsidia ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subsidia ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subsidia ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subsidia ELSE 0 END)) as subsidia,'
					         .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subs ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subs ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subs ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subs ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subs ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subs ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subs ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subs ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subs ELSE 0 END)) as subs,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.dolg ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.dolg ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.dolg ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.dolg ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.dolg ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.dolg ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.dolg ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.dolg ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.dolg ELSE 0 END)) as dolg '
					      .' FROM '.$this->base.'.VODA as t1,'.$this->base.'.STOKI as t2,'.$this->base.'.PODOGREV as t3,'.$this->base.'.OTOPLENIE as t4 ,'
					      .''.$this->base.'.KVARTPLATA as t5,'.$this->base.'.TBO as t6 ,'.$this->base.'.ENERGY as t7, '.$this->base.'.GAS as t8 ,'.$this->base.'.VAXTA as t9 '.$t.'';
		
		    break;
		    case "TekNachAllApp1":		  
			  $t1= "WHERE";
			IF ($this->voda){ 
			$t1 =$t1.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->stoki){ 
			$t1 =$t1.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->podogrev){ 
			$t1 =$t1.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->otoplenie){ 
			$t1 =$t1.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->kvartplata){ 
			$t1 =$t1.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->tbo){ 
			$t1 =$t1.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->energy){ 
			$t1 =$t1.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->gas){ 
			$t1 =$t1.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			IF ($this->vaxta){ 
			$t1 =$t1.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			}
			 $this->sql='SELECT (CASE '.$this->voda.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t1.mec,t1.god),"")  ELSE "" END) as period1 ,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t2.mec,t2.god),"")  ELSE "" END) as period2 ,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t3.mec,t3.god),"")  ELSE "" END) as period3 ,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t4.mec,t4.god),"")  ELSE "" END) as period4 ,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t5.mec,t5.god),"")  ELSE "" END) as period5 ,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t6.mec,t6.god),"")  ELSE "" END) as period6 ,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t7.mec,t7.god),"")  ELSE "" END) as period7 ,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t8.mec,t8.god),"")  ELSE "" END) as period8 ,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t9.mec,t9.god),"")  ELSE "" END) as period9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.zadol,0)  ELSE "" END) as zadol1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.zadol,0)  ELSE "" END) as zadol2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.zadol,0)  ELSE "" END) as zadol3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.zadol,0)  ELSE "" END) as zadol4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.zadol,0)  ELSE "" END) as zadol5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.zadol,0)  ELSE "" END) as zadol6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.zadol,0)  ELSE "" END) as zadol7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.zadol,0)  ELSE "" END) as zadol8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.zadol,0)  ELSE "" END) as zadol9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.nachisleno,0)  ELSE "" END) as nachisleno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.nachisleno,0)  ELSE "" END) as nachisleno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.nachisleno,0)  ELSE "" END) as nachisleno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.nachisleno,0)  ELSE "" END) as nachisleno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.nachisleno,0)  ELSE "" END) as nachisleno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.nachisleno,0)  ELSE "" END) as nachisleno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.nachisleno,0)  ELSE "" END) as nachisleno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.nachisleno,0)  ELSE "" END) as nachisleno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.nachisleno,0)  ELSE "" END) as nachisleno9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.oplacheno,0)  ELSE "" END) as oplacheno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.oplacheno,0)  ELSE "" END) as oplacheno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.oplacheno,0)  ELSE "" END) as oplacheno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.oplacheno,0)  ELSE "" END) as oplacheno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.oplacheno,0)  ELSE "" END) as oplacheno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.oplacheno,0)  ELSE "" END) as oplacheno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.oplacheno,0)  ELSE "" END) as oplacheno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.oplacheno,0)  ELSE "" END) as oplacheno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.oplacheno,0)  ELSE "" END) as oplacheno9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subsidia,0)  ELSE "" END) as subsidia1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subsidia,0)  ELSE "" END) as subsidia2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subsidia,0)  ELSE "" END) as subsidia3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subsidia,0)  ELSE "" END) as subsidia4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subsidia,0)  ELSE "" END) as subsidia5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subsidia,0)  ELSE "" END) as subsidia6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subsidia,0)  ELSE "" END) as subsidia7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subsidia,0)  ELSE "" END) as subsidia8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subsidia,0)  ELSE "" END) as subsidia9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subs,0)  ELSE "" END) as subs1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subs,0)  ELSE "" END) as subs2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subs,0)  ELSE "" END) as subs3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subs,0)  ELSE "" END) as subs4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subs,0)  ELSE "" END) as subs5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subs,0)  ELSE "" END) as subs6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subs,0)  ELSE "" END) as subs7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subs,0)  ELSE "" END) as subs8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subs,0)  ELSE "" END) as subs9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)  ELSE "" END) as budjet1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)  ELSE "" END) as budjet2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)  ELSE "" END) as budjet3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)  ELSE "" END) as budjet4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)  ELSE "" END) as budjet5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)  ELSE "" END) as budjet6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)  ELSE "" END) as budjet7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)  ELSE "" END) as budjet8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)  ELSE "" END) as budjet9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.dolg,0)  ELSE "" END) as dolg1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.dolg,0)  ELSE "" END) as dolg2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.dolg,0)  ELSE "" END) as dolg3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.dolg,0)  ELSE "" END) as dolg4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.dolg,0)  ELSE "" END) as dolg5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.dolg,0)  ELSE "" END) as dolg6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.dolg,0)  ELSE "" END) as dolg7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.dolg,0)  ELSE "" END) as dolg8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.dolg,0)  ELSE "" END) as dolg9,'
					      .'((CASE '.$this->voda.' WHEN 1 THEN  t1.zadol ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.zadol ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.zadol ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.zadol ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.zadol ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.zadol ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.zadol ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.zadol ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.zadol ELSE 0 END)) as zadol,'
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.nachisleno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.nachisleno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.nachisleno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.nachisleno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.nachisleno ELSE 0 END)) as nachisleno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN t1.budjet+t1.pbudjet ELSE 0 END)+(CASE '.$this->stoki.' WHEN 1 THEN t2.budjet+t2.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN t3.budjet+t3.pbudjet ELSE 0 END)+(CASE '.$this->otoplenie.' WHEN 1 THEN t4.budjet+t4.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN t5.budjet+t5.pbudjet ELSE 0 END)+(CASE '.$this->tbo.' WHEN 1 THEN t6.budjet+t6.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN t7.budjet+t7.pbudjet ELSE 0 END)+(CASE '.$this->gas.' WHEN 1 THEN t8.budjet+t8.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN t9.budjet+t9.pbudjet ELSE 0 END)) as budjet,'					      
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.oplacheno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.oplacheno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.oplacheno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.oplacheno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.oplacheno ELSE 0 END)) as oplacheno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subsidia ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subsidia ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subsidia ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subsidia ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subsidia ELSE 0 END)) as subsidia,'
					         .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subs ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subs ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subs ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subs ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subs ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subs ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subs ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subs ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subs ELSE 0 END)) as subs,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.dolg ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.dolg ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.dolg ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.dolg ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.dolg ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.dolg ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.dolg ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.dolg ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.dolg ELSE 0 END)) as dolg '
					      .' FROM '.$this->base.'.VODA as t1,'.$this->base.'.STOKI as t2,'.$this->base.'.PODOGREV as t3,'.$this->base.'.OTOPLENIE as t4 ,'
					      .''.$this->base.'.KVARTPLATA as t5,'.$this->base.'.TBO as t6 ,'.$this->base.'.ENERGY as t7, '.$this->base.'.GAS as t8 ,'.$this->base.'.VAXTA as t9 '.$t1.'';
				
		    break;

case "TekNachAllApp2":		  
			
			  $t2= " WHERE ";
			IF ($this->voda){ 
			$t2 =$t2.' t1.address_id= '.$this->id.' AND  t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->stoki){ 
			$t2 =$t2.' AND t2.address_id= '.$this->id.' AND  t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->podogrev){ 
			$t2 =$t2.' AND t3.address_id= '.$this->id.' AND  t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->otoplenie){ 
			$t2 =$t2.' AND t4.address_id= '.$this->id.' AND  t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->kvartplata){ 
			$t2 =$t2.' AND t5.address_id= '.$this->id.' AND  t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->tbo){ 
			$t2 =$t2.' AND t6.address_id= '.$this->id.' AND  t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->energy){ 
			$t2 =$t2.' AND t7.address_id= '.$this->id.' AND  t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->gas){ 
			$t2 =$t2.' AND t8.address_id= '.$this->id.' AND  t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			IF ($this->vaxta){ 
			$t2 =$t2.' AND t9.address_id= '.$this->id.' AND  t9.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
			}
			 $this->sql='SELECT (CASE '.$this->voda.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t1.mec,t1.god),"")  ELSE "" END) as period1 ,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t2.mec,t2.god),"")  ELSE "" END) as period2 ,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t3.mec,t3.god),"")  ELSE "" END) as period3 ,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t4.mec,t4.god),"")  ELSE "" END) as period4 ,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t5.mec,t5.god),"")  ELSE "" END) as period5 ,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t6.mec,t6.god),"")  ELSE "" END) as period6 ,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t7.mec,t7.god),"")  ELSE "" END) as period7 ,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t8.mec,t8.god),"")  ELSE "" END) as period8 ,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(CONCAT_WS(" ",t9.mec,t9.god),"")  ELSE "" END) as period9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.zadol,0)  ELSE "" END) as zadol1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.zadol,0)  ELSE "" END) as zadol2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.zadol,0)  ELSE "" END) as zadol3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.zadol,0)  ELSE "" END) as zadol4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.zadol,0)  ELSE "" END) as zadol5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.zadol,0)  ELSE "" END) as zadol6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.zadol,0)  ELSE "" END) as zadol7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.zadol,0)  ELSE "" END) as zadol8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.zadol,0)  ELSE "" END) as zadol9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.nachisleno,0)  ELSE "" END) as nachisleno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.nachisleno,0)  ELSE "" END) as nachisleno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.nachisleno,0)  ELSE "" END) as nachisleno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.nachisleno,0)  ELSE "" END) as nachisleno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.nachisleno,0)  ELSE "" END) as nachisleno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.nachisleno,0)  ELSE "" END) as nachisleno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.nachisleno,0)  ELSE "" END) as nachisleno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.nachisleno,0)  ELSE "" END) as nachisleno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.nachisleno,0)  ELSE "" END) as nachisleno9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.oplacheno,0)  ELSE "" END) as oplacheno1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.oplacheno,0)  ELSE "" END) as oplacheno2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.oplacheno,0)  ELSE "" END) as oplacheno3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.oplacheno,0)  ELSE "" END) as oplacheno4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.oplacheno,0)  ELSE "" END) as oplacheno5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.oplacheno,0)  ELSE "" END) as oplacheno6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.oplacheno,0)  ELSE "" END) as oplacheno7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.oplacheno,0)  ELSE "" END) as oplacheno8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.oplacheno,0)  ELSE "" END) as oplacheno9,'
					       .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subsidia,0)  ELSE "" END) as subsidia1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subsidia,0)  ELSE "" END) as subsidia2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subsidia,0)  ELSE "" END) as subsidia3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subsidia,0)  ELSE "" END) as subsidia4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subsidia,0)  ELSE "" END) as subsidia5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subsidia,0)  ELSE "" END) as subsidia6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subsidia,0)  ELSE "" END) as subsidia7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subsidia,0)  ELSE "" END) as subsidia8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subsidia,0)  ELSE "" END) as subsidia9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.subs,0)  ELSE "" END) as subs1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.subs,0)  ELSE "" END) as subs2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.subs,0)  ELSE "" END) as subs3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.subs,0)  ELSE "" END) as subs4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.subs,0)  ELSE "" END) as subs5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.subs,0)  ELSE "" END) as subs6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.subs,0)  ELSE "" END) as subs7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.subs,0)  ELSE "" END) as subs8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.subs,0)  ELSE "" END) as subs9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.budjet,0)+IFNULL(t1.pbudjet,0)  ELSE "" END) as budjet1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.budjet,0)+IFNULL(t2.pbudjet,0)  ELSE "" END) as budjet2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.budjet,0)+IFNULL(t3.pbudjet,0)  ELSE "" END) as budjet3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.budjet,0)+IFNULL(t4.pbudjet,0)  ELSE "" END) as budjet4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.budjet,0)+IFNULL(t5.pbudjet,0)  ELSE "" END) as budjet5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.budjet,0)+IFNULL(t6.pbudjet,0)  ELSE "" END) as budjet6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.budjet,0)+IFNULL(t7.pbudjet,0)  ELSE "" END) as budjet7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.budjet,0)+IFNULL(t8.pbudjet,0)  ELSE "" END) as budjet8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.budjet,0)+IFNULL(t9.pbudjet,0)  ELSE "" END) as budjet9,'
					        .'(CASE '.$this->voda.' WHEN 1 THEN IFNULL(t1.dolg,0)  ELSE "" END) as dolg1,'
					       .'(CASE '.$this->stoki.' WHEN 1 THEN IFNULL(t2.dolg,0)  ELSE "" END) as dolg2,'
					       .'(CASE '.$this->podogrev.' WHEN 1 THEN IFNULL(t3.dolg,0)  ELSE "" END) as dolg3,'
					       .'(CASE '.$this->otoplenie.' WHEN 1 THEN IFNULL(t4.dolg,0)  ELSE "" END) as dolg4,'
					       .'(CASE '.$this->kvartplata.' WHEN 1 THEN IFNULL(t5.dolg,0)  ELSE "" END) as dolg5,'
					       .'(CASE '.$this->tbo.' WHEN 1 THEN IFNULL(t6.dolg,0)  ELSE "" END) as dolg6,'
					       .'(CASE '.$this->energy.' WHEN 1 THEN IFNULL(t7.dolg,0)  ELSE "" END) as dolg7,'
					       .'(CASE '.$this->gas.' WHEN 1 THEN IFNULL(t8.dolg,0)  ELSE "" END) as dolg8,'
					       .'(CASE '.$this->vaxta.' WHEN 1 THEN IFNULL(t9.dolg,0)  ELSE "" END) as dolg9,'
					      .'((CASE '.$this->voda.' WHEN 1 THEN  t1.zadol ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.zadol ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.zadol ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.zadol ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.zadol ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.zadol ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.zadol ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.zadol ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.zadol ELSE 0 END)) as zadol,'
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.nachisleno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.nachisleno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.nachisleno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.nachisleno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.nachisleno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.nachisleno ELSE 0 END)) as nachisleno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN t1.budjet+t1.pbudjet ELSE 0 END)+(CASE '.$this->stoki.' WHEN 1 THEN t2.budjet+t2.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN t3.budjet+t3.pbudjet ELSE 0 END)+(CASE '.$this->otoplenie.' WHEN 1 THEN t4.budjet+t4.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN t5.budjet+t5.pbudjet ELSE 0 END)+(CASE '.$this->tbo.' WHEN 1 THEN t6.budjet+t6.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN t7.budjet+t7.pbudjet ELSE 0 END)+(CASE '.$this->gas.' WHEN 1 THEN t8.budjet+t8.pbudjet ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN t9.budjet+t9.pbudjet ELSE 0 END)) as budjet,'					      
					       .'((CASE '.$this->voda.' WHEN 1 THEN  t1.oplacheno ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.oplacheno ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.oplacheno ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.oplacheno ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.oplacheno ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.oplacheno ELSE 0 END)) as oplacheno,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subsidia ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subsidia ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subsidia ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subsidia ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subsidia ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subsidia ELSE 0 END)) as subsidia,'
					         .'((CASE '.$this->voda.' WHEN 1 THEN  t1.subs ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.subs ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.subs ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.subs ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.subs ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.subs ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.subs ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.subs ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.subs ELSE 0 END)) as subs,'
					        .'((CASE '.$this->voda.' WHEN 1 THEN  t1.dolg ELSE 0 END) + (CASE '.$this->stoki.' WHEN 1 THEN  t2.dolg ELSE 0 END) +'
					      .'(CASE '.$this->podogrev.' WHEN 1 THEN  t3.dolg ELSE 0 END) + (CASE '.$this->otoplenie.' WHEN 1 THEN  t4.dolg ELSE 0 END) +'
					      .'(CASE '.$this->kvartplata.' WHEN 1 THEN  t5.dolg ELSE 0 END) + (CASE '.$this->tbo.' WHEN 1 THEN  t6.dolg ELSE 0 END) +'
					      .'(CASE '.$this->energy.' WHEN 1 THEN  t7.dolg ELSE 0 END) + (CASE '.$this->gas.' WHEN 1 THEN  t8.dolg ELSE 0 END) +'
					      .'(CASE '.$this->vaxta.' WHEN 1 THEN  t9.dolg ELSE 0 END)) as dolg '
					      .' FROM '.$this->base.'.VODA as t1,'.$this->base.'.STOKI as t2,'.$this->base.'.PODOGREV as t3,'.$this->base.'.OTOPLENIE as t4 ,'
					      .''.$this->base.'.KVARTPLATA as t5,'.$this->base.'.TBO as t6 ,'.$this->base.'.ENERGY as t7, '.$this->base.'.GAS as t8 ,'.$this->base.'.VAXTA as t9 '.$t2.'';
				
		    break;

		
			case "AppTekOplata":
			 $this->sql='SELECT rec_id,address_id,address, god, data,kvartplata,otoplenie,podogrev,voda,stoki,tbo,summa,prixod,kassa,nomer,operator,data_in ,CASE WHEN data = "'
			.$this->t.'" AND operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM '.$this->base.'.OPLATA  WHERE '.$this->base.'.OPLATA.address_id='.$this->id.' ORDER BY '.$this->base.'.OPLATA.data DESC LIMIT 1';
			// print($this->sql);   
		    break;
	    case "AppTekOplataFive":
			 $this->sql='SELECT rec_id,address, god, data,kvartplata,otoplenie,podogrev,voda,stoki,tbo,summa,prixod,kassa,nomer,operator,data_in ,CASE WHEN data = "'
			.$this->t.'" AND operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM '.$this->base.'.OPLATA  WHERE '.$this->base.'.OPLATA.address_id='.$this->id.' ORDER BY '.$this->base.'.OPLATA.data DESC LIMIT 5';
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
			     
				      $this->sql='CALL '.$this->base.'.raspechatkaOplataApp("'.$this->address_id.'","'.$this->voda.'","'.$this->stoki.'","'.$this->otoplenie.'","'.$this->podogrev.'","'
					.$this->kvartplata.'","'.$this->tbo.'","'.$this->energy.'","'.$this->gas.'","'.$this->vaxta.'",@success,@content)';
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