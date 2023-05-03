<?php
require_once('../private/initialize.php');
require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php');
require_once(PRIVATE_PATH . '/class/pagination.class.php');
$page_title = 'Prepackaged Events';
include SHARED_PATH . '/public_header.php';
$current_page = 1;
$per_page = 4;
$total_count = PrepackagedEvent::countAll(null);
$pagination = new Pagination($current_page, $per_page, $total_count);
$events = PrepackagedEvent::findAll($per_page, $pagination->offset(), null);

if(isPostRequest()){
    global $session;
    if($session->is_logged_in()){
        redirectTo(urlFor('/client/prepackage/prepackage_details.php'));
    }else{
        $error_message = array("Please sign in or register to book an event");
         redirectTo(urlFor('/homepage.php'));
        echo alertErrorMessage($error_message);
    }
}
?>
<div class="events-page">
    <div class="main">
        <?php include SHARED_PATH . '/public_navigation.php' ?>
        <div class="events-heading">
            <h1>Pre-packaged Events</h1>
            <p>Unwrap a memorable experience with our pre-packaged events! Ready-made fun, designed to create
                unforgettable
                memories</p>
        </div>
        <?php
        if (!empty($events)) {
            foreach ($events as $event) {
                ?>
                <div class="events-container">
                    <section class="events-about">
                        <div class="events-image">
                            <img src="<?php echo 'images/uploads/' . $event->getThumbnail() ?>" alt="">
                        </div>
                        <div class="events-content">
                            <h2><?php echo $event->getName() ?></h2>
                            <p><?php echo $event->getDescription() ?></p>
                            <form action="<?php echo urlFor('/events.php')?>" method="post">
                                <button type="submit" class="read-more">Book Event</button>
                            </form>
                        </div>
                    </section>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<?php include SHARED_PATH . '/public_footer.php' ?>
