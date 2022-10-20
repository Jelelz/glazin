<?php
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DASHBOARD | GLAZIN' DELIGHTS</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
        <script type="text/javascript" src="js/bootstrap/bootstrap.bundle.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    </head>



    <body>
     

    	<div class="sidebar">
    		<div class="sidebar-pic">
    			<h2 style="color: floralwhite;"><span class="lab la la-coffee"></span> Glazin' Delights</h2>
    	    </div>

    	<div class="sidebar-menu">
    		<ul>
    			<li>
    				<a href="dashboard.php" class="active"><span class="las la-igloo"></span>
    					<span>Dashboard</span></a>
    			</li>
                <li>
                    <a href="index.php"><span class="las la-home"></span>
                        <span>Home</span></a>
                </li>
    			<li>
    				<a href="client_connect.php"><span class="las la-users"></span>
    					<span>Clients</span></a><!--No of registered clients-->
    			</li>
                <li>
                    <a href=""><span class="las la-shopping-bag"></span>
                        <span>Orders</span></a><!--Orders made before check out-->
                </li>
    			<li>
    				<a href=""><span class="las la-clipboard"></span>
    					<span>Sales</span></a><!--Orders after check out-->
    			</li>
    			
    			<li>
    				<a href="food.php"><span class="la la-pagelines"></span>
    					<span>Products</span></a><!--Page to add images to the menu page-->
    			</li>
    			<li>
    				<a href="admin_connect.php"><span class="las la-user-circle"></span>
    					<span>Accounts</span></a><!--Showcase the admins-->
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
    			Dashboard
    		    </h1>

    		<div class="user-wrapper">
                <img src="images/avatar.jpeg" width="80px" height="80px" alt="">
                <div>
                    <small style="font-size: large;">Admin:</small>
                    <h4 style="font-weight: bolder;"><?php
                    if (isset($_SESSION['username']))
                    {
                        echo $_SESSION['username'];
                    }
                    
                    ?><h4>
                </div>	
    		</div>

    		</header>


            <main>
                <div class="cards">
                    <div class="card-one">
                        <div>
                            <h1>54</h1>
                            <span>Clients</span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>

                    </div>
                    <div class="card-one">
                        <div>
                            <h1>124</h1>
                            <span>Orders</span>
                        </div>
                        <div>
                            <span class="las la-shopping-bag"></span>
                        </div>

                    </div>

                    <div class="card-one">
                        <div>
                            <h1>79</h1>
                            <span>Sales</span>
                        </div>
                        <div>
                            <span class="las la-clipboard"></span>
                        </div>

                    </div>

                </div>
            </main>


    </div>

        


    </body>
 </html>
