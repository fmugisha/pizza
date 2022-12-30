<?php
  
  include('config/db_connect.php');

  $username_email = $password = '';
  $errors = array('user'=>'', 'password'=>'');

  if(isset($_POST['login'])) {
  	$username_email = $_POST['email'];
  	$password = $_POST['password'];

  	$data = mysqli_query($db_connect, "SELECT * FROM user WHERE username = '$username_email' OR email = '$username_email'");

  	$user = mysqli_fetch_assoc($data);

  	if(mysqli_num_rows($data) > 0) {
  		if($password== $user['password']) {
  			setcookie('user', $user['firstname'], time() + 60);
  			session_start();
  			$_SESSION["login"] = true;
  			$_SESSION['id'] = $user['id'];

  			header('Location: index.php');
  		} else {
  			$errors['password'] = 'Wrong password!';
  		}
  	} else {
  		$errors['email'] = 'User is not registered!';
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | BabuPizza</title>
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
				<li><a href="register.php" class="btn brand z-depth-0">Register</a></li>
			</ul>
		</div>
	</nav>
	<section class="container grey-text">
		<h4 class="center">Login</h4>
		<form class="white" action="login.php" method="POST">
			<label>Username or Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($username_email); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['user'];
				?>
			</div>
			<label>Password:</label>
			<input type="password" name="password"/>
			<div class="red-text">
				<?php
				  echo $errors['password'];
				?>
			</div>
			<div class="center">
				<input type="submit" name="login" value="Login" class="btn brand z-depth-0" />
			</div>
		</form>
	</section>
	<?php include('templates/footer.php') ?>
</body>
</html>