<?php
    $admin_flag = False;
    $title = 'CONTACT FORM';
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
    <?php include('footer.php'); ?>
</body>

</html>
