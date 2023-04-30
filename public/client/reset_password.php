<?php require_once('../../private/initialize.php');
requireLogin() ?>
<?php include SHARED_PATH . '/client_header.php' ?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
        <div class="main-top">
            <h1>Reset Password</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>
        </div>
        <div class="reset-container">
            <div class="reset-center">
                <div class="reset-header">Reset Password Form</div>
                <form action="">
                    <input type="email" placeholder="Email" value="<?php echo $_SESSION['email']?>" readonly>
                    <i class="fas fa-envelope"></i>
                    <input type="password" id="pswrd" placeholder="Password">
                    <i class="fas fa-lock" onclick="show()"></i>
                    <input type="submit" value="Reset Password">
                </form>
            </div>
        </div>
        <script type="application/javascript">
            <?php require_once(PUBLIC_PATH . "/js/show_password.js"); ?>
        </script>
    </section>
</div>