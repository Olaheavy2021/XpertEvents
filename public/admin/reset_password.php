<?php require_once('../../private/initialize.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
require_once(PRIVATE_PATH . '/class/employee.class.php');


if (isPostRequest()) {
    $args = $_POST['employee'];
    $employee = new Employee($args);
    $result = $employee->resetPassword();
    if($result){
        global $session;
        $session->message('Password reset was successful. Please sign in again.');
        redirectTo(urlFor('/homepage.php'));
    }
}else {
    $employee = new Employee;
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Reset Password</p>
        </div>
        <div class="tableSection">
            <div class="admin-reset-error">
                <?php echo displayErrors($employee->errors); ?>
            </div>
            <div class="reset-container">
                <div class="reset-center">
                    <div class="reset-header">Reset Password Form</div>
                    <form action="<?php echo urlFor('/admin/reset_password.php'); ?>" method="post">
                        <input type="email" name="employee[email]" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" readonly>
                        <i class="fas fa-envelope"></i>
                        <input type="password" name="employee[password]" id="pswrd" placeholder="Password" value="<?php echo removeSpecialChars($employee->password) ?>">
                        <i class="fas fa-lock" onclick="show()"></i>
                        <input type="submit" value="Reset Password">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    <?php require_once(PUBLIC_PATH . "/js/show_password.js"); ?>
</script>
