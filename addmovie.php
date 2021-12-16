<?php
	session_start();
	include('connection.php');

	$sample = new Sample();
	$rows = $sample->read_all();

	$errTitle="";
	$errDescription="";
	$errPosterpic="";
	$errPrice="";
	$errYtlink="";
	$errSeats="";
	$errDate="";
	$errTime="";
	$errCinema="";
	$title="";
	$description="";
	$posterpic="";
	$price="";
	$ytlink="";
	$seats="";
	$date="";
	$time="";
	$cinema="";

	if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST["title"])){
        	unset($_POST["title"]);
        	$errTitle="Title is required!";
        }else{
        	$title=$_POST["title"];
        }
  
        if(empty($_POST["description"])){
        	unset($_POST["description"]);
        	$errDescription="Description is required!";
        }else{
        	$description=$_POST["description"];
        }
    
        $posterpic=$_FILES["myfile"]["name"];

        if(empty($_POST["price"])){
        	unset($_POST["price"]);
        	$errPrice="Price is required!";
        }else{
        	$price=$_POST["price"];
        }

		if(empty($_POST["ytlink"])){
			unset($_POST["ytlink"]);
        	$errYtlink="Trailer link is required!";
        }else{
        	$ytlink=$_POST['ytlink'];
        	if(!preg_match("/https:\/\/(www\.)*youtube\.com\/.*/",$ytlink)){
            unset($_POST["ytlink"]);
            $errYtlink="Invalid link!";
          }
        }

        if(empty($_POST["ticketNum"])){
        	unset($_POST["ticketNum"]);
        	$errSeats="Maximum ticket number is required!";
        }else{
        	$seats=$_POST['ticketNum'];
        }

        if(empty($_POST["date"])){
            $errDate="Please select a date!";
        }else{
        	$date=$_POST['date'];
        }

        if(empty($_POST["time"])){
        	$errTime="Please select a time!";
        }else{
        	$time=$_POST["time"];
        }

		if(empty($_POST["cinema"])){
        	$errCinema="Please select a cinema!";
        }else{
        	$cinema=$_POST["cinema"];
        }        
    }

    if(isset($_POST['add'])){
	    foreach($rows as $row){
	    	if($time == $row['time'] && $date == $row['date'] && $cinema == $row['cinema']){
	    		unset($_POST['time']);
	    		unset($_POST['date']);
	    		unset($_POST['cinema']);
	    		$errCinema="Schedule is already taken!";
	    	}
	    }
	}

    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

	$addmovie = $sample->addmovie();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Movie Hub</title>
		<link rel="stylesheet" type="text/css" href="style.css">


	</head>
	<body style="background:#eee">
		<header>
			<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
			
			<nav >
				<label for="toggle">&#9776</label>
				<input type="checkbox" id="toggle">
				
				<ul class="menu">
					<li><a href="index.php" >Home</a></li>
					<li><a href="adminmovies.php" class="active">Booking</a></li>
					<li><a href="adminblog.php">Blogs</a></li>
				</ul>

			</nav>
			<div class="clearfix"></div>

		</header>
		<h2>Add Movie Page </h2>
		<form method="post" action="#" enctype = "multipart/form-data" style="margin-left: 40%" >
			Movie title:<input style="padding:5px; width:295px; margin:5px" type="text" name="title" value="<?php echo $title;?>"><span class="errMsg"><?php echo $errTitle;?></span><br>
			<span style="float: left; padding-top: 10px;">Movie Description:</span><textarea style="padding:5px; width:240px; margin:5px" rows="4" type="text" name="description"><?php echo $description;?></textarea><span class="errMsg"><?php echo $errDescription;?></span><br>
			Movie poster:<input style="padding:5px; width:250px; margin:5px" type="file" name="myfile"><span class="errMsg"><?php echo $errPosterpic;?></span><br>
			Price:<input style="padding:5px; width:330px; margin:5px" type="number" min="1" step="1" name="price" value="<?php echo $price;?>"><span class="errMsg"><?php echo $errPrice;?></span><br>
			Movie trailer link:<input style="padding:5px; width:250px; margin:5px" type="text" name="ytlink" value="<?php echo $ytlink;?>"><span class="errMsg"><?php echo $errYtlink;?></span><br>
			Number of maximum tickets:<input style="padding:5px; width:170px; margin:5px" type="number" min="1" step="1" name="ticketNum" value="<?php echo $seats;?>"><span class="errMsg"><?php echo $errSeats;?></span><br>
			Date:
				<input type="radio" name="date" <?php if(isset($date) && $date=="A") echo "checked";?> value="A">A
	            <input type="radio" name="date" <?php if(isset($date) && $date=="B") echo "checked";?> value="B">B
	            <span class="errMsg"><?php echo $errDate;?></span><br><br>
			Time:
				<input type="radio" name="time" <?php if(isset($time) && $time=="A") echo "checked";?> value="A">A
	            <input type="radio" name="time" <?php if(isset($time) && $time=="B") echo "checked";?> value="B">B
	            <span class="errMsg"><?php echo $errTime;?></span><br><br>
			Cinema:
				<input type="radio" name="cinema" <?php if(isset($cinema) && $cinema=="1") echo "checked";?> value="1">1
	            <input type="radio" name="cinema" <?php if(isset($cinema) && $cinema=="2") echo "checked";?> value="2">2
	            <input type="radio" name="cinema" <?php if(isset($cinema) && $cinema=="3") echo "checked";?> value="3">3
	            <input type="radio" name="cinema" <?php if(isset($cinema) && $cinema=="4") echo "checked";?> value="4">4
	            <span class="errMsg"><?php echo $errCinema;?></span><br><br>
	        <input style="width:380px;margin-bottom:150px;background-color: #FCA311;border-radius: 5px;color: #14213D;font-weight: 200;font-size: 18px;height: 35px;	cursor:pointer;" type="submit" name="add" value="ADD MOVIE">
        </form>
    </body>
</html>