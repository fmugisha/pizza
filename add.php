<?php

  include('config/db_connect.php');
  
  $email = $title = $ingredients = '';
  $errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
  $info = array('errors'=>'', 'valid'=>'');

  if(isset($_POST['submit'])) {
  	if(empty($_POST['email'])) {
  		$errors['email'] = 'An email is required <br/>';
  	} else {
  		$email = $_POST['email'];
  		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			$errors['email'] = 'This is not valid email!';
  		}
  	}

  	if(empty($_POST['title'])) {
  		$errors['title'] = 'A title is required <br/>';
  	} else {
  		$title = $_POST['title'];
  		if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
  			$errors['title'] = 'This is not valid title!';
  		}
  	}

  	if(empty($_POST['ingredients'])) {
  		$errors['ingredients'] = 'An ingredients is required <br/>';
  	} else {
  		$ingredients = $_POST['ingredients'];
  		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
  			$errors['ingredients'] = 'Ingredients must be a list separated by commas!';
  		}
  	}

  	if(array_filter($errors)) {
  		$info['errors'] = 'There is some error in a form';
  	} else {

  		$email = mysqli_real_escape_string($db_connect, $_POST['email']);
  		$title = mysqli_real_escape_string($db_connect, $_POST['title']);
  		$ingredients = mysqli_real_escape_string($db_connect, $_POST['ingredients']);

  		$sql = "INSERT INTO pizzas(email, title, ingredients) VALUES('$email', '$title', '$ingredients')";

  		if(mysqli_query($db_connect, $sql)) {
  			header('Location: index.php');
  		} else {
  			echo 'query error: ' . mysqli_error($db_connect);
  		}
  	}
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add | BabuPizza</title>
	<link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>

	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['email'];
				?>
			</div>
			<label>Pizza Title:</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['title'];
				?>
			</div>
			<label>Ingredients (comma separeted):</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients);  ?>"/>
			<div class="red-text">
				<?php
				  echo $errors['ingredients'];
				?>
			</div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0" />
			</div>
			<div class="red-text" style="text-align: center;">
				<?php
				  echo $info['errors'];
				?>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</body>
</html>