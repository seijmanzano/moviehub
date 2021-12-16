<?php 
	include 'connection.php';
	$sample = new Sample();
	$id = $_REQUEST['id'];
	$deletemovie = $sample->deletemovie($id);

 ?>