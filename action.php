


<?php

session_start();
require_once "config/db2.php";

if(isset($_GET['remove']))
{
	$id = $_GET['remove'];
	$delete_stmt = $connection->prepare("DELETE FROM orderitem WHERE itemID = :iid");
	$delete_stmt ->execute(array(":iid"=>$id));

	$_SESSION['showAlert'] = "block";
	$_SESSION['message'] = "Items removed from the cart";
	header("location:cart.php");

}

if(isset($_GET['clear']))
{
	$id = $_GET["clear"];
	$delete_stmt = $connection->prepare("DELETE FROM orderitem");
	$delete_stmt -> execute();

	$_SESSION['showAlert'] = "block";
	$_SESSION['message'] = "All items removed from the cart";
	header("location:cart.php");
}


?>