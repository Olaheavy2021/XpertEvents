<?php
require_once(PRIVATE_PATH . '/class/event.class.php');
require_once(PRIVATE_PATH . '/class/user.class.php');

class CustomEvent extends Event
{
    static protected $tableName = "custom_events";
    static protected $dbColumns = ['id', 'name', 'description', 'location', 'event_date', 'price',
        'number_of_guest', 'is_av_required', 'is_catering_required', 'number_of_chair', 'number_of_table', 'client_id'];

    protected $number_of_guest;

    protected $is_av_required;

    protected $is_catering_required;

    protected $number_of_chair;

    protected $number_of_table;

    protected $client_id;

    private $client_email;

    private $client_name;

    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->location = $args['location'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->event_date = $args['event_date'] ?? '';
        $this->price = $args['price'] ?? 0;
        $this->number_of_guest = $args['number_of_guest'] ?? 0;
        $this->number_of_chair = $args['number_of_chair'] ?? 0;
        $this->number_of_table = $args['number_of_table'] ?? 0;
        $this->is_catering_required = $args['is_catering_required'] ?? '';
        $this->is_av_required = $args['is_av_required'] ?? '';
        $this->client_email = $args['client_email'] ?? '';
        $this->client_id = $args['client_id'] ?? 0;
    }

    public function getNumberOfGuests()
    {
        return $this->number_of_guest;
    }

    public function isAvRequired()
    {
        return $this->is_av_required;
    }

    public function isCateringRequired()
    {
        return $this->is_catering_required;
    }

    public function getNumberOfChair()
    {
        return $this->number_of_chair;
    }

    public function getNumberOfTable()
    {
        return $this->number_of_table;
    }

    public function getClientEmail()
    {
        return $this->client_email;
    }

    public function getClientName()
    {
        return $this->client_name;
    }

    public function setClientName(string $name)
    {
        $this->client_name = $name;
    }

    public function getClientID()
    {
        return $this->client_id;
    }

    public function setClientEmail(string $email)
    {
        $this->client_email = $email;
    }

    /**
     * @return bool
     */
    public function createEvent(): bool
    {
        //check if the user already exists
        $user = User::getUserByEmail($this->client_email);

        if (!$user) {
            $this->errors[] = "Client needs to create an account before event can be profiled.";
        }

        //validate the form
        $this->validateInput();

        if (empty($this->errors)) {
            //save inside the database
            $this->client_id = $user->getId();
            $result = parent::create();
            if ($result) {
                global $session;
                $session->message("Custom Event created Successfully");
                redirectTo(urlFor('/admin/custom/custom_index.php'));
            }
        }
        echo alertErrorMessage($this->errors);
        return false;

    }

    /**
     * @param string $id
     * @return bool
     */
    public function updateEvent(string $id): bool
    {
        //check if the user already exists
        $user = User::getUserByEmail($this->client_email);

        if (!$user) {
            $this->errors[] = "Client needs to create an account before event can be profiled.";
        }

        //validate the form
        $this->validateInput();

        if (empty($this->errors)) {
            //save inside the database
            $this->client_id = $user->getId();
            $this->id = $id;
        
            $result = parent::update();
            if ($result) {
                global $session;
                $session->message("Custom Event updated Successfully");
                redirectTo(urlFor('/admin/custom/custom_index.php'));
            }
        }

        echo alertErrorMessage($this->errors);
        return false;

    }

    protected function validateInput(): array
    {
        $this->errors = [];

        if (isBlank($this->client_email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!hasLength($this->client_email, array('max' => 255))) {
            $this->errors[] = "Email must be less than 255 characters.";
        } elseif (!hasValidEmailFormat($this->client_email)) {
            $this->errors[] = "Email must be a valid format.";
        }

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

        // Remove any non-numeric characters from the chair input
        $this->number_of_chair = preg_replace('/[^0-9.]/', '', $this->number_of_chair);
        if (isBlank($this->number_of_chair)) {
            $this->errors[] = "Number of chair cannot be blank.";
        } elseif (!is_numeric($this->number_of_chair) || $this->number_of_chair <= 0) {
            $this->errors[] = "Number of chair must be a valid number.";
        }

        // Remove any non-numeric characters from the table input
        $this->number_of_table = preg_replace('/[^0-9.]/', '', $this->number_of_table);
        if (isBlank($this->number_of_table)) {
            $this->errors[] = "Number of table cannot be blank.";
        } elseif (!is_numeric($this->number_of_table) || $this->number_of_table <= 0) {
            $this->errors[] = "Number of table must be a valid number.";
        }

        // Remove any non-numeric characters from the table input
        $this->number_of_guest = preg_replace('/[^0-9.]/', '', $this->number_of_guest);
        if (isBlank($this->number_of_guest)) {
            $this->errors[] = "Number of Guest cannot be blank.";
        } elseif (!is_numeric($this->number_of_guest) || $this->number_of_guest <= 0) {
            $this->errors[] = "Number of Guest must be a valid number.";
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

    /**
     * @return int
     */
    static public function getTotalNumberOfEvents() :int
    {
        $sql = "SELECT * FROM custom_events";
        $result = parent::findBySql($sql);
        return count($result);
    }

    static public function getClientEvents(int $per_page, int $offset)
    {
        $client_id = $_SESSION['user_id'];

        $sql = " SELECT * FROM custom_events";
        $sql .= " WHERE client_id ='" . $client_id . "'";
        $sql .= " LIMIT {$per_page} ";
        $sql .= " OFFSET {$offset}";

        return parent::findBySql($sql);
    }
}