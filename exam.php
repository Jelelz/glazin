<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>EXAM WORK</title>
	<link rel="stylesheet" type="text/css" href="css/exam.css">
</head>
	<body>
		<div>
		<div class="id">A A A A</div>
		<div>
			<span>B B
			      B B</span>
			<span id="id">C C C C</span>      
			<span class="class">D D D D</span>      
		</div>

		<div class="class">
			<span>E E E E</span>
			<div class="id">F F<br/>F F</div>
			<div id="class">G G<br/>G G</div>
			<div id="H">H H H H</div>
		</div>
	</div>

	<div class="main">
		<p>Class is awesome</p><br>
		<p>What will I do</p>
		<p>What will happen</p>
	</div>

	</body>
	<ul>
		<li>Coffee</li>
		<li>Tea </li>
		<li>Milk</li>
	</ul>
	<form action="exam.php" method="POST">
		<label for="uname">Username</label>
		<input type="text" name="username" placeholder="UserName required"><br>

		<label for="fname">First Name</label>
		<input type="text" name="firstname" placeholder="FirstName" required=""><br>

		<label for="lname">Last Name</label>
		<input type="text" name="lastname" required placeholder="LastName"><br>

		<label for="email">Email</label>
		<input type="email" name="email" placeholder="Email" required><br>

		<label for="password">Password</label>
		<input type="password" name="enterpassword" placeholder="Enter Password" required=""><br>

		<label for="password">Confirm Password</label>
		<input type="password" name="redo" required placeholder="confirm password"><br>

		<label for="gender">Gender: </label>

		<input type="radio" name="gender">
		<label for="female">Female</label>

		<input type="radio" name="gender">
		<label for="male">Male</label><br>

		<input type="checkbox" name="terms">
		<label for="terms">I accept Terms and Conditions</label><br>

        <input type="button" name="button" value="SUBMIT">
		<button type="submit button" name="submit">SUBMIT</button>

		<input type="reset" value="RESET">

		<label for="color">Pick a color</label>
		<input type="color" name="color"><br>

		<label for="items">Food item: </label>
		<select id="items" name="items">
			<option value="cookie">Cookie</option>
			<option value="cake">Cake</option>
			<option value="icecream">Ice Cream</option>
		</select><br>

		<label for="quantity">Quantity: </label>
		<input type="number" name="quantity"><br>
		<input type="button" name="submit button" value="Order">	

		
	</form>
</html>