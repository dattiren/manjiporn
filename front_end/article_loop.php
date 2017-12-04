<?php
//データの持ち方は以下の通り
$a_movie_data = array(
	'title'       => 'Big tits sample big tits sampleadf aef;w eihfdq oefhia eorif hq[oriag hfae[ori big tits sample big tits sampleadfaef;weihf　dqoefhiaeo　rifhq[oria　ghfae[or　っっっっ　ｄi',
	'movie_link'  => 'playback.php',
	'img_link'    => 'rocket.jpg',
	'categories'    => array(
			'wawawa', 'fefefe', 'titititi', 'popopo'
	),
	'count'       => 44444
);
//ループのため12個の配列を作る
$loop_data;
for($i=0;$i<12;$i++){
	$loop_data[] = $a_movie_data;
}
?>

<?php foreach($loop_data as $data): ?>
			<article class="container-sections-one-movie">
				<a href="<?php echo $data['movie_link']; ?>"><img src="<?php echo $data['img_link']; ?>" alt=""></a>
				<div class="container-sections-one-movie-info">
					<a class="container-sections-one-movie-info-link" href="<?php echo $data['movie_link']; ?>">
						<h2><?php echo $data['title']; ?></h2>
					</a>
					<div class="container-sections-one-movie-info-infomation">
						<span class="container-sections-one-movie-info-infomation-play">
							<i class="fa fa-play-circle" aria-hidden="true"></i><?php echo $data['count']; ?>
						</span>
						<span class="container-sections-one-movie-info-infomation-folder">
							<i class="fa fa-folder" aria-hidden="true"></i>ddddd
						</span>
					</div>
					<div class="container-sections-one-movie-info-category">
						<?php foreach($data['categories'] as $category): ?>
							<a href="#"><?php echo $category; ?></a>
						<?php endforeach;?>
					</div>
				</div>
			</article>
<?php endforeach; ?>