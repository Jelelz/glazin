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
                        <h2 style="font-family: Roboto;" class="col-lg-11 text-center">Update Food</h2>

                       <?php
                       require_once "config/db.php";

                       if(isset($_POST['edit_data']))
                       {
                        $id = $_POST['edit_id'];

                        $query = "SELECT * FROM food WHERE food_id = '$id' ";
                        $query_run = mysqli_query($connection,$query);

                        foreach($query_run as $row)
                        {
                        ?>

                        <form action="code.php"  method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="edit_id" value="<?php echo $row['food_id']?>">

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Food Name" required class="form-control my-3 p-3" name="edit_item" value="<?php echo $row['fooditem'] ?>">
                                    <p class="text-danger"></p>
                                </div>
                                
                            </div>
                            

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <label style="font-weight: bolder;" for="foodimage">Image:</label><br/>
                                    <input type="file" placeholder="Food Image" required class="form-control my-3 p-3" name="food_image" value="<?php echo $row['food_image'] ?>" id="foodimage">
                                    <p class="text-danger"></p>
                                </div>
                                
                            </div>



                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="number" placeholder="Food Price" required class="form-control my-3 p-3" name="edit_price" value="<?php echo $row['food_price'] ?>">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <input type="text" placeholder="Food Code" required class="form-control my-3 p-3" name="edit_code" value="<?php echo $row['food_code'] ?>">
                                </div>
                                
                            </div>

                            <div class="form-row">
                                <div class="offset-2 col-lg-7">
                                    <a href="adminfood.php" class="btn btn-danger">CANCEL</a>
                                    <button type="submit" class="btn1 mt-3 mb-5" name="foodupdate_btn" value="SAVE">UPDATE</button>
                                    
                                </div>
                            </div>
                            
                            <!--<p class="offset-2 font-weight-bold">Are you an admin? <a href="register1.php">Register Here</a></p>-->
                             

                        </form>




                        <?php

                         }
                       }
                       ?>



                        
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>