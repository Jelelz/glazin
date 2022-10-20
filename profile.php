
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PROFILE</title>
    <style>
    body{
    background-color: #C0C0C0;
    text-align: center;
    font-size: 2rem;
}
</style>
</head>
<body>
    <div class="user-wrapper">
        <img src="images/avatar.jpeg" width="80px" height="80px" alt="">
    </div>
    <h3>NAME:</h3>
<?php
session_start();


    if (isset($_SESSION['username']))
    {
        echo $_SESSION['username'];
    }
?>
<h3>EMAIL:</h3>



</body>
</html>
