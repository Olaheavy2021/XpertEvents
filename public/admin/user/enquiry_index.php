<?php
require_once('../../../private/initialize.php');
require_once(PRIVATE_PATH . '/class/enquiry.class.php');
require_once(PRIVATE_PATH . '/class/admin.class.php');
require_once(PRIVATE_PATH . '/class/pagination.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';

//Fetch all the enquiries and paginate the page
$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = Enquiry::countAll($_SESSION['user_id']);
$pagination = new Pagination($current_page, $per_page, $total_count);
$enquiries = Admin::viewEnquiries($per_page, $pagination->offset());

?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Customer Enquiries</p>
        </div>
        <div class="tableSection">
            <table>
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (!empty($enquiries)) {
                    for ($i = 0; $i < count($enquiries); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $i + 1 ?></td>
                            <td><?php echo removeSpecialChars($enquiries[$i]->getFullName()) ?></td>
                            <td><?php echo removeSpecialChars($enquiries[$i]->getEmail()); ?></td>
                            <td><?php echo removeSpecialChars(strtolower($enquiries[$i]->getMessage())); ?></td>
                            <td>
                                <button class="tableEye"><a
                                            href="<?php echo urlFor('/admin/user/enquiry_details.php?id=' . removeSpecialChars(encodeUrl($enquiries[$i]->getId()))) ?>"><i
                                                class="fas fa-eye"></i></a></button>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No customer enquiry found</td></tr>";
                }
                ?>
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

