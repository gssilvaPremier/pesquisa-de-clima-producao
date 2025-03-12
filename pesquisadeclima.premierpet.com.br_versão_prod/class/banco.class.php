<?
	
class Banco {
	
	protected $host;
	protected $porta;
	protected $user;
	protected $senha;
	protected $base;
	protected $encoding;
	
	function __construct($host, $porta, $user, $senha, $base, $encoding) {
		$this->host 		= $host;
		$this->porta 		= $porta;
		$this->user 		= $user;
		$this->senha 		= $senha;
		$this->base 		= $base;
		$this->encoding  	= $encoding;
	}
	
	public function getHost() {
		return $this->host;	
	}
	
	public function getPorta() {
		return $this->porta;	
	}
	
	public function getUser() {
		return $this->user;	
	}
	
	public function getSenha() {
		return $this->senha;	
	}
	
	public function getBase() {
		return $this->base;	
	}
	
	public function getEncoding() {
		return $this->encoding;	
	}
	
}