<?php

  include('config/db_connect.php');
  
  if(isset($_GET['id'])) {
  	$id = mysqli_real_escape_string($db_connect, $_GET['id']);

  	$pizza_data = "SELECT * FROM pizzas WHERE id = $id";

  	$data_connect = mysqli_query($db_connect, $pizza_data);

  	$data_fetch = mysqli_fetch_assoc($data_connect);

  	mysqli_free_result($data_connect);
  }

  $id = $_GET['id'];
  if(isset($_POST['update'])) {
  	$image = $_FILES['image']['name'];
  	$email = $_POST['email'];
  	$title = $_POST['title'];
  	$ingredients = $_POST['ingredients'];

  	if($image == NULL) {
  		$image_data = $data_fetch['image'];
  	} else {
  		if($folder = "upload/".$_FILES['image']['name']) {
  			unlink($folder);
  			$image_data = $image;
  		}
  	}

  	$sql = "UPDATE pizzas SET image = '$image', title ='$title', ingredients ='$ingredients', email ='$email' WHERE id=$id";

  	if(mysqli_query($db_connect, $sql)) {
  		  move_uploaded_file($_FILES['image']['tmp_name'], "upload/".$_FILES['image']['name']);
  		  header('Location: index.php');
  	} else {
  		  echo 'query error: ' . mysqli_error($db_connect);
  	}

  	mysqli_close($db_connect);
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update | BabuPizza</title>
	<link rel="icon" href="images/logo.png" type="image/png">
	<style>
		.image-upload {
			width: 100%;
			margin: 1rem 0;
		}
	</style>
</head>
<body>

	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Edit Pizza</h4>
		<form class="white" action="" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($data_fetch['email']); ?>"/>
			<label>Pizza Title:</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($data_fetch['title']); ?>"/>
			</div>
			<label>Ingredients (comma separeted):</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($data_fetch['ingredients']); ?>"/>
			<label>Image:</label>
			<input type="file" name="image" class="image-upload"/>
			<div class="center">
				<a href="index.php" class="btn brand z-depth-0">Cancel</a>
				<input type="submit" name="update" value="Update" class="btn brand z-depth-0" style="background-color: seagreen !important;" />
			</div>
		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</body>
</html>