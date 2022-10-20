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
	$username=$_POST['username'];
	$email=$_POST['email'];
	$enterpassword=$_POST['enterpassword'];

	$sql="update `client` set id=$id, username='$username', email='$email', enterpassword='$enterpassword' where id=$id";
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
        <link rel="stylesheet" type="text/css" href="css/register.css">
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
                        <h1 class="text-center font-weight-bold py-3 ">Welcome</h1>


                        <form action="client.php" method="post">
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="UserName" class="form-control my-3 p-3" name="username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="email" placeholder="Email Id" class="form-control my-3 p-3" name="email">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="password" placeholder="Password" class="form-control my-3 p-3" name="enterpassword">
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