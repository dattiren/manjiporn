<?php
    $admin_flag = False;
    $title = 'MANJI_pc_top';
?>
<!DOCTYPE html>
<html lang="ja">

<?php include('head.php'); ?>

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
