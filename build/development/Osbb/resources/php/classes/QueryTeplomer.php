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
					.'YISGRAND.TEPLOMER.filial_id,'
					.'YISGRAND.TEPLOMER.teplomer_id,'
					.'YISGRAND.TEPLOMER.dteplomer_id,'
					.'YISGRAND.TEPLOMER.house_id,'
					.'YISGRAND.TEPLOMER.address,'
					.'YISGRAND.TEPLOMER.nomer,'
					.'YISGRAND.TEPLOMER.model_id,'
					.'YISGRAND.TEPLOMER.model,'
					.'YISGRAND.TEPLOMER.koef,'
					.'YISGRAND.TEPLOMER.area,'
					.'YISGRAND.TEPLOMER.edizm, '
					.'YISGRAND.TEPLOMER.sdate,'
					.'YISGRAND.TEPLOMER.pdate,'
					.'YISGRAND.TEPLOMER.note, '
					.'YISGRAND.TEPLOMER.out, '
					.'YISGRAND.TEPLOMER.operator '
					.' FROM YISGRAND.TEPLOMER '
					.' WHERE YISGRAND.TEPLOMER.filial_id='.$this->filial_id.' '
					.' AND YISGRAND.TEPLOMER.spisan=0 ';
					//print($this->sql); 
			break;
			case "OrgHTeplomer"://применяется
				  $this->sql='SELECT '
					.'YISGRAND.TEPLOMER.filial_id,'
					.'YISGRAND.TEPLOMER.teplomer_id,'
					.'YISGRAND.TEPLOMER.dteplomer_id,'
					.'YISGRAND.TEPLOMER.house_id,'
					.'YISGRAND.TEPLOMER.address,'
					.'YISGRAND.TEPLOMER.nomer,'
					.'YISGRAND.TEPLOMER.model_id,'
					.'YISGRAND.TEPLOMER.model,'
					.'YISGRAND.TEPLOMER.koef,'
					.'YISGRAND.TEPLOMER.area,'
					.'YISGRAND.TEPLOMER.edizm, '
					.'YISGRAND.TEPLOMER.sdate,'
					.'YISGRAND.TEPLOMER.pdate,'
					.'YISGRAND.TEPLOMER.data_spis as data_spis,'
					.'YISGRAND.TEPLOMER.note, '
					.'YISGRAND.TEPLOMER.out, '
					.'YISGRAND.TEPLOMER.operator '
					.' FROM YISGRAND.TEPLOMER '
					.' WHERE YISGRAND.TEPLOMER.filial_id='.$this->filial_id.' '
					.' AND YISGRAND.TEPLOMER.spisan=1 ';
					//print($this->sql);
					
			break;	
			      case "TekPokOrgTeplomera":			
			      $this->sql='SELECT '
					.'YISGRAND.TEPLOMER.teplomer_id,'
					.'YISGRAND.TEPLOMER.dteplomer_id,'
					.'YISGRAND.TEPLOMER.filial_id,'
					.'YISGRAND.TEPLOMER.house_id,'					
					.'YISGRAND.TEPLOMER.nomer,'
					.'YISGRAND.TEPLOMER.model_id,'
					.'YISGRAND.TEPLOMER.model,'
					.'YISGRAND.TEPLOMER.edizm,'
					.'YISGRAND.TEPLOMER.out,'
					.'YISGRAND.TEPLOMER.sdate,'
					.'YISGRAND.TEPLOMER.pdate,'
					.'YISGRAND.PTEPLOMER.pok_id,'
					.'YISGRAND.PTEPLOMER.data,'
					.'YISGRAND.PTEPLOMER.data as fdate,'
					.'YISGRAND.PTEPLOMER.pred,'
					.'YISGRAND.PTEPLOMER.tek as tekp,'
					.'YISGRAND.PTEPLOMER.tek,'
					.'YISGRAND.PTEPLOMER.qty,'
					.'YISGRAND.PTEPLOMER.koef,'
					.'YISGRAND.PTEPLOMER.gkal,'
					.'YISGRAND.PTEPLOMER.tarif,'
					.'YISGRAND.PTEPLOMER.area,'
					.'YISGRAND.PTEPLOMER.gkm2,'
					.'YISGRAND.PTEPLOMER.otoplenie,'
					.'YISGRAND.PTEPLOMER.operator '
					.' FROM YISGRAND.TEPLOMER ,YISGRAND.PTEPLOMER '
					.' WHERE YISGRAND.TEPLOMER.teplomer_id='.$this->teplomer_id.''					
					.' AND YISGRAND.PTEPLOMER.teplomer_id='.$this->teplomer_id.' '
					.' ORDER BY YISGRAND.PTEPLOMER.pok_id DESC  limit 1 ';
					//print($this->sql);
			break;
			case "AllPokOrgTeplomera":			
				 $this->sql='SELECT * FROM YISGRAND.PTEPLOMER '		
					.' WHERE YISGRAND.PTEPLOMER.teplomer_id='.$this->teplomer_id.''
					.' ORDER BY YISGRAND.PTEPLOMER.pok_id DESC   ';
			break;
			case "TekNachOrgTeplomera":			  
			   $this->sql='SELECT filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,'
				  .'"Гкал" as edizm,gkal as qty,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno,dolg FROM YISGRAND.OTOPLENIE WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ';
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
					.'YISGRAND.TM_ORG_FILIAL.filial_id,'
					.'YISGRAND.TM_ORG_FILIAL.fname as name,'
					.'YISGRAND.TM_ORG_FILIAL.area,'
					.'YISGRAND.TM_ORG_FILIAL.visota, '
					.'YISGRAND.TM_ORG_FILIAL.volume, '
					.'YISGRAND.TM_ORG_FILIAL.people, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_otopl, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_xvoda, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_stoki, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_gvoda, '
					.'YISGRAND.TM_ORG_FILIAL.gvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.xvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.teplomer, '
					.'YISGRAND.TM_ORG_FILIAL.dteplomer, '
					.'YISGRAND.TM_ORG_FILIAL.dteplomer_id, '
					.'YISGRAND.TM_ORG_FILIAL.dvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.dvodomer_id, '
					.'YISGRAND.TM_ORG_FILIAL.gkal_y_ot, '
					.'YISGRAND.TM_ORG_FILIAL.nrx_gvs_d, '
					.'YISGRAND.TM_ORG_FILIAL.tarif_ot, '
					.'YISGRAND.TM_ORG_FILIAL.tarif_gv, '
					.'(SELECT YISGRAND.OTOPLENIE.gkal FROM YISGRAND.OTOPLENIE '
					.' WHERE YISGRAND.OTOPLENIE.filial_id =YISGRAND.TM_ORG_FILIAL.filial_id '
					.' ORDER BY YISGRAND.OTOPLENIE.data DESC LIMIT 1 ) as gkal,  '
					.'(SELECT YISGRAND.PODOGREV.`gkal` FROM YISGRAND.PODOGREV '
					.' WHERE YISGRAND.PODOGREV.filial_id = YISGRAND.TM_ORG_FILIAL.filial_id '
					.' ORDER BY YISGRAND.PODOGREV.data DESC LIMIT 1 ) as gkal_podogrev  '
					.' FROM YISGRAND.TM_ORG_FILIAL '
					.' WHERE YISGRAND.TM_ORG_FILIAL.house_id ='.$this->house_id.' '
					.' AND YISGRAND.TM_ORG_FILIAL.dteplomer_id ='.$this->dteplomer_id.'';
					//print_r($this->sql); 
			  break;
			  case "AllOrgByHouse":// применяется	
			    $this->sql='SELECT '
					.'YISGRAND.TM_ORG_FILIAL.filial_id,'
					.'YISGRAND.TM_ORG_FILIAL.fname as name,'
					.'YISGRAND.TM_ORG_FILIAL.area,'
					.'YISGRAND.TM_ORG_FILIAL.visota, '
					.'YISGRAND.TM_ORG_FILIAL.volume, '
					.'YISGRAND.TM_ORG_FILIAL.people, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_otopl, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_xvoda, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_stoki, '
					.'YISGRAND.TM_ORG_FILIAL.vkl_gvoda, '
					.'YISGRAND.TM_ORG_FILIAL.gvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.xvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.teplomer, '
					.'YISGRAND.TM_ORG_FILIAL.dteplomer, '
					.'YISGRAND.TM_ORG_FILIAL.dteplomer_id, '
					.'YISGRAND.TM_ORG_FILIAL.dvodomer, '
					.'YISGRAND.TM_ORG_FILIAL.dvodomer_id, '
					.'YISGRAND.TM_ORG_FILIAL.gkal_y_ot, '
					.'YISGRAND.TM_ORG_FILIAL.nrx_gvs_d, '
					.'YISGRAND.TM_ORG_FILIAL.tarif_ot, '
					.'YISGRAND.TM_ORG_FILIAL.tarif_gv, '
					.'(SELECT YISGRAND.OTOPLENIE.gkal FROM YISGRAND.OTOPLENIE '
					.' WHERE YISGRAND.OTOPLENIE.filial_id =YISGRAND.TM_ORG_FILIAL.filial_id '
					.' ORDER BY YISGRAND.OTOPLENIE.data DESC LIMIT 1 ) as gkal,  '
					.'(SELECT YISGRAND.PODOGREV.`gkal` FROM YISGRAND.PODOGREV '
					.' WHERE YISGRAND.PODOGREV.filial_id = YISGRAND.TM_ORG_FILIAL.filial_id '
					.' ORDER BY YISGRAND.PODOGREV.data DESC LIMIT 1 ) as gkal_podogrev  '
					.' FROM YISGRAND.TM_ORG_FILIAL '
					.' WHERE YISGRAND.TM_ORG_FILIAL.house_id ='.$this->house_id.''
					.' AND (YISGRAND.TM_ORG_FILIAL.dteplomer_id ='.$this->dteplomer_id.' OR YISGRAND.TM_ORG_FILIAL.dteplomer_id =0)';
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
			     $this->sql='CALL YISGRAND.in_ateplomer_history('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "OTeplomer":			
			     $this->sql='CALL YISGRAND.in_oteplomer_history('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "Dteplomer":			
			     $this->sql='CALL YISGRAND.in_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
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
			     $this->sql='CALL '.$this->base.'.out_ateplomer_history('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			break;
			case "OTeplomer":			
			    $this->sql='CALL YISGRAND.out_oteplomer_history('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
		//print($this->sql);
			break;
			case "Dteplomer":			
			    $this->sql='CALL YISGRAND.out_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
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
			      $this->sql='CALL YISGRAND.add_ateplomer('.$this->address_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '
			      .$this->koef.', "'.$this->edizm.'", @teplomer_id, @success, @msg)';
			 //  print($this->sql);
			break;
	    case "editAppTeplomer":			
			    $this->sql='CALL YISGRAND.edit_ateplomer('.$this->teplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.',"'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "changeAppTeplomer":			
			    $this->sql='CALL YISGRAND.change_ateplomer('.$this->teplomer_id.','.$this->address_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "addOrgTeplomer":			
			    $this->sql='CALL YISGRAND.add_oteplomer('.$this->filial_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "changeOrgTeplomer":			
			    $this->sql='CALL YISGRAND.change_oteplomer('.$this->teplomer_id.','
			    .$this->filial_id.',"'.$this->sdate.'","'.$this->pdate.'", "'.$this->nomer.'", '.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;

			case "editOrgTeplomer":			
			    $this->sql='CALL YISGRAND.edit_oteplomer('.$this->teplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.', '.$this->tek.', '.$this->koef.', "'
			      .$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;

		

			case "change_DTeplomer":			
			   $this->sql='CALL YISGRAND.change_dteplomer('.$this->house_id.','.$this->dteplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','.$this->tek.','
							    .$this->koef.',"'.$this->edizm.'",@teplomer_id,@success,@msg)';
			   // print($this->sql);
			break;
			
			case "add_DTeplomer":			
			   $this->sql='CALL YISGRAND.add_dteplomer('.$this->house_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','
							    .'"'.$this->vvod.'",'.$this->allapp.','.$this->first_app.','.$this->last_app.', '.$this->tek.','
							    .$this->koef.',"'.$this->edizm.'", @teplomer_id,@success,@msg)';
			   // print($this->sql);
			break;

			case "edit_DTeplomer":			
			   $this->sql='CALL YISGRAND.edit_dteplomer('.$this->dteplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','
							    .'"'.$this->vvod.'",'.$this->allapp.','.$this->first_app.','.$this->last_app.','.$this->tek.','.$this->koef.',"'.$this->edizm.'", @teplomer_id,@success,@msg)';
			  // print($this->sql);
			break;

			case "addMop":	
			      $this->sql='CALL YISGRAND.add_update_mop('.$this->mop_id.','.$this->house_id.','.$this->dteplomer_id.','.$this->mopid.', '
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
			$this->sql='CALL YISGRAND.del_oteplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "OTeplomer":			
			$this->sql='CALL YISGRAND.spisan_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "DelOTeplomer":			
			$this->sql='CALL YISGRAND.del_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "Dteplomer":			
			 $this->sql='CALL YISGRAND.del_dteplomer('.$this->dteplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "delMop":			
			 $this->sql='CALL YISGRAND.del_mop('.$this->mop_id.',@success,@msg)';
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
			     $this->sql='CALL YISGRAND.delete_pokaz_ateplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
	    		case "OTeplomer":			
			     $this->sql='CALL YISGRAND.delete_pokaz_oteplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
			case "Dteplomer":			
			   $this->sql='CALL YISGRAND.delete_pokaz_dteplomera('.$this->pok_id.','.$this->house_id.','.$this->dteplomer_id.',@success,@msg)';
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

		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		
		 if(isset($params->tek) && ($params->tek)) {
		 $this->tek = $params->tek;
		} else {
		  $this->tek = 0;
		}
	 if(isset($params->temp) && ($params->temp)) {
		 $this->temp = $params->temp;
		} else {
		  $this->temp = 0;
		}
		 if(isset($params->newValue) && ($params->newValue)) {
		 $this->newValue = $params->newValue;
		} else {
		  $this->newValue = 0;
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
		if(isset($params->house_id) && ($params->house_id)) {
		  $this->house_id = (int) $params->house_id;
		} else {
		  $this->house_id = 0;
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
	      if(isset($params->day_ot) && ($params->day_ot)) {
		  $this->day_ot= (int) $params->day_ot;
		} else {
		  $this->day_ot= 0;
		}
		if(isset($params->date_ot) && ($params->date_ot)) {
		 $this->date_ot = $params->date_ot;
		} else {
		  $this->date_ot =  '00000000';
		}
		if(isset($params->date_to) && ($params->date_to)) {
		 $this->date_to = $params->date_to;
		} else {
		  $this->date_to =  '00000000';
		}
		if(isset($params->ldate_ot) && ($params->ldate_ot)) {
		 $this->ldate_ot = $params->ldate_ot;
		} else {
		  $this->ldate_ot =  '00000000';
		}
		if(isset($params->ldate_to) && ($params->ldate_to)) {
		 $this->ldate_to = $params->ldate_to;
		} else {
		  $this->ldate_to =  '00000000';
		}
		if(isset($params->newValueDayDt) && ($params->newValueDayDt)) {
		  $this->newValueDayDt= (int) $params->newValueDayDt;
		} else {
		  $this->newValueDayDt= 0;
		}
		if(isset($params->day_gv) && ($params->day_gv)) {
		  $this->day_gv= (int) $params->day_gv;
		} else {
		  $this->day_gv= 0;
		}
		if(isset($params->new_day_dt) && ($params->new_day_dt)) {
		  $this->new_day_dt= (int) $params->new_day_dt;
		} else {
		  $this->new_day_dt= 0;
		}
	      if(isset($params->date_in) && ($params->date_in)) {
		  $this->data_tek =preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params->date_in);
		} else {
		  $this->data_tek= '00000000';
		}
	      if(isset($params->date_ot) && ($params->date_ot)) {
		  $this->data_hh =preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params->date_ot);
		} else {
		  $this->data_hh= '00000000';
		}
		 if(isset($params->koef) && ($params->koef)) {
		 $this->koef = $params->koef;
		} else {
		  $this->koef = 0;
		}

		if(isset($params->zadol) && ($params->zadol)) {
		 $this->zadol = $params->zadol;
		} else {
		  $this->zadol = 0;
		}
		if(isset($params->note) && ($params->note)) {
		 $this->note = $params->note;
		} else {
		  $this->note = '';
		}
		if(isset($params->info) && ($params->info)) {
			$this->info = $params->info;
		 $this->info = $params->info;
		} else {
		  $this->info = '';
		}
		if(isset($params->data) && ($params->data)) {
		 $this->data = $params->data;
		} else {
		  $this->data = '';
		}
		if(isset($params->date_pred) && ($params->date_pred)) {
		 $this->data_pred = preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params->date_pred);
		} else {
		  $this->data_pred = '00000000';
		}
	if(isset($params->data_perer) && ($params->data_perer)) {
		 $this->data_perer = $params->data_perer;
		} else {
		  $this->data_perer = '00000000';
		}
		if(isset($params->gkal) && ($params->gkal)) {
		 $this->gkal = $params->gkal;
		} else {
		  $this->gkal = 0;
		}
	if(isset($params->perer_gkal) && ($params->perer_gkal)) {
		 $this->perer_gkal = $params->perer_gkal;
		} else {
		  $this->perer_gkal = 0;
		}
		if(isset($params->tarif) && ($params->tarif)) {
		 $this->tarif = $params->tarif;
		} else {
		  $this->tarif = 0;
		}
		if(isset($params->newValueSquareDt) && ($params->newValueSquareDt)) {
		 $this->newValueSquareDt = $params->newValueSquareDt;
		} else {
		  $this->newValueSquareDt = 0;
		}

		/*NewPokTeplomera*/
		switch ($this->what) {
			case "ATeplomer":			
			    $this->sql='CALL YISGRAND.input_new_pokaz_ateplomera('.$this->address_id.', '.$this->teplomer_id.','.$this->tek.','
									     .$this->newValue.', @success,@msg)';
		//print($this->sql);
			break;
			case "insTekPokOrgTepl":			
			    $this->sql='CALL YISGRAND.input_new_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.','
										  .$this->tek.','.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;

			case "insHandOrgTepl":			
			    $this->sql='CALL YISGRAND.input_hand_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.','
										  .$this->tek.','.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;


			case "Dteplomer":			
			  $this->sql='CALL YISGRAND.input_new_pokaz_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'","'.$this->data_tek.'","'.$this->ldate_ot.'","'.$this->ldate_to.'","'.$this->tek.'","'.$this->newValue.'",@success,@msg)';
		//print($this->sql);
			break;

			case "HeatHouse":			
			   $this->sql='CALL YISGRAND.input_new_pokaz_heathouse_do_m2('.$this->dteplomer_id.','.$this->house_id.',"'.$this->day_ot.'",'.$this->temp.',@success,@msg)';
		//print($this->sql);
			break;
		      case "NachOtoplenieSquare":			
			   $this->sql='CALL YISGRAND.NachOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->date_ot.'","'.$this->date_to.'",'.$this->temp.',@success,@msg)';
		//print($this->sql);
			break;
			case "Middle":			
			   $this->sql='CALL YISGRAND.input_new_pokaz_middle('.$this->house_id.','.$this->dteplomer_id.','.$this->day_middle.',@success,@msg)';
		//print($this->sql);
			break;

			case "HotWater":			
			   $this->sql='CALL YISGRAND.nachisl_gvs_house('.$this->house_id.','.$this->dteplomer_id.',"'.$this->day_gv.'", @success, @msg)';
	//	print($this->sql);
			break;

			
			case "SaldoOtoplOrg":			
			   $this->sql='UPDATE YISGRAND.OTOPLENIE SET `zadol` = '.$this->zadol.', `dolg` = '.$this->zadol.'+`nachisleno`-`oplacheno` WHERE filial_id = '.$this->filial_id.' AND EXTRACT(YEAR_MONTH FROM `data`) = EXTRACT(YEAR_MONTH FROM curdate())';
		//print($this->sql);
			break;
			case "PererOrgGkal":			
			   $this->sql='CALL YISGRAND.input_perer_org_gkal('.$this->filial_id.',"'.$this->data.'","'.$this->tarif.'", "'.$this->newValue.'", "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
		case "AppOtopleniePererIns":			
			   $this->sql='CALL '.$this->base.'.input_perer_app_gkal('.$this->address_id.',"'.$this->data_perer.'",'.$this->perer_gkal.', "'.$this->info.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererOrgDt":			
			   $this->sql='CALL YISGRAND.input_perer_org_square_dteplomera('.$this->house_id.','.$this->dteplomer_id.','.$this->filial_id.', "'.$this->data.'" ,'.$this->newValueDayDt.','.$this->newValueSquareDt.', "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererDteplomer":			
			   $this->sql='CALL YISGRAND.input_perer_gkal_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'" ,'.$this->newValueSquareDt.','.$this->gkal.',"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererDteplomerOut":			
			   $this->sql='CALL YISGRAND.input_perer_gkal_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data.'" ,'.$this->newValueSquareDt.','.$this->gkal.',"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererOtoplenieSquare":			
			   $this->sql='CALL YISGRAND.PererOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->data.'" ,"'.$this->note.'",@success,@msg)';
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