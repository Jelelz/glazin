<!--CONNECT TO DATABASE AND CREATION OF CLIENT'S TABLE-->

<!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8">
        <title>Clients Table</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
<style>
body{
	background-color: #C0C0C0;
}
.text-light{
	text-decoration: none;
}

</style>
</head>


<body>
	<h1 class="text-center">CLIENTS</h1>
	<div class="container">
		<button class="btn btn-primary my-3"><a href="register.php" class="text-light">Add Client</a>
		</button>
	</div>


	<div class="row px-5 col-lg-10 justify-content-center">
        <table class="table">
        	<thead>
                <tr>
                	
                    <th scope="col">Id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>



<?php
$conn = mysqli_connect("localhost", "jelel", "JelelKimokiy@2001", "registration");
// Check connection
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `client`";
$result = $conn->query($sql);

if($result)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$id=$row['id'];
		$username=$row['username'];
		$email=$row['email'];
		$enterpassword=$row['enterpassword'];
		echo ' <tr>
		<th scope = "row"> '.$id.' </th>
		<td> '.$username.' </td>
		<td> '.$email.' </td>
		<td> '.$enterpassword.' </td>
		<td>
        <button class = "btn btn-info"><a href="update.php?    updateid='.$id.' " class="text-light">Update</a></button>
        <button class = "btn btn-success"><a href="delete.php? deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
		</tr>';		
	}
} 

?>
    


        </table>
    </div>
</body>
</html>