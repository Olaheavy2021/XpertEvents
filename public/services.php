<?php
require_once('../private/initialize.php');
$page_title = 'Services';
include SHARED_PATH . '/public_header.php';
?>
<div class="main">
    <?php include SHARED_PATH . '/public_navigation.php' ?>
    <div class="section">
        <div class="serviceTitle">
            <h1>Our Services</h1>
        </div>
        <div class="services">
            <div class="servicesCard">
                <div class="servicesIcon">
                    <ion-icon name="woman-sharp"></ion-icon>
                </div>
                <h2>Wedding Packages</h2>
                <p>With our personalized wedding packages, we create unforgettable moments that last a lifetime,
                    leaving you with cherished memories of your special day.</p>
            </div>
            <div class="servicesCard">
                <div class="servicesIcon">
                    <ion-icon name="people-sharp"></ion-icon>
                </div>
                <h2>Corporate Days Out</h2>
                <p>From outdoor activities to experiential learning,
                    we design custom programs that help teams bond,team building, achieve their goals together
                    and strengthening connections
                </p>
            </div>
            <div class="servicesCard">
                <div class="servicesIcon">
                    <ion-icon name="wine-sharp"></ion-icon>
                </div>
                <h2>Special Events</h2>
                <p>Whether it's a birthday party, anniversary celebration, or a gala event,
                    our event management experts are dedicated to turning your vision into reality with every detail</p>
            </div>
        </div>
    </div>
</div>
<?php include SHARED_PATH . '/public_footer.php'?>
