<center><a href="register/home.php" class="btn btn-primary">Click here to go back</a><br><br></center>

<?php
session_start();
if(!isset($_SESSION['username'])){ //if login in session is not set
    header("Location: login.php");
}
	include "../../database/database.php";
	if(isset($_GET['id'])) {
		echo json_encode(
			Database::prepare(
			'SELECT * FROM `persons` WHERE id=' . $_GET['id'],
			array()
			)->fetchAll(PDO::FETCH_ASSOC)
		);
	} else
		echo json_encode(
			Database::prepare(
			'SELECT * FROM `persons`',
			array()
			)->fetchAll(PDO::FETCH_ASSOC)
		);
?>

 