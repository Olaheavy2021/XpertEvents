<?php
//require_once('../../../private/initialize.php');
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/employee.class.php');
requireLogin();
include SHARED_PATH . '/admin_header.php';
if (!isset($_GET['id'])) {
    redirectTo(urlFor('/admin/custom/custom_index.php'));
}
$id = $_GET['id'];
$event = Employee::viewCustomEvent($id);
if (!$event) {
    redirectTo(urlFor('/admin/custom/custom_index.php'));
}
?>
<div class="container">
    <?php include SHARED_PATH . '/admin_navigation.php' ?>
    <div class="userTable">
        <div class="userTableHeader">
            <p>Custom Event Details</p>
        </div>
        <div class="disableContent">
            <a class="back-link" href="<?php echo urlFor('/admin/custom/custom_index.php') ?>">&laquo; Back to
                List</a>
            <div class="prepackage-container">
                <form>
                    <div class="form first">
                        <div class="details">
                            <span class="title">Custom Event Details</span>

                            <div class="fields">
                                <div class="input-field">
                                    <label>Name</label>
                                    <input type="text" name="event[name]"
                                           value="<?php echo removeSpecialChars($event->getName()) ?>"
                                           readonly>
                                </div>
                                <div class="input-field">
                                    <label>Client Email</label>
                                    <input type="email" name="event[client_email]"
                                           value="<?php echo removeSpecialChars($event->getClientEmail()) ?>"
                                           readonly>
                                </div>
                                <div class="input-field">
                                    <label>Client Name</label>
                                    <input type="email" name="event[client_name]"
                                           value="<?php echo removeSpecialChars($event->getClientName()) ?>"
                                           readonly>
                                </div>

                                <div class="input-field">
                                    <label>Date of Event</label>
                                    <input type="date" name="event[event_date]"
                                           value="<?php echo removeSpecialChars($event->getEventDate()) ?>"
                                           readonly>
                                </div>

                                <div class="input-field">
                                    <label>Location</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->getLocation()) ?>"
                                           name="event[location]" readonly>
                                </div>

                                <div class="input-field">
                                    <label>Number of Tables</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->getNumberOfTable()) ?>"
                                           name="event[number_of_table]"
                                           readonly>
                                </div>

                                <div class="input-field">
                                    <label>Number of Guests</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->getNumberOfGuests()) ?>"
                                           name="event[number_of_guest]"
                                           readonly>
                                </div>

                                <div class="input-field">
                                    <label>Number of Chairs</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->getNumberOfChair()) ?>"
                                           name="event[number_of_chair]"
                                           readonly>
                                </div>

                                <div class="input-field">
                                    <label>Price</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->getPrice()) ?>"
                                           name="event[price]"
                                           readonly>
                                </div>
                                <div class="input-field">
                                    <label>Catering</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->isCateringRequired()) ?>"
                                           name="event[is_catering_required]"
                                           readonly>
                                </div>
                                <div class="input-field">
                                    <label>Audio Visual</label>
                                    <input type="text"
                                           value="<?php echo removeSpecialChars($event->isAvRequired()) ?>"
                                           name="event[is_av_required]"
                                           readonly>
                                </div>


                            </div>
                        </div>

                        <div class="details">
                            <span class="title">Brief Description</span>
                            <textarea name="event[description]"
                                      placeholder="Enter text here"
                                      readonly><?php echo removeSpecialChars($event->getDescription()) ?></textarea>
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>
</div>
</body>
</html>
