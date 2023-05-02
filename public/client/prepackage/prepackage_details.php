<?php
// require_once('../../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php');
requireLogin();
include SHARED_PATH . '/client_header.php';
//load the events from the database
$current_page = 1;
$per_page = 5;
$total_count = PrepackagedEvent::countAll(null);
$pagination = new Pagination($current_page, $per_page, $total_count);
$events = PrepackagedEvent::findAll($per_page, $pagination->offset(), null);
?>
<div class="container">
    <?php include SHARED_PATH . '/client_navigation.php' ?>
    <section class="main">
        <div class="main-top">
            <h1>Prepackaged Events</h1>
            <span> <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
                <i class="fas fa-user-cog"></i></span>
        </div>
        <section class="main-events">
            <?php foreach ($events as $event) { ?>
                <div class="events-box">
                    <div class="course">
                        <div class="box">
                            <h3><?php echo removeSpecialChars($event->getName())?></h3>
                            <p>&#163 <?php echo removeSpecialChars($event->getPrice())?></p>
                            <button>Book Event</button>
                            <i class="fas fa-box-open event"></i>
                        </div>
                        <div class="box">
                            <img src="<?php echo '../../images/uploads/' . $event->getThumbnail() ?>" alt="Thumbnail">
                        </div>
                        <div class="box">
                            <h3 class="description"><?php echo removeSpecialChars($event->getShortDescription())?></h3>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </section>

