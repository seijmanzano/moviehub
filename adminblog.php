<!DOCTYPE html>
<html>
<head>
	<!--inedit ko ulet db yung date nirename ko ng dateofpost hehe saka yung datatype ng post ginawa kong text500 kasi di makuha lahat ng varchar -->
	<meta charset="utf-8">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" 
	rel="stylesheet" 
	integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" 
	crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<style>
		body
		{
		  font-family: 'Tahoma',sans-serif;
		  background-color: #14213D;
		}

		a{
			text-decoration: none;
			cursor: pointer;
		}
		header{
		font-size: 30px;
		position:relative;
		width: 100%;
		background:#FCA311;
	    padding: 10px 100px;
		box-sizing: border-box;
		/*border-radius: 4px;*/
		box-shadow: 0 2px 5px rgba(0,0,0,.2);
		}

		.logo{
			color:#2980b9;
			height: 50px;
			font-size: 36px;
			line-height: 60px;
			padding: 0 20px;
			text-align: center;
			box-sizing: border-box;
			float: left;
			font-weight: 700;
			text-decoration: none;
			color: white;
			text-shadow: 2px 2px 4px black;
			font-family: Tahoma;
			

		}

		.hubDesign{
			color:#14213D;
			border:5px solid black;
			text-shadow: 2px 2px 4px #EEE;
			border-radius: 5px;
		}

		/*nav{
			float:right;
		}*/
		.clearfix{
			clear: both;
		}

		nav ul{
			margin: 0;
			padding:0;
			display: flex;
			float: right;
		}

		nav ul li {
			list-style: none;

		}
		nav ul li a{

			display:block;
			margin:10px 2px;
			padding: 10px 10px;
			text-decoration: none;
			color:#262626;
			font-size: 18px;
			


		}

		nav ul li a.active{
			color:white;
			background-color: black;
			border-radius: 5px;
			/*font-weight: 800;*/
		}

		nav ul li a:hover{
			color:black;
			transition: 0.3s;
			background-color: #ddd;
			border-radius: 5px;

		}
	</style>
</head>
<body>
	<header >
		<a href="index.php" class="logo">Movie <span class="hubDesign">hub</span></a>
		<nav>

			<ul class="menu">
				<li><a href="index.php" >Home</a></li>
				<li><a href="adminmovies.php">Booking</a></li>
				<li><a href="adminblog.php"  class="active">Blogs</a></li>
			</ul>

		</nav>
		<div class="clearfix"></div>

	</header>
<!-- Nav -->


<!-- Modal  add-->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="add.php" method="POST">
      	<div class="modal-body">
				  <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Title</label>
				    <input type="text" class="form-control" name="title" placeholder="Enter Name">
				  </div>
				  <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Post</label>
				    <textarea type="text" class="form-control" name="post" placeholder="Enter Post"></textarea>
				  </div>
				 <!-- <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">Email address</label>
				    <input type="text" class="form-control" name="email" placeholder="Enter Email">
				  </div>
				   <div class="mb-3">
				    <label for="exampleInputEmail1" class="form-label">GPA</label>
				    <input type="text" class="form-control" name="gpa" placeholder="Enter GPA">
				  </div>
				  <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Password</label>
				    <input type="text" class="form-control" name="pass" placeholder="Enter Password">
				  </div>
				  <div class="mb-3">
				    <label for="exampleInputUsertype1" class="form-label">User type</label>
				    <input type="text" class="form-control" name="usertype" placeholder="'user' or 'admin'">
				  </div> -->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" name="insertdata" class="btn btn-primary">Add Post</button>
		      </div>
      	</form>

    </div>
  </div>
</div>

<!-- blog informations -->


       <?php 
         		include 'connection.php';
         		$sample = new Sample();
         		$sql = "SELECT * FROM blog ORDER BY dateofpost DESC";
						$res = mysqli_query($sample->con,$sql);

				?>
				

<div class="container pt-5 color-white">
  <div class="row">
    <div class="col-12">
      <table class="table " bgcolor="#eee">
      	<thead bgcolor="#aaa">
           <th scope="col" colspan="7" style="text-align: right" >
		            	<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#add" style="background:#1F51FF;margin-right:20px; color:white; border:solid 1px black" > Make a Post</button>
						</th>
      	</thead>     
        <?php  
						if($res){
							foreach ($res as $row) {
				?>
		        <tbody class="find">		    
				<!--	<tr> 
						<td id="post-id"><?php //echo $row['id'] ?></td>
						<td align="right">
							<button type="button" class="btn btn-primary editbtn" style="background-color:#00cc7b;border: solid 1px #00cc7b">Update</button>
						</td>
						<td align="center">
							<button type="button" class="btn btn-danger deletebtn">Delete</button>
						</td>
					</tr>
					<tr> 
						<td style="padding:0px 100px" id="post-title"><?php //echo $row['title'] ?></td>
					</tr>
					<tr> 
						<td style="padding:0px 100px">By: Seiji Manzano</td>
					</tr>
		         	<tr> 
		         		<td style="padding:0px 100px"><?php //echo $row['dateofpost'] ?></td> 		         		
		         	</tr>
		         	<tr>
		         	 <td style="padding:50px 100px" id="posts"><?php //echo $row['post'] ?></td> 
		         	</tr>  -->
		         	<tr>
		        		<td><?php echo $row['id'] ?></td>		        		
		         		<td><?php echo $row['title'] ?></td>
		         		<td style="padding:0px 100px">By: Seiji Manzano</td>
		         		<td>
		         			<?php 
		         								$changedate = date("M d, Y", strtotime($row['dateofpost']));
		         						echo "Date: ". $changedate; ?>
		         		</td>
		         		<td><?php echo $row['post'] ?></td>
								<td align="center">
									<button type="button" class="btn btn-primary editbtn">Update</button>
								</td>
								<td align="center">
									<button type="button" class="btn btn-danger deletebtn">Delete</button>
								</td>
		         		

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

<!--Modal  update-->
<div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="updates.php" method="POST">
      	<div class="modal-body">
      		<input type="hidden" name="update_id" id="update_id">
				  
				  <div class="mb-3">
				    <label  class="form-label">Title</label>
				    <input type="text" class="form-control" name="title" id="title"  value="" placeholder="Title">
				  
				  </div>
				 <!-- <div class="mb-3">
				    <label class="form-label">Age</label>
				    <input type="number" class="form-control" name="age" id="age" placeholder="Enter Age">
				  </div> -->

				  
				  <div class="mb-3">
				    <label class="form-label">Post</label>
				    <input type="text" class="form-control" name="post" id="post"  value="" placeholder="Post">
				  
				  </div>
				  <!-- <div class="mb-3">
				    <label class="form-label">GPA</label>
				    <input type="text" class="form-control" name="gpa" id="gpa" placeholder="Enter GPA">
				  
				  </div> -->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" name="updatedata" class="btn btn-primary">Save changes</button>
		      </div>

      	</form>

    </div>
  </div>
</div>


<!-- Modal  Delete-->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="deletes.php" method="POST">
      	<div class="modal-body">
      		<input type="hidden" name="delete_id" id="delete_id">
				  
						<h4>Do you want to delete this post?</h4>
				  
				  </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
		        <button type="submit" name="deletedata" class="btn btn-primary">Yes</button>
		      </div>
      	</form>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" 
	integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" 
	crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

<!--Delete function-->
<script>
	$(document).ready(function() {
		$('.deletebtn').on('click', function(){

				$('#delete').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

					console.log(data);

					$('#delete_id').val(data[0]);
			
		});
	});
</script>

<!-- Update function -->
<script>
	$(document).ready(function() {
		$('.editbtn').on('click', function(){

				$('#update').modal('show');
				
				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

					console.log(data);

					$('#update_id').val(data[0]);
					$('#title').val(data[1]);
					//$('#date').val(data[2]);
					$('#post').val(data[4]);
				

		});
	});

</script>
</html>