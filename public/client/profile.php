<?php require_once('../../private/initialize.php');
requireLogin() ?>
<?php include SHARED_PATH . '/client_header.php' ?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
        <div class="main-top">
            <h1>Profile</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>

        </div>
        <div class="profile-container">
            <div class="profile-box">
                <img src="../../public/images/default_avatar.jpg" class="profile-pic" alt="Default avatar">
                <h3><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></h3>
                <h3><?php echo $_SESSION['email'] ;?> </h3>
                <?php
                if (!empty($_SESSION['phone_number'])) {
                echo '<h3>' . $_SESSION['phone_number'] . '</h3>';
                }
                ?>
                <button type="button"><a
                            href="<?php echo urlFor('/client/reset_password.php?id=' . removeSpecialChars(encodeUrl($_SESSION['user_id']))) ?>">Reset
                        Password</a></button>
                <div class="profile-bottom">

                </div>
            </div>
        </div>
    </section>
</div>