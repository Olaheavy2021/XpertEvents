<?php
require_once('../private/initialize.php');
require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php');
require_once(PRIVATE_PATH . '/class/pagination.class.php');
$page_title = 'Prepackaged Events';
include SHARED_PATH . '/public_header.php';
$current_page = 1;
$per_page = 5;
$total_count = PrepackagedEvent::countAll(null);
$pagination = new Pagination($current_page, $per_page, $total_count);
$events = PrepackagedEvent::findAll($per_page, $pagination->offset(), null);
?>
<div class="events-page">
    <div class="main">
        <?php include SHARED_PATH . '/public_navigation.php' ?>
        <div class="events-heading">
            <h1>Pre-packaged Events</h1>
            <p>Unwrap a memorable experience with our pre-packaged events! Ready-made fun, designed to create unforgettable
                memories</p>
        </div>
        <?php foreach ($events as $event) { ?>
        <div class="events-container">
            <section class="events-about">
                <div class="events-image">
                    <img src="<?php echo 'images/uploads/' . $event->getThumbnail() ?>" alt="">
                </div>
                <div class="events-content">
                    <h2><?php echo $event->getName() ?></h2>
                    <p><?php echo $event->getDescription() ?></p>
                    <a href="" class="read-more" onclick="bookEvent()" >Book Event</a>
                </div>
            </section>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    function bookEvent() {
        alert("Welcome to XpertEvents, Please sign in or register to book an event.");
    }
</script>
<?php include SHARED_PATH . '/public_footer.php' ?>
