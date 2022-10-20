<?php

// Include db file
require_once "config/db.php"; 

if (isset($_POST['submitImage'])) 
{

    $foodname = $_POST['fooditem'];
    $price = $_POST['food_price'];
    $code = $_POST['food_code'];

    $filename = $_FILES['food_image']['name'];
    $filetmpname = $_FILES['food_image']['tmp_name'];
    $folder = "storage/".$filename;

    $sql = "INSERT INTO food(fooditem, food_image, food_price, food_code) VALUES('$foodname', '$filename', '$price', '$code')";

    mysqli_query($connection, $sql);

$qry = move_uploaded_file($filetmpname, $folder);
if($qry)
{
    header("location: food.php");
    echo "image uploaded";
}
else{
    echo "image not uploaded";
}

}



?>



<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <title>ADMIN | Food Update</title>
        <link rel="stylesheet" type="text/css" href="css/food.css">
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
                        <h1 style="font-family: Roboto;" class="col-lg-11 text-center font-weight-bold py-3 ">Welcome Admin</h1>
                        <h2 style="font-family: Roboto;" class="col-lg-11 text-center">Food Registration</h2>

                        



                        <form action="food.php"  method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Food Name" required class="form-control my-3 p-3" name="fooditem">
                                    <p class="text-danger"></p>
                                </div>
                                
                            </div>
                            

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <label style="font-weight: bolder;" for="foodimage">Image:</label><br/>
                                    <input type="file" placeholder="Food Image" required class="form-control my-3 p-3" name="food_image" id="foodimage">
                                    <p class="text-danger"></p>
                                </div>
                                
                            </div>



                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="number" placeholder="Food Price" required class="form-control my-3 p-3" name="food_price">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Food Code" required class="form-control my-3 p-3" name="food_code">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <button type="submit button" class="btn1 mt-3 mb-5" name="submitImage" value="SAVE">ADD</button>
                                    
                                </div>
                            </div>
                            
                            <!--<p class="offset-2 font-weight-bold">Are you an admin? <a href="register1.php">Register Here</a></p>-->
                             

                        </form>
                    </div>
                </div>
            </div>
        </section>
        <h1 class="text-center" style="font-family: Roboto;">PRODUCTS</h1>
        <?php 
        include_once "adminfood.php";
        ?>
    </body>
</html>


