<!DOCTYPE html>
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
					<li><a href="about.php" >About</a></li>
					<li><a href="">Booking</a></li>
					<li><a href="">Blogs</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>
		</header>

		<div class="loginForm">
			<div id="contactTitle">
				<h2>Login your account</h2>
			</div>
			<div class="boxLogin">
				<?php
					session_start();
					include 'connection.php';
					$_SESSION['id'] = null;
					$sample = new Sample();
					$login = $sample->login();
				?>
				<form method="post" action="#">
				    <input type="text" name="username" class="form-controlLogin" placeholder="Enter Your Username" required><br>
				    <input type="text" name="password" class="form-controlLogin" placeholder="Enter Your Password" required><br>
				    <input type="submit" name="login" class="form-controlLogin submit" value="LOGIN">
				
				</form>
				<p style="text-align:center; color: white;">Don't have account yet? <a style="text-decoration: none; color: white;" href="signup.php">SIGN UP</a></p>
			</div>
		</div>


	</body>
</html>