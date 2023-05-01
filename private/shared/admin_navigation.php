<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar">
    <ul>
        <li>
            <a href="<?php echo urlFor('/homepage.php'); ?>">
                <i class="fas fa-house-user"></i>
                <div class="title">XpertEvents</div>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/admin/index.php'); ?>"
                <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                <i class="fas fa-th-large"></i>
                <div class="title">Dashboard</div>
            </a>
        </li>
        <?php
        if ($_SESSION['role'] === ADMIN_ROLE) {
            echo '<li><a href="' . urlFor('/admin/user/user_index.php') . '"';
            if ($current_page == 'user_index.php') {
                echo 'class="active"';
            }
            echo '><i class="fas fa-users-cog"></i><div class="title">Manage Users</div></a></li>';
        }
        ?>
        <li>
            <a href="<?php echo urlFor('/admin/prepackage/prepackage_index.php'); ?>"
                <?php if ($current_page == 'prepackage_index.php') echo 'class="active"'; ?>>
                <i class="fas fa-box-open"></i>
                <div class="title">Prepackaged Events</div>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-glass-cheers"></i>
                <div class="title">Custom Events</div>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/admin/profile.php'); ?>" <?php if ($current_page == 'profile.php') echo 'class="active"'; ?>>
                <i class="fas fa-user-cog"></i>
                <div class="title">Profile</div>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/logout.php'); ?>" class="logout" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
                <div class="title">Logout</div>
            </a>
        </li>
    </ul>
</div>