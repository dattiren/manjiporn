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
	<header>
		<div class="header-container">
			<a class="header-container-logo" href="index.php">
				<img src="logo.png" alt="">
			</a>
			<form class="header-container-searchform" name="searchform" method="get" action="#">
				<input name="keywords" value="" type="text" />
				<button type="submit" alt="検索" name="searchBtn4"></button>
			</form>
			<a href="#" class="header-container-create">
				CREATE ACCOUNT
			</a>
			<a href="#" class="header-container-login">
				LOGIN
			</a>
		</div>
	</header>
	<div class="container">
		<div class="container-senctions">
			<section class="container-sections-one">
				<h1>RECENTLY POPULAR</h1>
				<?php for($i=0;$i<=20;$i++): ?>
					<article class="container-sections-one-movie">
						<img src="rocket.jpg" alt="">
						<div class="container-sections-one-movie-info">
							<a class="container-sections-one-movie-info-link" href="playback.php">
								<h2>Big tits sample big tits sampleadf aef;w eihfd'q oefhia eorif hq[oriag hfae[ori big tits sample big tits sampleadfaef;weihf　d'qoefhiaeo　rifhq[oria　ghfae[or　っっっっ　ｄi</h2>
							</a>
							<div class="container-sections-one-movie-info-infomation">
								<span>
									<i class="fa fa-play-circle" aria-hidden="true"></i>44444</span>
								<span>
									<i class="fa fa-folder" aria-hidden="true"></i>ddddd</span>
							</div>
							<div class="container-sections-one-movie-info-category">
								<a>wawawa</a>
								<a>fefefefefe</a>
								<a>tintintintin</a>
								<a>ponponpnop</a>
							</div>
						</div>
					</article>
				<?php endfor; ?>
			</section>
			<section class="container-sections-one">
				<h1>Recommended</h1>
				<article class="container-sections-one-movie">
					<img src="rocket.jpg" alt="">
					<div class="container-sections-one-movie-info">
						<a class="container-sections-one-movie-info-link" href="#">
							<h2>Big tits sample big tits sampleadfaef;weihfd'qoefhiaeorifhq[oriaghfae[ori big tits sample big tits sampleadfaef;weihfd'qoefhiaeorifhq[oriaghfae[ori</h2>
						</a>
						<div class="container-sections-one-movie-info-infomation">
							<span>
								<i class="fa fa-play-circle" aria-hidden="true"></i>44444</span>
							<span>
								<i class="fa fa-folder" aria-hidden="true"></i>ddddd</span>
						</div>
						<div class="container-sections-one-movie-info-category">
							<a>wawawa</a>
							<a>fefefefefe</a>
							<a>tintintintin</a>
							<a>ponponpnop</a>
						</div>
					</div>
				</article>
			</section>
		</div>
		<div class="container-side">
			<nav class="contaier-side-category">
				<h1>
					<i class="fa fa-bed" aria-hidden="true"></i>CATEGORY</h1>
				<ul class="contaier-side-category-list">
					<li>
						<i class="fa fa-square-o" aria-hidden="true"></i>
						<a href="">aaaaaa</a>
					</li>
					<li>
						<i class="fa fa-check-square-o" aria-hidden="true"></i>
						<a href="">bbbbb</a>
					</li>
					<li>
						<i class="fa fa-square-o" aria-hidden="true"></i>
						<a href="">vcvcv</a>
					</li>
					<li>
						<i class="fa fa-square-o" aria-hidden="true"></i>
						<a href="">popopop</a>
					</li>
				</ul>
			</nav>
			<div class="contaier-side-adsence">ad</div>
			<div class="contaier-side-adsence">ad</div>
		</div>
	</div>
	<div class="adsence"></div>
	<footer>footer
		<a href="use_info.php">利用規約</a>
		<a href="contact.php">お問い合わせ</a>
	</footer>
</body>
</html>