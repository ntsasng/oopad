<?php
session_start();
require "class.php";
require "user.php";
$err = "";
if (isset($_POST['ok'])) {
	$u = $p = "";
	if ($_POST['username'] == NULL) {
		$err[] = "Plz input your username";
	} else {
		$u = $_POST['username'];
	}
	if ($_POST['password'] == NULL) {
		$err[] = "Plz input your password";
	} else {
		$p = $_POST['password'];
	}
	if ($u && $p) {
		$muser = new User;
		$muser->setUsername($u);
		$muser->setPassword($p);
		$data = $muser->checkLogin();
		if ($data == false) {
			$err[] = "Something wrong usernam or password";
		} else {
			$_SESSION['se_username'] = $data['username'];
			$_SESSION['se_level'] = $data['level'];
			header('location: index.php');
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
</head>
<body>
	<?php
		if ($err != "") {
			echo "<ul>";
			foreach ($err as $e) {
				echo "<li>$e</li>";
			}
		echo "</ul>";
		}
	?>
	<form action="login.php" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		<input type="submit" name="ok" value="Login">
	</form>
</body>
</html>