<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Movie Hub</title>
		<link rel="stylesheet" type="text/css" href="style.css">


	</head>
	<body>
		<header>
			<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
			
			<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
				
				<ul class="menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="booking.php">Booking</a></li>
					<li><a href="userblog.php">Blogs</a></li>
					<li><a href="contact.php" class="active">Contact Us</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>
		</header>

		<div class="contactForm" style="background:url(images/bg12.jpg);width: 100%;padding:5% 0; ;background-size: cover; height:800px">
			<div id="contactTitle">
				<h2>Contact Us</h2>
				<h3>We are always ready to serve you.</h3>
			</div>

			<div class="box">
				<form action="email-script.php" method="post">

				<!-- This is for receiver -->
					<label for="inputEmail">to <span style="color: #FF0000">*</span></label>
                            <input type="hidden" name="toEmail" id="toEmail" class="form-control"  value="alfredveniegasmendoza11@gmail.com" readonly required autofocus><br>


				    <input type="text" name="fromEmail" id="fromEmail" class="form-control" placeholder="Enter Your Email" required><br>
				    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter a Subject" required><br>
				    <textarea name="message" id="message" class="form-control" placeholder="Message" rows="4" required></textarea><br>
				    <input type="submit" name="sendMailBtn" class="form-control submit" value="SEND MESSAGE">
				
				</form>
			</div>
		</div>
		<div id="footer">
			<div id="footerLogo">
				<img src="images/logo.jpg">
			</div>

			<div id="latestUpdate">
				<h4>LATEST UPDATE</h4><br>
				<p>-Watch movies online</p>
				<p>-Best deals online</p>
				<p>-Free drinks and foods</p>
				<p>-Best movies of all time</p>
				<p>-Romantic movies</p>

			</div>
			<div id="quickLinks">
				<h4>QUICK LINKS</h4><br>
				<p>-Booking Page</p>
				<p>-Reservation Site</p>
				<p>-Learn to code</p>
				<p>-More< amazing site</p>
			</div>

			<div id="keepConnected">
				<h4>KEEP CONNECTED</h4><br>
				<p>Fb: MovieHub</p>
				<p>Located at: Zone 1, Abar 1st, <br>San Jose City, Nueva Ecija</p>
				<p><a class="iconFoot">&#9990</a> +639753114750</p> 
				<p><a class="iconFoot">&#9993</a> moviehub@gmail.com</p>

			</div>
			<div id="allRight">
				<p><br><br>Copyright&copy 2021. All Rights Reserved by MovieHub </p>
			</div>
		</div>
		</footer>

	</body>
</html>