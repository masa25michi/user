<?php
include_once ('DB.php');
session_start();

class User{
	private $database;
	private $tel;
	private $email;
	private $pass;
	private $isSigned;

	public function __construct($database){
		$this->database = $database;
		if(!empty($_POST['signin'])){
			$this->signin();
		}
		else if(!empty ($_POST['signout'])){
			$this->signout();
		}
	}

	public function signin(){
		if(check_signed()){
			$this->isSigned = true;
			$this->tel = $_SESSION['tel'];
			$this->email = $_SESSION['email'];
		}else{
			if( !empty($_POST['tel']) && !empty($_POST('pass')) ){
				$this->tel = $this->db->real_escape_string($_POST['tel']);
				$this->pass = $this->db->real_escape_string($_POST['pass']);
				return (verify_password()?true:false);
			}
		}
		return false;
	}

	public function check_signed(){
		if(!empty($_SESSION['tel']) && $_SESSION('isSigned') ){
			return (verify_password($_SESSION['tel'],$_SESSION['pass'])?true:false);
		}
		return false;
	}

	public function verify_password(){
		$sql = "select password from User where Tel = ?;"
		$result = $database->query($sql, array($tel));
		if($result->rowCount() >0){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				if(strcmp($row['password'], $pass){
					return true;
				}
			}
		}
		return false;
	}

	public function signout(){
		session_unset();
		session_destroy();
		$this->isSigned = false;
		exit();
	}
}

?>