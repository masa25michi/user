<?php

session_start();

class User{
	private $database;
	private $tel;
	private $email;
	private $pass;
	private $isSigned;
	private $events;

	public function __construct($database){
		$this->database = $database;
		if(!empty($_POST['signIn'])){
			if($this->signIn()){
				echo "Success";
			}else{
				echo "Error";
			}
		}
		else if(!empty ($_GET['signOut'])){
			$this->signOut();

		}else if(!empty($_POST['addSchedule'])){
			$this->addSchedule();
		}
	}

	public function signIn(){
		if($this->check_signed()){
			$this->isSigned = true;
			$this->tel = $_SESSION['tel'];
			$this->email = $_SESSION['email'];
		}else{
			if( !empty($_POST['tel']) && !empty($_POST['pass']) ){
				// $this->tel = $this->db->real_escape_string($_POST['tel']);
				// $this->pass = $this->db->real_escape_string($_POST['pass']);
				$this->tel = $_POST['tel'];
				$this->pass = $_POST['pass'];
				
				$_SESSION['tel'] = $this->tel;
				$_SESSION['pass'] = $this->pass;
				$_SESSION['isSigned'] = True;
				return ($this->verify_password()?true:false);
				// return true;
			}
		}
		return false;
	}

	public function check_signed(){
		if(!empty($_SESSION['tel']) && !empty($_SESSION['isSigned']) && !empty($_SESSION['pass']) ){

			$this->tel = $_SESSION['tel'];
			$this->pass = $_SESSION['pass'];
			// echo $_SESSION['pass'];
			return ($this->verify_password()?true:false);
		} 
		return false;
	}

	public function verify_password(){
		$sql = "select Password from User where Tel = ?;";
		$result = $this->database->prepare($sql, array($this->tel));
		// $result = $this->database->query($sql);
		if($result->rowCount() > 0){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				if(strcmp($row['Password'], ($this->pass))==0){
					return true;
				}
			}
		}
		return false;
	}

	public function signOut(){
		session_unset();
		session_destroy();
		$this->isSigned = false;
		header('Location: index.php');
		exit();
	}
}
?>