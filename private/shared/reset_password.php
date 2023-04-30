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
                <input type="text" placeholder="Email">
                <i class="fas fa-envelope"></i>
                <input type="password" id="pswrd" placeholder="Password">
                <i class="fas fa-lock" onclick="show()"></i>
<!--                <input type="submit" value="Reset Password">-->
            </form>
        </div>
    </div>
    <script type="application/javascript">
       <?php require_once(PUBLIC_PATH . "/js/show_password.js"); ?>
    </script>
</section>