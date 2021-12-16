<?php

	class Sample{

		private $dbhost = "localhost";
		private $dbuser = "root";
		private $dbpass = "";
		private $dbname = "moviehubdb";
		public $con;

		public function __construct(){
			try {
				$this->con = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
			} catch (Exception $e) {
				echo "connection failed" . $e->getMessage();
			}
		}

		public function login(){
			if(isset($_POST['login'])){
				if(isset($_POST['username']) && isset($_POST['password'])){
					if(!empty($_POST['username']) && !empty($_POST['password'])){
						$username = $_POST['username'];
						$password = $_POST['password'];
						
						$query = "SELECT * FROM login WHERE username = '$username'";
						$result = $this->con->query($query);
						if($result) {
							$userdata = mysqli_fetch_assoc($result);
							
							if($userdata['password'] === $password){
								$_SESSION['id'] = $userdata['id'];
								echo "<script>window.location.href = 'index.php';</script>";
								die;
							}
							
						}
						echo '<script>alert("Usename or password is incorrect!")</script>';
						echo "<script>window.location.href = 'login.php';</script>";
					}
					else{echo "<script>alert('Fill up the required information!');</script>";
						 echo "<script>window.location.href = 'login.php';</script>";
					}
				}
			}
		}

		public function check_log(){
			if(isset($_SESSION['id'])){
				$id = $_SESSION['id'];

				$query = "SELECT * FROM login WHERE id = '$id'";
				$result = $this->con->query($query);
				if ($result){
					$userdata = mysqli_fetch_assoc($result);
					return $userdata;
				}
			}
			else {echo "<script>window.location.href = 'index.php';</script>";}
		}

		public function book(){
			if (isset($_POST['book'])){

				if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['ticketNum']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['regular-small-counts']) && isset($_POST['regular-medium-counts']) && isset($_POST['regular-large-counts']) && isset($_POST['cheese-small-counts']) && isset($_POST['cheese-medium-counts']) && isset($_POST['cheese-large-counts']) && isset($_POST['caramel-small-counts']) && isset($_POST['caramel-medium-counts']) && isset($_POST['caramel-large-counts']) && isset($_POST['cola-small-counts']) && isset($_POST['cola-medium-counts']) && isset($_POST['cola-large-counts']) && isset($_POST['tea-small-counts']) && isset($_POST['tea-medium-counts']) && isset($_POST['tea-large-counts']) && isset($_POST['royal-small-counts']) && isset($_POST['royal-medium-counts']) && isset($_POST['royal-large-counts'])){

						$row = $this->select($_SESSION['temp']);

						$row['seats'] = $row['seats'] - $_POST['ticketNum'];

						$query = "UPDATE movies SET seats='$row[seats]'";
						$result = $this->con->query($query);

						$name = $_POST['name'];
						$email = $_POST['email'];
						$ticketNum = $_POST['ticketNum'];
						$date = $_POST['date'];
						$time = $_POST['time'];
						$regular_small = $_POST['regular-small-counts'];
						$regular_medium = $_POST['regular-medium-counts'];
						$regular_large = $_POST['regular-large-counts'];
						$cheese_small = $_POST['cheese-small-counts'];
						$cheese_medium = $_POST['cheese-medium-counts'];
						$cheese_large = $_POST['cheese-large-counts'];
						$caramel_small = $_POST['caramel-small-counts'];
						$caramel_medium = $_POST['caramel-medium-counts'];
						$caramel_large = $_POST['caramel-large-counts'];
						$cola_small = $_POST['cola-small-counts'];
						$cola_medium = $_POST['cola-medium-counts'];
						$cola_large = $_POST['cola-large-counts'];
						$tea_small = $_POST['tea-small-counts'];
						$tea_medium = $_POST['tea-medium-counts'];
						$tea_large = $_POST['tea-large-counts'];
						$royal_small = $_POST['royal-small-counts'];
						$royal_medium = $_POST['royal-medium-counts'];
						$royal_large = $_POST['royal-large-counts'];

						$query = "INSERT INTO booking (name, email, num_of_ticket, date, time, regular_small, regular_medium, regular_large, cheese_small, cheese_medium, cheese_large, caramel_small, caramel_medium, caramel_large, cola_small, cola_medium, cola_large, tea_small, tea_medium, tea_large, royal_small, royal_medium, royal_large) VALUES ('$name','$email','$ticketNum','$date','$time','$regular_small','$regular_medium','$regular_large','$cheese_small','$cheese_medium','$cheese_large','$caramel_small','$caramel_medium','$caramel_large','$cola_small','$cola_medium','$cola_large','$tea_small','$tea_medium','$tea_large','$royal_small','$royal_medium','$royal_large')";
						
						if ($result = $this->con->query($query)){
							unset($_POST['book']);
							echo "<script>alert('Book successfull!');</script>";
							echo "<script>window.location.href = 'booking.php';</script>";
						}else{
							echo "<script>alert('Booking failed!');</script>";
							echo "<script>window.location.href = 'booking.php';</script>";
						}
				}
			}
		}

		public function read_all(){
			$data = null;

			$query = "SELECT * FROM movies";
			if ($result = $this->con->query($query)){
				while ($row = mysqli_fetch_assoc($result)){
					$data[] = $row;
				}
			}
			return $data;
		}

		public function addmovie(){

			if (isset($_POST['add'])){
				if (isset($_POST['title']) && isset($_POST['description']) && isset($_FILES['myfile']['name']) && isset($_POST['price']) && isset($_POST['ytlink']) && isset($_POST['ticketNum']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['cinema'])){
						
						$title=$_POST['title'];
						$description=$_POST['description'];
						$temp=$_FILES['myfile']['tmp_name'];
						$posterpic="images/".$_FILES['myfile']['name'];
						$price=$_POST['price'];
						$ytlink=$_POST['ytlink'];
						$ticketNum=$_POST['ticketNum'];
						$date=$_POST['date'];
						$time=$_POST['time'];
						$cinema=$_POST['cinema'];

						$query = "INSERT INTO movies (title,description,posterpic,price,ytlink,seats,date,time,cinema) VALUES ('$title','$description','$posterpic','$price','$ytlink','$ticketNum','$date','$time','$cinema')";
						if ($result = $this->con->query($query)){
							move_uploaded_file($temp,$posterpic);
							echo "<script>alert('Movie added successfully!');</script>";
							echo "<script>window.location.href = 'adminmovies.php';</script>";
						}else{
							echo "<script>alert('Failed to add movie!');</script>";
							echo "<script>window.location.href = 'adminmovies.php';</script>";
						}
				}
			}
		}

		public function select($id){
			$data = null;

			$query = "SELECT * FROM movies WHERE id = '$id'";
			if ($result = $this->con->query($query)){
				while($row = $result->fetch_assoc()){
					$data = $row;
				}
			}
			return $data;
		}

		public function updatemovie($data){

			$query = "UPDATE movies SET title='$data[title]', description='$data[description]', price='$data[price]', ytlink='$data[ytlink]', seats='$data[seats]', date='$data[date]', time='$data[time]', cinema='$data[cinema]' WHERE id='$data[id] '";

			if ($result = $this->con->query($query)){
				echo "<script>alert('Movie updated successfully!');</script>";
                echo "<script>window.location.href = 'adminmovies.php';</script>";
			}else{
				echo "<script>alert('Failed to update movie!');</script>";
                echo "<script>window.location.href = 'adminmovies.php';</script>";
			}
		}

		public function deletemovie($id){

			$query = "DELETE FROM movies where id = '$id'";
			if ($result = $this->con->query($query)){
				echo "<script>alert('Movie Deleted!');</script>";
				echo "<script>window.location.href = 'adminmovies.php';</script>";
			}else{
				echo "<script>alert('Failed to delete movie!');</script>";
                echo "<script>window.location.href = 'adminmovies.php';</script>";
			}
		}

	}
?>