<?php
require_once('../../../private/initialize.php');
require_once(PRIVATE_PATH . '/class/admin.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (!isset($_GET['id'])) {
    redirectTo(urlFor('/admin/user/enquiry_index.php'));
}
$id = $_GET['id'];
$enquiry = Admin::viewEnquiry($id);
if (!$enquiry) {
    redirectTo(urlFor('/admin/user/enquiry_index.php'));
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Customer Enquiry Details</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/user/enquiry_index.php') ?>">&laquo; Back to
                List</a>
            <div class="prepackage-container">
                <form>
                    <div class="form first">
                        <div class="details">
                            <span class="title">Enquiry Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label>Name
                                        <input type="text" readonly
                                               value="<?php echo removeSpecialChars($enquiry->getFullName()) ?>">
                                    </label>
                                </div>

                                <div class="input-field">
                                    <label>Email
                                        <input readonly type="text"
                                               value="<?php echo removeSpecialChars($enquiry->getEmail()) ?>">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="details">
                            <span class="title">Message</span>
                            <textarea readonly
                                      placeholder="Enter text here"><?php echo removeSpecialChars($enquiry->getMessage()) ?></textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
