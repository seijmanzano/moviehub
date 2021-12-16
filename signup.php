<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Movie Hub</title>
		<link rel="stylesheet" type="text/css" href="style.css">


	</head>
	<body class="bg">
		<header>
			<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
			
			<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
				
				<ul class="menu">
					<li><a href="index.php">Home</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>
		</header>

		<div class="loginForm">
			<div id="contactTitle">
				<h2>Sign up</h2>
			</div>
			<div class="boxLogin">
				<?php
					include 'connection.php';
					$sample = new Sample();
					$insert = $sample->add_acc();
				?>
				<form method="post" action="#">
					<input type="text" name="email" class="form-controlLogin" placeholder="Enter Your Email" required><br>
				    <input type="text" name="username" class="form-controlLogin" placeholder="Enter Your Username" required><br>
				    <input type="text" name="password" class="form-controlLogin" placeholder="Enter Your Password" required><br>
				    <input type="submit" name="signup" class="form-controlLogin submit" value="SIGN UP">
				
				</form>
			</div>
		</div>
		

	</body>
</html>