<?php
 //require_once('../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
include(PRIVATE_PATH . '/class/user.class.php');
$page_title = 'Homepage';
include SHARED_PATH . '/public_header.php';

if (isPostRequest()) {
    // Create record using post parameters
    $args = $_POST['user'];

    $user = new User($args);
    //validation for the inputs
    if (isBlank($user->email)) {
        $user->errors[] = "The email cannot be blank";
    }

    if (isBlank($user->password)) {
        $user->errors[] = "The password cannot be blank";
    }

    if (empty($user->errors)) {
       $user->login();
    }

}
?>

<div class="main">
    <?php include SHARED_PATH . '/public_navigation.php' ?>

    <div class="content">
        <h1><span>XpertEvents</span></h1>
        <p class="par">Welcome to our event management website, where we specialize in crafting <br>
            unforgettable moments and experiences that will leave a lasting impression <br>
            on you and your guests.<br>
            Let's make your vision a reality!
        </p>
        <button class="cn"><a href="<?php echo urlFor('/contact_us.php'); ?>">Contact US</a></button>
        <div class="form">
            <h2>Login Here</h2>

            <form action="<?php echo urlFor('/homepage.php'); ?>" method="post">
                <label>
                    <input type="email" name="user[email]" placeholder="Enter Email Here"
                           value="<?php if(isset($user)) {
                              echo removeSpecialChars($user->email); } ?>">
                </label>
                <label>
                    <input type="password" name="user[password]" required placeholder="Enter Password Here">
                </label>
                <button class="btnn" type="submit">Login</button>
            </form>


            <p class="link">Don't have an account<br>
                <a href="<?php echo urlFor('/register.php'); ?>">Sign up </a> here</a></p>
            <br/>
            <br/>

        </div>
    </div>
</div>
<?php include SHARED_PATH . '/public_footer.php' ?>
