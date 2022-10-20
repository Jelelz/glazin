<?php
$conn = mysqli_connect("localhost", "jelel", "JelelKimokiy@2001", "registration");
// Check connection
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
   if (isset($_GET['deleteid'])){
   	$id=$_GET['deleteid'];

   	$sql="delete from `admin` where id=$id";
   	$result = $conn->query($sql);
   	if($result)
   	{
   		//echo "Deleted successfully";
   		header('location:admin_connect.php');
    }
    else
    {
    	die(mysqli_error($con));
    }

   }
?>