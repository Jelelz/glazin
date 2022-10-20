<?php

$names = filter_input(INPUT_POST, 'names');
$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$enterpassword =filter_input(INPUT_POST, 'enterpassword');

//INSERT DATA INTO ADMIN TABLE IN THE DATABASE 

// Include db file
require_once "config/db.php";

if(isset($_POST['submit']))
{
    $names = $_POST['names'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $enterpassword = $_POST['enterpassword'];

    $errors = array();

    $u = "SELECT username FROM admin WHERE username = '$username' ";
    $uu = mysqli_query($connection,$u);

    $e = "SELECT email FROM admin WHERE email = '$email' ";
    $ee = mysqli_query($connection,$e);


    if (mysqli_num_rows($uu) > 0)
    {
        $errors['u'] = "Username Exists";
    }

    if (mysqli_num_rows($ee) > 0)
    {
        $errors['e'] = "Email Exists";
    }

    if (count($errors)==0)
    {
        //$enterpassword = md5($enterpassword); //This will encrypt the password.
        $query = "INSERT INTO admin(names,username,email,enterpassword) values('$names','$username','$email','$enterpassword')";

        $result = mysqli_query($connection,$query);

        if ($result)
        {
            echo "<script>alert('Registered Successfully')</script>";
            
            header('location: login1.php');
        }
        else
        {
            echo "<script>alert('Failed')</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Admin Registration</title>
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
                        <div class="col-lg-11">
                        <h1 style="font-family: Roboto;" class="text-center font-weight-bold py-3 ">Welcome Admin</h1>
                        <h4 style="font-family: Roboto;" class="text-center font-weight-bold">Register here</h4>
                        </div>
                        
                        <form action="register1.php" method="post">
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Enter Full Name" required class="form-control my-3 p-3" name="names">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Enter UserName" required class="form-control my-3 p-3" name="username">
                                    <p class="text-danger"><?php if(isset($errors['u'])) echo $errors['u'];?></p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="email" placeholder="Enter Email Id" required class="form-control my-3 p-3" name="email">
                                    <p class="text-danger"><?php if(isset($errors['e'])) echo $errors['e'];?></p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="password" placeholder="Enter Password" required class="form-control my-3 p-3" name="enterpassword">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <button type="submit button"class="btn1 mt-3 mb-5" name="submit" >Register</button>
                                    
                                </div>
                            </div>
                            
                            
                             

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>