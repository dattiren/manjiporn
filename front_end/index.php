<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<script src="https://use.fontawesome.com/8135123537.js"></script>
	<title>MANJI_pc_top</title>
</head>

<body>
<?php include('header.php'); ?>
	<div class="container">
		<div class="container-senctions">
			<section class="container-sections-one">
				<h1>RECENTLY POPULAR</h1>
				<?php include('article_loop.php'); ?>
			</section>
			<section class="container-sections-one">
				<h1>Recommended</h1>
				<?php include('article_loop.php'); ?>
			</section>
		</div>
		<?php include('side_nav.php'); ?>
	</div>
	<div class="adsence"></div>
	<?php include('footer.php'); ?>
</body>
</html>