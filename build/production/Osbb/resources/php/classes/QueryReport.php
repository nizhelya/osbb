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
	protected $rfond = RFOND;
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
		//$this->vod=implode(':',$this->vodomer);
		//print($this->what);
		switch ($this->what) {
		
		case "ItogBudjetPoGroupSv":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroupSv("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
		break;
		case "ItogBudjetPoGroupRazv":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroupRazv("'.$this->lgota_yes.'", "'.$this->gr.'","'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			 // print($this->sql);
		break;		
		case "ItogBudjetPoGroupSvOsmd":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroupSvOsmd("'.$this->osmd_id.'","'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			 // print($this->sql);
		break;
		case "ItogBudjetPoGroupRazvOsmd":			
			      $this->sql='CALL '.$this->base.'.ItogBudjetPoGroupRazvOsmd("'.$this->osmd_id.'","'.$this->lgota_yes.'", "'.$this->gr.'","'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';		
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
			      .'"'.$this->rfond.'", '
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
			      .'"'.$this->rfond.'", '
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
			      .'"'.$this->rfond.'", '
			      .'"'.$this->energy.'", '
			      .'"'.$this->vaxta.'", '
			      .'"'.$this->date_from.'", '
			      .'"'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
		break;	
			
	
			case "SvodOtNasel":		
			      $this->sql='CALL '.$this->base.'.SvodOtNasel('
			      .'"'.$this->date_from.'", '
			      .'@content,@success,@msg)';
			//  print($this->sql);
			break;
			case "NachislenoAllKv":		
			      $this->sql='CALL '.$this->base.'.NachislenoAllKv("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
			break;
			case "ListOnPay":		
			      $this->sql='CALL '.$this->base.'.ListOnPay("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			 // print($this->sql);
			break;
			case "NachislenoAllVaxta":
				$this->sql='CALL '.$this->base.'.NachislenoAllVaxta("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';

			break;
			case "NachislenoAllRfond":
				$this->sql='CALL '.$this->base.'.NachislenoAllRfond("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';

			break;
			case "NachislenoAllVoda":
			      $this->sql='CALL '.$this->base.'.NachislenoAllVoda("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';

			  
			break;
			case "raspechatkaApp":			
			      $this->sql='CALL OSBB.raspechatkaApp("'.$this->osmd_id.'","'.$this->house_id.'","'.$this->date_from.'","'.implode(',',$this->adr).'",@content,@success,@msg)';
			 // print($this->sql);
			break;
			case "NachislenoAllTbo":
			      $this->sql='CALL '.$this->base.'.NachislenoAllTbo("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';

			break;
			case "NachislenoAllTeplo":			
			      $this->sql='CALL '.$this->base.'.NachislenoAllTeplo("'.$this->house_id.'", "'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			//  print($this->sql);
			break;
			case "NachislenoAllPtn":			
			      $this->sql='CALL '.$this->base.'.NachislenoAllPtn("'.$this->house_id.'", "'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			//  print($this->sql);
			break;
			case "NachislenoAllEnergy":	
			    $this->sql='CALL '.$this->base.'.NachislenoAllEnergy("'.$this->house_id.'", "'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			//  print($this->sql);
			break;	
			case "Spravka":		
			      $this->sql='CALL OSBB.Spravka('.$this->rec_id.','.$this->address_id.',"'.$this->kuda.'",@content,@success,@msg)';
			break;
			case "PrintSubsUtsznAll":		
			      $this->sql='CALL  '.$this->base.'.PrintSubsUtsznAll("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "AppHistory":		
			      $this->sql='CALL '.$this->base.'.AppHistory("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			
			case "LgotnikData":		
			      $this->sql='CALL '.$this->base.'.LgotnikData("'.$this->date_from.'","'.$this->date_to.'", @head,@content,@foot,@success,@msg)';
			break;
			case "ItogMonthTeplo":		
			      $this->sql='CALL '.$this->base.'.ItogMonthTeplo("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			case "ItogMonth":		
			      $this->sql='CALL '.$this->base.'.ItogMonth("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';;
			      break;
					
			case "ItogMonthVoda":		
			      $this->sql='CALL '.$this->base.'.ItogMonthVoda("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			case "ItogMonthRfond":		
			      $this->sql='CALL '.$this->base.'.ItogMonthRfond("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ItogMonthKv":		
			      $this->sql='CALL '.$this->base.'.ItogMonthKv("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			case "ItogMonthVaxta":		
			      $this->sql='CALL '.$this->base.'.ItogMonthVaxta("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			case "ItogMonthTbo":		
			      $this->sql='CALL '.$this->base.'.ItogMonthTbo("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			case "ItogMonthEnergy":		
			      $this->sql='CALL '.$this->base.'.ItogMonthEnergy("'.$this->house_id.'","'.$this->date_from.'","'.$this->date_to.'",  @content,@success,@msg)';
			break;
			
			case "ControlTbo":		
			      $this->sql='CALL '.$this->base.'.ControlTbo("'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			break;
			case "ControlVoda":		
			      $this->sql='CALL '.$this->base.'.ControlVoda("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ControlCubov":		
			      $this->sql='CALL '.$this->base.'.ControlCubov("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ControlKv":		
			      $this->sql='CALL '.$this->base.'.ControlKv("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ControlVaxta":		
			      $this->sql='CALL '.$this->base.'.ControlVaxta("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ControlGas":		
			      $this->sql='CALL '.$this->base.'.ControlGas("'.$this->date_from.'","'.$this->date_to.'", @content,@success,@msg)';
			break;
			case "ControlEnergy":		
			      $this->sql='CALL '.$this->base.'.ControlEnergy("'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
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
			case "courseMapEn":			
			      $this->sql='CALL OSBB.courseMapEn("'.$this->house_id.'", "'.$this->date_from.'",@content,@success,@msg)';
			//  print($this->sql);
			break;
			case "courseMapVoda":			
			      $this->sql='CALL OSBB.courseMapVoda("'.$this->house_id.'", "'.$this->date_from.'",@content,@success,@msg)';
			//  print($this->sql);
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
			switch ($this->rbDolg) {
			case "1": 
			$this->sql='CALL '.$this->base.'.DolgSumma("'.$this->house_id.'","'.$this->start.'","'.$this->finish.'","'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';
			break;
			case "0": 
			$this->sql='CALL '.$this->base.'.DolgMonth("'.$this->house_id.'","'.$this->start.'","'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';					break;
			}	

			break;
			case "HistoryFlatPayment":			
			      $this->sql='CALL '.$this->base.'.HistoryFlatPayment("'.$this->address_id.'", @content)';
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
			case "InfoOsmd":
			      $this->sql='CALL YISGRAND.InfoOsmd(@content,@success,@msg)';
			break;	
			case "FlatRaspechatkaVoda":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaVoda('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			break;
			case "editLgotaUtszn":
			       $this->sql='CALL OSBB.editLgotaUtszn('.$this->rec_id.',"'.$this->data.'","'.$this->date_akt.'","'			      
			       .$this->st.'","'
			       .$this->oplata.'","'
			       .$this->doplata.'","'
			       .$this->nachisleno.'","'
			       .$this->fin.'",'
			       .'@success,@msg)';
			break;			
			case "FlatRaspechatkaTeplo":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaTeplo('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

			  //print($this->sql);
			break;
			case "FlatRaspechatkaPtn":			
			      $this->sql='CALL '.$this->base.'.FlatRaspechatkaPtn('.$this->address_id.',"'.$this->date_from.'","'.$this->date_to.'",@content,@success,@msg)';

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
			case "ReportVozvratSubsidia":
			switch ($this->usluga_id) {
			      case "1":
				    $this->sql='CALL OSBB.VozvratSubsidia_kv('.$this->osmd_id.',@content,@success,@msg)';

				break;
				
				case "2":
				    $this->sql='CALL OSBB.VozvratSubsidia_otoplenie('.$this->osmd_id.',@content,@success,@msg)';

				break;
				case "3":
				    $this->sql='CALL OSBB.VozvratSubsidia_voda('.$this->osmd_id.',@content,@success,@msg)';
				break;
				case "4":
				    $this->sql='CALL OSBB.VozvratSubsidia_en('.$this->osmd_id.',@content,@success,@msg)';

				break;
				case "5":
				    $this->sql='CALL OSBB.VozvratSubsidia_tbo('.$this->osmd_id.',@content,@success,@msg)';

				break;
				case "6":
				    $this->sql='CALL OSBB.VozvratSubsidia_ptn('.$this->osmd_id.',@content,@success,@msg)';

				break;
				}		    
			      			 //print_r($this->sql); 
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