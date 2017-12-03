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
<?php include('header.php'); ?>

    <div class="container">
        <h1 class="container-singletitle">Contact form</h1>
        <div class="container-contact">
            <form action="#">
                <label for="id">User ID</label>
                <input type="text" name="id">
                <label for="pass">Password</label>
                <input type="text" name="pass">
                <button type='submit' name='action' value='send'>Submit</button>
            </form>
        </div>

    </div>



    <div class="adsence"></div>
    <?php include('footer.php'); ?>
</body>

</html>