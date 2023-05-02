<?php 
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
// require_once('../../private/initialize.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Profile</p>
        </div>
        <div class="tableSection">
            <div class="profile-container">
                <div class="profile-box">
                    <img src="../../public/images/default_avatar.jpg" class="profile-pic" alt="Default avatar">
                    <h3><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></h3>
                    <h3><?php echo $_SESSION['email'] ?></h3>
                    <h3>+2348134583502</h3>
                    <button type="button"><a
                                href="<?php echo urlFor('/admin/reset_password.php?id=' . removeSpecialChars(encodeUrl($_SESSION['user_id']))) ?>">Reset
                            Password</a></button>
                    <div class="profile-bottom">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
