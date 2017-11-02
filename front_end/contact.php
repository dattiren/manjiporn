<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/8135123537.js"></script>
    <title>CONTACT FORM</title>
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
        <h1 class="container-singletitle">Contact form</h1>
        <div class="container-contact">
            <form action="#">
                <label for="name">Name</label>
                <input type="text" name="name">
                <label for="mail">E-mail</label>
                <input type="text" name="mail">
                <label for="subject"> Subject</label>
                <input type="text" name="subject">
                <label for="comments">Comments</label>
                <textarea name="comments" rows="4"></textarea>
                <button type='submit' name='action' value='send'>Submit</button>
            </form>
        </div>

    </div>



    <div class="adsence"></div>
    <footer>footer
		<a href="use_info.html">利用規約</a>
		<a href="contact.html">お問い合わせ</a>
	</footer>
</body>

</html>