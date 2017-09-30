<?php

class Database {

	public $conn = null;


	// returnes connection to db
	public function connect_open($server, $user, $pass, $db) {

		$conn = new mysqli($server, $user, $pass, $db);

		// check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully to database.<br>";
		return $conn;
		}

	public function connect_close($conn) {
		$conn ->close();
		echo "Connection to database terminated.<br>";
	}

	public function create_db($name, $conn) {

		$sql = "CREATE DATABASE $name";
		if ($conn ->query($sql) === TRUE) {
			echo "Database created successfully.<br>";
		}
		else {
			echo $conn ->error. "<br>";
		} 
	}

	public function create_table($conn) {
		// creates tables for students
		$sql = "CREATE TABLE Students (
			PersonID VARCHAR(30) PRIMARY KEY,
			Password VARCHAR(30) NOT NULL,
			XP int(6),
			Lectures int(6)
			)";

		if ($conn -> query($sql) === TRUE) {
			echo "Table 'Students' created successfully.<br>";
		}
		else {
			echo "Error creating table: " . $conn ->error . "<br>";
		}


		// creates table for lecturers
		$sql2 = "CREATE TABLE Lecturers (
			PersonID VARCHAR(30) PRIMARY KEY,
			Password VARCHAR(30) NOT NULL
			)";

		if ($conn -> query($sql2) === TRUE) {
			echo "Table 'Lecturers' created successfully.<br>";
		}
		else {
			echo "Error creating table: " . $conn ->error . "<br>";
		}
	}

	public function insert($table, $user, $pass, $conn) {

		// inserting into lecturers table
		if ($table==="Lecturers") {
			$sql3 = "INSERT INTO $table (PersonID, Password)
			VALUES ('$user', '$pass')";

			if ($conn->query($sql3) === TRUE) {
				echo "New lecturer added.<br>";
			}
			else {
				echo "Error adding lecturer: " . $conn->error . "<br>";
			}
		}

		// inserting into students table
		if ($table==="Students") {
			$sql4 = "INSERT INTO $table (PersonID, Password, XP, Lectures)
			VALUES ('$user', '$pass', 0, 0)";

			if ($conn->query($sql4) === TRUE) {
				echo "New student added.<br>";
			}
			else {
				die("Student is already here beb");
			}
		}
	}

	public function incr_xp($user, $old_xp, $conn) {

		$sql6 = "UPDATE Students SET XP=$old_xp+1 WHERE PersonID='$user'";
		if ($conn->query($sql6) === TRUE) {
			echo "XP record updated successfully.<br>";
		}
		else {
			echo "Error updating record: " . $conn->error . "<br>";
		}
	}

	//returns xp int
	public function show_xp($user, $conn) {

		$sql5 = "SELECT XP From Students WHERE PersonID='$user'";
		$result = $conn->query($sql5);

		// show how many xp points student currently has
		$xp = 0;
		while ($row = $result->fetch_assoc()) {
			//echo "XP: " . $row["XP"] . "<br>";
			$xp = $row["XP"];
		}
		return $xp;
	}

	// returns attendance int
	public function show_attendance($user, $conn) {

		$sql5 = "SELECT Lectures From Students WHERE PersonID='$user'";
		$result = $conn->query($sql5);

		// show student's attendance
		$att = 0;
		while ($row = $result->fetch_assoc()) {
			//echo "Attendance: " . $row["Lectures"] . "<br>";
			$att = $row["Lectures"];
		}
		return $att;
	}

	public function incr_attendance($user, $old_att, $conn) {

		$sql7 = "UPDATE Students SET Lectures=$old_att+1 WHERE PersonID='$user'";
		if ($conn->query($sql7) === TRUE) {
			echo "Attendance record updated successfully.<br>";
		}
		else {
			echo "Error updating record: " . $conn->error . "<br>";
		}
	}

	// returns total attendance
	public function total_attendance($conn) {

		$sql8 = "SELECT COUNT(PersonID) AS num FROM Students";
		$result = $conn->query($sql8);
		while ($row = $result->fetch_assoc()) {
			echo "Total attendance: " . $row["num"] . "<br>";
			$total_att = $row["num"];
		}
		return $total_att;
	}

	// checks to see if the user is inside corresponding table, returns boolean value
	public function check_user($table, $user, $conn) {

		$sql = "SELECT PersonID FROM $table";
		$result = $conn->query($sql);
		while ($row = $result->fetch_assoc()) {
			if ($user === $row["PersonID"]) return TRUE;
		}
		return FALSE;
	}

	// checks to see if the user's password matches the one in the table, returns boolean value
	public function check_password($table, $user, $pass, $conn) {

		$sql2 = "SELECT PersonID, Password FROM $table WHERE PersonID='$user'";
		$result = $conn->query($sql2);
		while ($row = $result->fetch_assoc()) {
			if ($pass === $row["Password"]) return TRUE;
			else return FALSE;
		}
	}

}

?>