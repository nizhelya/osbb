<?php
include_once './yis_config.php';

class QueryAddress
{
	private $_db;
	protected $_result;
	protected $address_id;
	protected $private;
	protected $appartment;
	protected $_total;
	protected $_count;
	protected $_sql;
	protected $base = BASE;
	protected $raion_id = RAION;
	protected $street_id = STREET;
	protected $house_id = HOUSE;
	protected $_sql_total;
	protected $_limit;
	protected $login;
	protected $password;
	protected $_array;
	protected $_id;
	protected $_what;	
	protected $_place;
	protected $_type;
	public $results;
	

public function __construct()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', LOGIN ,PASSWORD, 'YISGRAND');
		
		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}
		$_db->set_charset("utf8");
    
		return $_db;
	}


	public function getResults(stdClass $params)
	{
		
		
				$_db = $this->__construct();


		if(isset($params->what) && ($params->what)) {
		 $_what = $params->what;
		} else {
		  $_what = null;
		}
		if(isset($params->what_id) && ($params->what_id)) {
		  $_id = (int) $params->what_id;
		} else {
		  $_id = 0;
		}

		if(isset($params->address_id) && ($params->address_id)) {
		 $this->address_id = $params->address_id;
		} else {
		  $this->address_id = null;
		}
		if(isset($params->house_id) && ($params->house_id)) {
		 $this->house_id = $params->house_id;
		} else {
		  $this->house_id = null;
		}
		if(isset($params->privat) && ($params->privat)) {
		 $this->privat = $params->privat;
		} else {
		  $this->privat = 0;
		}
		if(isset($params->appartment) && ($params->appartment)) {
		 $this->appartment = $params->appartment;
		} else {
		  $this->appartment = null;
		}

		switch ($_what) {
	//inuse
	  case "raion":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.RAION WHERE YIS.RAION.`raion_id` = '.$this->raion_id.'';
			   //print($_sql); 
		    break;
		     case "street":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.STREET WHERE YIS.STREET.`street_id` = '.$this->street_id.'';
			    
		    break;
		      case "house":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.HOUSE WHERE YIS.HOUSE.`house_id`  in('.$this->house_id.')';
	    //  print($_sql);
			    
		    break;
		  case "StreetsFromRaion":
			$_sql_total=null; 
			if ($_id==0) {
			  $_sql='SELECT * FROM YIS.STREET ORDER BY street';
			} else {
			  $_sql='SELECT YIS.STREET.street_id, YIS.STREET.street FROM YIS.STREET, YIS.HOUSE WHERE YIS.STREET.street_id=YIS.HOUSE.street_id AND YIS.HOUSE.raion_id='.$_id.' GROUP BY YIS.STREET.street_id ORDER BY YIS.STREET.street';
			}
			    
		    break;

		    case "HousesFromRaion":
			  $_sql_total=null; 
			  $_sql='SELECT raion_id,street_id,house_id,raion,house,house as item FROM YIS.HOUSE WHERE raion_id= '.$_id.' ORDER BY house';
			    
		    break;

		  case "kvartira":
			 
			    $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment,
			    address as item,cast(appartment as unsigned) as app FROM YIS.ADDRESS WHERE house_id in('.$this->house_id.') ORDER BY app';
			 
//print($_sql);
		    break;

		       case "AddressFromHouses":
			  $_sql_total=null; 
			  if ($_id == 0) { $_sql='SELECT address_id, address FROM YIS.ADDRESS ORDER BY address';
			  } else {
			  $_sql='SELECT * FROM YIS.ADDRESS WHERE house_id= '.$_id.'';
			    //print($_sql);
			  }
		    break;
			
		     case "address":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.ADDRESS  WHERE address_id='.$_id.' LIMIT 1';
			    
		    break;


		    case "CheckFlat":

			  $_sql_total=null; 
			  $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment FROM YIS.ADDRESS WHERE house_id='.$this->house_id.' AND appartment="'.$this->appartment.'" LIMIT 1';
			// print($_sql);  
		    break;
		    case "HistoryAppartment":
			  $_sql_total=null; 
			  $_sql= 'SELECT *  FROM OSBB.APP_HISTORY WHERE `address_id`='.$_id.' order by `data_in` DESC'; 
//print($_sql);
		    break;
		    case "Appartment":
			  $_sql_total=null; 
			
			  $_sql= 'SELECT *,(CASE WHEN lgotchik > 0 THEN 1 ELSE 0 END ) as lgota, `vxvoda`,'
				  .'(SELECT `nomer` FROM YIS.DOGOVOR_YTKE WHERE `address_id`='.$_id.' LIMIT 1) AS dog_ytke, '
				  .'(SELECT `nomer` FROM YIS.DOGOVOR_VIK WHERE `address_id`='.$_id.' LIMIT 1) AS dog_vik'
				  .' FROM OSBB.APPARTMENT WHERE `address_id`='.$_id.' order by `data_in` limit 1'; 
//print($_sql);  
		 break;
		    case "Lgotnik"://применяется
			 // $_sql_total='SELECT * FROM VODOMER WHERE address_id='.$_id.''; 
			   $_sql='SELECT * , CONCAT(YIS.LGOTAMEN.`surname`,\' \', SUBSTRING(YIS.LGOTAMEN.`firstname`,1,1),\'.\',SUBSTRING(YIS.LGOTAMEN.`lastname`,1,1),\'.\') as fio  FROM YIS.LGOTAMEN WHERE  YIS.LGOTAMEN.address_id='.$_id.' AND YIS.LGOTAMEN.vkl = "да"';
			break;
			    case "getDogovorVik"://применяется
			   $_sql='SELECT * FROM YIS.DOGOVOR_VIK WHERE  YIS.DOGOVOR_VIK.address_id='.$this->address_id.' ';
			   	//print($_sql);  

			break;
			   case "getDogovorYtke"://применяется
			   $_sql='SELECT * FROM YIS.DOGOVOR_YTKE WHERE  YIS.DOGOVOR_YTKE.address_id='.$this->address_id.' ';
			   	//print($_sql);  

			break;
	    case "HistoryLgotnik"://применяется
			   $_sql='SELECT * , CONCAT(YIS.LGOTAMEN.`surname`,\' \', SUBSTRING(YIS.LGOTAMEN.`firstname`,1,1),\'.\',SUBSTRING(YIS.LGOTAMEN.`lastname`,1,1),\'.\') as fio FROM YIS.LGOTAMEN WHERE  YIS.LGOTAMEN.address_id='.$_id.'';
	//print($_sql);  

		    break;
		    
		       case "YearNachisleno":
			  $_sql_total=null; 
			  $_sql='SELECT god FROM OSBB.VODA    GROUP BY god DESC'; 
					    
		    break;
		       case "NachDetail":
			 //print_r($_period); 
			  $_sql_total=null; 
			  $_sql='SELECT * FROM '.$_table.' WHERE address_id='.$_id.' and data=DATE_FORMAT("'.$_period.'","%Y-%m-%d")'; 
				//	      print($_sql);
		    break;

		} // End of Switch ($what)
		
	
		if($_db){
		

		$_result = $_db->query($_sql) or die('Connect Error in '. $_what .'  (    ' .  $_sql . '    ) ' . $_db->connect_error);

		$_array=array();
		while ($row = $_result->fetch_assoc()) {
			array_push($_array, $row);
		}
		$results = array();
		$results['success']= true;


		//if ($results['total']	= $_total;
		$results['total']= null;
		/*if(isset($results['total') && ($results['total')) {
		 $results['total' = $results['total';
		} else {
		   $results['total'= null;
		}*/


		$results['data']= $_array;
		}else{
		 $results['success']= false;
		}
		return $results;
	}
	public function updateRecords(stdClass $params)      // ================================= UPDATE RECORDS
		{
		$_db = $this->__construct();

	 
		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		//$this->recs=implode(',',$params->rec);
		//$this->recs=implode('":"',$this->rec);

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
		
				//print($this->recs);

		switch ($this->what) {
		    case "AppartmentUpdate":
		 $this->sql='CALL OSBB.AppartmentUpdate('
		.$this->address_id.','
		.$this->house_id.',"'
		.$this->address.'", "'
		.$this->kod.'", '
		.$this->tenant.','
		.$this->absent.', '
		.$this->podnan.','
		.$this->lgotchik.',"'
		.$this->subsidia.'",'
		.$this->area_balk.','
		.$this->area_dop.','
		.$this->area_full.','
		.$this->area_otopl.','
		.$this->area_life.','
		.$this->room.',"'
		.$this->lift.'","'
		.$this->teplomer.'",'
		.$this->gasomer.','
		.$this->energomer.','
		.$this->dteplomer_id.','
		.$this->dvodomer_id.',"'
		.$this->boiler.'", "'
		.$this->nanim.'", "'
		.$this->fio.'", "'
		.$this->inn.'", "'
		.$this->passport.'", "'
		.$this->vidan.'", "'
		.$this->viddata.'", "'
		.$this->privat.'", "'
		.$this->order.'", "'
		.$this->data_ordera.'","'
		.$this->vgvoda.'", "'
		.$this->vxvoda.'", "'
		.$this->voda.'", "'
		.$this->stoki.'", "'
		.$this->podogrev.'", "'
		.$this->otoplenie.'", "'
		.$this->kvartplata.'", "'
		.$this->tbo.'","'
		.$this->energy.'","'
		.$this->gas.'","'
		.$this->vaxta.'",'
		.$this->tarif_kv.','
		.$this->tarif_ot.','
		.$this->tarif_gv.','
		.$this->tarif_xv.','		
		.$this->tarif_st.','
		.$this->tarif_tbo.','
		.$this->tarif_en.','
		.$this->tarif_gas.','
		.$this->tarif_vax.',"'
		.$this->what_change.'", "'
		.$this->data_change.'", "'
		.$this->info.'", "'
		.$this->phone.'", "'
		.$this->chdata.'", '
		.' @success, @msg)';
			 // print($this->sql);
		break;
 case "AppartmentChange":
		 $this->sql='CALL OSBB.AppartmentChange('
		.$this->address_id.','
		.$this->house_id.',"'
		.$this->address.'", "'
		.$this->kod.'", '
		.$this->tenant.','
		.$this->absent.', '
		.$this->podnan.','
		.$this->lgotchik.',"'
		.$this->subsidia.'",'
		.$this->area_balk.','
		.$this->area_dop.','
		.$this->area_full.','
		.$this->area_otopl.','
		.$this->area_life.','
		.$this->room.',"'
		.$this->lift.'","'
		.$this->teplomer.'",'
		.$this->gasomer.','
		.$this->energomer.','
		.$this->dteplomer_id.','
		.$this->dvodomer_id.',"'
		.$this->boiler.'", "'
		.$this->nanim.'", "'
		.$this->fio.'", "'
		.$this->inn.'", "'
		.$this->passport.'", "'
		.$this->vidan.'", "'
		.$this->viddata.'", "'
		.$this->privat.'", "'
		.$this->order.'", "'
		.$this->data_ordera.'","'
		.$this->vgvoda.'", "'
		.$this->vxvoda.'", "'
		.$this->voda.'", "'
		.$this->stoki.'", "'
		.$this->podogrev.'", "'
		.$this->otoplenie.'", "'
		.$this->kvartplata.'", "'
		.$this->tbo.'","'
		.$this->energy.'","'
		.$this->gas.'","'
		.$this->vaxta.'",'
		.$this->tarif_kv.','
		.$this->tarif_ot.','
		.$this->tarif_gv.','
		.$this->tarif_xv.','		
		.$this->tarif_st.','
		.$this->tarif_tbo.','
		.$this->tarif_en.','
		.$this->tarif_gas.','
		.$this->tarif_vax.',"'
		.$this->what_change.'", "'
		.$this->data_change.'", "'
		.$this->info.'", "'
		.$this->phone.'","'
		.$this->operator.'","'
		.$this->chdata.'", '
		.' @success, @msg)';
			 // print($this->sql);
		break;
			case "AppVodaIns":
				 $this->sql='UPDATE OSBB.VODA SET zadol="'.$this->zadol.'",'
				.'OSBB.VODA.people="'.$this->people.'",'
				.'OSBB.VODA.xkub="'.$this->xkub.'",'
				.'OSBB.VODA.gkub="'.$this->gkub.'",'
				.'OSBB.VODA.kubn="'.$this->kubn.'",'
				.'OSBB.VODA.pkub="'.$this->pkub.'",'
				.'OSBB.VODA.tarif="'.$this->tarif.'",'
				.'OSBB.VODA.norma="'.$this->norma.'",'
				.'OSBB.VODA.xvoda="'.$this->xvoda.'",'
				.'OSBB.VODA.gvoda="'.$this->gvoda.'",'
				.'OSBB.VODA.perer="'.$this->perer.'",'
				.'OSBB.VODA.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.VODA.xkub_lg="'.$this->xkub_lg.'",'
				.'OSBB.VODA.gkub_lg="'.$this->gkub_lg.'",'
				.'OSBB.VODA.budjet="'.$this->budjet.'",'
				.'OSBB.VODA.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.VODA.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.VODA.dolg="'.$this->dolg.'",'
				.'OSBB.VODA.info="'.$this->info.'",'
				.'OSBB.VODA.operator="'.$this->login.'",'
				.'OSBB.VODA.data_in= CURDATE() '
				.' WHERE OSBB.VODA.address_id='.$this->address_id.' AND '
				.' OSBB.VODA.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppStokiIns":
			 $this->sql='UPDATE OSBB.STOKI SET zadol="'.$this->zadol.'",'
				.'OSBB.STOKI.people="'.$this->people.'",'
				.'OSBB.STOKI.xkub="'.$this->xkub.'",'
				.'OSBB.STOKI.gkub="'.$this->gkub.'",'
				.'OSBB.STOKI.kubn="'.$this->kubn.'",'
				.'OSBB.STOKI.pkub="'.$this->pkub.'",'
				.'OSBB.STOKI.tarif="'.$this->tarif.'",'
				.'OSBB.STOKI.norma="'.$this->norma.'",'
				.'OSBB.STOKI.xvoda="'.$this->xvoda.'",'
				.'OSBB.STOKI.gvoda="'.$this->gvoda.'",'
				.'OSBB.STOKI.perer="'.$this->perer.'",'
				.'OSBB.STOKI.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.STOKI.xkub_lg="'.$this->xkub_lg.'",'
				.'OSBB.STOKI.gkub_lg="'.$this->gkub_lg.'",'
				.'OSBB.STOKI.budjet="'.$this->budjet.'",'
				.'OSBB.STOKI.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.STOKI.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.STOKI.dolg="'.$this->dolg.'",'
				.'OSBB.STOKI.info="'.$this->info.'",'
				.'OSBB.STOKI.operator="'.$this->login.'",'
				.'OSBB.STOKI.data_in= CURDATE() '
				.' WHERE OSBB.STOKI.address_id='.$this->address_id.' AND '
				.' OSBB.STOKI.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppPodogrevIns":
				 $this->sql='UPDATE OSBB.PODOGREV SET zadol="'.$this->zadol.'",'
				.'OSBB.PODOGREV.people="'.$this->people.'",'
				.'OSBB.PODOGREV.kub="'.$this->kub.'",'
				.'OSBB.PODOGREV.gkal="'.$this->gkal.'",'
				.'OSBB.PODOGREV.tarif="'.$this->tarif.'",'
				.'OSBB.PODOGREV.norma="'.$this->norma.'",'
				.'OSBB.PODOGREV.podogrev="'.$this->podogrev.'",'
				.'OSBB.PODOGREV.perer="'.$this->perer.'",'
				.'OSBB.PODOGREV.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.PODOGREV.gkub_lg="'.$this->gkub_lg.'",'
				.'OSBB.PODOGREV.budjet="'.$this->budjet.'",'
				.'OSBB.PODOGREV.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.PODOGREV.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.PODOGREV.dolg="'.$this->dolg.'",'
				.'OSBB.PODOGREV.info="'.$this->info.'",'
				.'OSBB.PODOGREV.operator="'.$this->login.'",'
				.'OSBB.PODOGREV.data_in= CURDATE() '
				.' WHERE OSBB.PODOGREV.address_id='.$this->address_id.' AND '
				.' OSBB.PODOGREV.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
				case "AppEnergyIns":
				 $this->sql='UPDATE OSBB.ENERGY SET zadol="'.$this->zadol.'",'
				.'OSBB.ENERGY.people="'.$this->people.'",'
				.'OSBB.ENERGY.kwh="'.$this->kwh.'",'
				.'OSBB.ENERGY.kwhn="'.$this->kwhn.'",'
				.'OSBB.ENERGY.tarif="'.$this->tarif.'",'
				.'OSBB.ENERGY.ptarif="'.$this->ptarif.'",'
				.'OSBB.ENERGY.norma="'.$this->norma.'",'
				.'OSBB.ENERGY.energy="'.$this->energy.'",'
				.'OSBB.ENERGY.perer="'.$this->perer.'",'
				.'OSBB.ENERGY.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.ENERGY.kwh_lg="'.$this->kwh_lg.'",'
				.'OSBB.ENERGY.budjet="'.$this->budjet.'",'
				.'OSBB.ENERGY.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.ENERGY.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.ENERGY.dolg="'.$this->dolg.'",'
				.'OSBB.ENERGY.info="'.$this->info.'",'
				.'OSBB.ENERGY.operator="'.$this->login.'",'
				.'OSBB.ENERGY.data_in= CURDATE() '
				.' WHERE OSBB.ENERGY.address_id='.$this->address_id.' AND '
				.' OSBB.ENERGY.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppOtoplenieIns":
				 $this->sql='UPDATE OSBB.OTOPLENIE SET zadol="'.$this->zadol.'",'
				 .'OSBB.OTOPLENIE.metod="'.$this->metod.'",'
				.'OSBB.OTOPLENIE.square="'.$this->square.'",'
				.'OSBB.OTOPLENIE.gkal="'.$this->gkal.'",'
				.'OSBB.OTOPLENIE.gkalm2="'.$this->gkalm2.'",'
				.'OSBB.OTOPLENIE.gkm2="'.$this->gkm2.'",'
				.'OSBB.OTOPLENIE.gkm2_mop="'.$this->gkm2_mop.'",'
				.'OSBB.OTOPLENIE.gkal_mop="'.$this->gkal_mop.'",'
				.'OSBB.OTOPLENIE.tarif="'.$this->tarif.'",'
				.'OSBB.OTOPLENIE.tarif_gkal="'.$this->tarif_gkal.'",'
				.'OSBB.OTOPLENIE.data_perer="'.$this->data_perer.'",'
				.'OSBB.OTOPLENIE.tarif_perer="'.$this->tarif_perer.'",'
				.'OSBB.OTOPLENIE.perer_gkal="'.$this->perer_gkal.'",'
				.'OSBB.OTOPLENIE.gkm2_perer="'.$this->gkm2_perer.'",'
				.'OSBB.OTOPLENIE.perer="'.$this->perer.'",'
				.'OSBB.OTOPLENIE.mop="'.$this->mop.'",'
				.'OSBB.OTOPLENIE.otoplenie="'.$this->otoplenie.'",'
				.'OSBB.OTOPLENIE.otoplenie_gkal="'.$this->otoplenie_gkal.'",'
				.'OSBB.OTOPLENIE.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.OTOPLENIE.square_lg="'.$this->square_lg.'",'
				.'OSBB.OTOPLENIE.budjet="'.$this->budjet.'",'
				.'OSBB.OTOPLENIE.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.OTOPLENIE.budjet_mop="'.$this->budjet_mop.'",'
				.'OSBB.OTOPLENIE.budjet_gkal="'.$this->budjet_gkal.'",'
				.'OSBB.OTOPLENIE.budjet_m2="'.$this->budjet_m2.'",'
				.'OSBB.OTOPLENIE.gkm2_lg="'.$this->gkm2_lg.'",'
				.'OSBB.OTOPLENIE.square_lg="'.$this->square_lg.'",'
				.'OSBB.OTOPLENIE.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.OTOPLENIE.dolg="'.$this->dolg.'",'
				.'OSBB.OTOPLENIE.info="'.$this->info.'",'
				.'OSBB.OTOPLENIE.operator="'.$this->login.'",'
				.'OSBB.OTOPLENIE.data_in= CURDATE() '
				.'WHERE OSBB.OTOPLENIE.address_id='.$this->address_id.' AND OSBB.OTOPLENIE.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppKvartplataIns":
				 $this->sql='UPDATE OSBB.KVARTPLATA SET zadol="'.$this->zadol.'",'
				.'OSBB.KVARTPLATA.square="'.$this->square.'",'
				.'OSBB.KVARTPLATA.kvartplata="'.$this->kvartplata.'",'
				.'OSBB.KVARTPLATA.dop="'.$this->dop.'",'
				.'OSBB.KVARTPLATA.tarif="'.$this->tarif.'",'
				.'OSBB.KVARTPLATA.perer="'.$this->perer.'",'
				.'OSBB.KVARTPLATA.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.KVARTPLATA.square_lg="'.$this->square_lg.'",'
				.'OSBB.KVARTPLATA.budjet="'.$this->budjet.'",'
				.'OSBB.KVARTPLATA.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.KVARTPLATA.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.KVARTPLATA.dolg="'.$this->dolg.'",'
				.'OSBB.KVARTPLATA.info="'.$this->info.'",'
				.'OSBB.KVARTPLATA.operator="'.$this->login.'",'
				.'OSBB.KVARTPLATA.data_in= CURDATE() '
				.' WHERE OSBB.KVARTPLATA.address_id='.$this->address_id.' AND '
				.' OSBB.KVARTPLATA.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppTboIns":
				 $this->sql='UPDATE OSBB.TBO SET zadol="'.$this->zadol.'",'
				.'OSBB.TBO.people="'.$this->people.'",'
				.'OSBB.TBO.tbo="'.$this->tbo.'",'
				.'OSBB.TBO.tarif="'.$this->tarif.'",'
			  .'OSBB.TBO.perer="'.$this->perer.'",'
				.'OSBB.TBO.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.TBO.people_lg="'.$this->people_lg.'",'
				.'OSBB.TBO.budjet="'.$this->budjet.'",'
				.'OSBB.TBO.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.TBO.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.TBO.dolg="'.$this->dolg.'",'
				.'OSBB.TBO.info="'.$this->info.'",'
				.'OSBB.TBO.operator="'.$this->login.'",'
				.'OSBB.TBO.data_in= CURDATE() '
				.' WHERE OSBB.TBO.address_id='.$this->address_id.' AND '
				.' OSBB.TBO.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppGasIns":
				 $this->sql='UPDATE OSBB.GAS SET zadol="'.$this->zadol.'",'
				.'OSBB.GAS.people="'.$this->people.'",'
				.'OSBB.GAS.kub="'.$this->kub.'",'
				.'OSBB.GAS.tarif="'.$this->tarif.'",'
				.'OSBB.GAS.norma="'.$this->norma.'",'
				.'OSBB.GAS.gas="'.$this->gas.'",'
				.'OSBB.GAS.perer="'.$this->perer.'",'
				.'OSBB.GAS.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.GAS.kub_lg="'.$this->kub_lg.'",'
				.'OSBB.GAS.budjet="'.$this->budjet.'",'
				.'OSBB.GAS.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.GAS.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.GAS.dolg="'.$this->dolg.'",'
				.'OSBB.GAS.info="'.$this->info.'",'
				.'OSBB.GAS.operator="'.$this->login.'",'
				.'OSBB.GAS.data_in= CURDATE() '
				.' WHERE OSBB.GAS.address_id='.$this->address_id.' AND '
				.' OSBB.GAS.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			  // print_r($this->sql); 
			break;
			case "AppVaxtaIns":
				 $this->sql='UPDATE OSBB.VAXTA SET zadol="'.$this->zadol.'",'
				.'OSBB.VAXTA.people="'.$this->people.'",'
				.'OSBB.VAXTA.vaxta="'.$this->vaxta.'",'
				.'OSBB.VAXTA.tarif="'.$this->tarif.'",'
			  .'OSBB.VAXTA.perer="'.$this->perer.'",'
				.'OSBB.VAXTA.nachisleno="'.$this->nachisleno.'",'
				.'OSBB.VAXTA.people_lg="'.$this->people_lg.'",'
				.'OSBB.VAXTA.budjet="'.$this->budjet.'",'
				.'OSBB.VAXTA.pbudjet="'.$this->pbudjet.'",'
				.'OSBB.VAXTA.oplacheno="'.$this->oplacheno.'",'
				.'OSBB.VAXTA.dolg="'.$this->dolg.'",'
				.'OSBB.VAXTA.info="'.$this->info.'",'
				.'OSBB.VAXTA.operator="'.$this->login.'",'
				.'OSBB.VAXTA.data_in= CURDATE() '
				.' WHERE OSBB.VAXTA.address_id='.$this->address_id.' AND '
				.' OSBB.VAXTA.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "addLgotaVoda":
			$this->sql='CALL OSBB.addLgotaVoda('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'
										      .$this->lgota.'","'
										      .$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaStoki":
			      $this->sql='CALL OSBB.addLgotaStoki('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaPodogrev":
			      $this->sql='CALL OSBB.addLgotaPodogrev('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaOtoplenie":
			      $this->sql='CALL OSBB.addLgotaOtoplenie('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'
										      .$this->lgota.'","'
										      .$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
//print($this->sql);

			break;
			case "addLgotaKvartplata":
			      $this->sql='CALL OSBB.addLgotaKvartplata('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaTbo":
			      $this->sql='CALL OSBB.addLgotaTbo('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
			case "addLgotaPererVoda":
			      $this->sql='CALL OSBB.addLgotaPererVoda('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'													.$this->address.'","'
										      .$this->fio.'","'													.$this->lgota.'","'													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaPererStoki":
			      $this->sql='CALL OSBB.addLgotaPererStoki('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'													.$this->address.'","'
										      .$this->fio.'","'													.$this->lgota.'","'													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaPererPodogrev":
			      $this->sql='CALL OSBB.addLgotaPererPodogrev('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'													.$this->lgota.'","'													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'													.$this->chekInput.'","'		      										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaPererOtoplenie":
			      $this->sql='CALL OSBB.addLgotaPererOtoplenie('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
			case "addLgotaPererKvartplata":
			      $this->sql='CALL OSBB.addLgotaPererKvartplata('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPererTbo":
			      $this->sql='CALL OSBB.addLgotaPererTbo('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
			case "editLgotaEnergy":
			      $this->sql='CALL OSBB.editLgotaEnergy('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaVoda":
			      $this->sql='CALL OSBB.editLgotaVoda('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaStoki":
			      $this->sql='CALL OSBB.editLgotaStoki('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  // print_r($this->sql); 

			break;

	case "editLgotaPodogrev":
			      $this->sql='CALL OSBB.editLgotaPodogrev('
										      .$this->rec_id.','
										      .$this->address_id.',"'
      										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaOtoplenie":
			      $this->sql='CALL OSBB.editLgotaOtoplenie('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaKvartplata":
			      $this->sql='CALL OSBB.editLgotaKvartplata('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->people.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaTbo":
			      $this->sql='CALL OSBB.editLgotaTbo('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
			case "editLgotaTbo":
	$this->sql='CALL OSBB.editLgotaEnergy('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
	$this->sql='CALL OSBB.editLgotaGas('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
		case "addLgotnik":
			      $this->sql='CALL YISGRAND.addLgotnik("'
										      .$this->lgota_id.'","'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->surname_ua.'","'
										      .$this->firstname_ua.'","'
										      .$this->lastname_ua.'","'
										      .$this->kartochka.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->document.'","'
										      .$this->data.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->given.'","'
										      .$this->people.'","'
													.$this->percent.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
			break;
			case "addDogovorVik":
			      $this->sql='CALL OSBB.addDogovorVik("'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nanim_ua.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->ua.'",'
										      .'@success,@msg)';
			break;
			case "editDogovorVik":
			      $this->sql='CALL OSBB.editDogovorVik("'
										      .$this->dog_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nanim_ua.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->ua.'",'
										      .'@success,@msg)';
			break;
			case "addDogovorYtke":
			      $this->sql='CALL OSBB.addDogovorYtke("'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nanim_ua.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->ua.'",'
										      .'@success,@msg)';
			break;
			case "editDogovorYtke":
			      $this->sql='CALL OSBB.editDogovorYtke("'
										      .$this->dog_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nanim_ua.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->ua.'",'
										      .'@success,@msg)';
			break;
			case "editLgotnik":
			      $this->sql='CALL YISGRAND.editLgotnik("'
										      .$this->lgotnik_id.'","'
										      .$this->lgota_id.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->surname_ua.'","'
										      .$this->firstname_ua.'","'
										      .$this->lastname_ua.'","'
										      .$this->kartochka.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->document.'","'
										      .$this->data.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->given.'","'
										      .$this->people.'","'
										      .$this->percent.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
										      			 //  print_r($this->sql); 

			break;
		case "editOplataApp":
			      $this->sql='CALL OSBB.editOplataApp('.$this->rec_id.','.$this->address_id.','.$this->kvartplata.','.$this->otoplenie.',"'.$this->podogrev.'",'.$this->voda.','
			      .$this->stoki.','.$this->tbo.','.$this->energy.','.$this->gas.','.$this->vaxta.','.$this->summa.','.$this->god.',"'.$this->prixod.'","'.$this->kassa.'",
			      "'.$this->data.'","'.$this->pr.'","'.$this->nomer.'","'.$this->data_in.'",@success,@msg)';
//print($this->sql);
			break;
			case "AddAddressNachislVoda":			
			    $this->sql='CALL OSBB.AddAddressNachisl("voda",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislStoki":			
			    $this->sql='CALL OSBB.AddAddressNachisl("stoki",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislPodogrev":			
			    $this->sql='CALL OSBB.AddAddressNachisl("podogrev",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislOtoplenie":			
			    $this->sql='CALL OSBB.AddAddressNachisl("otoplenie",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislKvartplata":			
			    $this->sql='CALL OSBB.AddAddressNachisl("kvartplata",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislTbo":			
			    $this->sql='CALL OSBB.AddAddressNachisl("tbo",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislEnergy":			
			    $this->sql='CALL OSBB.AddAddressNachisl("energy",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislGas":			
			    $this->sql='CALL OSBB.AddAddressNachisl("gas",'.$this->address_id.','.'@success,@msg)';
			break;
			case "AddAddressNachislVaxta":			
			    $this->sql='CALL OSBB.AddAddressNachisl("vaxta",'.$this->address_id.','.'@success,@msg)';
			break;
			case "delLgotaVodaPerer":
			      $this->sql='CALL OSBB.delLgotaVodaPerer('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaStokiPerer":
			      $this->sql='CALL OSBB.delLgotaStokiPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaPodogrevPerer":
			      $this->sql='CALL OSBB.delLgotaPodogrevPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaOtopleniePerer":
			      $this->sql='CALL OSBB.delLgotaOtopleniePerer('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaKvartplataPerer":
			      $this->sql='CALL OSBB.delLgotaKvartplataPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaTboPerer":
			      $this->sql='CALL OSBB.delLgotaTboPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaVoda":
			      $this->sql='CALL OSBB.delLgotaVoda('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaStoki":
			      $this->sql='CALL OSBB.delLgotaStoki('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaPodogrev":
			      $this->sql='CALL OSBB.delLgotaPodogrev('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaOtoplenie":
			      $this->sql='CALL OSBB.delLgotaOtoplenie('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaKvartplata":
			      $this->sql='CALL OSBB.delLgotaKvartplata('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaTbo":
			      $this->sql='CALL OSBB.delLgotaTbo('.$this->rec_id.',@success,@msg)';
			      
			break;
		case "clear_pr_voda_stoki":
			      $this->sql='UPDATE OSBB.VODA as t1  SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
		case "vvod_tarif_voda_stoki":
			      $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						$this->results['res'] = 1;	
									// print($this->sql);

		break;
		case "nachislenie_voda":
			       $this->sql='CALL OSBB.nachislenie_voda("'.$this->house_id.'",@success,@msg)';				    
			break;
			case "update_kubov_norma":
			       $this->sql='CALL OSBB.update_kubov_norma("'.$this->data.'",@success,@msg)';				    
			break;
			
	  
		case "chekOrgImport":
			      $this->sql='CALL OSBB.chekOrgImport(@success,@msg)';
			  break;
		 case "addOplataAllOrg":			
			      $this->sql='CALL OSBB.addOplataAllOrg('.$this->rec_id.', @success,@msg)';
			 // print($this->sql);
			break;
		 case "addOplataOrg":
			$this->sql='CALL OSBB.addOplataOrg('.$this->rec_id.',"'.$this->edrpou.'","'.$this->mfo.'","'.$this->pr.'","'.$this->data.'","'.$this->nomer.'",'
						.''.$this->iorg_id.','.$this->org_id.','.$this->filial_id.','.$this->ins.',"'.$this->rs.'","'.$this->summa.'","'.$this->note.'",@success,@msg)';
						//print($this->sql);
			break;
		case "update_port":
			      $this->sql='CALL OSBB.update_port("'.$this->data.'",@success,@msg)';
			   // print_r($this->sql); 
			break;
		case "update_fio_port":
			      $this->sql='CALL OSBB.update_fio_port("'.$this->data.'",@success,@msg)';
			  break;
		case "update_fio_subsidia":
			      $this->sql='CALL OSBB.update_fio_subsidia("'.$this->data.'",@success,@msg)';
			      			 // print_r($this->sql); 

			  break;
		  case "update_utszn_subsidia":
			      $this->sql='CALL OSBB.update_utszn_subsidia( "'.$this->data.'",@success,@msg)';
			      			 //print_r($this->sql); 
			      			 break;
		case "update_utszn_lgota":
			      $this->sql='CALL OSBB.update_utszn_lgota( "'.$this->usluga_id.'","'.$this->data.'",@success,@msg)';
			      			 //print_r($this->sql); 
			      			 break;
		case "editSubsidiaUtszn":
			       $this->sql='CALL OSBB.editSubsidiaUtszn('.$this->rec_id.',"'.$this->data.'","'.$this->date_akt.'","'
			       .$this->boss.'","'
			       .$this->glavbuh.'","'
			       .$this->st.'","'
			       .$this->oplata.'","'
			       .$this->doplata.'","'
			       .$this->nachisleno.'","'
			       .$this->fin.'",'
			       .'@success,@msg)';
			break;
		case "editLgotaUtszn":
			       $this->sql='CALL OSBB.editLgotaUtszn('.$this->rec_id.',"'.$this->data.'","'.$this->date_akt.'","'
			       .$this->boss.'","'
			       .$this->glavbuh.'","'
			       .$this->st.'","'
			       .$this->oplata.'","'
			       .$this->doplata.'","'
			       .$this->nachisleno.'","'
			       .$this->fin.'",'
			       .'@success,@msg)';
			break;
		case "vipiskaSchetovVik":
			      $this->sql='CALL OSBB.vipiskaSchetovVik("'.$this->data.'",@success,@msg)';
			  break;
		case "updateSchetaVik":
			      $this->sql='CALL OSBB.updateSchetaVik("'.$this->data.'",@success,@msg)';
			      			      			 //  print_r($this->sql); 

			  break;
		case "input_port":
			      $this->sql='CALL OSBB.input_port("'.$this->data.'",@success,@msg)';
			break;
		case "input_subsidia":
			      $this->sql='CALL OSBB.input_subsid("'.$this->data.'",@success,@msg)';
			break;
			case "input_oplata_gerz":
			      $this->sql='CALL OSBB.input_oplata_gerz(@success,@msg)';
			break;
			case "control_port":
			      $this->sql='CALL OSBB.control_port("'.$this->data.'",@success,@msg)';
			break;
			case "control_subsidia":
			      $this->sql='CALL OSBB.control_subsidia("'.$this->data.'",@success,@msg)';
			break;
	case "otkat_oplata_port":
			      $this->sql='CALL OSBB.otkat_oplata_port("'.$this->data.'",@success,@msg)';
			break;
			case "otkat_oplata_subsidia":
			      $this->sql='CALL OSBB.otkat_oplata_subsidia("'.$this->data.'",@success,@msg)';
			break;
			case "fixDolgTeplo":
			      $this->sql='CALL OSBB.fixDolgTeplo("'.$this->fdata.'",@success,@msg)';
			break;
	   case "addPortovik":
			      $this->sql='CALL OSBB.addPortovik("'.$this->data.'",'.$this->address_id.','.$this->tabn.',@success,@msg)';
			   // print_r($this->sql); 

			break;
		
		case "pereraschet_voda_stoki":
			      $this->sql='CALL OSBB.pereraschet_voda_stoki("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "vvod_tarif_teplo":
			       $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
		case "clear_pr_podogrev":
			      $this->sql='UPDATE OSBB.PODOGREV as t1 SET  t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
		case "nachislenie_podogrev":
			       $this->sql='CALL OSBB.nachislenie_podogrev(@success,@msg)';				    
			break;
	  case "nachislenie_podogrev_house":
			      $this->sql='CALL OSBB.nachislenie_podogrev_house("'.$this->house_id.'",@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "pereraschet_podogrev":
			      $this->sql='CALL OSBB.pereraschet_podogrev("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->gv9.'","'
										      .$this->ch_gv9.'","'
										      .$this->gv16.'","'
										      .$this->ch_gv16.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  // print_r($this->sql); 

			break;
			case "nachislenie_kvartplata":
			       $this->sql='CALL OSBB.nachislenie_kvartplata("'.$this->house_id.'",@success,@msg)';		
			       			 //  print_r($this->sql); 

			break;
		case "PrintAktUtsznAll":	
		 $this->sql='INSERT INTO OSBB.TMP_TABLE SET OSBB.TMP_TABLE.`rec_id` = '.$this->rec_id.'';
		$this->results['res'] = 1;	
		break;
			case "vvod_tarif_kv":
			       $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			       $this->results['res'] = 1;
			       break;
		case "clear_pr_kv":
			      $this->sql='UPDATE OSBB.KVARTPLATA as t1 SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			      			       			 //  print_r($this->sql); 

						$this->results['res'] = 1;	
		break;
		
		case "clear_pr_vaxta":
			      $this->sql='UPDATE OSBB.VAXTA as t1 SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
			case "vvod_tarif_vaxta":
			        $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			        $this->results['res'] = 1;	
			break;

			case "pereraschet_kvartplata":
			      $this->sql='CALL OSBB.pereraschet_kvartplata("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->kv.'","'
										      .$this->ch_kv.'","'										      
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			 //  print_r($this->sql); 

			break;
			case "vvod_tarif_tbo":
			        $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			        $this->results['res'] = 1;	
			break;
			      case "clear_pr_tbo":
			      $this->sql='UPDATE OSBB.TBO as t1 SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
			break;
			      case "nachislenie_tbo":
			       $this->sql='CALL OSBB.nachislenie_tbo("'.$this->house_id.'",@success,@msg)';	
			       			  //print_r($this->sql); 

			break;
			 case "nachislenie_vaxta":
			       $this->sql='CALL OSBB.nachislenie_vaxta("'.$this->house_id.'",@success,@msg)';		
			break;
			case "pereraschet_tbo":
			      $this->sql='CALL OSBB.pereraschet_tbo("'.$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->tbo.'","'
										      .$this->ch_tbo.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
			case "pereraschet_vaxta":
			      $this->sql='CALL OSBB.pereraschet_vaxta("'.$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->vaxta.'","'
										      .$this->ch_vaxta.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
			case "vvod_tarif_energy":
			      $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			      $this->results['res'] = 1;	
			break;
			      case "clear_pr_energy":
			      $this->sql='UPDATE OSBB.ENERGY as t1 SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
			break;
			      case "nachislenie_energy":
			      $this->sql='CALL OSBB.nachislenie_energy("'.$this->house_id.'",@success,@msg)';
			break;
			case "vvod_tarif_otoplenie":
			      $this->sql='UPDATE OSBB.TARIF as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			      $this->results['res'] = 1;	
			break;
			      case "clear_pr_otoplenie":
			      $this->sql='UPDATE OSBB.OTOPLENIE as t1 SET t1.`pr` = 0 WHERE t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
			break;
			      case "nachislenie_otoplenie":
			      $this->sql='CALL OSBB.nachislenie_otoplenie("'.$this->house_id.'",@success,@msg)';
			break;
			case "pereraschet_energy":
			      $this->sql='CALL OSBB.pereraschet_energy("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
										      .$this->energy.'","'
										      .$this->ch_energy.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "newAddress":
			      $this->sql='CALL OSBB.newAddress("'
										      .$this->qtykv.'","'
										      .$this->nomerkv.'","'
										      .$this->raion_id.'","'
										      .$this->street_id.'","'
									              .$this->house_id.'","'
										      .$this->kvartplata.'","'
										      .$this->tbo.'","'
										      .$this->voda.'","'
										      .$this->stoki.'","'
										      .$this->podogrev.'","'
										      .$this->otoplenie.'","'
										      .$this->energy.'","'
										      .$this->gas.'","'
										      .$this->vaxta.'",'										      
										      .'@success,@msg)';
			    //print_r($this->sql); 

			break;
			case "newOsbb":
				$this->sql='CALL OSBB.newOsbb('.$this->house_id.','.$this->kvartplata.','.$this->tbo.','.$this->voda.','.$this->stoki.','.$this->podogrev.','.$this->otoplenie.','.$this->energy.','.$this->gas.','.$this->vaxta.','.'@success,@msg)';
			    //print_r($this->sql); 

			break;
		case "delAddress":
			      $this->sql='CALL OSBB.delAddress('.$this->delAddressId.','.$this->control.',@success,@msg)';
			    //print_r($this->sql); 

			break;
		case "checkDelAddress":
			      $this->sql='CALL OSBB.checkDelAddress('.$this->address_id.',@success,@msg)';
			    //print_r($this->sql); 

			break;	
		case "newHouse":
			      $this->sql='CALL OSBB.newHouse("'
										      .$this->newhouse.'","'
										      .$this->tarif.'","'
										      .$this->nomer.'","'
										      .$this->raion_id.'","'
										      .$this->street_id.'",'
 									       .'@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
	case "newStreet":
			      $this->sql='CALL OSBB.newStreet("'
										      .$this->newStreet.'","'
										      .$this->abbr.'",'
										      .$this->privat.','
 									       .'@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
case "newRaion":
			      $this->sql='CALL OSBB.newRaion("'
										      .$this->newRaion.'",'
 									       .'@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
case "ExportBudjetEmail":
			      $this->sql='CALL OSBB.ExportBudjetEmail("'.$this->data.'",'
 									       .'@success,@msg)';
			    //print_r($this->sql); 

			break;

		} // End of Switch ($what)  

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_errno);
		
		$this->sql_callback='SELECT @new_id,@new_name,@success, @msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error >>>  ' . $_db->connect_errno . '  <<< ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg'] = $this->row['@msg'];
			$this->results['new_id'] = $this->row['@new_id'];
			$this->results['new_name'] = $this->row['@new_name'];
		}
		
		return $this->results;

	} // ================================= UPDATE RECORDS


	}