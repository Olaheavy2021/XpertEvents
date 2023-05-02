<?php
require_once('../../../private/initialize.php');
require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php');
require_once(PRIVATE_PATH . '/class/admin.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (isPostRequest()) {
    $args = $_POST['event'];
    $event = new PrepackagedEvent($args);
    Admin::createPrepackagedEvent($event);
} else {
    $event = new PrepackagedEvent;
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Add Prepackaged Events</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/prepackage/prepackage_index.php') ?>">&laquo; Back to
                List</a>
            <div class="prepackage-container">
                <form action="<?php echo urlFor('/admin/prepackage/create.php') ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="form first">
                        <div class="details">
                            <span class="title">Event Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label>Name</label>
                                    <input type="text" name="event[name]"
                                           value="<?php echo removeSpecialChars($event->getName()) ?>"
                                           placeholder="Enter event name" required>
                                </div>

                                <div class="input-field">
                                    <label>Date of Event</label>
                                    <input type="date" name="event[event_date]"
                                           value="<?php echo removeSpecialChars($event->getEventDate()) ?>"
                                           placeholder="Enter Event Date" required>
                                </div>

                                <div class="input-field">
                                    <label>Location</label>
                                    <input type="text" placeholder="Enter Location"
                                           value="<?php echo removeSpecialChars($event->getLocation()) ?>"
                                           name="event[location]" required>
                                </div>

                                <div class="input-field">
                                    <label>Price</label>
                                    <input type="number" min="1" placeholder="Enter price"
                                           value="<?php echo removeSpecialChars($event->getPrice()) ?>" name="event[price]"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="details">
                            <span class="title">Brief Description</span>
                            <textarea name="event[description]"
                                      value="<?php echo removeSpecialChars($event->getDescription()) ?>"
                                      placeholder="Enter text here"></textarea>
                            <input id="file-upload" name="image" type="file">
                            <div class="thumbnail"></div>
                            <button class="nextBtn">
                                <span class="btnText">Submit</span>
                                <i class="uil uil-navigator"></i>
                            </button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


