<?php require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
include ('/home/SHU/c2042523/public_html/xpertevents/private/class/client.class.php');
$page_title = 'Register';

if (isPostRequest()) {

    // Create record using post parameters
    $args = $_POST['client'];
    $client = new Client($args);
    $result = $client->register();

    if ($result) {
        $new_id = $client->id;
        if (!empty($session)) {
            $session->message('The client was created successfully.');
            $session->login($client);
        }
        redirectTo(urlFor('/client/index.php'));
    }

} else {
    $client = new Client;
}
?>

<?php include SHARED_PATH . '/public_header.php' ?>
<div class="main">
    <?php include SHARED_PATH . '/public_navigation.php'; ?>

    <div class="registerError">
        <?php echo displayErrors($client->errors); ?>
    </div>


    <div class="registrationForm">
        <!-- Register Page Header -->
        <h2>Sign Up Here</h2>
        <form action="<?php echo urlFor('/register.php'); ?>" method="post">
            <!-- Beginning: Input Fields -->
            <label>
                <input type="email" name="client[email]" value="<?php echo removeSpecialChars($client->email) ?>"
                       placeholder="Enter Email Here">
            </label>
            <label>
                <input type="text" name="client[first_name]" value="<?php echo removeSpecialChars($client->first_name) ?>"
                       placeholder="Enter FirstName Here">
            </label>
            <label>
                <input type="text" name="client[last_name]" value="<?php echo removeSpecialChars($client->last_name) ?>"
                       placeholder="Enter Lastname Here">
            </label>
            <label>
                <input type="password" name="client[password]" value="<?php echo removeSpecialChars($client->password) ?>"
                       placeholder="Enter Password Here">
            </label>
            <label>
                <input type="password" name="client[confirm_password]"
                       value="<?php echo removeSpecialChars($client->confirm_password) ?>"
                       placeholder="Confirm Password Here">
            </label>
            <!-- End : Input Fields -->
            <button class="btnn" type="submit">Register</button>
        </form>

        <p class="link">Already have an account<br>
            <a href="homepage.php">Login here</a></p>
        <br/>
        <br/>

    </div>
</div>
<?php include SHARED_PATH . '/public_footer.php' ?>