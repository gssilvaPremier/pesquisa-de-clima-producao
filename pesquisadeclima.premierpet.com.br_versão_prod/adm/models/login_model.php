<?php

class Login_Model extends Model{
	
	private $login;
	private $password;
	private $lembrar;
	
	function __construct() {
		parent::__construct();	
	}
	
	public function run() {
		
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
		    
		    
			
			$this->login 	= Func::antiInjection($_POST['login']);
			$this->password = md5($_POST['password'] . TOKEN);
			
			
			
			if(COOKIE) {
				if(isset($_POST['lembrar'])) {
					$this->lembrar  = $_POST['lembrar'];
				} else {
					$this->lembrar = 0;
				}
			}
			
			//print_r($this);
			$this->logar();
			
		
			
		} else {			
			Session::init();
			Session::onDestroy();
			header('location: ' .URL . '/' . PAGINA_INICIAL);				
		}
	}
	
	public function verifyCookie() {
		
		if(isset($_COOKIE['senha']) && COOKIE) {						
			$this->login 	= $_COOKIE['usuario'];
			$this->password = $_COOKIE['senha'];						
			$this->logar(true);			
		}
		
	}

	public function logar($ajax = false) {

			$sth = $this->db->prepare("SELECT id, nivel FROM users WHERE 
					login = :login AND password = :password;");
					
					
			$sth->execute(array(
					':login' => $this->login,
					':password' => $this->password
					));
			
			$data = $sth->fetch();
			
			

			
			$count = $sth->rowCount();
			if($count > 0 ) {
				Session::init();
				Session::set('nivel', $data['nivel']);
				Session::set('idUsuario', $data['id']);
				Session::set('loggedIn', true);
				
				if(COOKIE) {
					if(($this->lembrar == 1) && !$ajax) {				
						Cookie::set('usuario', $this->login, COOKIE_TIME, COOKIE_PATH);
						Cookie::set('senha', $this->password, COOKIE_TIME, COOKIE_PATH);	
					} else {
						if(!$ajax) {
							if (isset($_COOKIE['senha'])) {
								Cookie::onUnset('senha');
							}
						}
					}
				}
				
				Func::creatPath();				
								
				if($ajax) {
					echo 'ajax';	
				} else {
					header('location: ' .URL . 'dashboard');			
				}
			} else {
				Session::init();
				Session::onDestroy();
				if($ajax) {
					echo false;	
				} else {
					header('location: ' .URL . PAGINA_INICIAL);
				}
			}
	}
	
}