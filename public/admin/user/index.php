<?php require_once('../../../private/initialize.php'); ?>
<?php require_once (PRIVATE_PATH . '/class/user.class.php'); ?>
<?php require_once (PRIVATE_PATH . '/class/pagination.class.php'); ?>
<?php requireLogin() ?>
<?php include SHARED_PATH . '/admin_header.php' ?>
<?php

$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = User::countAll();
$pagination = new Pagination($current_page, $per_page, $total_count);
$users = User::findAll($per_page, $pagination->offset());
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>User Details</p>
            <div>
                <button class="addNewUser">Add Employee</button>
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
                                echo '<button class="tableEdit"><a href="' . urlFor('/admin/user/enable_user.php?id=' . removeSpecialChars(encodeUrl($users[$i]->id))) . '"><i class="fas fa-trash-restore"></i></a></button>';
                            }else{
                                echo '<button class="tableDelete"><a href="' . urlFor('/admin/user/disable_user.php?id=' . removeSpecialChars(encodeUrl($users[$i]->id))) . '"><i class="fas fa-trash"></i></a></button>';
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
        $url = urlFor('/admin/user/index.php');
        echo $pagination->pageLinks($url);
        ?>
        <!--            <div><i class="fas fa-angle-left"></i></div>-->
        <!--            <div><i class="fas fa-chevron-left"></i></div>-->
        <!--            <div>1</div>-->
        <!--            <div>2</div>-->
        <!--            <div><i class="fas fa-chevron-right"></i></div>-->
        <!--            <div><i class="fas fa-angle-right"></i></div>-->
        <!--        </div>-->
    </div>
</div>
</body>
</html>

