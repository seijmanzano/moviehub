<?php 
	require 'connection.php';
	$sample = new Sample();
	if(isset($_POST['deletedata']))
	{
		$id = $_POST['delete_id'];

		$sql = "DELETE FROM blog 
			WHERE id='$id'";

		mysqli_query($sample->con,$sql);
		header('Location: adminblog.php');

	}
 ?>