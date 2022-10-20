<?php
session_start();

require_once "config/db2.php";

if(isset($_POST['add_item']))
{
    $id = $_POST['fid'];
    $name = $_POST['item'];
    $image = $_POST['img'];
    $price = $_POST['price'];
    $code = $_POST['fcode'];
    $qty = $_POST['fqty'] ;
    $tprice = $price * $qty;


    $select_stmt = $connection->prepare("SELECT food_code FROM orderitem WHERE food_code=:code");
    $select_stmt->execute(array(":code"=>$code));
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

    $check_code = $row["food_code"];

    if(!$check_code)
    {
        $insert_stmt=$connection->prepare("INSERT INTO orderitem(fooditem, food_image, food_price, food_code, quantity, totalprice) VALUES(:name, :image, :price, :code, :qty, :ttl_price) ");

        $insert_stmt->bindParam(":name", $name);
        $insert_stmt->bindParam(":image", $image);
        $insert_stmt->bindParam(":price", $price);
        $insert_stmt->bindParam(":code", $code);
        $insert_stmt->bindParam(":qty", $qty);
        $insert_stmt->bindParam(":ttl_price", $tprice);
        $insert_stmt->execute();

        echo '<div class="alert alert-success alert-dismissible mt-2">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>Item added to your cart</strong>
              </div>';

        header('location: menu.php');

       

    }
    else{
        echo '<div class="alert alert-danger alert-dismissible mt-2">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>Item already added to your cart!</strong>
              </div>';
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>MENU | GLAZIN' DELIGHTS</title>
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    
    <body>

     

        <div class="sidebar">

            <div class="sidebar-pic" >
                <h2 style="color: floralwhite;"><span class="lab la la-coffee"></span> Glazin' Delights</h2>
            </div>

        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="menu.php" class="active"><span class="las la la-cutlery"></span>
                        <span class="text-center">MENU</span></a>
                </li>
                <li>
                    <a href="index.php"><span class="las la-home"></span>
                        <span>Home</span></a>
                </li>
                <li>
                    <a href="profile.php"><span class="las la-user-circle"></span>
                        <span>My Profile</span></a><!--Show Client's details-->
                </li>
                <li>
                    <a href="cart.php" id="cart-item"><span class="las la la-cart-arrow-down"></span>
                    Shopping Cart</a><!--Shows what the client orders before and during checkout-->
                </li>
                <li>
                    <a href=""><span class="las la-shopping-bag"></span>
                    <span>My Orders</span></a><!--Show client's history orders-->
                </li>
                <li>
                    <a href="logout.php"><span class="las la la-close"></span>
                    <span>Log out</span></a><!--Show client's history orders-->
                </li>
            </ul>
        </div>
    </div>
  


        <div class="main-content">
            
            <header>
                <h1>

                <label for="">
                    <span class="las la-bars"></span>
                </label>
                MENU
                </h1>

            <div class="user-wrapper">
                <img src="images/avatar.jpeg" width="80px" height="80px" alt="">
                <div>
                    <small style="font-size: large;">WELCOME</small>
                    <h4 class="text-center" style="font-weight: bolder;"><?php
                    if (isset($_SESSION['username']))
                    {
                        echo $_SESSION['username'];
                    }
                    ?><h4>
                </div>  
            </div>
            </header>


            <main>
                <div class="main-part">

                    <div class="main-image">
                        <img src="images/menu.jpeg">
                        <h1 class="first-txt">MENU</h1>
                        <h1 class="secnd-txt">LOVE</h1>
                        <h2 class="third-txt">AT FIRST</h2>
                        <h2 class="frth-txt">BITE</h2>
                    </div>

                    <div class="topic1">
                        <h1 class="text-center">POUND CAKES</h1>
                    </div>


                    <div class="main-menu">

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 1");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 2");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                        
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 3");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 4");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 5");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 6");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 7");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 8");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 9");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 10");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 11");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 12");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 13");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 29");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>
                    




                    </div>

                        <div class="topic1">
                        <h1 class="text-center">SPONGE CAKES</h1>
                        </div>


                    <div class="main-menu">

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 14");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 15");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 16");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 17");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 18");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 19");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;"><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>


                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 20");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 30");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>

                        <div class="one-item">
                            <?php
                            require_once "config/db2.php";
                            $select_stmt=$connection->prepare("SELECT * FROM food WHERE food_id = 31");
                            $select_stmt->execute();
                            while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                            {
                            ?>
                        <div>
                            <a href="#"><img src="storage/<?php echo $row['food_image']; ?>"></a>
                            
                            <p><?php echo $row['fooditem'];?></p>
                            <small>KSH <?php echo number_format($row['food_price'],2);?></small>

                        </div>
                        <form class="form-submit" method="POST">
                            <input type ="hidden" name="fid" value="<?php echo $row['food_id']; ?>">
                            <input type="hidden" name="item" value="<?php echo $row['fooditem']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['food_image']; ?>">
                            <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
                            <input type="hidden" name="fcode" value="<?php echo $row['food_code']; ?>">
                            <button name="add_item" value="add_to_cart" style="border: none;" ><span class="las la la-cart-plus"></span></button>
                            <input style="width: 75px;" type="number" name="fqty" value="<?php echo $row['quantity'];?>">
                        </form>
                            <?php
                            }
                            ?>
                        </div>



                    </div>
                </div>
                

                
            </main>

        </div>
       
       
    </body>
    </html>