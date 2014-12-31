<?php
session_start();
require "class.php";
require "functions.php";
$err = "";
$id = $_GET['uid'];
if ($_SESSION['se_level'] != 1 ) {
	header('location: login.php');
	exit();
}
$muser = new User;
if (isset($_POST['ok'])) {
	$u = $p = "";
	if ($_POST['username'] == NULL) {
		$err[] = "Plz input your username";
	} else {
		$u = $_POST['username'];
	}

	if ($_POST['password'] != $_POST['repassword']) {
		$err[] = "Password not match";
	} else {
		if ($_POST['password'] != NULL ) {
			$p = $_POST['password'];
		} else {
			$p = "none";
		}
	}
	$l = $_POST['level'];
	if ($u && $p && $l) {
		$muser->setUsername($u);
		$muser->setPassword($p);
		$muser->setLevel($l);
		if ($muser->checkUser($id) == false) {
			$err[] = "Username already";
		} else {
			$muser->updateUser($id);
			header('location: index.php');
			exit();
		}
	}

}
$data = $muser->getUserdata($id);
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
	<form action="edit_user.php?uid=<?php echo $data['id']; ?>" method="post">
		Username: <input type="text" name="username" value="<?php echo $data['username']; ?>" /><br />
		Password: <input type="password" name="password" /><br />
		Re-Password: <input type="password" name="repassword" /><br />
		Level: <select name="level" id="">
			<option value="1" <?php if ($data['level'] == 1) echo "selected='selected'"; ?>>Admin</option>
			<option value="2" <?php if ($data['level'] == 2) echo "selected=''selected" ?>>Member</option>
		</select><br />
		<input type="submit" name="ok" value="Submit">
	</form>
</body>
</html>