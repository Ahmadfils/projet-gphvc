<?php 
ob_start();
session_start();
include '../inc/config.php';
if (isset($_GET['num'])) {
	$query = $pdo->prepare("DELETE FROM license WHERE id = ?");
	$query->execute(array($_GET['num']));

	$message = "Delete successful";
	$_SESSION['message_del'] = $message;
	header('Location:license.php');
}
 ?>