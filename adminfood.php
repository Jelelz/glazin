
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title>FOOD UPDATE | GLAZIN' DELIGHTS</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
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
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>PRODUCT</th>
                                <th>IMAGE</th>
                                <th>PRICE</th>
                                <th>CODE</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                require_once "config/db2.php";
                                $select_stmt=$connection->prepare("SELECT * FROM food");
                                $select_stmt->execute();
                                while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $row['food_id']?></td>
                                    <td><?php echo $row['fooditem']?></td>
                                    <td><img src="storage/<?php echo $row['food_image']; ?>" width="50" height="50"></td>
                                    <td><?php echo $row['food_price']?></td>
                                    <td><?php echo $row['food_code']?></td>

                                    <td>
                                        <form action="food_edit.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['food_id']?>">
                                            <button type="submit" name="edit_data" class="btn btn-sucess">EDIT</button>
                                        </form>
                                    </td>
                                    <td><a href="#" class="btn btn-danger">DELETE</a></td>
                                </tr>
                                <?php
                            }
                                ?>

                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>