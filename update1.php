<?php
$conn = mysqli_connect("localhost", "jelel", "JelelKimokiy@2001", "registration");
// Check connection
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}


$id=$_GET['updateid'];

if(isset($_POST['submit']))
{
	$names=$_POST['names'];
	$email=$_POST['email'];
	$username=$_POST['username'];
	$enterpassword=$_POST['enterpassword'];

	$sql="update `admin` set id=$id, names='$names', email='$email',username='$username', enterpassword='$enterpassword' where id=$id";
	$result = $conn->query($sql);
	if($result){
		echo "updated successfully";

	}else{
		die(mysqli_error($con));
	}
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Client Registration</title>
        <link rel="stylesheet" type="text/css" href="css/register1.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
        <style>
            body
            {
                background: rgb(219, 226, 226);
            }

        </style>
    </head>
    
    <body>
        <section class="Form my-1 mx-5">
            <div class="container">
                <div class = "row no-pad">
                    <div class= "col-lg-3 ">
                        <img src="./display.jpeg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 px-5 pt-5 offset-1">
                        <h1 class="text-center font-weight-bold py-3 ">Welcome Admin</h1>
                        
                        <form action="admin.php" method="post">
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Enter Full Name" class="form-control my-3 p-3" name="names">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Enter UserName" class="form-control my-3 p-3" name="username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="email" placeholder="Enter Email Id" class="form-control my-3 p-3" name="email">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="password" placeholder="Enter Password" class="form-control my-3 p-3" name="enterpassword">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <button type="submit button" class="btn1 mt-3 mb-5" name="submit">Update</button>
                                    
                                </div>
                            </div>
                            
                            
                             

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>