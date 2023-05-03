<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav>
    <ul>
        <li>
            <a href="<?php echo urlFor('/homepage.php'); ?>" class="logo">
                <i class="fas fa-home"></i>
                <span class="nav-item">XpertEvents</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/client/index.php'); ?>"
                <?php if ($current_page == 'index.php') echo 'class="active"'; ?>>
                <i class="fas fa-th-large"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/client/prepackage/prepackage_details.php') ?>"
                <?php if ($current_page == 'prepackage_details.php') echo 'class="active"'; ?>>
                <i class="fas fa-box-open"></i>
                <span class="nav-item">Prepackaged Events</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/client/custom/custom_index.php') ?>"
                <?php if ($current_page == 'custom_index.php') echo 'class="active"'; ?>>
                <i class="fas fa-glass-cheers"></i>
                <span class="nav-item">Custom Events</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/client/profile.php') ?>"
                <?php if ($current_page == 'profile.php') echo 'class="active"'; ?>
              title="Profile">
                <i class="fas fa-user"></i>
                <span class="nav-item">Profile</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/logout.php'); ?>" class="logout" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Logout</span>
            </a>
        </li>

    </ul>
</nav>
