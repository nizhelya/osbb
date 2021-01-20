<?php

class QueryUserLogin
{
	private $_db;
	protected $login;
	protected $password;	
	protected $sql;
	public $results;
	
	
	public function connect()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
		if ($_db->connect_error) {
			return  false;
		} else {		
		$_db->set_charset("utf8");    
		return $_db;
		}
	}

		public function login(stdClass $params)
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
		if(isset($params->memorize) && ($params->memorize)) {
		  $this->remember= $params->memorize;
		} else {
		   $this->remember=0;
		}		
		    $_db = $this->connect();

		if($_db){

			 $this->sql='SELECT mysql.user.user as login,YISGRAND.COMMUN_USERS.user_id,YISGRAND.COMMUN_USERS.role,YISGRAND.COMMUN_USERS.org_id as prixod_id FROM YISGRAND.COMMUN_USERS,mysql.user WHERE mysql.user.user = "'.$this->login.'" and mysql.user.password = password("'.$this->password.'") and mysql.user.user = YISGRAND.COMMUN_USERS.login' ; 
//print($this->sql);
		// $this->sql='SELECT user_id,login,role,org_id as prixod_id FROM YISGRAND.COMMUN_USERS WHERE login="'.$this->login.'"'; 
		 $_result = $_db->query($this->sql) or die('Connect Error (' . $this->sql. ') ' . $_db->connect_error);

		 $rows=mysqli_affected_rows($_db);
		if($rows){
		while ($row = $_result->fetch_assoc()) {
			$results->user_id = $row['user_id'];
			$results->login	= $row['login'];
		  $results->password = $this->password;
			$results->role= $row['role'];
			$results->prixod_id= $row['prixod_id'];
			$results->success = true;
			}
		} else{
			$results->success = false;
		}
		
		
		}else{
		  $results->success = false;
		}
		return $results;
	}
}
