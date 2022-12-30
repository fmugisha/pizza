<?php
  
  include('config/db_connect.php');

  $fname = $sname = $username = $email = $password = $confirmpassword = '';
  $errors = array('fname'=>'', 'username'=>'', 'email'=>'', 'password'=>'');
  $info = array('errors'=>'', 'valid'=>'');
  
  if(isset($_POST['register'])) {
  	$fname = $_POST['fname'];
  	$sname = $_POST['sname'];
  	$username = $_POST['uname'];
  	$email = $_POST['email'];
  	$password = $_POST['password1'];
  	$confirmpassword = $_POST['password2'];

  	$exist_uname = mysqli_query($db_connect, "SELECT * FROM user WHERE username = '$username'");

  	$exist_email = mysqli_query($db_connect, "SELECT * FROM user WHERE email = '$email'");

  	if(empty($fname) OR empty($sname)) {
  		$errors['fname'] = "Please atleast FirstName is required!";
  	}

  	if(empty($username)) {
  		$errors['username'] = "Username is required!";
  	} else {
  		if(!preg_match('/[a-z]{4}/', $username)) {
  			$errors['username'] = "Username is not valid";
  		} else {
  			if(mysqli_num_rows($exist_uname) > 0) {
  				$errors['username'] = "Username has already taken!";
  			}
  		}
  	}

  	if(empty($email)) {
  		$errors['email'] = "Email is required!";
  	} else {
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$errors['email'] = "Email is not valid";
  		} else {
  			if(mysqli_num_rows($exist_email) > 0) {
  				$errors['email'] = "Email has already taken!";
  			} else {
  				if($password != $confirmpassword) {
  					$errors['password'] = "Passwords are not matching!";
  				}
  			}
  		}
  	}

  	if(array_filter($errors)) {
  		$info['errors'] = "There is some errors in a form!";
  	} else {
  		$first_name = mysqli_real_escape_string($db_connect, $fname);
  		$second_name = mysqli_real_escape_string($db_connect, $sname);
  		$user_name = mysqli_real_escape_string($db_connect, $username);
  		$mail = mysqli_real_escape_string($db_connect, $email);
  		$passWord = mysqli_real_escape_string($db_connect, $password);

  		$store = "INSERT INTO user(firstname, secondname, username, email, password) VALUES('$first_name', '$second_name', '$user_name', '$mail', '$passWord')";

  		if(mysqli_query($db_connect, $store)) {
  			header('Location: login.php');
  		  echo "<script> alert('Register account Successful!'); </script>";
  		} else {
  			echo "query error: " . mysqli_error($db_connect);
  		}
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register | BabuPizza</title>
	<link rel="icon" href="images/logo.png" type="image/png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<style>
		::-webkit-scrollbar {
			width: 20px;
			height: 10px;
		}
		::-webkit-scrollbar-track {
			background: transparent;
		}
		::-webkit-scrollbar-thumb {
			background-color: #cbb09c;
			border-radius: 25px;
			border: 5px solid #f5f5f5 !important;
		}
		.brand {
			background: #cbb09c !important;
		}

		.brand-text {
			color: #cbb09c !important;
		}

		form {
			max-width: 460px;
			margin: 20px auto;
			padding: 20px;
		}

		.pizza {
			width: 100px;
			margin: 40px auto -30px;
			display: block;
			position: relative;
			top: -30px;
		}
		.tit {
			font-weight: 600;
		}
	</style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
		<div class="container">
			<a href="index.php" class="brand-logo brand-text">BabuPizza</a>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
				<li><a href="login.php" class="btn brand z-depth-0">Login</a></li>
			</ul>
		</div>
	</nav>
	<section class="container grey-text">
		<h4 class="center">Register Account</h4>
		<form class="white" action="" method="POST">
			<label>First Name:</label>
			<input type="text" name="fname" value="<?php echo htmlspecialchars($fname); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['fname'];
				?>
			</div>
			<label>Second Name:</label>
			<input type="text" name="sname" value="<?php echo htmlspecialchars($sname); ?>"/>
			<label>Username:</label>
			<input type="text" name="uname" value="<?php echo htmlspecialchars($username); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['username'];
				?>
			</div>
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['email'];
				?>
			</div>
			<div class="red-text">
			<label>Password:</label>
			<input type="password" name="password1" value="<?php echo htmlspecialchars($password); ?>"/>
			<label>Confirm Password:</label>
			<input type="Password" name="password2" value="<?php echo htmlspecialchars($confirmpassword); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['password'];
				?>
			</div>
			<div class="center">
				<input type="submit" name="register" value="Register" class="btn brand z-depth-0" />
			</div>
			<div class="red-text" style="text-align: center;">
				<?php
				  echo $info['errors'];
				?>
			</div>
		</form>
	</section>
	<?php include('templates/footer.php') ?>
</body>
</html>