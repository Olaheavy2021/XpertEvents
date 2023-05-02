<?php
require_once('../../../private/initialize.php');
require_once(PRIVATE_PATH . '/class/user.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (!isset($_GET['id'])) {
    redirectTo(urlFor('/admin/prepackage/prepackage_index.php'));
}
$id = $_GET['id'];
$event = PrepackagedEvent::findById($id);
if (!$event) {
    redirectTo(urlFor('/admin/prepackage/prepackage_index.php'));
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Prepackaged Event Details</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/prepackage/prepackage_index.php') ?>">&laquo; Back to
                List</a>
            <div class="prepackage-container">
                <form>
                    <div class="form first">
                        <div class="details">
                            <span class="title">Event Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label>Name</label>
                                    <input type="text" name="event[name]" readonly
                                           value="<?php echo removeSpecialChars($event->getName()) ?>"
                                           placeholder="Enter your name" required>
                                </div>

                                <div class="input-field">
                                    <label>Date of Event</label>
                                    <input readonly type="date" name="event[event_date]"
                                           value="<?php echo removeSpecialChars($event->getEventDate()) ?>"
                                           placeholder="Enter Event Date" required>
                                </div>

                                <div class="input-field">
                                    <label>Location</label>
                                    <input readonly type="text"
                                           value="<?php echo removeSpecialChars($event->getLocation()) ?>"
                                           name="event[location]">
                                </div>

                                <div class="input-field">
                                    <label>Price</label>
                                    <input readonly type="number"
                                           value="<?php echo removeSpecialChars($event->getPrice()) ?>"
                                           name="event[price]">
                                </div>
                                <div class="input-field">
                                    <label>Status</label>
                                    <input type="text" readonly
                                           value="<?php echo ($event->getEventStatus() == '1') ? 'Enabled' : 'Disabled'; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="details">
                            <span class="title">Brief Description</span>
                            <textarea readonly name="event[description]"
                                      value="<?php echo removeSpecialChars($event->getDescription()) ?>"
                                      placeholder="Enter text here"><?php echo removeSpecialChars($event->getDescription()) ?></textarea>
                            <div class="thumbnail">
                                <img height="250px"
                                     src="<?php echo '../../images/uploads/' . $event->getThumbnail() ?>"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
