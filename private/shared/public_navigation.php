<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="navbar">
    <div class="icon">
        <h2 class="logo">XpertEvents</h2>
    </div>

    <div class="menu">
        <ul>
            <li><a href="<?php echo urlFor('/homepage.php'); ?>"
                    <?php if ($current_page == 'homepage.php') echo 'class="active"'; ?>>HOME</a></li>
            <li><a href="<?php echo urlFor('/services.php'); ?>"
                    <?php if ($current_page == 'services.php') echo 'class="active"'; ?>>SERVICES</a></li>
            <li>
                <a href="<?php echo urlFor('/events.php'); ?>" <?php if ($current_page == 'events.php') echo 'class="active"'; ?>>EVENTS
            </li>
            <li><a href="<?php echo urlFor('/contact_us.php'); ?>"
                    <?php if ($current_page == 'contact_us.php') echo 'class="active"'; ?>>CONTACT</a></li>
            <li><a href="<?php echo urlFor('/register.php'); ?>"
                    <?php if ($current_page == 'register.php') echo 'class="active"'; ?>>REGISTER</a></li>
        </ul>
    </div>

</div>