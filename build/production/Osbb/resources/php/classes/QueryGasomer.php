<?php
include_once './yis_config.php';

class QueryGasomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $address_id;
	protected $what;
	protected $gasomer_id;
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
			case "TekPokGasomera":			
			      $this->sql='SELECT t1.*,t2.*,t2.data as fdate,t2.tek as tekp FROM '.$this->base.'.GASOMER as t1,'.$this->base.'.PGASOMER as t2 '
					  .' WHERE t1.gasomer_id='.$this->gasomer_id.' AND t2.gasomer_id='.$this->gasomer_id.' ORDER BY t2.pok_id DESC limit 1';
			break;
			
			case "TekPokGasomer":			
			      $this->sql='SELECT t1.*,t2.*,t2.data as fdate,t2.tek as tekp  FROM '.$this->base.'.GASOMER as t1,'.$this->base.'.PGASOMER as t2 '
					  .' WHERE t1.gasomer_id='.$this->gasomer_id.' AND t2.pok_id='.$this->pok_id.' limit 1';
		
			break;
			case "AllPokGasomera":			
			  $this->sql='SELECT t1.*,t1.data as fdate  FROM '.$this->base.'.PGASOMER  as t1  WHERE '
			  .' t1.gasomer_id='.$this->gasomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 4 ';
				//	  print($this->sql);
			break;
		        case "AllPokGasomeraAll":			
			  $this->sql='SELECT t1.*,t1.data as fdate  FROM '.$this->base.'.PGASOMER  as t1  WHERE '
			  .' t1.gasomer_id='.$this->gasomer_id.'  ORDER BY t1.pok_id DESC  ';
				//	  print($this->sql);
			break;

			
			
			case "AppGasomer"://применяется
			   $this->sql='SELECT t2.*,t1.gasomer_id FROM '.$this->base.'.AGASOMER as t1 LEFT JOIN '.$this->base.'.GASOMER  as t2 USING (gasomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=0  ORDER BY t2.gasomer_id DESC';
					 //print($this->sql); 
			break;
			
			
			case "AppHGasomer"://применяется
				  $this->sql='SELECT t2.*,t1.gasomer_id FROM '.$this->base.'.AGASOMER as t1 LEFT JOIN '.$this->base.'.GASOMER as t2 USING (gasomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=1  ORDER BY t1.gasomer_id DESC';
					
			break;	
			
			case "ExistentGasomer"://применяется
			    $this->sql='SELECT t1.`gasomer_id`,t1.`nomer` FROM '.$this->base.'.GASOMER  as t1 WHERE t1.`house_id`='.$this->house_id.' AND t1.`joint`=1 ORDER BY t1.`nomer` ';
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
	public function addGasomer(stdClass $params)
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
			case "addAppGasomer":
			    $this->sql='CALL '.$this->base.'.add_agasomer("'
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
							    .'@gasomer_id,@success,@msg)';
//print($this->sql);

			break;
			case "editAppGasomer":			
			      $this->sql='CALL '.$this->base.'.edit_agasomer("'							  
							    .$this->gasomer_id.'","'
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
			case "changeAppGasomer":			
			    $this->sql='CALL '.$this->base.'.change_agasomer('.$this->new_address_id.','.$this->address_id.','.$this->gasomer_id.','.'@success,@msg)';
			break;	             
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);

		
		$this->sql_callback='SELECT @gasomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['gasomer_id'] = $this->row['@gasomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	}
	 public function updateGasomer(stdClass $params)
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
			
					
			case "AddMeedlePokGasomera":
			$this->sql='CALL '.$this->base.'.AddMeedlePokGasomera('.$this->gasomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@date_st,@date_fin,@pok_do,@pok_ot,@rday,@mday,@qty_kub,@kub_day,@kubov,@success,@msg)';
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

	public function delGasomer(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.del_agasomer('.$this->gasomer_id.',@success,@msg)';

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
		public function spisanGasomer(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.spisan_agasomer('.$this->gasomer_id.',@success,@msg)';
			break;
			case "AGasomerBack":
			      $this->sql='CALL '.$this->base.'.back_spisan_agasomer('.$this->gasomer_id.',@success,@msg)';
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

public function inGasomerHistory(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.in_agasomer_history('.$this->gasomer_id.',@success,@msg)';
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
public function outGasomerHistory(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.out_agasomer_history('.$this->gasomer_id.',@success,@msg)';
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

public function delPokGasomera(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.delete_pokaz_agasomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
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
	public function newPokGasomer(stdClass $params)
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
			case "AGasomer":
			      $this->sql='CALL '.$this->base.'.input_new_pokaz_agasomera('.$this->gasomer_id.','.$this->address_id.',"'.$this->tek.'","'.$this->newValue.'",@success,@msg)';

			break;
			
			case "insHandApp":			
			      $this->sql='CALL '.$this->base.'.input_hand_pokaz_agasomera('.$this->gasomer_id.','.$this->address_id.','.$this->tek.','.$this->newKubov.',@success,@msg)';
			break;
			case "insMeedlePokGasomera":			
			      $this->sql='CALL '.$this->base.'.insMeedlePokVod('.$this->gasomer_id.','.$this->address_id.','.'"'.$this->type.'","'.$this->tek.'","'.$this->newKubov.'",
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