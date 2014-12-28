<?php
error_reporting(0);
class Database {
	private $_hostname 	= "localhost";
	private $_userhost	= "root";
	private $_passhost	= "123456";
	private $_dbname	= "php_oopad";
	private $_conn 		= NULL;
	private $_result	= NULL;
	function connect () {
		$this->_conn = mysql_connect($this->_hostname, $this->_userhost, $this->_passhost);
		mysql_select_db($this->_dbname, $this->_conn);
	}

	function disconnect () {
		if ($this->_conn) {
			mysql_close($this->_conn);
		}
	}

	function query ($sql) {
		$this->_result = mysql_query($sql);
	}

	function num_rows () {
		if ($this->_result) {
			$row = mysql_num_rows($this->_result);
		} else {
			$row = 0;
		}
		return $row;
	}

	function fetch () {
		if ($this->_result) {
			$data = mysql_fetch_assoc($this->_result);
		} else {
			$data = 0;
		}
		return $data;
	}
}
$db = new Database;
$db->connect();
$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
$db->query($sql);
$row = $db->num_rows();
echo "So dong trong CSDL: " . $row . "<hr />";
while ($data = $db->fetch()) {
	echo $data['username'] . "<br />";
	echo $data['level'] . "<hr />";
}