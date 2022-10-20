<!DOCTYPE html>
<html>
<head>
	    <meta charset="utf-8">
        <title>Admin Table</title>
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
	<h1 class="text-center">ADMIN</h1>
	<div class="container">
		<button class="btn btn-primary my-3"><a href="register1.php" class="text-light">Add Admin</a>
		</button>
	</div>


	<div class="row px-5 col-lg-10 justify-content-center">
        <table class="table">
            <tr>
                <thead>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th colspan="1">Action</th>
                </thead>
            </tr>


<?php
$conn = mysqli_connect("localhost", "jelel", "JelelKimokiy@2001", "registration");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM `admin`";
$result = $conn->query($sql);


if($result)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$id=$row['id'];
		$names=$row['names'];
		$email=$row['email'];
		$username=$row['username'];
		$enterpassword=$row['enterpassword'];
		echo ' <tr>
		<th scope = "row"> '.$id.' </th>
		<td> '.$names.' </td>
		<td> '.$email.' </td>
		<td> '.$username.' </td>
		<td> '.$enterpassword.' </td>
		<td>
        <button class = "btn btn-info"><a href="update1.php?    updateid='.$id.' " class="text-light">Update</a></button>
        <button class = "btn btn-success"><a href="delete1.php? deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
		</tr>';		
	}
} 
?>
        </table>
    </div>
</body>
</html>