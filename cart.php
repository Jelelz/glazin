<?php 
session_start();

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>SHOPPING CART | GLAZIN' DELIGHTS</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
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
<div class="container">
    <div style="display: <?php 
                if(isset($_SESSION["showAlert"])){echo $_SESSION['showAlert'];} else {echo "none";} unset($_SESSION['showAlert'])?>" class="alert alert-success alert-dismissible mt-2">
                 <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                
                <h1 class="text-center" style="font-family: Roboto;">SHOPPING CART</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col"> </th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-right">Total Price</th>
                        <th scope="col" class="text-right"><a href="action.php?clear=all" onClick = "return confirm('Are you sure to clear your cart?');" class="btn btn-sm btn-danger" >Empty Cart</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "config/db2.php";
                        $select_stmt=$connection->prepare("SELECT * FROM orderitem");
                        $select_stmt->execute();
                        $grand_total = 0;
                        
                        while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                        <tr>
                            <td><img src="storage/<?php echo $row['food_image']; ?>" width="50" height="50"></td>

                            <td><?php echo $row["fooditem"]; ?></td>

                            <td><?php echo number_format($row["food_price"],2); ?></td>

                            <td><input  class="form-control itemQty" value="<?php echo $row['quantity']; ?>"style="width: 75px;"></td>

                            <td class="text-right"><?php echo number_format($row["totalprice"],2); ?></td>

                            <td class="text-right">
                                <a href="action.php?remove=<?php echo $row["itemID"];?>" onClick="return confirm('Are you sure you want to remove this item?');" class="btn btn-sm btn-danger"><i class="las la-trash-alt"></i></a>    
                            </td>

                            <input type="hidden" class="fid" value="<?php echo $row["itemID"]; ?>">
                            <input type="hidden" class="price" value="<?php echo $row["food_price"]; ?>">
        
                            <?php $grand_total +=$row["totalprice"]; ?>


                        </tr>
                        <?php
                        }
                        ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sub-Total</td>
                            <td class="text-right"><?php echo number_format($grand_total,2); ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="text-right"><?php echo number_format($grand_total,2); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <a href="menu.php" class="btn btn-block btn-light"><i class="fa fa-shopping-cart"></i>Continue Shopping</a>
                </div>

                <div class="col-sm-12  col-md-6 text-right">
                    <a href="cart.php" class="btn btn-md btn-block btn-success text-uppercase <?=($grand_total>1)?"":"disabled"; ?>"> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>