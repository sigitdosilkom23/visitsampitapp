<?php
require_once '../config.php';
class Login extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}
	public function login(){
		
		extract($_POST);
		$secretKey = "6LcJzHghAAAAAMoZbsbGGISBjkVfT6m6fg7kKODA";
		$captcha=$_POST['g-recaptcha-response'];
	        $ip = $_SERVER['REMOTE_ADDR'];

	        $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$captcha;

	        $response = file_get_contents($url);
	        $responseKeys = json_decode($response,true);
	        if($responseKeys["success"]) {
			$usernameReal = mysqli_real_escape_string($this->conn,$username);
			$passwordReal = mysqli_real_escape_string($this->conn,$password);
	        $qry = $this->conn->query("SELECT * from users where username = '$usernameReal' and password = md5('$passwordReal') ");
			 
				if($qry->num_rows > 0){

					foreach($qry->fetch_array() as $k => $v){
						if(!is_numeric($k) && $k != 'password'){
							$this->settings->set_userdata($k,$v);
						}

					}
					$this->settings->set_userdata('login_type',1);
					$this->conn->query("UPDATE users SET isAktive = 1 WHERE username = '$usernameReal' AND password = md5('$passwordReal')");

					return json_encode(array('status'=>'success'));

				}else{
					return json_encode(array('status'=>'incorrect','last_qry'=>"SELECT * from users where username = '$username' and password = md5('$password') "));
				}

	        } else {
				return json_encode(array('status'=>'spam','last_qry'=>"spammer detected, please reload first"));
	                echo 'You are spammer';
	        }
			
	}
	public function logout(){
		if($this->settings->sess_des()){
			$this->conn->query("UPDATE users SET isAktive = 0");
			redirect('admin/login.php');
		}
	}
	function login_user(){
		extract($_POST);
		$usernameReal = mysqli_real_escape_string($this->conn,$username);
		$passwordReal = mysqli_real_escape_string($this->conn,$password);
		$qry = $this->conn->query("SELECT * from users where username = '$usernameReal' and password = md5('$passwordReal') and type=0 ");
		if($qry->num_rows > 0){
			foreach($qry->fetch_array() as $k => $v){
				$this->settings->set_userdata($k,$v);
			}
			$this->settings->set_userdata('login_type',1);
		$resp['status'] = 'success';
		}else{
		$resp['status'] = 'incorrect';
		}
		if($this->conn->error){
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'login_user':
		echo $auth->login_user();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	default:
		echo $auth->index();
		break;
}