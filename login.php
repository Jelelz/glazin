
<?php

//Starting the session necessary for using session variables
session_start();
    

if(isset($_POST['Login']))
{
    // Include db file
    require_once "config/db.php";

    $un = mysqli_real_escape_string($connection, $_POST['username']);
    $pw = mysqli_real_escape_string($connection, $_POST['enterpassword']);

    $errors = array();

    //Error message if the input field is left blank
    if (empty($un)){
        array_push($errors, "Username is required");
    }
    if (empty($pw)){
        array_push($errors, "Password is required");
    }


    //Checking for the errors
    if (count($errors)==0)
    {
        //Password matching
        $query = "SELECT * FROM client WHERE username='$un' AND enterpassword = '$pw' ";
        $results = mysqli_query($connection, $query);

        //$results = 1 means that one user with the entered username exists
        if(mysqli_num_rows($results) == 1){
            //Storing username in session variable
            $_SESSION['username'] = $un;
            

            //Welcome message
            $_SESSION['success'] = "You have logged in";

            //Page on which the user is sent to after loggin in
            header('location: menu.php');
        }
        else{
            //If the username and password doesn't match
            $fmsg = "Invalid Login Credentials.";

        }
    }


}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>LOG IN</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
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
            <div class="container vertical-center">
                <div class = "row no-pad inner-block">
                    


                    <div class= "col-lg-3 ">
                        <img src="./display.jpeg" class="img-fluid" alt="">
                    </div>


                    <div class="col-lg-7 px-5 pt-0 offset-1">
                        <h1 style="font-family: Roboto;" class="text-center font-weight-bold py-4 ">Log In</h1>

                        <div class="justify-content-end text-center col-lg-2 offset-11 pt-0">
                        <a href="login1.php" type="button" class="btn1 text-decoration-none">Are you an Admin?</a> 
                    </div>

                        
                        
                        <form method="POST">
                            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                            
                             
                            
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Enter UserName" required class="form-control my-0 p-3" name="username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="password" placeholder="Enter Password" required class="form-control my-3 p-3" name="enterpassword">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <button type="submit button" name="Login" class="btn1 mt-3 mb-5">LogIn</button>
                                </div>
                            </div>
                            <input class="offset-2" type='checkbox' name='check-box'><span>Remember Password</span><br>
                            <a class="offset-2" href="#">Forgot Password</a>
                            <p class="offset-2">Don't have an account? <a href="register.php">Register Here</a></p>
                             

                        </form>
                    </div>
                </div>
            </div>
        </section>

    </body>
</html>
