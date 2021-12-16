<?php
	session_start();
	include('connection.php');

	$sample = new Sample();
	if(isset($_POST['book'])){
		$id = $_SESSION['temp'];
	}else{
		$id = $_GET['id'];
		$_SESSION['temp'] = $id;
	}

	$row = $sample->select($id);
	
	$errName="";
	$errEmail="";
	$errTicketNum="";
	$errDate="";
	$errTime="";
	$name="";
	$email="";
	$ticketNum="";
	$date="";
	$time="";

	if(isset($_POST['book'])){
        if(empty($_POST["name"])){
        	unset($_POST["name"]);
        	$errName="Name is required!";
        }else{
        	$name=test_input($_POST["name"]);
        	if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
            	unset($_POST["name"]);
            	$errName="Only letters and white space allowed!";
        	}
        }
  
        if(empty($_POST["email"])){
        	unset($_POST["email"]);
        	$errEmail="Email is required!";
        }else{
        	$email=test_input($_POST["email"]);
        	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            	unset($_POST["email"]);
            	$errEmail="Invalid Email!";
        	}
        }
    
        if(empty($_POST["ticketNum"])){
        	unset($_POST["ticketNum"]);
        	$errTicketNum="Number of ticket is required!";
        }else{
        	$ticketNum=$_POST["ticketNum"];
    		if($ticketNum>$row['seats']){
    			unset($_POST["ticketNum"]);
        		$errTicketNum= "Only " . $row['seats'] . " tickets are available!";	
  			}
        }

        if(empty($_POST["date"])){
            $errDate="Please select a date!";
        }else{
        	if($row['date']=='A'){
        		$date=$_POST["date"];
				if(date('l', strtotime($date)) == "Monday" || date('l', strtotime($date)) == "Wednesday" || date('l', strtotime($date)) == "Friday"){
				}else{
					unset($_POST["date"]);
					$errDate="Select a valid date!";
				}
			}
			if($row['date']=='B'){
        		$date=$_POST["date"];
				if(date('l', strtotime($date)) == "Tuesday" || date('l', strtotime($date)) == "Thursday" || date('l', strtotime($date)) == "Saturday"){
				}else{
					unset($_POST["date"]);
					$errDate="Select a valid date!";
				}
			}
			$todate=date("Y-m-d");
			if($date<$todate){
				unset($_POST["date"]);
				$errDate="Select a valid date!";
			}
        }

        if(empty($_POST["time"])){
        	$errTime="Please select a time!";
        }else{
        	$time=$_POST["time"];
        }

    }

    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

	$book = $sample->book();
?>

<!DOCTYPE html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Movie Hub</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

	</head>
	<body class="bookingBG">
		<header>
			<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
			<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
					
				<ul class="menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="booking.php" class="active">Booking</a></li>
					<li><a href="userblog.php">Blogs</a></li>
					<li><a href="contact.php">Contact Us</a></li>
				</ul>
			</nav>
			<div class="clearfix"></div>
		</header>


		<div style="text-align:center; width: 100%; margin-top: 3vw; ">
			<iframe width="70%" height="700px" src="<?php echo $row['ytlink']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>

		<div style="background:#14213D;padding-top: 100px;margin-top: 50px ">
		<div class="bookingbox">
			<img src="<?php echo $row['posterpic']; ?>" width="100%" style="margin-left: 200px; margin-top:0px; border:solid white 3px;box-shadow: 4px 3px 14px 1px rgba(171,171,171,1);">
		</div>
		<h1 style="margin-top: 50px; margin-left: 700px; color:#FCA311;" ><?php echo $row['title']; ?></h1>
		<h1 style="margin-left: 700px; color: white"><?php echo "Php".$row['price'].".00"; ?></h1>
		<p style="margin-top: 20px; color: white;margin-left: 700px; margin-right: 200px; font-size: 1.5vw; text-align: justify;"><?php echo $row['description']; ?></p>
		

		<button id="myBtn" style="margin-left:320px;margin-bottom:150px;box-shadow: none;background-color: #FCA311;border-color: transparent;border-radius: 5px;color: #14213D;font-weight: 200;font-size: 20px;height: 50px;	cursor:pointer;">Book this movie</button>
		</div>
		<div id="myModal" class="modal">

			<div class="modal-content" style="background:#E5E5E5; ">
		    	<span class="close">&times;</span>
		    	<div>
		    		<table>
		    			<tr>
		    				<th>
		    					<img src="<?php echo $row['posterpic']; ?>" width="550px" style="margin:20px;margin-left:50px">
		    				</th>
		    				<th style="padding: 1vw; vertical-align: top; text-align: left;">
		    					<h1 style="color:black"><?php echo $row['title']." (Php".$row['price'].".00)"; ?></h1>
		    					
		    					<form method="post" action="booking2.php">
		    						Name:&nbsp&nbsp<input style="width:250px; padding:8px" type="text" id="name" name="name" value="<?php echo $name;?>"/><span class="errMsg"> <?php echo $errName;?></span><br><br>
		    						Email:&nbsp&nbsp<input style="width:250px;padding:8px" type="text" id="email" name="email" value="<?php echo $email;?>"/><span class="errMsg"> <?php echo $errEmail;?></span><br><br>
		    						Enter number of ticket:&nbsp&nbsp<input style="width:120px;padding:8px" type="number" min="1" step="1" id="ticketNum" name="ticketNum" value="<?php echo $ticketNum;?>"/><span class="errMsg"> <?php echo $errTicketNum;?></span><br><br>
		    						<i> ( This movie is only available during 
			    					<?php
			    						if($row['date']=='A'){
			    							echo "Monday, Wednesday, and Friday";
			    						}
			    						if($row['date']=='B'){
			    							echo "Tuesday, Thursday, and Saturday";
			    						}
			    					?>
			    					)
			    					</i>
			    					<br>Select date:
			    					<input class="form-modal" type="date" name="date" value="<?php echo $date;?>"><span class="errMsg"> <?php echo $errDate;?></span><br><br>
			    					Select time:
			    					<?php
			    						if($row['time']=='A'){
			    					?>
			    							<input class="form-modal" type="radio" name="time" value="9:00 AM" <?php if(isset($time) && $time=="9:00 AM") echo "checked"; ?> >9:00 AM&nbsp&nbsp
											<input class="form-modal" type="radio" name="time" value="1:00 PM" <?php if(isset($time) && $time=="1:00 PM") echo "checked"; ?> >1:00 PM&nbsp&nbsp
											<input class="form-modal" type="radio" name="time" value="5:00 PM" <?php if(isset($time) && $time=="5:00 PM") echo "checked"; ?> >5:00 PM&nbsp&nbsp
			    					<?php 
			    						}
			    						if($row['time']=='B'){
			    					?>
			    							<input class="form-modal" type="radio" name="time" value="11:00 AM" <?php if(isset($time) && $time=="11:00 AM") echo "checked"; ?> >11:00 AM&nbsp&nbsp
											<input class="form-modal" type="radio" name="time" value="3:00 PM" <?php if(isset($time) && $time=="3:00 PM") echo "checked"; ?> >3:00 PM&nbsp&nbsp
											<input class="form-modal" type="radio" name="time" value="5:00 PM" <?php if(isset($time) && $time=="7:00 PM") echo "checked"; ?> >7:00 PM&nbsp&nbsp
									<?php
			    						}
			    					?>
			    					<span class="errMsg"> <?php echo $errTime;?></span><br><br>

			    					<input type="hidden" name="regular-small-counts" id="regsc">
								    <input type="hidden" name="regular-medium-counts" id="regmc">
								    <input type="hidden" name="regular-large-counts" id="reglc">
								    <input type="hidden" name="cheese-small-counts" id="chesc">
								    <input type="hidden" name="cheese-medium-counts" id="chemc">
								    <input type="hidden" name="cheese-large-counts" id="chelc">
								    <input type="hidden" name="caramel-small-counts" id="carsc">
								    <input type="hidden" name="caramel-medium-counts" id="carmc">
								    <input type="hidden" name="caramel-large-counts" id="carlc">
								    <input type="hidden" name="cola-small-counts" id="cosc">
								    <input type="hidden" name="cola-medium-counts" id="comc">
								    <input type="hidden" name="cola-large-counts" id="colc">
								    <input type="hidden" name="tea-small-counts" id="tsc">
								    <input type="hidden" name="tea-medium-counts" id="tmc">
								    <input type="hidden" name="tea-large-counts" id="tlc">
								    <input type="hidden" name="royal-small-counts" id="roysc">
								    <input type="hidden" name="royal-medium-counts" id="roymc">
								    <input type="hidden" name="royal-large-counts" id="roylc">
				    					
									Do you want to add snacks/drinks?
		    						<input type="radio" name="y/n" value="yes" id="yes">Yes
		    						<input type="radio" name="y/n" value="no" id="no">No
		    						<div class="yes select" id="yes-div" style="display: none;">
			    						Popcorn flavors:<br>
			    						<input type="checkbox" id="regular">Regular<br>
			    							<div class="regular-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="regular-small-check">Small
												<span class="number">
													<button class="minus" id="regular-small-minus" disabled>-</button>
													<input type="text" id="regular-small-counter" class="counter" value="0" name="regular-small-count" disabled/>
													<button class="plus" id="regular-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#regular-small-check').change(function () {
													    $('#regular-small-minus').prop("disabled", !this.checked);
													    $('#regular-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#regular-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#regular-small-minus').click(function () {
															var $input = $(this).parent().find('input#regular-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#regsc').val($input.val());
															return false;
														});
														$('#regular-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#regsc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="regular-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="regular-medium-minus" disabled>-</button>
													<input type="text" id="regular-medium-counter" class="counter" value="0" name="regular-medium-count" disabled/>
													<button class="plus" id="regular-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#regular-medium-check').change(function () {
													    $('#regular-medium-minus').prop("disabled", !this.checked);
													    $('#regular-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#regular-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#regular-medium-minus').click(function () {
															var $input = $(this).parent().find('input#regular-medium-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#regmc').val($input.val());
															return false;
														});
														$('#regular-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#regmc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="regular-large-check">Large
			    							<span class="number">
													<button class="minus" id="regular-large-minus" disabled>-</button>
													<input type="text" id="regular-large-counter" class="counter" value="0" name="regular-large-count" disabled/>
													<button class="plus" id="regular-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#regular-large-check').change(function () {
													    $('#regular-large-minus').prop("disabled", !this.checked);
													    $('#regular-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#regular-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#regular-large-minus').click(function () {
															var $input = $(this).parent().find('input#regular-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#reglc').val($input.val());
															return false;
														});
														$('#regular-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#reglc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#regular").click(function(){
											            if($(this).is(":checked")){
											                $(".regular-select").show();
											                $("#regular-small-check").prop("checked", false);
											                $("#regular-medium-check").prop("checked", false);
											                $("#regular-large-check").prop("checked", false);
											                $("input#regsc").val(0);
												            $("input#regmc").val(0);
				            								$("input#reglc").val(0);
				            								$("input#regular-small-counter").val(0);
												            $("input#regular-medium-counter").val(0);
				            								$("input#regular-large-counter").val(0);
											                $('#regular-small-minus').prop("disabled", true);
													    	$('#regular-small-plus').prop("disabled", true);
													    	$('#regular-medium-minus').prop("disabled", true);
													    	$('#regular-medium-plus').prop("disabled", true);
													    	$('#regular-large-minus').prop("disabled", true);
													    	$('#regular-large-plus').prop("disabled", true);
											            }else{
											                $(".regular-select").hide();
											                $("input#regsc").val(0);
												            $("input#regmc").val(0);
				            								$("input#reglc").val(0);
				            								$("input#regular-small-counter").val(0);
												            $("input#regular-medium-counter").val(0);
				            								$("input#regular-large-counter").val(0);
											            }
											        });
											    });
										    </script>
			    						<input type="checkbox" id="cheese">Cheese<br>
			    						<div class="cheese-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="cheese-small-check">Small
												<span class="number">
													<button class="minus" id="cheese-small-minus" disabled>-</button>
													<input type="text" id="cheese-small-counter" class="counter" value="0" name="cheese-small-count" disabled/>
													<button class="plus" id="cheese-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cheese-small-check').change(function () {
													    $('#cheese-small-minus').prop("disabled", !this.checked);
													    $('#cheese-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cheese-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#cheese-small-minus').click(function () {
															var $input = $(this).parent().find('input#cheese-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#chesc').val($input.val());
															return false;
														});
														$('#cheese-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#chesc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="cheese-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="cheese-medium-minus" disabled>-</button>
													<input type="text" id="cheese-medium-counter" class="counter" value="0" name="cheese-medium-count" disabled/>
													<button class="plus" id="cheese-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cheese-medium-check').change(function () {
													    $('#cheese-medium-minus').prop("disabled", !this.checked);
													    $('#cheese-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cheese-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#cheese-medium-minus').click(function () {
															var $input = $(this).parent().find('input#cheese-medium-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#chemc').val($input.val());
															return false;
														});
														$('#cheese-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#chemc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="cheese-large-check">Large
			    							<span class="number">
													<button class="minus" id="cheese-large-minus" disabled>-</button>
													<input type="text" id="cheese-large-counter" class="counter" value="0" name="cheese-large-count" disabled/>
													<button class="plus" id="cheese-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cheese-large-check').change(function () {
													    $('#cheese-large-minus').prop("disabled", !this.checked);
													    $('#cheese-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cheese-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#cheese-large-minus').click(function () {
															var $input = $(this).parent().find('input#cheese-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#chelc').val($input.val());
															return false;
														});
														$('#cheese-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#chelc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#cheese").click(function(){
											            if($(this).is(":checked")){
											                $(".cheese-select").show();
											                $("#cheese-small-check").prop("checked", false);
											                $("#cheese-medium-check").prop("checked", false);
											                $("#cheese-large-check").prop("checked", false);
											                $("input#chesc").val(0);
												            $("input#chemc").val(0);
				            								$("input#chelc").val(0);
				            								$("input#cheese-small-counter").val(0);
												            $("input#cheese-medium-counter").val(0);
				            								$("input#cheese-large-counter").val(0);
											                $('#cheese-small-minus').prop("disabled", true);
													    	$('#cheese-small-plus').prop("disabled", true);
													    	$('#cheese-medium-minus').prop("disabled", true);
													    	$('#cheese-medium-plus').prop("disabled", true);
													    	$('#cheese-large-minus').prop("disabled", true);
													    	$('#cheese-large-plus').prop("disabled", true);
											            }else{
											                $(".cheese-select").hide();
											                $("input#chesc").val(0);
												            $("input#chemc").val(0);
				            								$("input#chelc").val(0);
				            								$("input#cheese-small-counter").val(0);
												            $("input#cheese-medium-counter").val(0);
				            								$("input#cheese-large-counter").val(0);
											            }
											        });
											    });
										    </script>
			    						<input type="checkbox" id="caramel">Caramel<br>
			    						<div class="caramel-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="caramel-small-check">Small
												<span class="number">
													<button class="minus" id="caramel-small-minus" disabled>-</button>
													<input type="text" id="caramel-small-counter" class="counter" value="0" name="caramel-small-count" disabled/>
													<button class="plus" id="caramel-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#caramel-small-check').change(function () {
													    $('#caramel-small-minus').prop("disabled", !this.checked);
													    $('#caramel-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#caramel-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#caramel-small-minus').click(function () {
															var $input = $(this).parent().find('input#caramel-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#carsc').val($input.val());
															return false;
														});
														$('#caramel-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#carsc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="caramel-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="caramel-medium-minus" disabled>-</button>
													<input type="text" id="caramel-medium-counter" class="counter" value="0" name="caramel-medium-count" disabled/>
													<button class="plus" id="caramel-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#caramel-medium-check').change(function () {
													    $('#caramel-medium-minus').prop("disabled", !this.checked);
													    $('#caramel-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#caramel-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#caramel-medium-minus').click(function () {
															var $input = $(this).parent().find('input#caramel-medium-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#carmc').val($input.val());
															return false;
														});
														$('#caramel-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#carmc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="caramel-large-check">Large
			    							<span class="number">
													<button class="minus" id="caramel-large-minus" disabled>-</button>
													<input type="text" id="caramel-large-counter" class="counter" value="0" name="caramel-large-count" disabled/>
													<button class="plus" id="caramel-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#caramel-large-check').change(function () {
													    $('#caramel-large-minus').prop("disabled", !this.checked);
													    $('#caramel-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#caramel-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#caramel-large-minus').click(function () {
															var $input = $(this).parent().find('input#caramel-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#carlc').val($input.val());
															return false;
														});
														$('#caramel-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#carlc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#caramel").click(function(){
											            if($(this).is(":checked")){
											                $(".caramel-select").show();
											                $("#caramel-small-check").prop("checked", false);
											                $("#caramel-medium-check").prop("checked", false);
											                $("#caramel-large-check").prop("checked", false);
											                $("input#carsc").val(0);
												            $("input#carmc").val(0);
				            								$("input#carlc").val(0);
				            								$("input#caramel-small-counter").val(0);
												            $("input#caramel-medium-counter").val(0);
				            								$("input#caramel-large-counter").val(0);
											                $('#caramel-small-minus').prop("disabled", true);
													    	$('#caramel-small-plus').prop("disabled", true);
													    	$('#caramel-medium-minus').prop("disabled", true);
													    	$('#caramel-medium-plus').prop("disabled", true);
													    	$('#caramel-large-minus').prop("disabled", true);
													    	$('#caramel-large-plus').prop("disabled", true);
											            }else{
											                $(".caramel-select").hide();
											                $("input#carsc").val(0);
												            $("input#carmc").val(0);
				            								$("input#carlc").val(0);
				            								$("input#caramel-small-counter").val(0);
												            $("input#caramel-medium-counter").val(0);
				            								$("input#caramel-large-counter").val(0);
											            }
											        });
											    });
										    </script>
									    Drinks:<br>
			    						<input type="checkbox" id="cola">Coca-cola<br>
			    							<div class="cola-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="cola-small-check">Small
												<span class="number">
													<button class="minus" id="cola-small-minus" disabled>-</button>
													<input type="text" id="cola-small-counter" class="counter" value="0" name="cola-small-count" disabled/>
													<button class="plus" id="cola-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cola-small-check').change(function () {
													    $('#cola-small-minus').prop("disabled", !this.checked);
													    $('#cola-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cola-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#cola-small-minus').click(function () {
															var $input = $(this).parent().find('input#cola-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#cosc').val($input.val());
															return false;
														});
														$('#cola-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#cosc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="cola-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="cola-medium-minus" disabled>-</button>
													<input type="text" id="cola-medium-counter" class="counter" value="0" name="cola-medium-count" disabled/>
													<button class="plus" id="cola-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cola-medium-check').change(function () {
													    $('#cola-medium-minus').prop("disabled", !this.checked);
													    $('#cola-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cola-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
															var $input = $(this).parent().find('input#cola-medium-counter');
														$('#cola-medium-minus').click(function () {
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#comc').val($input.val());
															return false;
														});
														$('#cola-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#comc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="cola-large-check">Large
			    							<span class="number">
													<button class="minus" id="cola-large-minus" disabled>-</button>
													<input type="text" id="cola-large-counter" class="counter" value="0" name="cola-large-count" disabled/>
													<button class="plus" id="cola-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#cola-large-check').change(function () {
													    $('#cola-large-minus').prop("disabled", !this.checked);
													    $('#cola-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#cola-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#cola-large-minus').click(function () {
															var $input = $(this).parent().find('input#cola-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#colc').val($input.val());
															return false;
														});
														$('#cola-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#colc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#cola").click(function(){
											            if($(this).is(":checked")){
											                $(".cola-select").show();
											                $("#cola-small-check").prop("checked", false);
											                $("#cola-medium-check").prop("checked", false);
											                $("#cola-large-check").prop("checked", false);
											                $("input#cosc").val(0);
												            $("input#comc").val(0);
				            								$("input#colc").val(0);
				            								$("input#cola-small-counter").val(0);
												            $("input#cola-medium-counter").val(0);
				            								$("input#cola-large-counter").val(0);
											                $('#cola-small-minus').prop("disabled", true);
													    	$('#cola-small-plus').prop("disabled", true);
													    	$('#cola-medium-minus').prop("disabled", true);
													    	$('#cola-medium-plus').prop("disabled", true);
													    	$('#cola-large-minus').prop("disabled", true);
													    	$('#cola-large-plus').prop("disabled", true);
											            }else{
											                $(".cola-select").hide();
											                $("input#cosc").val(0);
												            $("input#comc").val(0);
				            								$("input#colc").val(0);
				            								$("input#cola-small-counter").val(0);
												            $("input#cola-medium-counter").val(0);
				            								$("input#cola-large-counter").val(0);
											            }
											        });
											    });
										    </script>
			    						<input type="checkbox" id="tea">Iced Tea<br>
			    						<div class="tea-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="tea-small-check">Small
												<span class="number">
													<button class="minus" id="tea-small-minus" disabled>-</button>
													<input type="text" id="tea-small-counter" class="counter" value="0" name="tea-small-count" disabled/>
													<button class="plus" id="tea-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#tea-small-check').change(function () {
													    $('#tea-small-minus').prop("disabled", !this.checked);
													    $('#tea-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#tea-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#tea-small-minus').click(function () {
															var $input = $(this).parent().find('input#tea-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#tsc').val($input.val());
															return false;
														});
														$('#tea-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#tsc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="tea-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="tea-medium-minus" disabled>-</button>
													<input type="text" id="tea-medium-counter" class="counter" value="0" name="tea-medium-count" disabled/>
													<button class="plus" id="tea-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#tea-medium-check').change(function () {
													    $('#tea-medium-minus').prop("disabled", !this.checked);
													    $('#tea-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#tea-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#tea-medium-minus').click(function () {
															var $input = $(this).parent().find('input#tea-medium-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#tmc').val($input.val());
															return false;
														});
														$('#tea-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#tmc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="tea-large-check">Large
			    							<span class="number">
													<button class="minus" id="tea-large-minus" disabled>-</button>
													<input type="text" id="tea-large-counter" class="counter" value="0" name="tea-large-count" disabled/>
													<button class="plus" id="tea-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#tea-large-check').change(function () {
													    $('#tea-large-minus').prop("disabled", !this.checked);
													    $('#tea-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#tea-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#tea-large-minus').click(function () {
															var $input = $(this).parent().find('input#tea-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#tlc').val($input.val());
															return false;
														});
														$('#tea-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#tlc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#tea").click(function(){
											            if($(this).is(":checked")){
											                $(".tea-select").show();
											                $("#tea-small-check").prop("checked", false);
											                $("#tea-medium-check").prop("checked", false);
											                $("#tea-large-check").prop("checked", false);
											                $("input#tsc").val(0);
												            $("input#tmc").val(0);
				            								$("input#tlc").val(0);
				            								$("input#tea-small-counter").val(0);
												            $("input#tea-medium-counter").val(0);
				            								$("input#tea-large-counter").val(0);
											                $('#tea-small-minus').prop("disabled", true);
													    	$('#tea-small-plus').prop("disabled", true);
													    	$('#tea-medium-minus').prop("disabled", true);
													    	$('#tea-medium-plus').prop("disabled", true);
													    	$('#tea-large-minus').prop("disabled", true);
													    	$('#tea-large-plus').prop("disabled", true);
											            }else{
											                $(".tea-select").hide();
											                $("input#tsc").val(0);
												            $("input#tmc").val(0);
				            								$("input#tlc").val(0);
				            								$("input#tea-small-counter").val(0);
												            $("input#tea-medium-counter").val(0);
				            								$("input#tea-large-counter").val(0);
											            }
											        });
											    });
										    </script>
			    						<input type="checkbox" id="royal">Royal<br>
			    						<div class="royal-select" style="display: none;">
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="small" id="royal-small-check">Small
												<span class="number">
													<button class="minus" id="royal-small-minus" disabled>-</button>
													<input type="text" id="royal-small-counter" class="counter" value="0" name="royal-small-count" disabled/>
													<button class="plus" id="royal-small-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#royal-small-check').change(function () {
													    $('#royal-small-minus').prop("disabled", !this.checked);
													    $('#royal-small-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#royal-small-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#royal-small-minus').click(function () {
															var $input = $(this).parent().find('input#royal-small-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#roysc').val($input.val());
															return false;
														});
														$('#royal-small-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#roysc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="medium" id="royal-medium-check">Medium
			    							<span class="number">
													<button class="minus" id="royal-medium-minus" disabled>-</button>
													<input type="text" id="royal-medium-counter" class="counter" value="0" name="royal-medium-count" disabled/>
													<button class="plus" id="royal-medium-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#royal-medium-check').change(function () {
													    $('#royal-medium-minus').prop("disabled", !this.checked);
													    $('#royal-medium-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#royal-medium-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#royal-medium-minus').click(function () {
															var $input = $(this).parent().find('input#royal-medium-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#roymc').val($input.val());
															return false;
														});
														$('#royal-medium-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#roymc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="checkbox" value="large" id="royal-large-check">Large
			    							<span class="number">
													<button class="minus" id="royal-large-minus" disabled>-</button>
													<input type="text" id="royal-large-counter" class="counter" value="0" name="royal-large-count" disabled/>
													<button class="plus" id="royal-large-plus" disabled>+</button>
												</span>
												<script type="text/javascript">
													$('#royal-large-check').change(function () {
													    $('#royal-large-minus').prop("disabled", !this.checked);
													    $('#royal-large-plus').prop("disabled", !this.checked);
													    var $input = $(this).parent().find('input#royal-large-counter');
															$input.val(0);
															return false;
													}).change()
										    		$(document).ready(function() {
														$('#royal-large-minus').click(function () {
															var $input = $(this).parent().find('input#royal-large-counter');
															var count = parseInt($input.val()) - 1;
															count = count < 1 ? 0 : count;
															$input.val(count);
															$input.change();
															$('input#roylc').val($input.val());
															return false;
														});
														$('#royal-large-plus').click(function () {
															var $input = $(this).parent().find('input');
															$input.val(parseInt($input.val()) + 1);
															$input.change();
															$('input#roylc').val($input.val());
															return false;
														});
													});
											    </script>
											<br>
			    							</div>
			    							<script type="text/javascript">
									    		$(function(){
											        $("#royal").click(function(){
											            if($(this).is(":checked")){
											                $(".royal-select").show();
											                $("#royal-small-check").prop("checked", false);
											                $("#royal-medium-check").prop("checked", false);
											                $("#royal-large-check").prop("checked", false);
											                $("input#roysc").val(0);
												            $("input#roymc").val(0);
				            								$("input#roylc").val(0);
				            								$("input#royal-small-counter").val(0);
												            $("input#royal-medium-counter").val(0);
				            								$("input#royal-large-counter").val(0);
											                $('#royal-small-minus').prop("disabled", true);
													    	$('#royal-small-plus').prop("disabled", true);
													    	$('#royal-medium-minus').prop("disabled", true);
													    	$('#royal-medium-plus').prop("disabled", true);
													    	$('#royal-large-minus').prop("disabled", true);
													    	$('#royal-large-plus').prop("disabled", true);
											            }else{
											                $(".royal-select").hide();
											                $("input#roysc").val(0);
												            $("input#roymc").val(0);
				            								$("input#roylc").val(0);
				            								$("input#royal-small-counter").val(0);
												            $("input#royal-medium-counter").val(0);
				            								$("input#royal-large-counter").val(0);
											            }
											        });
											    });
										    </script>
		    							</div>
		    						</div>
		    						<div class="no select"></div>
		    						<script type="text/javascript">
								    	$(document).ready(function(){
								    		$('input[name="y/n"]').click(function(){
								       			var inputValue = $(this).attr("value");
								            	var target = $("." + inputValue);
								            	$(".select").not(target).hide();
								            	$(target).show();
								          	});
								          	$('input#no').click(function(){
								          		$(".regular-select").hide();
								          		$("#regular").prop("checked", false);
								          		$("#regular-small-check").prop("checked", false);
								                $("#regular-medium-check").prop("checked", false);
								                $("#regular-large-check").prop("checked", false);
								                $('#regular-small-minus').prop("disabled", true);
										    	$('#regular-small-plus').prop("disabled", true);
										    	$('#regular-medium-minus').prop("disabled", true);
										    	$('#regular-medium-plus').prop("disabled", true);
										    	$('#regular-large-minus').prop("disabled", true);
										    	$('#regular-large-plus').prop("disabled", true);
										    	$(".cheese-select").hide();
								          		$("#cheese").prop("checked", false);
								          		$("#cheese-small-check").prop("checked", false);
								                $("#cheese-medium-check").prop("checked", false);
								                $("#cheese-large-check").prop("checked", false);
								                $('#cheese-small-minus').prop("disabled", true);
										    	$('#cheese-small-plus').prop("disabled", true);
										    	$('#cheese-medium-minus').prop("disabled", true);
										    	$('#cheese-medium-plus').prop("disabled", true);
										    	$('#cheese-large-minus').prop("disabled", true);
										    	$('#cheese-large-plus').prop("disabled", true);
										    	$(".caramel-select").hide();
								          		$("#caramel").prop("checked", false);
								          		$("#caramel-small-check").prop("checked", false);
								                $("#caramel-medium-check").prop("checked", false);
								                $("#caramel-large-check").prop("checked", false);
								                $('#caramel-small-minus').prop("disabled", true);
										    	$('#caramel-small-plus').prop("disabled", true);
										    	$('#caramel-medium-minus').prop("disabled", true);
										    	$('#caramel-medium-plus').prop("disabled", true);
										    	$('#caramel-large-minus').prop("disabled", true);
										    	$('#caramel-large-plus').prop("disabled", true);
										    	$(".cola-select").hide();
								          		$("#cola").prop("checked", false);
								          		$("#cola-small-check").prop("checked", false);
								                $("#cola-medium-check").prop("checked", false);
								                $("#cola-large-check").prop("checked", false);
								                $('#cola-small-minus').prop("disabled", true);
										    	$('#cola-small-plus').prop("disabled", true);
										    	$('#cola-medium-minus').prop("disabled", true);
										    	$('#cola-medium-plus').prop("disabled", true);
										    	$('#cola-large-minus').prop("disabled", true);
										    	$('#cola-large-plus').prop("disabled", true);
										    	$(".tea-select").hide();
								          		$("#tea").prop("checked", false);
								          		$("#tea-small-check").prop("checked", false);
								                $("#tea-medium-check").prop("checked", false);
								                $("#tea-large-check").prop("checked", false);
								                $('#tea-small-minus').prop("disabled", true);
										    	$('#tea-small-plus').prop("disabled", true);
										    	$('#tea-medium-minus').prop("disabled", true);
										    	$('#tea-medium-plus').prop("disabled", true);
										    	$('#tea-large-minus').prop("disabled", true);
										    	$('#tea-large-plus').prop("disabled", true);
								          		$(".royal-select").hide();
								          		$("#royal").prop("checked", false);
								          		$("#royal-small-check").prop("checked", false);
								                $("#royal-medium-check").prop("checked", false);
								                $("#royal-large-check").prop("checked", false);
								                $('#royal-small-minus').prop("disabled", true);
										    	$('#royal-small-plus').prop("disabled", true);
										    	$('#royal-medium-minus').prop("disabled", true);
										    	$('#royal-medium-plus').prop("disabled", true);
										    	$('#royal-large-minus').prop("disabled", true);
										    	$('#royal-large-plus').prop("disabled", true);
										    	$("input#regsc").val(0);
									            $("input#regmc").val(0);
									            $("input#reglc").val(0);
												$("input#chesc").val(0);
									            $("input#chemc").val(0);
									            $("input#chelc").val(0);
												$("input#carsc").val(0);
									            $("input#carmc").val(0);
									            $("input#carlc").val(0);
												$("input#cosc").val(0);
									            $("input#comc").val(0);
									            $("input#colc").val(0);
												$("input#tsc").val(0);
									            $("input#tmc").val(0);
									            $("input#tlc").val(0);
												$("input#roysc").val(0);
									            $("input#roymc").val(0);
	            								$("input#roylc").val(0);
	            								$("input#regular-small-counter").val(0);
									            $("input#regular-medium-counter").val(0);
	            								$("input#regular-large-counter").val(0);
	            								$("input#cheese-small-counter").val(0);
									            $("input#cheese-medium-counter").val(0);
	            								$("input#cheese-large-counter").val(0);
	            								$("input#caramel-small-counter").val(0);
									            $("input#caramel-medium-counter").val(0);
	            								$("input#caramel-large-counter").val(0);
	            								$("input#cola-small-counter").val(0);
									            $("input#cola-medium-counter").val(0);
	            								$("input#cola-large-counter").val(0);
	            								$("input#tea-small-counter").val(0);
									            $("input#tea-medium-counter").val(0);
	            								$("input#tea-large-counter").val(0);
	            								$("input#royal-small-counter").val(0);
									            $("input#royal-medium-counter").val(0);
	            								$("input#royal-large-counter").val(0);
								          	});
								        });
								    </script>
								    <br>
								    <input style="box-shadow: none;background-color: #FCA311;border-radius: 5px;color: black;font-weight: 200;font-size: 15px;height: 30px;cursor:pointer;" type="submit" id="book" name="book" value="Confirm Book">
								</form>
		    				</th>
		    			</tr>
		    		</table>
		    	</div>
			</div>
		</div>
		<script>
			var modal = document.getElementById("myModal");
			var btn = document.getElementById("myBtn");
			var span = document.getElementsByClassName("close")[0];
			var book = document.getElementById("book");

			<?php
				if(isset($_POST['book'])){
					echo "modal.style.display = \"block\";";

					if($_POST['regular-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".regular-select\").show();
							  $(\"#regular\").prop(\"checked\", true);
							  $(\"#regular-small-check\").prop(\"checked\", true);
							  $('#regular-small-minus').prop(\"disabled\", false);
		    				  $('#regular-small-plus').prop(\"disabled\", false);
		    				  $(\"input#regular-small-counter\").val(".$_POST['regular-small-counts'].");";
					}
					if($_POST['regular-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".regular-select\").show();
							  $(\"#regular\").prop(\"checked\", true);
							  $(\"#regular-medium-check\").prop(\"checked\", true);
							  $('#regular-medium-minus').prop(\"disabled\", false);
		    				  $('#regular-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#regular-medium-counter\").val(".$_POST['regular-medium-counts'].");";
					}
					if($_POST['regular-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".regular-select\").show();
							  $(\"#regular\").prop(\"checked\", true);
							  $(\"#regular-large-check\").prop(\"checked\", true);
							  $('#regular-large-minus').prop(\"disabled\", false);
		    				  $('#regular-large-plus').prop(\"disabled\", false);
		    				  $(\"input#regular-large-counter\").val(".$_POST['regular-large-counts'].");";
					}
					if($_POST['cheese-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cheese-select\").show();
							  $(\"#cheese\").prop(\"checked\", true);
							  $(\"#cheese-small-check\").prop(\"checked\", true);
							  $('#cheese-small-minus').prop(\"disabled\", false);
		    				  $('#cheese-small-plus').prop(\"disabled\", false);
		    				  $(\"input#cheese-small-counter\").val(".$_POST['cheese-small-counts'].");";
					}
					if($_POST['cheese-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cheese-select\").show();
							  $(\"#cheese\").prop(\"checked\", true);
							  $(\"#cheese-medium-check\").prop(\"checked\", true);
							  $('#cheese-medium-minus').prop(\"disabled\", false);
		    				  $('#cheese-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#cheese-medium-counter\").val(".$_POST['cheese-medium-counts'].");";
					}
					if($_POST['cheese-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cheese-select\").show();
							  $(\"#cheese\").prop(\"checked\", true);
							  $(\"#cheese-large-check\").prop(\"checked\", true);
							  $('#cheese-large-minus').prop(\"disabled\", false);
		    				  $('#cheese-large-plus').prop(\"disabled\", false);
		    				  $(\"input#cheese-large-counter\").val(".$_POST['cheese-large-counts'].");";
					}if($_POST['caramel-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".caramel-select\").show();
							  $(\"#caramel\").prop(\"checked\", true);
							  $(\"#caramel-small-check\").prop(\"checked\", true);
							  $('#caramel-small-minus').prop(\"disabled\", false);
		    				  $('#caramel-small-plus').prop(\"disabled\", false);
		    				  $(\"input#caramel-small-counter\").val(".$_POST['caramel-small-counts'].");";
					}
					if($_POST['caramel-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".caramel-select\").show();
							  $(\"#caramel\").prop(\"checked\", true);
							  $(\"#caramel-medium-check\").prop(\"checked\", true);
							  $('#caramel-medium-minus').prop(\"disabled\", false);
		    				  $('#caramel-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#caramel-medium-counter\").val(".$_POST['caramel-medium-counts'].");";
					}
					if($_POST['caramel-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".caramel-select\").show();
							  $(\"#caramel\").prop(\"checked\", true);
							  $(\"#caramel-large-check\").prop(\"checked\", true);
							  $('#caramel-large-minus').prop(\"disabled\", false);
		    				  $('#caramel-large-plus').prop(\"disabled\", false);
		    				  $(\"input#caramel-large-counter\").val(".$_POST['caramel-large-counts'].");";
					}
					if($_POST['cola-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cola-select\").show();
							  $(\"#cola\").prop(\"checked\", true);
							  $(\"#cola-small-check\").prop(\"checked\", true);
							  $('#cola-small-minus').prop(\"disabled\", false);
		    				  $('#cola-small-plus').prop(\"disabled\", false);
		    				  $(\"input#cola-small-counter\").val(".$_POST['cola-small-counts'].");";
					}
					if($_POST['cola-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cola-select\").show();
							  $(\"#cola\").prop(\"checked\", true);
							  $(\"#cola-medium-check\").prop(\"checked\", true);
							  $('#cola-medium-minus').prop(\"disabled\", false);
		    				  $('#cola-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#cola-medium-counter\").val(".$_POST['cola-medium-counts'].");";
					}
					if($_POST['cola-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".cola-select\").show();
							  $(\"#cola\").prop(\"checked\", true);
							  $(\"#cola-large-check\").prop(\"checked\", true);
							  $('#cola-large-minus').prop(\"disabled\", false);
		    				  $('#cola-large-plus').prop(\"disabled\", false);
		    				  $(\"input#cola-large-counter\").val(".$_POST['cola-large-counts'].");";
					}
					if($_POST['tea-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".tea-select\").show();
							  $(\"#tea\").prop(\"checked\", true);
							  $(\"#tea-small-check\").prop(\"checked\", true);
							  $('#tea-small-minus').prop(\"disabled\", false);
		    				  $('#tea-small-plus').prop(\"disabled\", false);
		    				  $(\"input#tea-small-counter\").val(".$_POST['tea-small-counts'].");";
					}
					if($_POST['tea-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".tea-select\").show();
							  $(\"#tea\").prop(\"checked\", true);
							  $(\"#tea-medium-check\").prop(\"checked\", true);
							  $('#tea-medium-minus').prop(\"disabled\", false);
		    				  $('#tea-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#tea-medium-counter\").val(".$_POST['tea-medium-counts'].");";
					}
					if($_POST['tea-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".tea-select\").show();
							  $(\"#tea\").prop(\"checked\", true);
							  $(\"#tea-large-check\").prop(\"checked\", true);
							  $('#tea-large-minus').prop(\"disabled\", false);
		    				  $('#tea-large-plus').prop(\"disabled\", false);
		    				  $(\"input#tea-large-counter\").val(".$_POST['tea-large-counts'].");";
					}
					if($_POST['royal-small-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".royal-select\").show();
							  $(\"#royal\").prop(\"checked\", true);
							  $(\"#royal-small-check\").prop(\"checked\", true);
							  $('#royal-small-minus').prop(\"disabled\", false);
		    				  $('#royal-small-plus').prop(\"disabled\", false);
		    				  $(\"input#royal-small-counter\").val(".$_POST['royal-small-counts'].");";
					}
					if($_POST['royal-medium-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".royal-select\").show();
							  $(\"#royal\").prop(\"checked\", true);
							  $(\"#royal-medium-check\").prop(\"checked\", true);
							  $('#royal-medium-minus').prop(\"disabled\", false);
		    				  $('#royal-medium-plus').prop(\"disabled\", false);
		    				  $(\"input#royal-medium-counter\").val(".$_POST['royal-medium-counts'].");";
					}
					if($_POST['royal-large-counts']>0){
						echo "$(\"input[type=radio][id=yes]\").prop(\"checked\", true);
							  $(\"div#yes-div\").show();
							  $(\".royal-select\").show();
							  $(\"#royal\").prop(\"checked\", true);
							  $(\"#royal-large-check\").prop(\"checked\", true);
							  $('#royal-large-minus').prop(\"disabled\", false);
		    				  $('#royal-large-plus').prop(\"disabled\", false);
		    				  $(\"input#royal-large-counter\").val(".$_POST['royal-large-counts'].");";
					}
				}
			?>

			btn.onclick = function() {
				modal.style.display = "block";
				$("input#regsc").val(0);
	            $("input#regmc").val(0);
	            $("input#reglc").val(0);
				$("input#chesc").val(0);
	            $("input#chemc").val(0);
	            $("input#chelc").val(0);
				$("input#carsc").val(0);
	            $("input#carmc").val(0);
	            $("input#carlc").val(0);
				$("input#cosc").val(0);
	            $("input#comc").val(0);
	            $("input#colc").val(0);
				$("input#tsc").val(0);
	            $("input#tmc").val(0);
	            $("input#tlc").val(0);
				$("input#roysc").val(0);
	            $("input#roymc").val(0);
	            $("input#roylc").val(0);
	            $("input#regular-small-counter").val(0);
	            $("input#regular-medium-counter").val(0);
				$("input#regular-large-counter").val(0);
				$("input#cheese-small-counter").val(0);
	            $("input#cheese-medium-counter").val(0);
				$("input#cheese-large-counter").val(0);
				$("input#caramel-small-counter").val(0);
	            $("input#caramel-medium-counter").val(0);
				$("input#caramel-large-counter").val(0);
				$("input#cola-small-counter").val(0);
	            $("input#cola-medium-counter").val(0);
				$("input#cola-large-counter").val(0);
				$("input#tea-small-counter").val(0);
	            $("input#tea-medium-counter").val(0);
				$("input#tea-large-counter").val(0);
				$("input#royal-small-counter").val(0);
	            $("input#royal-medium-counter").val(0);
				$("input#royal-large-counter").val(0);
			}

			span.onclick = function() {
				modal.style.display = "none";
				document.getElementById('name').value = '';
				document.getElementById('email').value = '';
				document.getElementById('ticketNum').value = '';
				$("input[type=date]").val("");
				$("input[type=radio][name=time]").prop("checked", false);
				$("input[type=radio][id=yes]").prop("checked", false);
				$("input[type=radio][id=no]").prop("checked", false);
				$("div#yes-div").hide();
				$(".regular-select").hide();
	      		$("#regular").prop("checked", false);
	      		$("#regular-small-check").prop("checked", false);
	            $("#regular-medium-check").prop("checked", false);
	            $("#regular-large-check").prop("checked", false);
	            $('#regular-small-minus').prop("disabled", true);
		    	$('#regular-small-plus').prop("disabled", true);
		    	$('#regular-medium-minus').prop("disabled", true);
		    	$('#regular-medium-plus').prop("disabled", true);
		    	$('#regular-large-minus').prop("disabled", true);
		    	$('#regular-large-plus').prop("disabled", true);
		    	$(".cheese-select").hide();
	      		$("#cheese").prop("checked", false);
	      		$("#cheese-small-check").prop("checked", false);
	            $("#cheese-medium-check").prop("checked", false);
	            $("#cheese-large-check").prop("checked", false);
	            $('#cheese-small-minus').prop("disabled", true);
		    	$('#cheese-small-plus').prop("disabled", true);
		    	$('#cheese-medium-minus').prop("disabled", true);
		    	$('#cheese-medium-plus').prop("disabled", true);
		    	$('#cheese-large-minus').prop("disabled", true);
		    	$('#cheese-large-plus').prop("disabled", true);
		    	$(".caramel-select").hide();
	      		$("#caramel").prop("checked", false);
	      		$("#caramel-small-check").prop("checked", false);
	            $("#caramel-medium-check").prop("checked", false);
	            $("#caramel-large-check").prop("checked", false);
	            $('#caramel-small-minus').prop("disabled", true);
		    	$('#caramel-small-plus').prop("disabled", true);
		    	$('#caramel-medium-minus').prop("disabled", true);
		    	$('#caramel-medium-plus').prop("disabled", true);
		    	$('#caramel-large-minus').prop("disabled", true);
		    	$('#caramel-large-plus').prop("disabled", true);
		    	$(".cola-select").hide();
	      		$("#cola").prop("checked", false);
	      		$("#cola-small-check").prop("checked", false);
	            $("#cola-medium-check").prop("checked", false);
	            $("#cola-large-check").prop("checked", false);
	            $('#cola-small-minus').prop("disabled", true);
		    	$('#cola-small-plus').prop("disabled", true);
		    	$('#cola-medium-minus').prop("disabled", true);
		    	$('#cola-medium-plus').prop("disabled", true);
		    	$('#cola-large-minus').prop("disabled", true);
		    	$('#cola-large-plus').prop("disabled", true);
		    	$(".tea-select").hide();
	      		$("#tea").prop("checked", false);
	      		$("#tea-small-check").prop("checked", false);
	            $("#tea-medium-check").prop("checked", false);
	            $("#tea-large-check").prop("checked", false);
	            $('#tea-small-minus').prop("disabled", true);
		    	$('#tea-small-plus').prop("disabled", true);
		    	$('#tea-medium-minus').prop("disabled", true);
		    	$('#tea-medium-plus').prop("disabled", true);
		    	$('#tea-large-minus').prop("disabled", true);
		    	$('#tea-large-plus').prop("disabled", true);
	      		$(".royal-select").hide();
	      		$("#royal").prop("checked", false);
	      		$("#royal-small-check").prop("checked", false);
	            $("#royal-medium-check").prop("checked", false);
	            $("#royal-large-check").prop("checked", false);
	            $('#royal-small-minus').prop("disabled", true);
		    	$('#royal-small-plus').prop("disabled", true);
		    	$('#royal-medium-minus').prop("disabled", true);
		    	$('#royal-medium-plus').prop("disabled", true);
		    	$('#royal-large-minus').prop("disabled", true);
		    	$('#royal-large-plus').prop("disabled", true);
		    	$("input#regsc").val(0);
	            $("input#regmc").val(0);
	            $("input#reglc").val(0);
				$("input#chesc").val(0);
	            $("input#chemc").val(0);
	            $("input#chelc").val(0);
				$("input#carsc").val(0);
	            $("input#carmc").val(0);
	            $("input#carlc").val(0);
				$("input#cosc").val(0);
	            $("input#comc").val(0);
	            $("input#colc").val(0);
				$("input#tsc").val(0);
	            $("input#tmc").val(0);
	            $("input#tlc").val(0);
				$("input#roysc").val(0);
	            $("input#roymc").val(0);
	            $("input#roylc").val(0);
	            $("input#regular-small-counter").val(0);
	            $("input#regular-medium-counter").val(0);
				$("input#regular-large-counter").val(0);
				$("input#cheese-small-counter").val(0);
	            $("input#cheese-medium-counter").val(0);
				$("input#cheese-large-counter").val(0);
				$("input#caramel-small-counter").val(0);
	            $("input#caramel-medium-counter").val(0);
				$("input#caramel-large-counter").val(0);
				$("input#cola-small-counter").val(0);
	            $("input#cola-medium-counter").val(0);
				$("input#cola-large-counter").val(0);
				$("input#tea-small-counter").val(0);
	            $("input#tea-medium-counter").val(0);
				$("input#tea-large-counter").val(0);
				$("input#royal-small-counter").val(0);
	            $("input#royal-medium-counter").val(0);
				$("input#royal-large-counter").val(0);
			}

			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
					document.getElementById('name').value = '';
					document.getElementById('email').value = '';
					document.getElementById('ticketNum').value = '';
					$("input[type=date]").val("");
					$("input[type=radio][name=time]").prop("checked", false);
					$("input[type=radio][id=yes]").prop("checked", false);
					$("input[type=radio][id=no]").prop("checked", false);
					$("div#yes-div").hide();
					$(".regular-select").hide();
		      		$("#regular").prop("checked", false);
		      		$("#regular-small-check").prop("checked", false);
		            $("#regular-medium-check").prop("checked", false);
		            $("#regular-large-check").prop("checked", false);
		            $('#regular-small-minus').prop("disabled", true);
			    	$('#regular-small-plus').prop("disabled", true);
			    	$('#regular-medium-minus').prop("disabled", true);
			    	$('#regular-medium-plus').prop("disabled", true);
			    	$('#regular-large-minus').prop("disabled", true);
			    	$('#regular-large-plus').prop("disabled", true);
			    	$(".cheese-select").hide();
		      		$("#cheese").prop("checked", false);
		      		$("#cheese-small-check").prop("checked", false);
		            $("#cheese-medium-check").prop("checked", false);
		            $("#cheese-large-check").prop("checked", false);
		            $('#cheese-small-minus').prop("disabled", true);
			    	$('#cheese-small-plus').prop("disabled", true);
			    	$('#cheese-medium-minus').prop("disabled", true);
			    	$('#cheese-medium-plus').prop("disabled", true);
			    	$('#cheese-large-minus').prop("disabled", true);
			    	$('#cheese-large-plus').prop("disabled", true);
			    	$(".caramel-select").hide();
		      		$("#caramel").prop("checked", false);
		      		$("#caramel-small-check").prop("checked", false);
		            $("#caramel-medium-check").prop("checked", false);
		            $("#caramel-large-check").prop("checked", false);
		            $('#caramel-small-minus').prop("disabled", true);
			    	$('#caramel-small-plus').prop("disabled", true);
			    	$('#caramel-medium-minus').prop("disabled", true);
			    	$('#caramel-medium-plus').prop("disabled", true);
			    	$('#caramel-large-minus').prop("disabled", true);
			    	$('#caramel-large-plus').prop("disabled", true);
			    	$(".cola-select").hide();
		      		$("#cola").prop("checked", false);
		      		$("#cola-small-check").prop("checked", false);
		            $("#cola-medium-check").prop("checked", false);
		            $("#cola-large-check").prop("checked", false);
		            $('#cola-small-minus').prop("disabled", true);
			    	$('#cola-small-plus').prop("disabled", true);
			    	$('#cola-medium-minus').prop("disabled", true);
			    	$('#cola-medium-plus').prop("disabled", true);
			    	$('#cola-large-minus').prop("disabled", true);
			    	$('#cola-large-plus').prop("disabled", true);
			    	$(".tea-select").hide();
		      		$("#tea").prop("checked", false);
		      		$("#tea-small-check").prop("checked", false);
		            $("#tea-medium-check").prop("checked", false);
		            $("#tea-large-check").prop("checked", false);
		            $('#tea-small-minus').prop("disabled", true);
			    	$('#tea-small-plus').prop("disabled", true);
			    	$('#tea-medium-minus').prop("disabled", true);
			    	$('#tea-medium-plus').prop("disabled", true);
			    	$('#tea-large-minus').prop("disabled", true);
			    	$('#tea-large-plus').prop("disabled", true);
		      		$(".royal-select").hide();
		      		$("#royal").prop("checked", false);
		      		$("#royal-small-check").prop("checked", false);
		            $("#royal-medium-check").prop("checked", false);
		            $("#royal-large-check").prop("checked", false);
		            $('#royal-small-minus').prop("disabled", true);
			    	$('#royal-small-plus').prop("disabled", true);
			    	$('#royal-medium-minus').prop("disabled", true);
			    	$('#royal-medium-plus').prop("disabled", true);
			    	$('#royal-large-minus').prop("disabled", true);
			    	$('#royal-large-plus').prop("disabled", true);
			    	$("input#regsc").val(0);
		            $("input#regmc").val(0);
		            $("input#reglc").val(0);
					$("input#chesc").val(0);
		            $("input#chemc").val(0);
		            $("input#chelc").val(0);
					$("input#carsc").val(0);
		            $("input#carmc").val(0);
		            $("input#carlc").val(0);
					$("input#cosc").val(0);
		            $("input#comc").val(0);
		            $("input#colc").val(0);
					$("input#tsc").val(0);
		            $("input#tmc").val(0);
		            $("input#tlc").val(0);
					$("input#roysc").val(0);
		            $("input#roymc").val(0);
		            $("input#roylc").val(0);
		            $("input#regular-small-counter").val(0);
		            $("input#regular-medium-counter").val(0);
					$("input#regular-large-counter").val(0);
					$("input#cheese-small-counter").val(0);
		            $("input#cheese-medium-counter").val(0);
					$("input#cheese-large-counter").val(0);
					$("input#caramel-small-counter").val(0);
		            $("input#caramel-medium-counter").val(0);
					$("input#caramel-large-counter").val(0);
					$("input#cola-small-counter").val(0);
		            $("input#cola-medium-counter").val(0);
					$("input#cola-large-counter").val(0);
					$("input#tea-small-counter").val(0);
		            $("input#tea-medium-counter").val(0);
					$("input#tea-large-counter").val(0);
					$("input#royal-small-counter").val(0);
		            $("input#royal-medium-counter").val(0);
					$("input#royal-large-counter").val(0);
				}
			}
		</script>
	</body>
</html>