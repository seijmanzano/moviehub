<?php
	require 'connection.php';
	$sample = new Sample();	

	$date = date('Y/m/d');
	
	if(isset($_POST['insertdata']))
	{
		$title = $_POST['title'];
		$post = $_POST['post'];

		$sql = "INSERT INTO blog 
			SET title = '$title',
				dateofpost = '$date',
				post = '$post'";

		mysqli_query($sample->con,$sql);

		header('Location: adminblog.php');
	}
?>