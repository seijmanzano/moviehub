<?php
	require 'connection.php';
	$sample = new Sample();
	if(isset($_POST['updatedata']))
	{
		$id = $_POST['update_id'];

		$title = $_POST['title'];
		$post = $_POST['post'];		

		$sql = "UPDATE blog 
			SET title = '$title',				
				post = '$post'
				 WHERE id='$id'";

		mysqli_query($sample->con,$sql);

		header('Location: adminblog.php');
	}
?>