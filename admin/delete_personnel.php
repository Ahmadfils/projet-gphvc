<?php 
ob_start();
session_start();
include '../inc/config.php';
if (isset($_GET['id'])) {
	$query = $pdo->prepare("DELETE FROM utilisateur WHERE id = ?");
	$query->execute(array($_GET['id']));

	$message = "Delete successful";
	$_SESSION['message_del'] = $message;
	header('Location:personnel.php');
}
 ?>