<?php 
//require_once('../../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH .'/class/user.class.php');
require_once(PRIVATE_PATH .'/class/admin.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (isPostRequest()) {
    $args = $_POST['user'];
    $user = new User($args);
    $admin = new Admin();
    $admin->createAccount($user);
} else {
    $user = new User;
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Add Employee</p>
        </div>
        <div class="tableSection">
            <div class="reset-container">
                <div class="addUser-error">
                    <?php echo displayErrors($user->errors); ?>
                </div>
                <div class="reset-center">
                    <div class="reset-header">Create Employee Form</div>
                    <form action="<?php echo urlFor('/admin/user/add_employee.php') ?>" method="post">

                        <label>
                            <input type="email" required name="user[email]" placeholder="Email" value="<?php echo removeSpecialChars($user->email) ?>">
                        </label>
                        <i class="fas fa-envelope"></i>
                        <label>
                            <input type="text" required name="user[first_name]" placeholder="FirstName" value="<?php echo removeSpecialChars($user->first_name) ?>">
                        </label>
                        <label>
                            <input type="text" required name="user[last_name]" placeholder="LastName" value="<?php echo removeSpecialChars($user->last_name) ?>">
                        </label>
                        <label>
                            <input type="text" required name="user[phone_number]" placeholder="PhoneNumber" value="<?php echo removeSpecialChars($user->phone_number) ?>">
                        </label>
                        <label>
                            <select name="user[role]" required>
                                <option value="">Role</option>
                                <option value="<?php echo SALESSTAFF_ROLE ?>">Sales Staff</option>
                                <option value="<?php echo MANAGER_ROLE ?>">Manager</option>
                            </select>
                        </label>
                        <input type="submit" value="Create">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>