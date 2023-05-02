<?php
//require_once('../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
requireLogin();
include SHARED_PATH . '/client_header.php';
require_once(PRIVATE_PATH . '/class/client.class.php');

if (isPostRequest()) {
    $args = $_POST['client'];
    $client = new Client($args);
    $result = $client->resetPassword();
    if($result){
        global $session;
        $session->message('Password reset was successful. Please sign in again.');
        redirectTo(urlFor('/homepage.php'));
    }
}else {
    $client = new Client;
}
?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
        <div class="main-top">
            <h1>Reset Password</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>
        </div>
        <div class="reset-container">
            <div class="client-reset-error">
                <?php echo displayErrors($client->errors); ?>
            </div>

            <div class="reset-center">
                <div class="reset-header">Reset Password Form</div>
                <form action="<?php echo urlFor('/client/reset_password.php'); ?>" method="post">
                    <label>
                        <input type="email" name="client[email]" placeholder="Email" value="<?php echo $_SESSION['email']?>" readonly>
                    </label>
                    <i class="fas fa-envelope"></i>
                    <label for="pswrd"></label><input type="password" name="client[password]" id="pswrd" placeholder="Password" value="<?php echo removeSpecialChars($client->password) ?>">
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