<?php
	session_start();
	include('connection.php');

	$sample = new Sample();
	$rows = $sample->read_all();
?>

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
			<a href="#" class="logo">Movie <span class="hubDesign">hub</span></a>
			
			<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
				
				<ul class="menu">
					<li><a href="index.php" class="active">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="booking.php">Booking</a></li>
					<li><a href="userblog.php">Blogs</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>

		</header>
		
	 	<div class="banner">
	 		<div class="banner-image">
	 			<h1>Stream movies with great deals!</h1>
	 		</div>
	 	</div>

	 	<div id="lesson">
		 	<h2>About</h2>
		 	<p >In movie hub, you can watch all the latest and popular movies, TV shows,<br> as well as other content in seamless manner.</p> 
	 	</div>

	 	<div id="content">
		 	<div id="section1">
				<div class="images-container">
					<div class="box" >
						<img src="images/movie.jpg">
						<p>Digital library with tons of movies, eBooks, comics, and others. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>

					</div>
					<div class="box" alt="java">
						<img src="images/enjoy.png">
						<p>Videos can be watched without ads interrupting the seamless streaming. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do. </p>
					</div>
					<div class="box" alt="sql">
						<img src="images/deals.png">
						<p>Hassle free in watching movie together with a great deals. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod selasd dalig etar </p>
					</div>
				</div>
			</div>
		</div>

		<div id="slidePic">
			<h2 id="slideTitle">Watch it now!</h2>
			<div class="slideshow-container">
				<div class="mySlides fade">
					<div class="numbertext">1 / 3</div>
					<img src="images/squidgame.jpg" >  
					<!-- <div class="text">Watch it now!</div> -->
				</div>

				<div class="mySlides fade">
					<div class="numbertext">2 / 3</div>
					<img src="images/mortalcombat.jpg" > 
					<!-- <div class="text">Watch it now!</div> -->
				</div>

				<div class="mySlides fade">
					<div class="numbertext">3 / 3</div>
					<img src="images/blackwidow.jpg" > 
					<!-- <div class="text">Watch it now!</div> -->
				</div>

				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>

			</div>
			<br>
			<div class="dotShow">
				<span class="dot" onclick="currentSlide(1)"></span> 
				<span class="dot" onclick="currentSlide(2)"></span> 
				<span class="dot" onclick="currentSlide(3)"></span> 
			</div>
		</div>

		<div id="content2">
			<h2>Book a movie</h2>
		 	<div id="section2">
				<div class="images-container">
					<?php 
						if(!empty($rows)){
							$x=0;
							foreach($rows as $row){
						?>
					<div class="box" >
						<img src="<?php echo $row['posterpic']; ?>" >
						<p><?php echo $row['title']; ?></p>

					</div>
					<?php 
							}
						}
					?>
				</div>
			</div>
			<a href="booking.php"><input type="submit" class="viewClick" value ="View More..."></a>
		</div>

		<div class="contactForm" style="background:url(images/bg12.jpg);width: 100%;padding:5% 0; ;background-size: cover;">
			<div id="contactTitle">
				<h2>Contact Us</h2>
				<h3>We are always ready to serve you.</h3>
			</div>

			<div class="box">
				<form action="#">
				    <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required><br>
				    <input type="text" name="lastname" class="form-control" placeholder="Enter Your Email" required><br>
				    <textarea name="message" class="form-control" placeholder="Message" rows="4" required></textarea><br>
				    <input type="submit" name="" class="form-control submit" value="SEND MESSAGE">
				
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
		<script src="script.js" type="text/javascript"></script>
	</body>
</html>