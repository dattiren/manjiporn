<?php
$Myclass = new App\MyLibs\MyClass;
?>
<?php foreach($movies as $movie): ?>
			<article class="container-sections-one-movie">
				<a href="/movie?movie_id=<?php echo $movie->id; ?>"><img src="<?php echo 'rocket.jpg'; ?>" alt=""></a>
				<div class="container-sections-one-movie-info">
					<a class="container-sections-one-movie-info-link" href="/movie?movie_id=<?php echo $movie->id; ?>">
						<h2><?php echo substr($movie->title, 0, 60).'...'; ?></h2>
					</a>
					<div class="container-sections-one-movie-info-infomation">
						<span class="container-sections-one-movie-info-infomation-play">
							<i class="fa fa-play-circle" aria-hidden="true"></i><?php echo $movie->played_count; ?>
						</span>
						<span class="container-sections-one-movie-info-infomation-folder">
							<!--<i class="fa fa-folder" aria-hidden="true"></i>ddddd-->
						</span>
					</div>
					<div class="container-sections-one-movie-info-category">
					<?php $categories =  $Myclass->getCategories($movie->id);?>
						<?php foreach($categories as $category):?>
							<a href="#"><?php echo $category; ?></a>
						<?php endforeach;?>
					</div>
				</div>
			</article>
<?php endforeach; ?>