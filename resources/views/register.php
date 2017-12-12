<?php
    $admin_flag = False;
    $title = 'SIGN UP';
?>

<!DOCTYPE html>
<html lang="ja">

<?php include('head.php'); ?>

<body>
<?php include('header.php'); ?>

    <div class="container">
        <h1 class="container-singletitle">Contact form</h1>
        <div class="container-contact">
            <form action="#">
                <label for="id">User ID</label>
                <input type="text" name="id" placeholder="From 6 to 15 Words">
                <label for="pass">Password</label>
                <input type="text" name="pass" placeholder="From 6 to 15 Words">
                <button type='submit' name='action' value='send'>Register</button>
            </form>
        </div>

    </div>



    <div class="adsence"></div>
    <?php include('footer.php'); ?>
</body>

</html>
