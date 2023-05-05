<!--- Footer -->
<?php
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
?>
<footer>
    <div class="footerContainer">
        <div class="socialIcons">
            <a href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a>
            <a href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a>
            <a href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a>
            <a href="#">
                <ion-icon name="logo-google"></ion-icon>
            </a>
            <a href="#">
                <ion-icon name="logo-skype"></ion-icon>
            </a>
        </div>
        <div class="footerNav">
            <ul>
                 <li><a href="<?php echo urlFor('/homepage.php'); ?>"
                    <?php if ($current_page == 'homepage.php') echo 'class="active"'; ?>>HOME</a></li>
                <li><a href="<?php echo urlFor('/services.php'); ?>"
                    <?php if ($current_page == 'services.php') echo 'class="active"'; ?>>SERVICES</a>
                </li>
                <li>
                <a href="<?php echo urlFor('/events.php'); ?>" <?php if ($current_page == 'events.php') echo 'class="active"'; ?>>EVENTS
                </li>
                <li>
                    <a href="<?php echo urlFor('/contact_us.php'); ?>"
                    <?php if ($current_page == 'contact_us.php') echo 'class="active"'; ?>>CONTACT</a>
                </li>
                <li>
                    <a href="<?php echo urlFor('/register.php'); ?>"
                    <?php if ($current_page == 'register.php') echo 'class="active"'; ?>>REGISTER</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footerBottom">
        <p>Copyright &copy;2023; Designed by <span class="designer">WebGeeks</span></p>
    </div>
</footer>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
<!-- body -->
</body>
</html>

<?php
global $database;
db_disconnect($database);
?>
