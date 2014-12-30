<?php
class User extends Database {
	public $_username;
	public $_password;
	public $_level;
	public function __construct () {
		$this->connect();
	}

	public function setUsername ($name) {
		$this->_username = $name;
	}

	public function getUsername () {
		return $this->_username;
	}

	public function setPassword ($pass) {
		$this->_password = $pass;
	}

	public function getPassword () {
		return $this->_password;
	}

	public function setLevel ($l) {
		$this->_level = $l;
	}

	public function getLevel () {
		return $this->_level;
	}
	public function checkLogin () {
		$sql = "SELECT * FROM tbl_user WHERE username = '". $this->getUsername(). "' and password = '". $this->getPassword() ."'";
		$this->query($sql);
		if ($this->num_rows() == 0) {
			return false;
		} else {
			return $this->fetch();
		}
	}

	public function listUser () {
		$sql = "SELECT * FROM tbl_user ORDER BY id";
		$this->query($sql);
		if ($this->num_rows() == 0) {
			$data = 0;
		} else {
			while ($row = $this->fetch()) {
				$data[] = $row;
			}
			
		}
		return $data;
	}

	public function insertUser () {
		$sql = "INSERT INTO tbl_user (username, password, level) VALUES ('".$this->getUsername()."', '".$this->getPassword()."', '".$this->getLevel()."')";
		$this->query($sql);
	}

	public function checkUser () {
		$sql = "SELECT * FROM tbl_user WHERE username = '".$this->getUsername()."'";
		$this->query($sql);
		if ($this->num_rows() == 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editUser () {
		
	}

	public function delUser ($id) {
		$sql = "DELETE FROM tbl_user WHERE id = '$id'";
		$this->query($sql);
	}
}