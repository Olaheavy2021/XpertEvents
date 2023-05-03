<?php 
//require_once('../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');
require_once(PRIVATE_PATH . '/class/pagination.class.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');
require_once(PRIVATE_PATH . '/class/client.class.php');

requireLogin();
include SHARED_PATH . '/client_header.php';

//Fetch all the events and paginate the page
$current_page = $_GET['page'] ?? 1;
$per_page = 5;
$total_count = CustomEvent::countAll(null);
 if($total_count>0){
    $pagination = new Pagination($current_page, $per_page, $total_count);
    $events = Client::viewCustomEvents($per_page, $pagination->offset());
 }

?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
         <div class="main-top">
            <h1>Custom Events</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>
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
                            
                                    echo '<button class="tableEye"><a href="' . urlFor('/client/custom/details.php?id=' . removeSpecialChars(encodeUrl($events[$i]->getId()))) . '"><i class="fas fa-eye"></i></a></button>';
                                
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
         
    </section>
</div>