<?php
//require_once('../../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');
require_once(PRIVATE_PATH . '/class/salesstaff.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (isPostRequest()) {
    $args = $_POST['event'];
    $event = new CustomEvent($args);
    SalesStaff::createCustomEvent($event);
} else {
    $event = new CustomEvent;
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Add Custom Events</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/custom/custom_index.php') ?>">&laquo; Back to
                List</a>
            <div class="prepackage-container">
                <form action="<?php echo urlFor('/admin/custom/create.php') ?>" method="post">
                    <div class="form first">
                        <div class="details">
                            <span class="title">Custom Event Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label>Name</label>
                                    <input type="text" name="event[name]"
                                           value="<?php echo removeSpecialChars($event->getName()) ?>"
                                           placeholder="Enter event name" required>
                                </div>
                                <div class="input-field">
                                    <label>Client Email</label>
                                    <input type="email" name="event[client_email]"
                                           value="<?php echo removeSpecialChars($event->getClientEmail()) ?>"
                                           placeholder="Enter Client email" required>
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
                                    <label>Number of Tables</label>
                                    <input type="number" min="1" placeholder="Enter number of Table"
                                           value="<?php echo removeSpecialChars($event->getNumberOfTable()) ?>"
                                           name="event[number_of_table]"
                                           required>
                                </div>

                                <div class="input-field">
                                    <label>Number of Guests</label>
                                    <input type="number" min="1" placeholder="Enter number of Guests"
                                           value="<?php echo removeSpecialChars($event->getNumberOfGuests()) ?>"
                                           name="event[number_of_guest]"
                                           required>
                                </div>

                                <div class="input-field">
                                    <label>Number of Chairs</label>
                                    <input type="number" min="1" placeholder="Enter number of Chair"
                                           value="<?php echo removeSpecialChars($event->getNumberOfChair()) ?>"
                                           name="event[number_of_chair]"
                                           required>
                                </div>

                                <div class="input-field">
                                    <label>Price</label>
                                    <input type="number" min="1" placeholder="Enter price"
                                           value="<?php echo removeSpecialChars($event->getPrice()) ?>"
                                           name="event[price]"
                                           required>
                                </div>
                                <div class="input-field">
                                    <label>Catering</label>
                                    <select name="event[is_catering_required]" required>
                                        <option>Is Catering Required?</option>
                                        <option value="yes" <?php if ($event->isCateringRequired() == 'yes') echo ' selected="selected"'; ?>>
                                            Yes
                                        </option>
                                        <option value="no" <?php if ($event->isCateringRequired() == 'no') echo ' selected="selected"'; ?>>
                                            No
                                        </option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <label>Audio Visual</label>
                                    <select name="event[is_av_required]" required>
                                        <option>Is Av Required?</option>
                                        <option value="yes" <?php if ($event->isAvRequired() == 'yes') echo ' selected="selected"'; ?>>
                                            Yes
                                        </option>
                                        <option value="no" <?php if ($event->isAvRequired() == 'no') echo ' selected="selected"'; ?>>
                                            No
                                        </option>
                                    </select>
                                </div>


                            </div>
                        </div>

                        <div class="details">
                            <span class="title">Brief Description</span>
                            <textarea name="event[description]"
                                      value="<?php echo removeSpecialChars($event->getDescription()) ?>"
                                      placeholder="Enter text here" required></textarea>
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


