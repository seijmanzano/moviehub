
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
			</ul>
		</nav>
		<div class="clearfix"></div>
	</header>

	<div id="content2">
		<h2>Welcome Admin! </h2>
		<div style="border:px solid black; margin: 0 30%; padding: 20px;box-shadow: 4px 3px 14px 1px rgba(171,171,171,1); background: #fff;">
			<h3>Select an action</h3>
			<button style="margin-left:0px;margin-bottom:40px;box-shadow: 4px 3px 5px 1px rgba(101,101,101,0.8);background-color: #FCA311;border-color: transparent;border-radius: 5px;color: #14213D;font-weight: 200;font-size: 20px;height: 50px;	cursor:pointer; height:50px; width:200px; "><a style="color:white" href="adminmovies.php">CRUD for Booking</a></button><br>
			<button style="margin-bottom:70px;box-shadow: 4px 3px 5px 1px rgba(101,101,101,0.8);background-color: #FCA311;border-color: transparent;border-radius: 5px;color: #14213D;font-weight: 200;font-size: 20px;height: 50px;	cursor:pointer; height:50px; width:200px"><a style="color:white" href="adminblog.php">CRUD for Blogs</a></button>
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
		<script src="script.js" type="text/javascript"></script>
	</body>
</html>