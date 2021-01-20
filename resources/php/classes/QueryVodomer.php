<?php
include_once './yis_config.php';

class QueryVodomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $address_id;
	protected $what;
	protected $vodomer_id;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $pok_id;	
	protected $type;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $st;
	protected $kub;
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

		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$value;}
		  }
		}
	      
//==================КВАРТИРНЫЕ ВОДОМЕРЫ=============================//

		switch ($this->what) {
			
			case "TekPokVodomeraKassa":	
			      switch ($this->type) {
			      case "Хвода":
			      $this->sql='SELECT "Хвода" as type,t2.pok_id,t2.vodomer_id,t2.tek,t2.pred,t2.kub,t2.data,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.WATER  as t2 WHERE t2.vodomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			      break;
			       case "Гвода":
			      $this->sql='SELECT "Гвода" as type,t2.pok_id,t2.vodomer_id,t2.tek,t2.pred,t2.kub,t2.data,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.WATER  as t2 WHERE t2.vodomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			      break;
			       case "ENERG":
			      $this->sql='SELECT "ENERG" as type,t2.pok_id,t2.energomer_id as vodomer_id,t2.tek,t2.pred,t2.kwh as kub,t2.data,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.PENERGOMER  as t2 WHERE t2.energomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			      break;
			       case "TEPLO":
			      $this->sql='SELECT "TEPLO" as type,t2.pok_id,t2.teplomer_id as vodomer_id,t2.tek,t2.pred,t2.qty as kub,t2.data,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.PTEPLOMER  as t2 WHERE t2.teplomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			      break;
			      }

			break;
			case "TekPokVodomera":			
			      $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.VODOMER as t1,'.$this->base.'.WATER  as t2 '
					  .' WHERE t1.vodomer_id='.$this->vodomer_id.' AND t2.vodomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
					  					//  print($this->sql);

			break;
			
			case "TekPokWater":			
			      $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.VODOMER  as t1,'.$this->base.'.WATER as t2 '
					  .' WHERE t1.vodomer_id='.$this->vodomer_id.' AND t2.pok_id='.$this->pok_id.' limit 1';
		
			break;
			case "AllPokVodomera":			
				$this->sql='SELECT t1.*,t1.data as fdate FROM '.$this->base.'.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 4 ';
				//	  print($this->sql);
			break;
		     case "AllPokVodomeraAll":
				$this->sql='SELECT t1.*,t1.data as fdate FROM '.$this->base.'.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  ';

			break;

			case "AppVodomer"://применяется
				  $this->sql='SELECT t2.*,t1.vodomer_id FROM '.$this->base.'.AVODOMER as t1 LEFT JOIN '.$this->base.'.VODOMER  as t2 USING (vodomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=0  ORDER BY t2.vodomer_id DESC';
					// print($this->sql); 
			break;
			
			case "AppHVodomer"://применяется
				  $this->sql='SELECT t2.*,t1.vodomer_id FROM '.$this->base.'.AVODOMER as t1 LEFT JOIN '.$this->base.'.VODOMER  as t2 USING (vodomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=1  ORDER BY t2.vodomer_id DESC';
					
			break;	
			
			case "ExistentVodomer"://применяется
				  $this->sql='SELECT t1.`vodomer_id`,t1.`nomer` FROM '.$this->base.'.VODOMER  as t1'
					    .' WHERE t1.`house_id`='.$this->house_id.' AND t1.`joint`=1'
					    .' ORDER BY t1.`nomer` ';
					  // print($this->sql); 
			break;
			 case "AllWaterHouseRaion"://применяется	
			    $this->sql='SELECT *  FROM '.$this->base.'.WATERHOUSE as t1 WHERE  t1.raion_id ='.$this->raion_id.' AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
					//print_r($this->sql); 
			  break;
			

		} // End of Switch ($what)	      StWaterHouse
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'( '.$this->sql.' )' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}
	public function addVodomer(stdClass $params)
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
					else {$this->$key =$value;}
		  }
		}

		switch ($this->what) {
			case "addAppVodomer":
			    $this->sql='CALL '.$this->base.'.add_avodomer("'
							    .$this->joint.'","'
							    .$this->joint_id.'","'
							    .$this->address_id.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->zplomba.'","'
							    .$this->nomer.'" ,"'
							    .$this->model_id.'","'
							    .$this->place.'","'
							    .$this->position.'","'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'",'
							    .'@vodomer_id,@success,@msg)';
//print($this->sql);

			break;
			case "editAppVodomer":			
			      $this->sql='CALL '.$this->base.'.edit_avodomer("'							  
							    .$this->vodomer_id.'","'
							    .$this->joint.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->zplomba.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'", "'
							    .$this->position.'","'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'", '
							    .'@success,@msg)';
//print($this->sql);
			break;	
			case "changeAppVodomer":			
			    $this->sql='CALL '.$this->base.'.change_avodomer('.$this->new_address_id.','.$this->address_id.','.$this->vodomer_id.','.'@success,@msg)';
			break;	
			
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);

		
		$this->sql_callback='SELECT @vodomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['vodomer_id'] = $this->row['@vodomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	}
	 public function updateVodomer(stdClass $params)
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

		

		switch ($this->what) {
			
		
			
			case "all_nach_norma_voda_kv":
			       $this->sql='CALL '.$this->base.'.all_nach_norma_voda_kv(@success,@msg)';				    
			break;
			case "all_nach_norma_podogrev_kv":
			       $this->sql='CALL '.$this->base.'.all_nach_norma_podogrev_kv(@success,@msg)';				    
			break;

			case "AddMeedlePokVod":
			$this->sql='CALL '.$this->base.'.AddMeedlePokVod('.$this->vodomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@date_st,@date_fin,@pok_do,@pok_ot,@rday,@mday,@qty_kub,@kub_day,@kubov,@success,@msg)';
			break;
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @date_st,@date_fin,@pok_do,@pok_ot,@rday,@mday,@qty_kub,@kub_day,@kubov,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
			$this->results['date_st'] = $this->row['@date_st'];
			$this->results['date_fin']	=$this->row['@date_fin'];
			$this->results['pok_ot'] = $this->row['@pok_ot'];
			$this->results['pok_do']	=$this->row['@pok_do'];
			$this->results['rday'] = $this->row['@rday'];
			$this->results['mday']	=$this->row['@mday'];
			$this->results['qty_kub'] = $this->row['@qty_kub'];
			$this->results['kub_day'] = $this->row['@kub_day'];
			$this->results['kubov']	=$this->row['@kubov'];
		}			
		return $this->results;

	  }

	public function delVodomer(stdClass $params)
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
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.del_avodomer('.$this->vodomer_id.',@success,@msg)';

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
		public function spisanVodomer(stdClass $params)
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
		
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.spisan_avodomer('.$this->vodomer_id.',@success,@msg)';
			break;
			case "AVodomerBack":
			      $this->sql='CALL '.$this->base.'.back_spisan_avodomer('.$this->vodomer_id.',@success,@msg)';
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

public function inVodomerHistory(stdClass $params)
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
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.in_avodomer_history('.$this->vodomer_id.',@success,@msg)';
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
public function outVodomerHistory(stdClass $params)
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
		
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.out_avodomer_history('.$this->vodomer_id.',@success,@msg)';
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

public function delPokVodomera(stdClass $params)
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

		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_avodomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
			break;
			case "AVodomerKassa":
			switch ($this->type) {
			      case "Хвода":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_avodomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
			      			//print($this->sql);

			      break;
			       case "Гвода":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_avodomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
			      			//print($this->sql);

			      break;
			       case "ENERG":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_aenergomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
			      //print($this->sql);
			      break;
			       case "TEPLO":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_ateplomera('.$this->pok_id.',@success,@msg)';
			      //print($this->sql);
			      break;
			      }
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
	public function newPokVodomera(stdClass $params)
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
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_avodomer('.$this->vodomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
			//print($this->sql);

			break;
			case "AVodomerKassa":
			switch ($this->type) {
			      case "Хвода":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_avodomer('.$this->vodomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
			      			//print($this->sql);

			      break;
			       case "Гвода":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_avodomer('.$this->vodomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
			      			//print($this->sql);

			      break;
			       case "ENERG":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_aenergomera('.$this->vodomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
			      			//print($this->sql);
			      break;
			        case "TEPLO":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_ateplomera('.$this->vodomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
			      			//print($this->sql);
			      break;
			      }
			break;      
			case "insHandApp":			
			      $this->sql='CALL '.$this->base.'.input_hand_pokaz_avodomer('
										    .$this->vodomer_id.','
										   .$this->address_id.','
										    .'"'.$this->type.'",'
										    .$this->tek.','
										    .$this->newKubov
										    .',@success,@msg)';
			break;
			case "insMeedlePokVod":			
			      $this->sql='CALL '.$this->base.'.insMeedlePokVod('.$this->vodomer_id.','.$this->address_id.','.'"'.$this->type.'","'.$this->tek.'","'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->date_st.'","'.$this->date_fin.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->mday.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
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

}