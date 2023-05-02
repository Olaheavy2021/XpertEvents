<?php
require_once(PRIVATE_PATH . '/class/databaseobject.class.php');

class Enquiry extends DatabaseObject
{
    static protected $tableName = "customer_enquiry";
    static protected $dbColumns = ['id', 'full_name', 'message', 'email'];

    protected $email;
    protected $full_name;

    protected $message;

    public function __construct($args = [])
    {
        $this->full_name = $args['full_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->message = $args['message'] ?? '';
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function createEnquiry(): bool
    {
        //validate
        $this->validateInput();
        echo alertErrorMessage($this->errors);

        if (empty($this->errors)) {
            $result = parent::create();
            if ($result) {
                global $session;
                $session->message("Hi customer, your enquiry is being processed");
                redirectTo(urlFor('/homepage.php'));
            }
        }
        return false;
    }


    static public function getEnquiry(int $id)
    {
        return parent::findById($id);
    }

    static public function getEnquiries(int $per_page, int $offset):array
    {
        return parent::findAll($per_page, $offset, null);
    }

    protected function validateInput(): array
    {
        $this->errors = [];

        //Name
        if (isBlank($this->full_name)) {
            $this->errors[] = "Name cannot be blank.";
        } elseif (!hasLength($this->full_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Name must be between 2 and 255 characters.";
        }

        //Email
        if (isBlank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!hasLength($this->email, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Email must be between 2 and 255 characters.";
        }

        //Message
        if (isBlank($this->message)) {
            $this->errors[] = "Message cannot be blank.";
        } elseif (!hasLength($this->message, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Message must be between 2 and 255 characters.";
        }

        return $this->errors;
    }


}
