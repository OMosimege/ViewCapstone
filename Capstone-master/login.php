<?php
	include ("db.php");
	include("javascript.js"); //include javascript code
	session_start();

	$userid = $_POST["userid"];
	$password = $_POST["password"];
	$table = $_POST["table"];

	$_SESSION["userid"]=$userid;
	$_SESSION["password"]=$password;
	$_SESSION["table"]=$table;

	$S = "localhost:3306";
	$U = "root";
	$P = "";
	$D = "DB1";

	$ClassDB = new Database();
	$conn = $ClassDB->connect_open($S, $U, $P, $D);

	//echo $userid. "<br>";
	//echo $password . "<br>";
	//echo $table . "<br>";
	//$ClassDB->insert("Students", $userid, $password, $conn);
	//echo $ClassDB->check_student($table, "doggo", $conn). "<br>";

	if ($ClassDB->check_user($table, $userid, $conn) === TRUE & $ClassDB->check_password($table, $userid, $password, $conn) === TRUE) {
		echo "Login successful.<br>";

		if ($table === "Students") {
			header('Location: /studentmenu.html');
		}
		else header('Location: /lecturemenu.html');
	}
	else if ($ClassDB->check_user($table, $userid, $conn) === FALSE) {
		echo "Your account has been created<br>";
		$ClassDB->insert($table, $userid, $password, $conn);
		
		if ($table === "Students") {
			header('Location: /studentmenu.html');
		}
		else header('Location: /lecturemenu.html');
	}
	else header('Location: /welcome.html');	

	//need this
	<form action="login.php" method="post" onsubmit="return check_empty_field()"> //prev : <form action="" method="post">
	<label>Login :</label>
	<input type="text" name="username"/><br />
	<label>Password :</label>
	<input type="password" name="password"/><br/>
	<input type="submit" value=" Submit "/><br />
	</form>


?>

