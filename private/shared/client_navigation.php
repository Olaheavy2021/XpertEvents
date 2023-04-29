<nav>
    <ul>
        <li>
            <a href="<?php echo urlFor('/homepage.php'); ?>" class="logo">
                <i class="fas fa-home"></i>
                <span class="nav-item">XpertEvents</span>
            </a>
        </li>
        <li>
            <a href="<?php echo urlFor('/client/index.php'); ?>">
                <i class="fas fa-th-large"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-box-open"></i>
                <span class="nav-item">Prepackaged Events</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-glass-cheers"></i>
                <span class="nav-item">Custom Events</span>
            </a>
        </li>
        <li>
            <a href="#" title="Profile">
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