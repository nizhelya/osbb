<?php
include_once './yis_config.php';

class QueryTeplomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $teplomer_id;
	protected $dteplomer_id;
	protected $pok_id;
	protected $address_id;
	protected $what;
	protected $data=NULL;
	protected $res=array();
	protected $base = BASE;
	public	  $results=array();
	
		
	public function connect($login,$password)	{
		
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
		if(isset($params->house_id) && ($params->house_id)) {
		 $this->house_id = (int) $params->house_id;
		} else {
		  $this->house_id = 0;
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
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
	      if(isset($params->pok_id) && ($params->pok_id)) {
		  $this->pok_id= (int) $params->pok_id;
		} else {
		  $this->pok_id= 0;
		}

	      if(isset($params->data) && ($params->data)) {
		  $this->data= $params->data;
		} else {
		  $this->data= "";
		}
	       
		switch ($this->what) {
//   КВАРТИРНЫЙ ТЕПЛОМЕР
			case "TekPokTeplomera":			
			      $this->sql='SELECT '
					.''.$this->base.'.TEPLOMER.teplomer_id,'
					.''.$this->base.'.TEPLOMER.dteplomer_id,'
					.''.$this->base.'.TEPLOMER.address_id,'
					.''.$this->base.'.TEPLOMER.house_id,'					
					.''.$this->base.'.TEPLOMER.nomer,'
					.''.$this->base.'.TEPLOMER.model_id,'
					.''.$this->base.'.TEPLOMER.model,'
					.''.$this->base.'.TEPLOMER.edizm,'
					.''.$this->base.'.TEPLOMER.out,'
					.''.$this->base.'.PTEPLOMER.pok_id,'
					.''.$this->base.'.PTEPLOMER.data,'
					.''.$this->base.'.TEPLOMER.sdate,'
					.''.$this->base.'.TEPLOMER.pdate,'
					.''.$this->base.'.PTEPLOMER.data as fdate,'
					.''.$this->base.'.PTEPLOMER.pred,'
					.''.$this->base.'.PTEPLOMER.tek as tekp,'
					.''.$this->base.'.PTEPLOMER.tek,'
					.''.$this->base.'.PTEPLOMER.qty,'
					.''.$this->base.'.PTEPLOMER.koef,'
					.''.$this->base.'.PTEPLOMER.gkal,'
					.''.$this->base.'.PTEPLOMER.tarif,'
					.''.$this->base.'.PTEPLOMER.area,'
					.''.$this->base.'.PTEPLOMER.area_lg,'
					.''.$this->base.'.PTEPLOMER.gkm2,'
					.''.$this->base.'.PTEPLOMER.otoplenie,'
					.''.$this->base.'.PTEPLOMER.budjet,'
					.''.$this->base.'.PTEPLOMER.operator '
					.' FROM '.$this->base.'.TEPLOMER ,'.$this->base.'.PTEPLOMER '
					.' WHERE '.$this->base.'.TEPLOMER.teplomer_id='.$this->teplomer_id.''					
					.' AND '.$this->base.'.PTEPLOMER.teplomer_id='.$this->teplomer_id.' '
					.' ORDER BY '.$this->base.'.PTEPLOMER.pok_id DESC  limit 1 ';
					//print($this->sql);
			break;
			case "AllPokTeplomera":			
				 $this->sql='SELECT * FROM '.$this->base.'.PTEPLOMER '		
					.' WHERE '.$this->base.'.PTEPLOMER.teplomer_id='.$this->teplomer_id.''
					.' ORDER BY '.$this->base.'.PTEPLOMER.pok_id DESC   ';
			break;
			
			case "AppTeplomer"://применяется
				  $this->sql='SELECT '
					.''.$this->base.'.TEPLOMER.address_id,'
					.''.$this->base.'.TEPLOMER.teplomer_id,'
					.''.$this->base.'.TEPLOMER.dteplomer_id,'
					.''.$this->base.'.TEPLOMER.house_id,'
					.''.$this->base.'.TEPLOMER.address,'
					.''.$this->base.'.TEPLOMER.nomer,'
					.''.$this->base.'.TEPLOMER.model_id,'
					.''.$this->base.'.TEPLOMER.model,'
					.''.$this->base.'.TEPLOMER.koef,'
					.''.$this->base.'.TEPLOMER.area,'
					.''.$this->base.'.TEPLOMER.edizm, '
					.''.$this->base.'.TEPLOMER.sdate,'
					.''.$this->base.'.TEPLOMER.pdate,'
					.''.$this->base.'.TEPLOMER.note, '
					.''.$this->base.'.TEPLOMER.out, '
					.''.$this->base.'.TEPLOMER.operator '
					.' FROM '.$this->base.'.TEPLOMER '
					.' WHERE '.$this->base.'.TEPLOMER.address_id='.$this->address_id.' '
					.' AND '.$this->base.'.TEPLOMER.spisan=0 ';
					//print($this->sql); 
			break;
			case "AppHTeplomer"://применяется
				  $this->sql='SELECT '
					.''.$this->base.'.TEPLOMER.address_id,'
					.''.$this->base.'.TEPLOMER.teplomer_id,'
					.''.$this->base.'.TEPLOMER.dteplomer_id,'
					.''.$this->base.'.TEPLOMER.house_id,'
					.''.$this->base.'.TEPLOMER.address,'
					.''.$this->base.'.TEPLOMER.nomer,'
					.''.$this->base.'.TEPLOMER.model_id,'
					.''.$this->base.'.TEPLOMER.model,'
					.''.$this->base.'.TEPLOMER.koef,'
					.''.$this->base.'.TEPLOMER.area,'
					.''.$this->base.'.TEPLOMER.edizm, '
					.''.$this->base.'.TEPLOMER.sdate,'
					.''.$this->base.'.TEPLOMER.pdate,'
					.''.$this->base.'.TEPLOMER.data_spis as data_spis,'
					.''.$this->base.'.TEPLOMER.note, '
					.''.$this->base.'.TEPLOMER.out, '
					.''.$this->base.'.TEPLOMER.operator '
					.' FROM '.$this->base.'.TEPLOMER '
					.' WHERE '.$this->base.'.TEPLOMER.address_id='.$this->address_id.' '
					.' AND '.$this->base.'.TEPLOMER.spisan=1 ';
					//print($this->sql);
					
			break;	
			case "TekNachAppTeplomera":			  
			   $this->sql='SELECT address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,'
				  .'"Гкал" as edizm,gkal as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,dolg FROM '.$this->base.'.OTOPLENIE WHERE address_id='.$this->address_id.' ORDER BY data DESC LIMIT 1 ';
			//print($this->sql); 
			break;
//   ТЕПЛОМЕР ОРГАНИЗАЦИИ
			 case "OrgTeplomer"://применяется
				  $this->sql='SELECT '
					.'OSBB.TEPLOMER.filial_id,'
					.'OSBB.TEPLOMER.teplomer_id,'
					.'OSBB.TEPLOMER.dteplomer_id,'
					.'OSBB.TEPLOMER.house_id,'
					.'OSBB.TEPLOMER.address,'
					.'OSBB.TEPLOMER.nomer,'
					.'OSBB.TEPLOMER.model_id,'
					.'OSBB.TEPLOMER.model,'
					.'OSBB.TEPLOMER.koef,'
					.'OSBB.TEPLOMER.area,'
					.'OSBB.TEPLOMER.edizm, '
					.'OSBB.TEPLOMER.sdate,'
					.'OSBB.TEPLOMER.pdate,'
					.'OSBB.TEPLOMER.note, '
					.'OSBB.TEPLOMER.out, '
					.'OSBB.TEPLOMER.operator '
					.' FROM OSBB.TEPLOMER '
					.' WHERE OSBB.TEPLOMER.filial_id='.$this->filial_id.' '
					.' AND OSBB.TEPLOMER.spisan=0 ';
					//print($this->sql); 
			break;
			case "OrgHTeplomer"://применяется
				  $this->sql='SELECT '
					.'OSBB.TEPLOMER.filial_id,'
					.'OSBB.TEPLOMER.teplomer_id,'
					.'OSBB.TEPLOMER.dteplomer_id,'
					.'OSBB.TEPLOMER.house_id,'
					.'OSBB.TEPLOMER.address,'
					.'OSBB.TEPLOMER.nomer,'
					.'OSBB.TEPLOMER.model_id,'
					.'OSBB.TEPLOMER.model,'
					.'OSBB.TEPLOMER.koef,'
					.'OSBB.TEPLOMER.area,'
					.'OSBB.TEPLOMER.edizm, '
					.'OSBB.TEPLOMER.sdate,'
					.'OSBB.TEPLOMER.pdate,'
					.'OSBB.TEPLOMER.data_spis as data_spis,'
					.'OSBB.TEPLOMER.note, '
					.'OSBB.TEPLOMER.out, '
					.'OSBB.TEPLOMER.operator '
					.' FROM OSBB.TEPLOMER '
					.' WHERE OSBB.TEPLOMER.filial_id='.$this->filial_id.' '
					.' AND OSBB.TEPLOMER.spisan=1 ';
					//print($this->sql);
					
			break;	
			      case "TekPokOrgTeplomera":			
			      $this->sql='SELECT '
					.'OSBB.TEPLOMER.teplomer_id,'
					.'OSBB.TEPLOMER.dteplomer_id,'
					.'OSBB.TEPLOMER.filial_id,'
					.'OSBB.TEPLOMER.house_id,'					
					.'OSBB.TEPLOMER.nomer,'
					.'OSBB.TEPLOMER.model_id,'
					.'OSBB.TEPLOMER.model,'
					.'OSBB.TEPLOMER.edizm,'
					.'OSBB.TEPLOMER.out,'
					.'OSBB.TEPLOMER.sdate,'
					.'OSBB.TEPLOMER.pdate,'
					.'OSBB.PTEPLOMER.pok_id,'
					.'OSBB.PTEPLOMER.data,'
					.'OSBB.PTEPLOMER.data as fdate,'
					.'OSBB.PTEPLOMER.pred,'
					.'OSBB.PTEPLOMER.tek as tekp,'
					.'OSBB.PTEPLOMER.tek,'
					.'OSBB.PTEPLOMER.qty,'
					.'OSBB.PTEPLOMER.koef,'
					.'OSBB.PTEPLOMER.gkal,'
					.'OSBB.PTEPLOMER.tarif,'
					.'OSBB.PTEPLOMER.area,'
					.'OSBB.PTEPLOMER.gkm2,'
					.'OSBB.PTEPLOMER.otoplenie,'
					.'OSBB.PTEPLOMER.operator '
					.' FROM OSBB.TEPLOMER ,OSBB.PTEPLOMER '
					.' WHERE OSBB.TEPLOMER.teplomer_id='.$this->teplomer_id.''					
					.' AND OSBB.PTEPLOMER.teplomer_id='.$this->teplomer_id.' '
					.' ORDER BY OSBB.PTEPLOMER.pok_id DESC  limit 1 ';
					//print($this->sql);
			break;
			case "AllPokOrgTeplomera":			
				 $this->sql='SELECT * FROM OSBB.PTEPLOMER '		
					.' WHERE OSBB.PTEPLOMER.teplomer_id='.$this->teplomer_id.''
					.' ORDER BY OSBB.PTEPLOMER.pok_id DESC   ';
			break;
			case "TekNachOrgTeplomera":			  
			   $this->sql='SELECT filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,'
				  .'"Гкал" as edizm,gkal as qty,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno,dolg FROM OSBB.OTOPLENIE WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ';
			//print($this->sql); 
			break;
//   ДОМОВОЙ ТЕПЛОМЕР
			case "Dteplomer"://применяется			
			    $this->sql='SELECT '
					.''.$this->base.'.DTEPLOMER.dteplomer_id,'
					.''.$this->base.'.DTEPLOMER.house_id,'
					.''.$this->base.'.DTEPLOMER.house,'
					.''.$this->base.'.DTEPLOMER.appartment,'
					.''.$this->base.'.DTEPLOMER.first_app,'
					.''.$this->base.'.DTEPLOMER.last_app,'
					.''.$this->base.'.DTEPLOMER.vvod,'
					.''.$this->base.'.DTEPLOMER.nomer,'
					.''.$this->base.'.DTEPLOMER.model_id,'
					.''.$this->base.'.DTEPLOMER.model,'
					.''.$this->base.'.DTEPLOMER.koef,'
					.''.$this->base.'.DTEPLOMER.area,'
					.''.$this->base.'.DTEPLOMER.edizm ,'
					.''.$this->base.'.DTEPLOMER.sdate,'
					.''.$this->base.'.DTEPLOMER.pdate,'
					.''.$this->base.'.DTEPLOMER.note ,'
					.''.$this->base.'.DTEPLOMER.out ,'
					.''.$this->base.'.DTEPLOMER.operator '
					.' FROM '.$this->base.'.DTEPLOMER '
					.' WHERE '.$this->base.'.DTEPLOMER.house_id='.$this->house_id.''
					.' AND '.$this->base.'.DTEPLOMER.spisan=0 ORDER BY '.$this->base.'.DTEPLOMER.vvod';
					//print( $this->sql);  
		      break;		  
		      case "HDteplomers"://применяется			
			     $this->sql='SELECT '
					.''.$this->base.'.DTEPLOMER.dteplomer_id,'
					.''.$this->base.'.DTEPLOMER.house_id,'
					.''.$this->base.'.DTEPLOMER.house,'
					.''.$this->base.'.DTEPLOMER.appartment,'
					.''.$this->base.'.DTEPLOMER.first_app,'
					.''.$this->base.'.DTEPLOMER.last_app,'
					.''.$this->base.'.DTEPLOMER.vvod,'
					.''.$this->base.'.DTEPLOMER.nomer,'
					.''.$this->base.'.DTEPLOMER.model_id,'
					.''.$this->base.'.DTEPLOMER.model,'
					.''.$this->base.'.DTEPLOMER.koef,'
					.''.$this->base.'.DTEPLOMER.area,'
					.''.$this->base.'.DTEPLOMER.edizm, '
					.''.$this->base.'.DTEPLOMER.sdate,'
					.''.$this->base.'.DTEPLOMER.pdate,'
					.''.$this->base.'.DTEPLOMER.note, '
					.''.$this->base.'.DTEPLOMER.out ,'
					.''.$this->base.'.DTEPLOMER.operator '
					.' FROM '.$this->base.'.DTEPLOMER '
					.' WHERE '.$this->base.'.DTEPLOMER.house_id='.$this->house_id.''
					.' AND '.$this->base.'.DTEPLOMER.spisan=1 ';
			//print( $this->sql);  
		      break;


			  case "TekPokDTeplomera"://применяется	
			    $this->sql='SELECT '
					.''.$this->base.'.DTEPLOMER.dteplomer_id,'
					.''.$this->base.'.DTEPLOMER.house_id,'
					.''.$this->base.'.DTEPLOMER.house,'
					.''.$this->base.'.DTEPLOMER.koef,'
					.''.$this->base.'.DTEPLOMER.vvod,'
					.''.$this->base.'.DTEPLOMER.out,'
					.''.$this->base.'.DTEPLOMER.appartment,'
					.''.$this->base.'.DTEPLOMER.first_app,'
					.''.$this->base.'.DTEPLOMER.last_app,'
					.''.$this->base.'.DTEPLOMER.nomer,'
					.''.$this->base.'.DTEPLOMER.model,'
					.''.$this->base.'.DTEPLOMER.edizm,'
					.''.$this->base.'.DTEPLOMER.note,'
					.''.$this->base.'.PDTEPLOMER.pok_id,'
					.''.$this->base.'.PDTEPLOMER.data,'
					//.'DATE_FORMAT('.$this->base.'.PDTEPLOMER.pdata,"%d-%m-%Y") as fdate,'
					.''.$this->base.'.PDTEPLOMER.data as fdate,'
					.''.$this->base.'.PDTEPLOMER.pred,'
					.''.$this->base.'.PDTEPLOMER.tek as tekp,'
					.''.$this->base.'.PDTEPLOMER.gkal_dt as gkal,'
					.''.$this->base.'.PDTEPLOMER.tek,'
					.''.$this->base.'.PDTEPLOMER.gkm2,'
					.''.$this->base.'.PDTEPLOMER.operator '
					.' FROM '.$this->base.'.PDTEPLOMER ,'.$this->base.'.DTEPLOMER'
					.' WHERE '.$this->base.'.PDTEPLOMER.dteplomer_id='.$this->base.'.DTEPLOMER.dteplomer_id AND '
					.' '.$this->base.'.PDTEPLOMER.dteplomer_id='.$this->dteplomer_id.' '
					.' ORDER BY '.$this->base.'.PDTEPLOMER.pok_id DESC  limit 1 ';
					//print_r($this->sql); 
			  break;
			  case "TekPokHeatHouse"://применяется	
			    $this->sql='SELECT '
					.''.$this->base.'.HEATHOUSE.house_id,'
					.''.$this->base.'.HEATHOUSE.data as data_ot,'
					.''.$this->base.'.HEATHOUSE.data_tek as date_ot,'
					.'DAY(LAST_DAY(NOW())) as day_hh,'
					.''.$this->base.'.HEATHOUSE.day_ot ,'
					.''.$this->base.'.HEATHOUSE.day_gv ,'
					.''.$this->base.'.HEATHOUSE.first_app,'
					.''.$this->base.'.HEATHOUSE.last_app,'
					.''.$this->base.'.HEATHOUSE.people ,'
					.''.$this->base.'.HEATHOUSE.personal ,'
					.''.$this->base.'.HEATHOUSE.gkub_o,'
					.''.$this->base.'.HEATHOUSE.gkub_a,'
					.''.$this->base.'.HEATHOUSE.gkal_dt,'
					.''.$this->base.'.HEATHOUSE.gkal_hh,'
					.''.$this->base.'.HEATHOUSE.gkal_otso,'
					.''.$this->base.'.HEATHOUSE.gkal_otsa,'
					.''.$this->base.'.HEATHOUSE.gkal_otta,'
					.''.$this->base.'.HEATHOUSE.gkal_otto,'
					.''.$this->base.'.HEATHOUSE.gkal_ot, '
					.''.$this->base.'.HEATHOUSE.gkm2 ,'
					.''.$this->base.'.HEATHOUSE.gkal_gvna,'
					.''.$this->base.'.HEATHOUSE.gkal_gvno,'
					.''.$this->base.'.HEATHOUSE.gkal_gvva,'
					.''.$this->base.'.HEATHOUSE.gkal_gvvo,'
					.''.$this->base.'.HEATHOUSE.gkal_gvna+'
					.''.$this->base.'.HEATHOUSE.gkal_gvno+'
					.''.$this->base.'.HEATHOUSE.gkal_gvva+'
					.''.$this->base.'.HEATHOUSE.gkal_gvvo as gkal_gv,'
					.''.$this->base.'.HEATHOUSE.temp,'
					.''.$this->base.'.HEATHOUSE.area_nach,'
					.''.$this->base.'.HEATHOUSE.area_dt,'
					.''.$this->base.'.HEATHOUSE.area_dta,'
					.''.$this->base.'.HEATHOUSE.area_ta,'
					.''.$this->base.'.HEATHOUSE.area_ano,'
					.''.$this->base.'.HEATHOUSE.area_dto,'
					.''.$this->base.'.HEATHOUSE.area_to,'
					.''.$this->base.'.HEATHOUSE.area_ono,'
					.''.$this->base.'.HEATHOUSE.area_all,'
					.''.$this->base.'.HEATHOUSE.gkal_mop,'
					.''.$this->base.'.HEATHOUSE.gkm2_mop'												
					.' FROM '.$this->base.'.HEATHOUSE '
					.' WHERE '.$this->base.'.HEATHOUSE.house_id='.$this->house_id
					.' AND '.$this->base.'.HEATHOUSE.dteplomer_id='.$this->dteplomer_id.' '
					.' AND '.$this->base.'.HEATHOUSE.data=CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") limit 1 ';
					//print_r($this->sql); 
			  break;

			  case "PokHeatHouse":// НЕ применяется	
			     $this->sql='SELECT '
					.''.$this->base.'.HEATHOUSE.house_id,'
					.''.$this->base.'.HEATHOUSE.data as data_ot,'
					.''.$this->base.'.HEATHOUSE.data_tek as date_ot,'
					.''.$this->base.'.HEATHOUSE.data_tek as date_pred,'
					.''.$this->base.'.HEATHOUSE.day_ot ,'
					.''.$this->base.'.HEATHOUSE.day_gv ,'
					.''.$this->base.'.HEATHOUSE.first_app,'
					.''.$this->base.'.HEATHOUSE.last_app,'
					.''.$this->base.'.HEATHOUSE.people ,'
					.''.$this->base.'.HEATHOUSE.personal ,'
					.''.$this->base.'.HEATHOUSE.gkub_o,'
					.''.$this->base.'.HEATHOUSE.gkub_a,'
					.''.$this->base.'.HEATHOUSE.gkal_dt,'
					.''.$this->base.'.HEATHOUSE.gkal_hh,'
					.''.$this->base.'.HEATHOUSE.gkal_otso,'
					.''.$this->base.'.HEATHOUSE.gkal_otsa,'
					.''.$this->base.'.HEATHOUSE.gkal_otta,'
					.''.$this->base.'.HEATHOUSE.gkal_otto,'
					.''.$this->base.'.HEATHOUSE.gkal_ot, '
					.''.$this->base.'.HEATHOUSE.gkm2 ,'
					.''.$this->base.'.HEATHOUSE.gkal_gvna,'
					.''.$this->base.'.HEATHOUSE.gkal_gvno,'
					.''.$this->base.'.HEATHOUSE.gkal_gvva,'
					.''.$this->base.'.HEATHOUSE.gkal_gvvo,'
					.''.$this->base.'.HEATHOUSE.gkal_gvna+'
					.''.$this->base.'.HEATHOUSE.gkal_gvno+'
					.''.$this->base.'.HEATHOUSE.gkal_gvva+'
					.''.$this->base.'.HEATHOUSE.gkal_gvvo as gkal_gv,'
					.''.$this->base.'.HEATHOUSE.temp,'
					.''.$this->base.'.HEATHOUSE.area_nach,'
					.''.$this->base.'.HEATHOUSE.area_dt,'
					.''.$this->base.'.HEATHOUSE.area_dta,'
					.''.$this->base.'.HEATHOUSE.area_ta,'
					.''.$this->base.'.HEATHOUSE.area_ano,'
					.''.$this->base.'.HEATHOUSE.area_dto,'
					.''.$this->base.'.HEATHOUSE.area_to,'
					.''.$this->base.'.HEATHOUSE.area_ono,'
					.''.$this->base.'.HEATHOUSE.area_all,'
					.''.$this->base.'.HEATHOUSE.gkal_mop,'
					.''.$this->base.'.HEATHOUSE.gkm2_mop'												
					.' FROM '.$this->base.'.HEATHOUSE '
					.' WHERE '.$this->base.'.HEATHOUSE.house_id='.$this->house_id
					.' AND '.$this->base.'.HEATHOUSE.dteplomer_id='.$this->dteplomer_id.' '
					.' AND '.$this->base.'.HEATHOUSE.gkal_ot >0  ORDER BY '.$this->base.'.HEATHOUSE.data DESC limit 1 ';
					//print_r($this->sql); 
			  break;


			    case "AllPokDTeplomera":	//применяется	
		
			    $this->sql='SELECT * FROM '.$this->base.'.PDTEPLOMER '		
					.' WHERE  '.$this->base.'.PDTEPLOMER.dteplomer_id='.$this->dteplomer_id.''
					.' ORDER BY '.$this->base.'.PDTEPLOMER.pok_id DESC  ';
		 
			  //  print_r($this->sql); 
			break;	
			  case "TekNachHouse":			  
			   $this->sql='SELECT house_id,data,'
					.'CONCAT_WS(" ",mec,god) as period,'
					.'sum(zadol) as zadol,'
					.'CASE WHEN gkal=0 THEN "м2" ELSE "Гкал" END as edizm,'
					.'CASE WHEN gkal=0 THEN square ELSE gkal END as qty,'
					.'CASE WHEN gkal=0 THEN tarif ELSE tarif END as tarif,'
					.'sum(nachisleno) as nachisleno,'
					.'sum(perer) as perer,'
					.'sum(itogo) as itogo,'
					.'sum(oplacheno) as oplacheno,'
					.'sum(dolg) as dolg '
					.' FROM '.$this->base.'.OTOPLENIE'
					.' WHERE house_id='.$this->house_id.' '
					.' ORDER BY data DESC LIMIT 1 ';
					    //print($this->sql); 
			break;


			  case "OrgByDteplomer":// применяется	
			    $this->sql='SELECT '
					.'OSBB.TM_ORG_FILIAL.filial_id,'
					.'OSBB.TM_ORG_FILIAL.fname as name,'
					.'OSBB.TM_ORG_FILIAL.area,'
					.'OSBB.TM_ORG_FILIAL.visota, '
					.'OSBB.TM_ORG_FILIAL.volume, '
					.'OSBB.TM_ORG_FILIAL.people, '
					.'OSBB.TM_ORG_FILIAL.vkl_otopl, '
					.'OSBB.TM_ORG_FILIAL.vkl_xvoda, '
					.'OSBB.TM_ORG_FILIAL.vkl_stoki, '
					.'OSBB.TM_ORG_FILIAL.vkl_gvoda, '
					.'OSBB.TM_ORG_FILIAL.gvodomer, '
					.'OSBB.TM_ORG_FILIAL.xvodomer, '
					.'OSBB.TM_ORG_FILIAL.teplomer, '
					.'OSBB.TM_ORG_FILIAL.dteplomer, '
					.'OSBB.TM_ORG_FILIAL.dteplomer_id, '
					.'OSBB.TM_ORG_FILIAL.dvodomer, '
					.'OSBB.TM_ORG_FILIAL.dvodomer_id, '
					.'OSBB.TM_ORG_FILIAL.gkal_y_ot, '
					.'OSBB.TM_ORG_FILIAL.nrx_gvs_d, '
					.'OSBB.TM_ORG_FILIAL.tarif_ot, '
					.'OSBB.TM_ORG_FILIAL.tarif_gv, '
					.'(SELECT OSBB.OTOPLENIE.gkal FROM OSBB.OTOPLENIE '
					.' WHERE OSBB.OTOPLENIE.filial_id =OSBB.TM_ORG_FILIAL.filial_id '
					.' ORDER BY OSBB.OTOPLENIE.data DESC LIMIT 1 ) as gkal,  '
					.'(SELECT OSBB.PODOGREV.`gkal` FROM OSBB.PODOGREV '
					.' WHERE OSBB.PODOGREV.filial_id = OSBB.TM_ORG_FILIAL.filial_id '
					.' ORDER BY OSBB.PODOGREV.data DESC LIMIT 1 ) as gkal_podogrev  '
					.' FROM OSBB.TM_ORG_FILIAL '
					.' WHERE OSBB.TM_ORG_FILIAL.house_id ='.$this->house_id.' '
					.' AND OSBB.TM_ORG_FILIAL.dteplomer_id ='.$this->dteplomer_id.'';
					//print_r($this->sql); 
			  break;
			  case "AllOrgByHouse":// применяется	
			    $this->sql='SELECT '
					.'OSBB.TM_ORG_FILIAL.filial_id,'
					.'OSBB.TM_ORG_FILIAL.fname as name,'
					.'OSBB.TM_ORG_FILIAL.area,'
					.'OSBB.TM_ORG_FILIAL.visota, '
					.'OSBB.TM_ORG_FILIAL.volume, '
					.'OSBB.TM_ORG_FILIAL.people, '
					.'OSBB.TM_ORG_FILIAL.vkl_otopl, '
					.'OSBB.TM_ORG_FILIAL.vkl_xvoda, '
					.'OSBB.TM_ORG_FILIAL.vkl_stoki, '
					.'OSBB.TM_ORG_FILIAL.vkl_gvoda, '
					.'OSBB.TM_ORG_FILIAL.gvodomer, '
					.'OSBB.TM_ORG_FILIAL.xvodomer, '
					.'OSBB.TM_ORG_FILIAL.teplomer, '
					.'OSBB.TM_ORG_FILIAL.dteplomer, '
					.'OSBB.TM_ORG_FILIAL.dteplomer_id, '
					.'OSBB.TM_ORG_FILIAL.dvodomer, '
					.'OSBB.TM_ORG_FILIAL.dvodomer_id, '
					.'OSBB.TM_ORG_FILIAL.gkal_y_ot, '
					.'OSBB.TM_ORG_FILIAL.nrx_gvs_d, '
					.'OSBB.TM_ORG_FILIAL.tarif_ot, '
					.'OSBB.TM_ORG_FILIAL.tarif_gv, '
					.'(SELECT OSBB.OTOPLENIE.gkal FROM OSBB.OTOPLENIE '
					.' WHERE OSBB.OTOPLENIE.filial_id =OSBB.TM_ORG_FILIAL.filial_id '
					.' ORDER BY OSBB.OTOPLENIE.data DESC LIMIT 1 ) as gkal,  '
					.'(SELECT OSBB.PODOGREV.`gkal` FROM OSBB.PODOGREV '
					.' WHERE OSBB.PODOGREV.filial_id = OSBB.TM_ORG_FILIAL.filial_id '
					.' ORDER BY OSBB.PODOGREV.data DESC LIMIT 1 ) as gkal_podogrev  '
					.' FROM OSBB.TM_ORG_FILIAL '
					.' WHERE OSBB.TM_ORG_FILIAL.house_id ='.$this->house_id.''
					.' AND (OSBB.TM_ORG_FILIAL.dteplomer_id ='.$this->dteplomer_id.' OR OSBB.TM_ORG_FILIAL.dteplomer_id =0)';
					//print_r($this->sql); 
			  break;

			  case "MopByDteplomer":// применяется	
			    $this->sql='SELECT '
					.''.$this->base.'.MOP.`mop_id`,'
					.''.$this->base.'.MOP.`dteplomer_id`,'
					.''.$this->base.'.MOP.`house_id`,'
					.''.$this->base.'.MOP.`name`, '
					.''.$this->base.'.MOP.`mopid`, '
					.''.$this->base.'.MOP.`gkal_year`, '
					.''.$this->base.'.MOP.`temp` as tempr, '
					.'(SELECT CONCAT_WS(" ",'.$this->base.'.MOPN.`mec`,'.$this->base.'.MOPN.`god`) FROM '.$this->base.'.MOPN WHERE '.$this->base.'.MOPN.`mop_id`= '.$this->base.'.MOP.`mop_id` ORDER BY '.$this->base.'.MOPN.`data` DESC LIMIT 1) AS period, '
					.'(SELECT '.$this->base.'.MOPN.`gkal` FROM '.$this->base.'.MOPN WHERE '.$this->base.'.MOPN.`mop_id`= '.$this->base.'.MOP.`mop_id` ORDER BY '.$this->base.'.MOPN.`data` DESC LIMIT 1) AS gkal, '
					.'(SELECT '.$this->base.'.MOPN.`area` FROM '.$this->base.'.MOPN WHERE '.$this->base.'.MOPN.`mop_id`= '.$this->base.'.MOP.`mop_id` ORDER BY '.$this->base.'.MOPN.`data` DESC LIMIT 1) AS area, '
					.'(SELECT '.$this->base.'.MOPN.`temp` FROM '.$this->base.'.MOPN WHERE '.$this->base.'.MOPN.`mop_id`= '.$this->base.'.MOP.`mop_id` ORDER BY '.$this->base.'.MOPN.`data` DESC LIMIT 1) AS temp, '
					.'(SELECT '.$this->base.'.MOPN.`day_ot` FROM '.$this->base.'.MOPN WHERE '.$this->base.'.MOPN.`mop_id`= '.$this->base.'.MOP.`mop_id` ORDER BY '.$this->base.'.MOPN.`data` DESC LIMIT 1) AS day_ot '
					.' FROM '.$this->base.'.MOP '
					.' WHERE  '.$this->base.'.MOP.`house_id` ='.$this->house_id
					.' AND '.$this->base.'.MOP.`dteplomer_id` ='.$this->dteplomer_id;
					//print_r($this->sql); 
			  break;

		
		} // End of Switch ($what)	
		
//		$this->result = $_db->query($this->sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ')');

		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}

	public function inTeplomerHistory(stdClass $params)
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
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
		switch ($this->what) {
			case "ATeplomer":			
			     $this->sql='CALL OSBB.in_ateplomer_history('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "OTeplomer":			
			     $this->sql='CALL OSBB.in_oteplomer_history('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "Dteplomer":			
			     $this->sql='CALL OSBB.in_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
		}
		//print($this->sql);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);

		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	}

	public function outTeplomerHistory(stdClass $params)
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
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
		
		switch ($this->what) {
			case "ATeplomer":			
			     $this->sql='CALL '.$this->base.'.out_ateplomer_history('.$this->teplomer_id.',@success,@msg)';
			break;
			case "OTeplomer":			
			    $this->sql='CALL OSBB.out_oteplomer_history('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
		//print($this->sql);
			break;
			case "Dteplomer":			
			    $this->sql='CALL OSBB.out_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
		//print($this->sql);
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
	    public function addTeplomer(stdClass $params)
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
	if(isset($params->allapp) && ($params->allapp)) {
		 $this->allapp = (int) $params->allapp;
		} else {
		  $this->allapp = 0;
		}
		switch ($this->what) {
			case "addAppTeplomer":			
			      $this->sql='CALL OSBB.add_ateplomer('.$this->address_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '
			      .$this->koef.', "'.$this->edizm.'", @teplomer_id, @success, @msg)';
			 //  print($this->sql);
			break;
	    case "editAppTeplomer":			
			    $this->sql='CALL OSBB.edit_ateplomer('.$this->teplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.',"'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "changeAppTeplomer":			
			    $this->sql='CALL OSBB.change_ateplomer('.$this->teplomer_id.','.$this->address_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "addOrgTeplomer":			
			    $this->sql='CALL OSBB.add_oteplomer('.$this->filial_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "changeOrgTeplomer":			
			    $this->sql='CALL OSBB.change_oteplomer('.$this->teplomer_id.','
			    .$this->filial_id.',"'.$this->sdate.'","'.$this->pdate.'", "'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;

			case "editOrgTeplomer":			
			    $this->sql='CALL OSBB.edit_oteplomer('.$this->teplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;

		

			case "change_DTeplomer":			
			   $this->sql='CALL OSBB.change_dteplomer('.$this->house_id.','.$this->dteplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','.$this->tek.','
							    .$this->koef.',"'.$this->edizm.'",@teplomer_id,@success,@msg)';
			   // print($this->sql);
			break;
			
			case "add_DTeplomer":			
			   $this->sql='CALL OSBB.add_dteplomer('.$this->house_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','
							    .'"'.$this->vvod.'",'.$this->allapp.','.$this->first_app.','.$this->last_app.', '.$this->tek.','
							    .$this->koef.',"'.$this->edizm.'", @teplomer_id,@success,@msg)';
			   // print($this->sql);
			break;

			case "edit_DTeplomer":			
			   $this->sql='CALL OSBB.edit_dteplomer('.$this->dteplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','
							    .'"'.$this->vvod.'",'.$this->allapp.','.$this->first_app.','.$this->last_app.','.$this->tek.','.$this->koef.',"'.$this->edizm.'", @teplomer_id,@success,@msg)';
			  // print($this->sql);
			break;

			case "addMop":	
			      $this->sql='CALL OSBB.add_update_mop('.$this->mop_id.','.$this->house_id.','.$this->dteplomer_id.','.$this->mopid.', '
							    .$this->gkal_year.', @newmop_id, @success, @msg)';
			 //  print($this->sql);
			break;
		}
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @teplomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['teplomer_id'] = $this->row['@teplomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}
			
		return $this->results;

	}
	    public function delTeplomer(stdClass $params)
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
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->mop_id) && ($params->mop_id)) {
		  $this->mop_id = (int) $params->mop_id;
		} else {
		  $this->mop_id = 0;
		}
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
		switch ($this->what) {
			case "ATeplomer":			
			    $this->sql='CALL '.$this->base.'.spisan_ateplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "DelATeplomer":			
			$this->sql='CALL OSBB.del_oteplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "OTeplomer":			
			$this->sql='CALL OSBB.spisan_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "DelOTeplomer":			
			$this->sql='CALL OSBB.del_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "Dteplomer":			
			 $this->sql='CALL OSBB.del_dteplomer('.$this->dteplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "delMop":			
			 $this->sql='CALL OSBB.del_mop('.$this->mop_id.',@success,@msg)';
			    //print($this->sql);
			break;
		}
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @teplomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['teplomer_id'] = $this->row['@teplomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}
			
		return $this->results;

	}
	public function delPokTeplomera(stdClass $params)
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
		if(isset($params->data) && ($params->data)) {
		 $this->data = $params->data;
		} else {
		  $this->data = '';
		}
		if(isset($params->house_id) && ($params->house_id)) {
		  $this->house_id = (int) $params->house_id;
		} else {
		  $this->house_id = 0;
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
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
	      if(isset($params->pok_id) && ($params->pok_id)) {
		  $this->pok_id= (int) $params->pok_id;
		} else {
		  $this->pok_id= 0;
		}

		switch ($this->what) {
			case "ATeplomer":			
			     $this->sql='CALL OSBB.delete_pokaz_ateplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
	    		case "OTeplomer":			
			     $this->sql='CALL OSBB.delete_pokaz_oteplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
			case "Dteplomer":			
			   $this->sql='CALL OSBB.delete_pokaz_dteplomera('.$this->pok_id.','.$this->house_id.','.$this->dteplomer_id.',@success,@msg)';
		//print($this->sql);
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
	public function newPokTeplomera(stdClass $params)
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
		/*NewPokTeplomera*/
		switch ($this->what) {
			case "ATeplomer":			
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_ateplomera('.$this->teplomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
		//print($this->sql);
			break;
			case "insTekPokOrgTepl":			
			    $this->sql='CALL OSBB.input_new_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.','.$this->tek.','.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;

			case "insHandOrgTepl":			
			    $this->sql='CALL OSBB.input_hand_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.','.$this->tek.','.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;


			case "Dteplomer":			
			  $this->sql='CALL OSBB.input_new_pokaz_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'","'.$this->data_tek.'","'.$this->ldate_ot.'","'.$this->ldate_to.'","'.$this->tek.'","'.$this->newValue.'",@success,@msg)';
		//print($this->sql);
			break;

			case "HeatHouse":			
			   $this->sql='CALL OSBB.input_new_pokaz_heathouse_do_m2('.$this->dteplomer_id.','.$this->house_id.',"'.$this->day_ot.'",'.$this->temp.',@success,@msg)';
		//print($this->sql);
			break;
		      case "NachOtoplenieSquare":			
			   $this->sql='CALL OSBB.NachOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->date_ot.'","'.$this->date_to.'",'.$this->temp.',@success,@msg)';
		//print($this->sql);
			break;
			case "Middle":			
			   $this->sql='CALL OSBB.input_new_pokaz_middle('.$this->house_id.','.$this->dteplomer_id.','.$this->day_middle.',@success,@msg)';
		//print($this->sql);
			break;

			case "HotWater":			
			   $this->sql='CALL OSBB.nachisl_gvs_house('.$this->house_id.','.$this->dteplomer_id.',"'.$this->day_gv.'", @success, @msg)';
	//	print($this->sql);
			break;

			
			case "SaldoOtoplOrg":			
			   $this->sql='UPDATE OSBB.OTOPLENIE SET `zadol` = '.$this->zadol.', `dolg` = '.$this->zadol.'+`nachisleno`-`oplacheno` WHERE filial_id = '.$this->filial_id.' AND EXTRACT(YEAR_MONTH FROM `data`) = EXTRACT(YEAR_MONTH FROM curdate())';
		//print($this->sql);
			break;
			case "PererOrgGkal":			
			   $this->sql='CALL OSBB.input_perer_org_gkal('.$this->filial_id.',"'.$this->data.'","'.$this->tarif.'", "'.$this->newValue.'", "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
		case "AppOtopleniePererIns":			
			   $this->sql='CALL '.$this->base.'.input_perer_app_gkal('.$this->address_id.',"'.$this->data_perer.'",'.$this->perer_gkal.', "'.$this->info.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererOrgDt":			
			   $this->sql='CALL OSBB.input_perer_org_square_dteplomera('.$this->house_id.','.$this->dteplomer_id.','.$this->filial_id.', "'.$this->data.'" ,'.$this->newValueDayDt.','.$this->newValueSquareDt.', "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererDteplomer":			
			   $this->sql='CALL OSBB.input_perer_gkal_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'" ,'.$this->newValueSquareDt.','.$this->gkal.',"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererDteplomerOut":			
			   $this->sql='CALL OSBB.input_perer_gkal_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'" ,'.$this->newValueSquareDt.','.$this->gkal.',"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererOtoplenieSquare":			
			   $this->sql='CALL OSBB.PererOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->data.'" ,"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;

		}
		
		//print($this->sql);
//		$this->result = $_db->query($this->sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);


		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}
			
		return $this->results;
;
	}
/*	public function __destruct()
	{
		$_db = $this->connect($this->login,$this->password);
		$_db->close();
		
		return $this;
	}*/
}