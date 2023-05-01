<?php require_once('../../../private/initialize.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/user.class.php'); ?>
<?php require_once(PRIVATE_PATH . '/class/pagination.class.php'); ?>
<?php requireLogin() ?>
<?php include SHARED_PATH . '/admin_header.php' ?>
<?php
//Fetch all the users and paginate the page
$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = User::countAll($_SESSION['user_id']);
$pagination = new Pagination($current_page, $per_page, $total_count);
$users = User::findAll($per_page, $pagination->offset(), $_SESSION['user_id']);
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>User Details</p>
            <div>
                <button class="addNewUser"><a href="<?php echo urlFor('/admin/user/add_employee.php'); ?>">Add
                        Employee</a></button>
            </div>
        </div>
        <div class="tableSection">
            <table>
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < count($users); $i++) { ?>
                    <tr>
                        <td><?php echo $i + 1 ?></td>
                        <td><?php echo removeSpecialChars($users[$i]->first_name) . " " . removeSpecialChars($users[$i]->last_name); ?></td>
                        <td><?php echo removeSpecialChars($users[$i]->email); ?></td>
                        <td><?php echo removeSpecialChars(strtolower($users[$i]->role)); ?></td>
                        <td>
                            <?php
                            if (empty($users[$i]->account_status)) {
                                echo '<button class="tableEye"><a href="' . urlFor('/admin/user/enable_user.php?id=' . removeSpecialChars(encodeUrl($users[$i]->getId()))) . '"><i class="fas fa-trash-restore"></i></a></button>';
                            } else {
                                echo '<button class="tableDelete"><a href="' . urlFor('/admin/user/disable_user.php?id=' . removeSpecialChars(encodeUrl($users[$i]->getId()))) . '"><i class="fas fa-trash"></i></a></button>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <!--        <div class="pagination">-->
        <?php
        $url = urlFor('/admin/user/user_index.php');
        echo $pagination->pageLinks($url);
        ?>

    </div>
</div>
</body>
</html>

