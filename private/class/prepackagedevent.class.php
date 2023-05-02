<?php
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/event.class.php');
class PrepackagedEvent extends Event
{
    static protected $tableName = "prepackaged_events";
    static protected $dbColumns = ['id', 'name', 'description', 'location', 'event_date', 'price', 'thumbnail', 'event_status'];
    protected $thumbnail;

    protected $event_status;

    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->location = $args['location'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->event_date = $args['event_date'] ?? '';
        $this->thumbnail = $args['thumbnail'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->event_status = $args['event_status'] ?? 0;
    }

    /**
     * @return string
     */
    public function getThumbnail():string
    {
        return $this->thumbnail;
    }

    /**
     * @return string
     */
    public function getEventStatus():string
    {
        return $this->event_status;
    }

    /**
     * @return bool
     */
    public function createEvent(): bool
    {
        //validate the form
        $this->validateInput();

        //validate the image upload
        $img_content = $this->processImage();

        if (empty($this->errors) && !empty($img_content)) {
            //save inside the database
            $this->thumbnail = $img_content;
            $this->event_status = true;
            $result = parent::create();
            if ($result) {
                global $session;
                $session->message("Pre-packaged Event created Successfully");
                redirectTo(urlFor('/admin/prepackage/prepackage_index.php'));
            }
        }
        echo alertErrorMessage($this->errors);
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function editEvent(string $id): bool
    {
        $event = PrepackagedEvent::findById($id);
        //validate the form
        $this->validateInput();

        if (!empty($_FILES["image"]["name"])) {
            $this->thumbnail = $this->processImage();
            $this->event_status = $event->event_status;
            $this->id = $event->id;
        }else{
            $this->thumbnail = $event->thumbnail;
            $this->event_status = $event->event_status;
            $this->id = $event->id;
        }

        if (empty($this->errors) && !empty($this->thumbnail)) {
            //save inside the database
            $result = parent::update();
            if ($result) {
                global $session;
                $session->message("Pre-packaged Event modified Successfully");
                redirectTo(urlFor('/admin/prepackage/prepackage_index.php'));
            }
        }
        echo alertErrorMessage($this->errors);
        return false;
    }

    /**
     * @return int
     */
    static public function getTotalNumberOfEvents() :int
    {
        $sql = "SELECT * FROM prepackaged_events";
        $result = parent::findBySql($sql);
        return count($result);
    }


    protected function validateInput(): array
    {
        $this->errors = [];

        //Name
        if (isBlank($this->name)) {
            $this->errors[] = "Name cannot be blank.";
        } elseif (!hasLength($this->name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name must be between 2 and 255 characters.";
        }

        //Location
        if (isBlank($this->location)) {
            $this->errors[] = "Location cannot be blank.";
        } elseif (!hasLength($this->location, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Location must be between 2 and 255 characters.";
        }

        //Description
        if (isBlank($this->description)) {
            $this->errors[] = "Description cannot be blank.";
        } elseif (!hasLength($this->description, array('min' => 10, 'max' => 500))) {
            $this->errors[] = "Description must be between 10 and 255 characters.";
        }

        // Remove any non-numeric characters from the price input
        $this->price = preg_replace('/[^0-9.]/', '', $this->price);
        if (isBlank($this->price)) {
            $this->errors[] = "Price cannot be blank.";
        } elseif (!is_numeric($this->price) || $this->price <= 0) {
            $this->errors[] = "Price must be a valid number.";
        }

        // Check if date is a valid format (YYYY-MM-DD)
        $date_pattern = '/^(\d{4})-(\d{2})-(\d{2})$/';
        if (isBlank($this->event_date)) {
            $this->errors[] = "Date cannot be blank.";
        } elseif (!preg_match($date_pattern, $this->event_date, $matches)) {
            $this->errors[] = "Date is a not valid format";
        } elseif (!checkdate($matches[2], $matches[3], $matches[1])) {
            $this->errors[] = "Date is a not valid calendar date";
        }
        return $this->errors;
    }

    protected function processImage(): string
    {
        if (!empty($_FILES["image"]["name"])) {
            //Get file info
            $fileName = basename($_FILES["image"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            //Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg');
            if (in_array($fileType, $allowTypes)) {
                $permanent_name = rand(100, 10000) . "-" . $_FILES["image"]["name"];
                $temporary_name = $_FILES['image']['tmp_name'];
                $uploads_dir = PUBLIC_PATH . '/images/uploads';
                var_dump( $uploads_dir);

                move_uploaded_file($temporary_name, $uploads_dir . '/' . $permanent_name);

                return $permanent_name;

            } else {
                $this->errors[] = "$fileType is not allowed. Only JPG,JPEG & PNG";
            }
        } else {
            $this->errors[] = "Please select an image to upload";
        }
        return '';
    }

}