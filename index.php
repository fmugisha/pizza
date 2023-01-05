<?php

  include('config/db_connect.php');

  $sql = 'SELECT image, title, ingredients, id FROM pizzas ORDER BY created_at';

  $result = mysqli_query($db_connect, $sql);

  $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_free_result($result);
  mysqli_close($db_connect);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | BabuPizza</title>
	<link rel="icon" href="images/logo.png" type="image/png">
</head>
<body>
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Pizzas!</h4>
	<div class="container">
		<div class="row">
			<?php foreach($pizzas as $pizza): ?>

				<div class="col s4 md3">
					<div class="card z-depth-0">
					    <?php echo '<img src="upload/'.$pizza['image'].'" class="pizza">'?>
						<div class="card-content center">
							<h6 class="tit"><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul>
								<?php foreach(explode(',', $pizza['ingredients']) as $ingredient): ?>
									<li><?php echo htmlspecialchars($ingredient); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>
</body>
</html>