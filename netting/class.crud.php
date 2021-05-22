<?php
 if(!isset($_SESSION)) 
 { 
	 session_start(); 
 } 
require_once 'dbconfig.php';

class crud {

	private $db;
	private $dbhost=DBHOST;
	private $dbuser=DBUSER;
	private $dbpass=DBPWD;
	private $dbname=DBNAME;


	function __construct() {

		try {

			$this->db=new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8',$this->dbuser,$this->dbpass);

		// echo "Bağlantı Başarılı";

		} catch (Exception $e) {

			die("Bağlantı Başarısız:".$e->getMessage());
		}

	}	
	public function qSql($sql,$options=[]) {

		try {

			$stmt=$this->db->prepare($sql);
			$stmt->execute();
			return $stmt;

		} catch (Exception $e) {

			return ['status' => FALSE, 'error' => $e->getMessage()];

		}
	}
	public function tDate($date,$options=[]) {


		$arg=explode(" ",$date);
		$date=explode("-",$arg[0]);
		$time=$arg[1];

		if ($options['date']) {
			return $date[2]."-".$date[1]."-".$date[0];

		} else if ($options['time']) {
			return $time;
		} else if ($options['date_time']) {
			return $date[2]."-".$date[1]."-".$date[0]." ".$time;
		}

	}

	public function addValue($argse) {

		$values=implode(',',array_map(function ($item){
			return $item.'=?';
		},array_keys($argse)));

		return $values;
	}


	public function insert($table,$values,$options=[]) {

		try {

			// echo "<pre>";
			// print_r($values);
			// exit;

			if (isset($options['slug'])) {
				
				if (empty($values[$options['slug']])) {
					$values[$options['slug']]=$this->seo($values[$options['title']]);
				} else {
					$values[$options['slug']]=$this->seo($values[$options['slug']]);
				}
			}


			



			if (isset($options['pass'])) {
				$values[$options['pass']]=md5($values[$options['pass']]);
			}
			// echo "<pre>";
			// print_r($values);
			// exit;


			unset($values[$options['form_name']]);
			

			$stmt=$this->db->prepare("INSERT INTO $table SET {$this->addValue($values)}");
			$stmt->execute(array_values($values));

			return ['status' => TRUE];
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}


	public function update($table,$values,$options=[]) { 

		try {


			if (isset($options['slug'])) {
				
				if (empty($values[$options['slug']])) {
					$values[$options['slug']]=$this->seo($values[$options['title']]);
				} else {
					$values[$options['slug']]=$this->seo($values[$options['slug']]);
				}
			}

			

		


			if (isset($options['pass'])) {
				$values[$options['pass']]=md5($values[$options['pass']]);
			}
			
			$columns_id=$values[$options['columns']];
			unset($values[$options['form_name']]);
			unset($values[$options['columns']]);
			$valuesExecute=$values;
			$valuesExecute+=[$options['columns'] => $columns_id];

			

			// echo "<pre>";
			// print_r($values);
			
			// print_r($valuesExecute);
			// echo "<pre>";
			// exit;
			

			$stmt=$this->db->prepare("UPDATE $table SET {$this->addValue($values)} WHERE {$options['columns']}=?");
			$stmt->execute(array_values($valuesExecute));

			return ['status' => TRUE];
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}



	public function delete ($table,$columns,$values,$fileName=null) {


		try {

			if (!empty($fileName)) {
				unlink("dimg/$table/".$fileName);
			}

			$stmt=$this->db->prepare("DELETE FROM $table WHERE $columns=?");
			$stmt->execute([htmlspecialchars($values)]);

			return ['status' => TRUE]; 
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}


	
	

	public function adminInsert($admins_namesurname,$admins_username,$admins_pass,$admins_status) {

		try {

			$stmt=$this->db->prepare("INSERT INTO admins SET admins_namesurname=?,admins_username=?,admins_pass=?,admins_status=?");
			$stmt->execute([$admins_namesurname,$admins_username,md5($admins_pass),$admins_status]);

			return ['status' => TRUE];
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}

	}

	public function adminsLogin($admins_username,$admins_pass){

		try {
			$stmt=$this->db->prepare("SELECT * FROM admins WHERE admins_username=? AND admins_pass=?");
			$stmt->execute([$admins_username,md5($admins_pass)]);
		
			if ($stmt-> rowCount()==1) {
		
				$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
				$_SESSION["admins"]=[
					"admins_username" => $admins_username,
					"admins_namesurname" => $row['admins_namesurname'],
					"admins_file" => $row['admins_file'],
					"admins_id" => $row['admins_id']
				];
				return ['status' => TRUE];
			}
			else{
				return ['status'=> FALSE];
			}
		
		} catch (Exception $e) {
			return ['status' => FALSE,'error' => $e.getMessage()];
		}
		
		
		}

	

	public function read($table,$options=[]) {

		
		try {

			if (isset($options['columns_name']) && empty($options['limit'])) {

				$stmt=$this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']}");
				
			} else if (isset($options['columns_name']) && isset($options['limit'])) {


				$stmt=$this->db->prepare("SELECT * FROM $table order by {$options['columns_name']} {$options['columns_sort']} limit {$options['limit']}");
			} else {

				$stmt=$this->db->prepare("SELECT * FROM $table");

			}

			
			$stmt->execute();

			return $stmt;
			
		} catch (Exception $e) {
			
			echo $e->getMessage();
			return false;
		}
	}


	public function wread($table,$columns,$values,$options=[]) {

		
		try {

			$stmt=$this->db->prepare("SELECT * FROM $table WHERE $columns=?");
			$stmt->execute([htmlspecialchars($values)]);

			return $stmt;
			
		} catch (Exception $e) {
			
			return ['status' => FALSE, 'error' => $e->getMessage()];
		}
	}




}

?>