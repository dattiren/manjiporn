<?php
    $admin_flag = False;
    $title = 'SIGN IN';
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
