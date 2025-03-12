<?php

class User_Model extends Model {
	
	function __construct() {
		parent::__construct();		
	}
	
	function userList() {
		$sth = $this->db->prepare('SELECT id, login, nivel FROM users;');
		$sth->execute();
		return $sth->fetchAll();		
	}
	
	function singleUser($id) {
		$sth = $this->db->prepare('SELECT id, login, nivel FROM users WHERE id= :id');
		$sth->execute(array(
				':id' => $id
				));
		return $sth->fetch();		
	}
	
	function create($data) {
		$sth = $this->db->prepare('INSERT INTO users (login, password, nivel) 
									VALUES (:login,:password,:nivel)');
		$sth->execute(array(
				':login' => $data[login],
				':password' => $data[password],
				':nivel' => $data[nivel]							
				));	
	}
		
	function update($data) {
		$sth = $this->db->prepare('UPDATE users
										  SET login=:login, password=:password, nivel=:nivel
										  WHERE id=:id;');
		$sth->execute(array(
				':login' => $data[login],
				':password' => $data[password],
				':nivel' => $data[nivel],
				':id' => $data[id]
				));	
	}
	
	function edit($id) {
		
	}
	
	function delete($id) {
		
		if($id <> 1) {		
			$sth = $this->db->prepare('DELETE FROM users WHERE id= ' . $id);
			$sth->execute();
		}
		header('location: ' .URL . 'user');	
	}
	
	
}


?>