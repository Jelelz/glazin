<?php


$hostname = "localhost";
$username = "jelel";
$password = "JelelKimokiy@2001";
$dbname = "registration";

try
{
	$connection = new PDO("mysql:host={$hostname};dbname={$dbname}",$username,$password);
	$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e)
{
	$e -> getMessage();
}


?>