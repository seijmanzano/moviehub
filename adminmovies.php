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
		<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
		<nav >
			<label for="toggle">&#9776</label>
			<input type="checkbox" id="toggle">
				
			<ul class="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="adminmovies.php" class="active">Booking</a></li>
				<li><a href="adminblog.php">Blogs</a></li>
			</ul>
		</nav>
		<div class="clearfix"></div>
	</header>

	<div id="content2">
		<h2>Hi admin, this is a CRUD page for movie. </h2>
		<div id="section2" >
			<div class="images-container" >
				<?php 
					if(!empty($rows)){
						$x=0;
						foreach($rows as $row){
					?>
				<div class="box" >
					<img src="<?php echo $row['posterpic']; ?>" >
					<p><?php echo $row['title']; ?></p>
					<a style="margin-right:20px;padding:5px;background-color: #00cc7b;border-radius: 5px;color: #fff;font-weight: 200;font-size: 16px;height: 35px;	cursor:pointer;" href="updatemovie2.php?id=<?php echo $row['id']; ?>">Update</a>
					<a style="padding:5px;background-color: 	#DC143C;border-radius: 5px;color: #fff;font-weight: 200;font-size: 16px;height: 35px;	cursor:pointer;" href="deletemovie.php?id=<?php echo $row['id']; ?>">Delete</a>
				</div>
				<?php 
						}
					}
				?>
			</div>
		</div>
		<a href="addmovie.php"><input type="submit" class="viewClick" value ="Add Movie" style="background:#FCA311"></a>
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