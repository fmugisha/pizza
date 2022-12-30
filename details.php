<?php
  
  include('config/db_connect.php');

  if(isset($_POST['delete'])) {
  	$id_to_delete = mysqli_real_escape_string($db_connect, $_POST['id_to_delete']);

  	$sql = "DELETE FROM pizzas WHERE id=$id_to_delete";

  	if(mysqli_query($db_connect, $sql)) {
  		header('Location: index.php');
  	} else {
  		echo 'query error: ' . mysqli_error($db_connect);
  	}
  }

  if(isset($_GET['id'])) {
  	$id = mysqli_real_escape_string($db_connect, $_GET['id']);

  	$sql = "SELECT * FROM pizzas WHERE id=$id";

  	$result = mysqli_query($db_connect, $sql);

  	$pizza = mysqli_fetch_assoc($result);

  	mysqli_free_result($result);
  	mysqli_close($db_connect);
  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo htmlspecialchars($pizza['title']); ?> | BabuPizza</title>
	<link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>

	<?php include('templates/header.php') ?>

	<div class="container center">
		<?php if($pizza): ?>
			<h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
			<p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
			<p><?php echo htmlspecialchars($pizza['created_at']); ?></p>
			<h5>Ingredients:</h5>
			<p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

			<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
				<a href="update.php?id=<?php echo $pizza['id'] ?>" class="btn brand z-depth-0">Edit</a>
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
		<?php else: ?>
			<h5>There is no such pizza exists!</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php') ?>

</body>
</html>