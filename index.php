<?php
	session_start();
	require "class.php";
	require "functions.php";
	if ( $_SESSION['se_level'] != 1 ) {
		header('location: login.php');
		exit();
	}
	echo "Welcome back " . $_SESSION['se_username'] . "<br />";
	echo "<a href='logout.php'>Logout</a>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP User</title>
	<script>
	function xacnhan() {
		if (!window.confirm("Do you want delete this user?")) {
			return false;
		}
	}
	</script>
</head>
<body>
	<a href="add_user.php">Add new</a>
	<table border="1">
		<tr>
			<td>So thu tu</td>
			<td>Username</td>
			<td>Level</td>
			<td>Edit</td>
			<td>Delete</td>
		</tr>
		<?php
			$muser = new User;
			$data = $muser->listUser();
			$stt = 0;
			foreach ($data as $item) {
				$stt++;
				echo "<tr>";
				echo "<td>$stt</td>";
				echo "<td>$item[username]</td>";
				if ($item['level'] == 1) {
					echo "<td><font color='red'>Admin</font></td>";
				} else {
					echo "<td>Member</td>";
				}
				echo "<td><a href='edit_user.php?uid=$item[id]'>Edit</td>";
				echo "<td><a href='del_user.php?uid=$item[id]' onclick='return xacnhan()'>Delete</td>";
				echo "<tr>";
			}
		?>
	</table>
	
</body>
</html>