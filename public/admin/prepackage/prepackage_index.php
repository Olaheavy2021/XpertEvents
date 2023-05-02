<?php
require_once('../../../private/initialize.php');
require_once(PRIVATE_PATH . '/class/user.class.php');
require_once(PRIVATE_PATH . '/class/pagination.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
//Fetch all the events and paginate the page
$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = PrepackagedEvent::countAll(null);
$pagination = new Pagination($current_page, $per_page, $total_count);
$events = User::viewPrepackagedEvents($per_page, $pagination->offset());
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Prepackaged Events</p>
            <div>

                <?php if ($_SESSION['role'] === ADMIN_ROLE) { ?>
                    <button class="addNewUser"><a href="<?php echo urlFor('/admin/prepackage/create.php'); ?>">Add
                            Event</a></button>
                <?php } ?>

            </div>
        </div>
        <div class="tableSection">
            <table>
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($events)) {
                    for ($i = 0; $i < count($events); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $i + 1 ?></td>
                            <td><?php echo removeSpecialChars($events[$i]->getName()); ?></td>
                            <td><?php echo removeSpecialChars($events[$i]->getLocation()); ?></td>
                            <td>&#163 <?php echo removeSpecialChars($events[$i]->getPrice()); ?></td>
                            <td>
                                <?php
                                if ($_SESSION['role'] === ADMIN_ROLE) {
                                    echo '<button class="tableEye"><a href="' . urlFor('/admin/prepackage/details.php?id=' . removeSpecialChars(encodeUrl($events[$i]->getId()))) . '"><i class="fas fa-eye"></i></a></button>';
                                    echo '<button class="tableEdit"><a href="' . urlFor('/admin/prepackage/edit.php?id=' . removeSpecialChars(encodeUrl($events[$i]->getId()))) . '"><i class="fas fa-edit"></i></a></button>';
                                    //echo '<button class="tableDelete"><a href="' . urlFor('/admin/prepackage/disable.php?id=' . removeSpecialChars(encodeUrl($events[$i]->getId()))) . '"><i class="fas fa-trash"></i></a></button>';
                                } else {
                                    echo '<button class="tableEye"><a href="' . urlFor('/admin/prepackage/details.php?id=' . removeSpecialChars(encodeUrl($events[$i]->getId()))) . '"><i class="fas fa-eye"></i></a></button>';
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No prepackage event found</td></tr>";
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

