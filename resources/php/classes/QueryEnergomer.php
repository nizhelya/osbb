<?php
include_once './yis_config.php';

class QueryEnergomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $address_id;
	protected $what;
	protected $energomer_id;
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
	      
//==================КВАРТИРНЫЕ энергосчетчики=============================//

		switch ($this->what) {
			case "TekPokEnergomera":			
			      $this->sql='SELECT t1.*,t2.*,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.ENERGOMER as t1,'.$this->base.'.PENERGOMER as t2 '
					  .' WHERE t1.energomer_id='.$this->energomer_id.' AND t2.energomer_id='.$this->energomer_id.' ORDER BY t2.pok_id DESC limit 1';
			break;
			
			case "TekPokEnergomer":			
			      $this->sql='SELECT t1.*,t2.*,t2.data as fdate,t2.tek as tekp  FROM '.$this->base.'.ENERGOMER as t1,'.$this->base.'.PENERGOMER as t2 '
					  .' WHERE t1.energomer_id='.$this->energomer_id.' AND t2.pok_id='.$this->pok_id.' limit 1';
		
			break;
			case "AllPokEnergomera":			
			  $this->sql='SELECT t1.*,t1.data as fdate  FROM '.$this->base.'.PENERGOMER  as t1  WHERE '
			  .' t1.energomer_id='.$this->energomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 4 ';
				//	  print($this->sql);
			break;
		        case "AllPokEnergomeraAll":			
			  $this->sql='SELECT t1.*,t1.data as fdate  FROM '.$this->base.'.PENERGOMER  as t1  WHERE '
			  .' t1.energomer_id='.$this->energomer_id.'  ORDER BY t1.pok_id DESC  ';
				//	  print($this->sql);
			break;

			
			
			case "AppEnergomer"://применяется
			   $this->sql='SELECT t2.*,t1.energomer_id FROM '.$this->base.'.AENERGOMER as t1 LEFT JOIN '.$this->base.'.ENERGOMER  as t2 USING (energomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=0  ORDER BY t2.energomer_id DESC';
					 //print($this->sql); 
			break;
			
			
			case "AppHEnergomer"://применяется
				  $this->sql='SELECT t2.*,t1.energomer_id FROM '.$this->base.'.AENERGOMER as t1 LEFT JOIN '.$this->base.'.ENERGOMER as t2 USING (energomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=1  ORDER BY t1.energomer_id DESC';
					
			break;	
			
			case "ExistentEnergomer"://применяется
			    $this->sql='SELECT t1.`energomer_id`,t1.`nomer` FROM '.$this->base.'.ENERGOMER  as t1 WHERE t1.`house_id`='.$this->house_id.' AND t1.`joint`=1 ORDER BY t1.`nomer` ';
					  // print($this->sql); 
			break;
			

		} // End of Switch ($what)	      StWaterHouse
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'( '.$this->sql.' )' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}
	public function addEnergomer(stdClass $params)
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
			case "addAppEnergomer":
			    $this->sql='CALL '.$this->base.'.add_aenergomer("'
							    .$this->joint.'","'
							    .$this->joint_id.'","'
							    .$this->address_id.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->zplomba.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'","'
							    .$this->tek.'",'
							    .'@energomer_id,@success,@msg)';
//print($this->sql);

			break;
			case "editAppEnergomer":			
			      $this->sql='CALL '.$this->base.'.edit_aenergomer("'							  
							    .$this->energomer_id.'","'
							    .$this->joint.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->zplomba.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'", "'							  
							    .$this->tek.'", '
							    .'@success,@msg)';
//print($this->sql);
			break;	
			case "changeAppEnergomer":			
			    $this->sql='CALL '.$this->base.'.change_aenergomer('.$this->new_address_id.','.$this->address_id.','.$this->energomer_id.','.'@success,@msg)';
			break;	             
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);

		
		$this->sql_callback='SELECT @energomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['energomer_id'] = $this->row['@energomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	}
	 public function updateEnergomer(stdClass $params)
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
			case "AddMeedlePokEnergomera":
			$this->sql='CALL '.$this->base.'.AddMeedlePokEnergomera('.$this->energomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@date_st,@date_fin,@pok_do,@pok_ot,@rday,@mday,@qty_kwh,@kwh_day,@kwh,@success,@msg)';
			break;
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @date_st,@date_fin,@pok_do,@pok_ot,@rday,@mday,@qty_kwh,@kwh_day,@kwh,@success,@msg';

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
			$this->results['qty_kwh'] = $this->row['@qty_kwh'];
			$this->results['kwh_day'] = $this->row['@kwh_day'];
			$this->results['kwh']	=$this->row['@kwh'];
		}			
		return $this->results;

	  }

	public function delEnergomer(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.del_aenergomer('.$this->energomer_id.',@success,@msg)';

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
		public function spisanEnergomer(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.spisan_aenergomer('.$this->energomer_id.',@success,@msg)';
			break;
			case "AEnergomerBack":
			      $this->sql='CALL '.$this->base.'.back_spisan_aenergomer('.$this->energomer_id.',@success,@msg)';
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

public function inEnergomerHistory(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.in_aenergomer_history('.$this->energomer_id.',@success,@msg)';
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
public function outEnergomerHistory(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.out_aenergomer_history('.$this->energomer_id.',@success,@msg)';
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

public function delPokEnergomera(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_aenergomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
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
	public function newPokEnergomer(stdClass $params)
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
			case "AEnergomer":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_aenergomera('.$this->energomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->prev.'",@success,@msg)';
//print($this->sql);

			break;
			
			
			case "insMeedlePokEnergomera":			
			      $this->sql='CALL '.$this->base.'.insMeedlePokEnergomera('.$this->energomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newKwh.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->date_st.'","'.$this->date_fin.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->mday.'","'.$this->qty_kwh.'","'.$this->kwh_day.'",@success,@msg)';
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