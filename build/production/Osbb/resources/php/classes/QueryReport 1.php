<?php
include_once './yis_config.php';

class QueryReport
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
	protected $type_id;
	protected $pokaz;
	protected $pred;
	protected $voda = VODA;
	protected $stoki = STOKI;
	protected $podogrev = PODOGREV;
	protected $otoplenie = OTOPLENIE;
	protected $kvartplata = KVARTPLATA;
	protected $tbo = TBO;
	protected $energy = ENERGY;
	protected $gas = GAS;
	protected $vaxta = VAXTA;
	protected $tek;
	protected $kub;
	protected $base = BASE;
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
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}


// num
$this->cat_id=0;
$this->raion_id=0;
$this->address_id=0;
$this->dog_id=0;
$this->house_id=0;
$this->org_id=0;
$this->cat_yes=0;
$this->raion_yes=0;
$this->house_yes=0;
$this->org_yes=0;
//string
$this->date_from='';
$this->date_to='';
$this->nr='';
$this->ddata='';



$array = (array) $params;
foreach ( $array as $key => $value )  {
   if(isset($value)) {  
		  if (is_int($value)) { 
					$this->$key= (int)$value;}
			else if (is_float($value)) { 
					$this->$key= $value;}
			else if (is_array($value)) { 
					$this->$key= (array)$value;}
			else {
					$this->$key =$_db->real_escape_string($value);
			}
  }
}
		$this->sql='';
		$this->vod=implode(':',$this->vodomer);
		//print($this->what);
		switch ($this->what) {

		
			case "ItogBudjetPoGroup":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroup("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			 // print($this->sql);
			break;
			
			case "ItogBudjetPoGroupRazv":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroupRazv("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			 // print($this->sql);
			break;
		
			
	
			break;
		
		case "KassaReestr":		
			      $this->sql='CALL '.$this->base.'.KassaReestr('.$this->osmd_id.',"'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;

		
		case "KassirReestrDay":		
			    $this->sql='CALL '.$this->base.'.KassirReestrDay('.$this->osmd_id.',"'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
		case "KassirReestr":		
			    $this->sql='CALL '.$this->base.'.KassirReestr('.$this->osmd_id.',"'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
		case "KassaAddressOsmd":		
			      $this->sql='CALL  '.$this->base.'.KassaAddressOsmd('
			      .'"'.$this->osmd_id.'", '
			      .'"'.$this->kvartplata.'", '
			      .'"'.$this->voda.'", '
			      .'"'.$this->stoki.'", '
			      .'"'.$this->otoplenie.'", '
			      .'"'.$this->podogrev.'", '
			      .'"'.$this->tbo.'", '
			      .'"'.$this->gas.'", '
			      .'"'.$this->energy.'", '
			      .'"'.$this->vaxta.'", '
			      .'"'.$this->date_from.'", '
			      .'"'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
		break;

		case "KassaPrixodOsmd":		
			      $this->sql='CALL  '.$this->base.'.KassaPrixodOsmd('
			      .'"'.$this->osmd_id.'", '
			        .'"'.$this->kvartplata.'", '
			      .'"'.$this->voda.'", '
			      .'"'.$this->stoki.'", '
			      .'"'.$this->otoplenie.'", '
			      .'"'.$this->podogrev.'", '
			      .'"'.$this->tbo.'", '
			      .'"'.$this->gas.'", '
			      .'"'.$this->energy.'", '
			      .'"'.$this->vaxta.'", '
			      .'"'.$this->date_from.'", '
			      .'"'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
			break;

		case "KassaDateOsmd":		
			      $this->sql='CALL  '.$this->base.'.KassaDateOsmd('
			      .'"'.$this->osmd_id.'", '
			        .'"'.$this->kvartplata.'", '
			      .'"'.$this->voda.'", '
			      .'"'.$this->stoki.'", '
			      .'"'.$this->otoplenie.'", '
			      .'"'.$this->podogrev.'", '
			      .'"'.$this->tbo.'", '
			      .'"'.$this->gas.'", '
			      .'"'.$this->energy.'", '
			      .'"'.$this->vaxta.'", '
			      .'"'.$this->date_from.'", '
			      .'"'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
		break;	
			
	case "NachislenoPodogrevAllYtke":		
			      $this->sql='CALL '.$this->base.'.NachislenoPodogrevAllYtke('
			      .'"'.$this->date_from.'", '
			      .'"'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			 // print($this->sql);
			break;
			case "SvodOtNasel":		
			      $this->sql='CALL '.$this->base.'.SvodOtNasel('
			      .'"'.$this->date_from.'", '
			      .'@content,@success,@msg)';
			//  print($this->sql);
			break;
			case "NachislenoAllKv":		
			      $this->sql='CALL '.$this->base.'.NachislenoAllKv("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			 // print($this->sql);
			break;
			case "NachislenoAllVaxta":
				$this->sql='CALL '.$this->base.'.NachislenoAllVaxta("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';

			break;
			case "NachislenoAllVik":
			      $this->sql='CALL '.$this->base.'.NachislenoAllVik("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';

			  
			break;
			case "NachislenoAllTbo":
			      $this->sql='CALL '.$this->base.'.NachislenoAllTbo("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';

			break;
			case "NachislenoAllYtke":			
			      $this->sql='CALL '.$this->base.'.NachislenoAllYtke("'.$this->osmd_id.'", "'.$this->date_from.'","'.$this->date_to.'",@head,@content,@foot,@success,@msg)';
			//  print($this->sql);
			break;
			case "NachislenoAllEnergy":	
			    $this->sql='CALL '.$this->base.'.NachislenoAllEnergy("'.$this->osmd_id.'", "'.$this->date_from.'","'.$this->date_to.'",@head,@content,@foot,@success,@msg)';

			//  print($this->sql);
			break;			
			case "AppHistory":		
			      $this->sql='CALL '.$this->base.'.AppHistory("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			
			case "LgotnikData":		
			      $this->sql='CALL '.$this->base.'.LgotnikData("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthYtke":		
			      $this->sql='CALL '.$this->base.'.ItogMonthTeplo("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonth":		
			      $this->sql='CALL '.$this->base.'.ItogMonth("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			      break;
					
			case "ItogMonthVik":		
			      $this->sql='CALL '.$this->base.'.ItogMonthVik("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthGas":		
			      $this->sql='CALL '.$this->base.'.ItogMonthGas("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthKv":		
			      $this->sql='CALL '.$this->base.'.ItogMonthKv("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthVaxta":		
			      $this->sql='CALL '.$this->base.'.ItogMonthVaxta("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthTbo":		
			      $this->sql='CALL '.$this->base.'.ItogMonthTbo("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthEnergy":		
			      $this->sql='CALL '.$this->base.'.ItogMonthEnergy("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "controlLgot":
			      $this->sql='CALL '.$this->base.'.controlLgot("'.$this->rbUsluga.'","'.$this->data.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlTbo":		
			      $this->sql='CALL '.$this->base.'.ControlTbo("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlVik":		
			      $this->sql='CALL '.$this->base.'.ControlVik("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlVikOrg":		
			      $this->sql='CALL '.$this->base.'.ControlVikOrg("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlKv":		
			      $this->sql='CALL '.$this->base.'.ControlKvartplata("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlVaxta":		
			      $this->sql='CALL '.$this->base.'.ControlVaxta("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlEnergy":		
			      $this->sql='CALL '.$this->base.'.ControlEnergy("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ControlTeplo":		
			      $this->sql='CALL '.$this->base.'.ControlTeplo("'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			break;
			case "reportLgotnik":		
			      $this->sql='CALL '.$this->base.'.reportLgotnik("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "reportLgotnikEnd":		
			      $this->sql='CALL '.$this->base.'.reportLgotnikEnd("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			
			case "reportLgotnikLgota":		
			      $this->sql='CALL '.$this->base.'.reportLgotnikLgota("'.$this->lgota_id.'", @head,@content,@foot,@success,@msg)';
			break;
			case "reportLgotnikIzm":		
			      $this->sql='CALL '.$this->base.'.reportLgotnikIzm("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "reportLgotnikGroup":		
			      $this->sql='CALL '.$this->base.'.reportLgotnikGroup("'.$this->gr.'","'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "reportLgotnikHouse":		
			      $this->sql='CALL '.$this->base.'.reportLgotnikHouse("'.$this->house_id.'", @head,@content,@foot,@success,@msg)';
			break;
			case "Dolgi":
			$this->sql='CALL '.$this->base.'.DolgSumma("'.$this->house_id.'","'.$this->start.'","'.$this->finish.'","'.$this->date_from.'","'.$this->date_to.'",@head,@content,@foot,@success,@msg)';
						//  print($this->sql);

			break;
			
			case "CityVodomer":			
					$this->sql='CALL '.$this->base.'.CityVodomer(@content,@success,@msg)';								
				
			break;
			
			case "Warning":			
									$this->sql='CALL '.$this->base.'.DolgWarningSummaYtke('
									.'"'.$this->house_id.'", '
									.'"'.$this->start.'",'
									.'"'.$this->date_from.'",'
									.'"'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
						
			break;

			
			
		
		

			case "VikVodHouses":			
			      $this->sql='CALL '.$this->base.'.VikVodHouses("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			//  print($this->sql);
			break;
			case "InfoHouse":
			      $this->sql='CALL '.$this->base.'.InfoHouse('.$this->house_id.',@content,@success,@msg)';
			  // print_r($this->sql); 
			break;
				
			case "FlatRaspechatkaVoda":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaVoda('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			break;
						
			case "FlatRaspechatkaTeplo":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaTeplo('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			  //print($this->sql);
			break;
			case "FlatRaspechatkaKv":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaKv('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			break;
			case "FlatRaspechatkaTbo":
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaTbo('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			
			break;
			case "FlatRaspechatkaEnergy":
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaEnergy('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			
			break;
			case "FlatRaspechatkaGas":
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaGas('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			
			break;
			case "FlatRaspechatkaVaxta":
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaVaxta('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			
			break;
			case "HouseRaspechatkaKv":
			      $this->sql='CALL '.$this->base.'.HouseRaspechatkaKv('.$this->house_id.',"'.$this->sdata.'",@head,@content,@foot,@success,@msg)';
			  //  print_r($this->sql); 
			break;
			case "HouseKvRaspechatkaKv":
			      $this->sql='CALL '.$this->base.'.HouseKvRaspechatkaKv('.$this->house_id.',"'.$this->address_ot.'","'.$this->address_do.'","'.$this->sdata.'",@head,@content,@foot,@success,@msg)';
			  //  print_r($this->sql); 
			break;
	

			
		}
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @head,@content,@foot,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error >>>  ' . $_db->connect_errno . '  <<< ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['head'] = $this->row['@head'];
			$this->results['content'] = $this->row['@content'];
			$this->results['sql'] = $this->sql;
			$this->results['foot'] = $this->row['@foot'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg'] = $this->row['@msg'];

		}
			
		/*include_once('absent_file.php')*/


		return $this->results;

}


}