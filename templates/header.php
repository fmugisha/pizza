<?php
  
  include('config/db_connect.php');

  session_start();

  if(!empty($_SESSION['id'])) {
  	$id = $_SESSION['id'];

  	$data = mysqli_query($db_connect, "SELECT * FROM user WHERE id = $id");

  	$user = mysqli_fetch_assoc($data);

  } else {
  	header('Location: login.php');
  }
?>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BabuPizza</title>
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
		.center-pro {
			margin-left: 40%;
			display: inline-block;
		}
		.img-pro {
			position: relative;
			margin-top: 0.5rem;
			margin-left: 0.5rem;
			width: 100%;
			height: 100%;
			max-width: 40px;
			max-height: auto;
			border-radius: 50%;
		}
		.logout {
			color: grey !important;
		}
		.logout:hover {
			background-color: transparent !important;
		}
	</style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
		<div class="container">
			<a href="index.php" class="brand-logo brand-text">BabuPizza</a>
			<ul id="nav-mobile" class="center-pro hide-on-small-and-down">
			  <li class="grey-text">Welcome, <?php echo $user['firstname']; ?></li>
				<!--img src="images/bro.jpg" class="img-pro"-->
			</ul>
			<ul id="nav-mobile" class="right hide-on-small-and-down">
			    <li class="grey-text"><a href="logout.php" class="logout">Logout</a></li>
			    <li><a href="add.php" class="btn brand z-depth-0">Add Pizza</a></li>
			</ul>
		</div>
	</nav>