<?php
require_once "config/db.php";

if(isset($_POST['foodupdate_btn'])){

	$edit_id = $_POST['edit_id'];
	$edit_item = $_POST['edit_item'];
	$edit_image = $_FILES['food_image']['name'];
	$edit_price = $_POST['edit_price'];
	$edit_code = $_POST['edit_code'];

	$query = "UPDATE food SET fooditem='$edit_item', food_image='$edit_image', food_price='$edit_price', food_code='$edit_code' WHERE food_id='$edit_id' ";
	$query_run = mysqli_query($connection, $query);



	if($query_run)
	{
	move_uploaded_file($_FILES['food_image']['tmp_name'], "storage/".$_FILES['food_image']['name']);
	$_SESSION['success'] = "Product updated";
    header("location: food.php");
    
    }
    else{
    $_SESSION['status'] = "Product NOT updated";
	header("location: food.php");
}

 }


?>