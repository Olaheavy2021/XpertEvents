<?php 
//require_once('../../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once (PRIVATE_PATH . '/class/user.class.php');
require_once (PRIVATE_PATH . '/class/admin.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';

if (!isset($_GET['id'])) {
    redirectTo(urlFor('/admin/user/user_index.php'));
}
$id = $_GET['id'];
$user = User::findById($id);
if (!$user) {
    redirectTo(urlFor('/admin/user/user_index.php'));
}

if(isPostRequest()){
    $admin = new Admin();
    $result = $admin->disableUser($user->id);
    global $session;
    $session->message('The user was disabled successfully');
    redirectTo(urlFor('/admin/user/user_index.php'));
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Disable User</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/user/user_index.php') ?>">&laquo; Back to List</a>
            <div class="card">
                <h3>Are you sure you want to disable this user?</h3>
                <h3 class="item"><?php echo "Name : " . removeSpecialChars($user->getFullName()) ?></h3>
                <h3 class="item"><?php echo "Email : " . removeSpecialChars($user->email) ?></h3>
                <form action="<?php urlFor('/admin/user/disable_user.php?id=' . removeSpecialChars(encodeUrl($id))) ?>"
                      method="post">
                    <div>
                        <button type="submit" class="btn">Disable User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>