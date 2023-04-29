<?php
require_once('../private/initialize.php');
//require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
include SHARED_PATH . '/public_header.php'
?>
<div class="main">
    <?php include SHARED_PATH . '/public_navigation.php' ?>
    <div class="contactContent">
        <h2 class="contactHeading">Contact Us</h2>
        <p class="contactBody">Welcome to our contact us page! We're delighted that you're interested in getting in
            touch with us.
            <br/> Whether you have a question, feedback, or just want to say hello, we're here to listen
            and help.</p>
        <div class="contactDetails">
            <div class="contactInfo">
                <div class="contactBox">
                    <div class="contactIcon">
                        <ion-icon name="location-outline"></ion-icon>
                    </div>
                    <div class="contactText">
                        <h3>Address</h3>
                        <p>Howard St, Sheffield City Centre, Sheffield S1 1WB</p>
                    </div>
                </div>
                <div class="contactBox">
                    <div class="contactIcon">
                        <ion-icon name="call-outline"></ion-icon>
                    </div>
                    <div class="contactText">
                        <h3>Phone</h3>
                        <p>507-475-6094</p>
                    </div>
                </div>
                <div class="contactBox">
                    <div class="contactIcon">
                        <ion-icon name="mail-outline"></ion-icon>
                    </div>
                    <div class="contactText">
                        <h3>Email</h3>
                        <p>xpertevents@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="contactForm">
                <!-- Contact Form Header -->
                <h2>Send Message</h2>
                <!-- Beginning: Input Fields -->
                <label>
                    <input type="text" name="email" placeholder="Enter Full name Here">
                </label>
                <label>
                    <input type="text" name="" placeholder="Enter Email Here">
                </label>
                <label>Type your Message....</label>
                <textarea rows="60" cols="20">
                </textarea>
                <button class="btnn"><a href="#">Send</a></button>
            </div>
        </div>
    </div>
</div>
<?php include SHARED_PATH . '/public_footer.php'?>
