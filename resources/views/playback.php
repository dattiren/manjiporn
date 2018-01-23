<?php
		$title = $movie_data->title;
		$CAT = false;
		$admin_flag = false;
		$Myclass = new App\MyLibs\MyClass;
		$categories =  $Myclass->getCategoriesByMovieId($movie_data->id);
?>

<!DOCTYPE html>
<html lang="ja">

<?php include('head.php'); ?>

<body>
<?php include('header.php'); ?>
	<div class="container">
		<div class="container-senctions">
			<section class="container-sections-one">
				<div class="container-sections-one-playback">
					<iframe src="<?php echo $movie_data->url; ?>" frameborder="0" allowfullscreen>
					</iframe>
				</div>
				<div class="container-sections-one-playback-info">
					<h2><?php echo $movie_data->title?></h2>
					<div class="container-sections-one-playback-infomation">
						<span>
							<i class="fa fa-play-circle" aria-hidden="true"></i><?php echo $movie_data->played_count; ?>
						</span>
						<!--<span>
							<i class="fa fa-folder" aria-hidden="true"></i>ddddd
						</span>-->
					</div>
					<div class="container-sections-one-playback-category">
					<?php foreach($categories as $category): ?>
						<a href="/category?category_id=<?php echo $category->id;?>"><?php echo $category->name; ?></a>
					<?php endforeach; ?>
					</div>
					<div class="container-sections-one-playback-report">
					<!-- <a href="#">Add to Mylist</a> -->
					<a href="#">Can't watch</a>
					</div>
				</div>
			</section>
			<section class="container-sections-one">
			<h1>Others Recommended</h1>
			<?php include('article_loop.php'); ?>
		</section>
		</div>
		<?php include('side_nav.php'); ?>
	</div>
	<div class="adsence"></div>
	<?php include('footer.php'); ?>
</body>

</html>
