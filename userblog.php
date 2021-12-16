<!DOCTYPE html>
<html>
<!--
	May binago ako sa blog table: nag add ko ng bagong column na title tapos yung date date nalang datatype di na datetime
 -->
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" 
	crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="style.css">


	<style>
		body
		{
		  font-family: 'Roboto',sans-serif;
		  background-color: #ccc;
		}

		a{
			text-decoration: none;
			cursor: pointer;
		}
		.header{
			font-size: 30px;
		}
	</style>
</head>
<body>


	<header>
		<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
		<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
				
				<ul class="menu">
					<li><a href="index.php" >Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="booking.php">Booking</a></li>
					<li><a href="userblog.php" class="active">Blogs</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>

		</header><br>
		<h2>Blogs</h2>

<!--Student informations-->

     <?php 
         		include 'connection.php';
         		$sample = new Sample();	
         		$sql = "SELECT * FROM blog ORDER BY dateofpost DESC";
						$res = mysqli_query($sample->con,$sql);

			?>
				
<div class="container pt-5 color-white">
  <div class="row">
    <div class="col-12">
      <table class="table " bgcolor="#fff">
      	<thead bgcolor="#655967">
      		
      	</thead>
        <thead>
         
        </thead>
        <?php  
						if($res){
							foreach ($res as $row) {
				?>
		        <tbody>		     
		         		<tr> 
		         			<table class="table " bgcolor="#fff">
		         				<tbody>
		         					<tr bgcolor="#14213D" style="color:white; text-align:center; font-size:20px"> <td><?php echo $row['title'] ?></td> </tr>
		         					<tr  bgcolor="#FCA311" style=" text-align:center; font-size:15px">  <td>
		         						<?php 
		         								$changedate = date("M d, Y", strtotime($row['dateofpost']));
		         						echo "Date: ". $changedate; ?></td> </tr>
		         					<tr > <td style="padding:50px 100px"><?php echo $row['post'] ?></td> </tr>
		         				</tbody>
		         			</table>
		         		</tr>							
						</tbody>
				<?php 
							}
						}
						else {
							echo "No record found";
						}
        ?>
      </table>
    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
	crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</html>