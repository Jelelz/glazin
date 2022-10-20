<?php

session_start();

$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$enterpassword =filter_input(INPUT_POST, 'enterpassword');

//INSERT DATA INTO CLIENT TABLE IN THE DATABASE 

// Include db file
require_once "config/db.php";

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $enterpassword = $_POST['enterpassword'];

    $errors = array();

    $u = "SELECT username FROM client WHERE username = '$username' ";
    $uu = mysqli_query($connection,$u);

    $e = "SELECT email FROM client WHERE email = '$email' ";
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
        $query = "INSERT INTO client(username,email,enterpassword) values('$username','$email','$enterpassword')";

        $result = mysqli_query($connection,$query);

        if ($result)
        {
            //Storing email in session variable
            $_SESSION['email'] = $email;

            echo "<script>alert('Registered Successfully')</script>";
            
            header('location: login.php');
        }
        else
        {
            echo "<script>alert('Failed')</script>";
        }
    }
}

?>



<!DOCTYPE html>
<html >
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
        <section class="Form my-5 mx-4">
            <div class="container">
                <div class = "row no-pad">
                    <div class= "col-lg-3 ">
                        <img src="./display.jpeg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-7 px-5 pt-5 offset-1">
                        <h1 style="font-family: Roboto;" class="col-lg-11 text-center font-weight-bold py-3 ">Welcome</h1>

                        



                        <form action="register.php"  method="post">
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="UserName" required class="form-control my-3 p-3" name="username">
                                    <p class="text-danger"><?php if(isset($errors['u'])) echo $errors['u'];?></p>
                                </div>
                                
                            </div>
                            

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="email" placeholder="Email Id" required class="form-control my-3 p-3" name="email">
                                    <p class="text-danger"><?php if(isset($errors['e'])) echo $errors['e'];?></p>
                                </div>
                                
                            </div>



                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="password" placeholder="Password" required class="form-control my-3 p-3" name="enterpassword">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <button type="submit button" class="btn1 mt-3 mb-5" name="submit" value="register">Register</button>
                                    
                                </div>
                            </div>
                            
                            <!--<p class="offset-2 font-weight-bold">Are you an admin? <a href="register1.php">Register Here</a></p>-->
                             

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>

