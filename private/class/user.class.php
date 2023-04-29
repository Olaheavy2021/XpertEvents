<?php
require_once(PRIVATE_PATH . '/class/databaseobject.class.php');
class User extends DatabaseObject
{
    static protected $tableName = "users";
    static protected $dbColumns = ['id', 'first_name', 'last_name', 'email', 'hashed_password', 'role', 'account_status'];

    public $id;
    public $first_name;

    public $last_name;

    public $email;

    protected $hashed_password;

    public $role;

    public $account_status;

    public $password;

    public $confirm_password;

    protected $password_required = true;

    public function __construct($args = [])
    {
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->role = $args['role'] ?? '';
        $this->account_status = $args['account_status'] ?? 0;
        $this->confirm_password = $args['confirm_password'] ?? '';
    }


    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * @return void
     */
    protected function setHashedPassword(): void
    {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->hashed_password);
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        //check if the user already exists
        $user = $this->getUserByEmail($this->email);

        if (!$user) {
            $this->errors[] = "The password or email is invalid. ";
            return false;
        }

        $this->hashed_password = $user->hashed_password;

        if (!$this->verifyPassword($this->password)) {
            $this->errors[] = "The password or email is invalid. ";
            return false;
        }

        //check if the account is not disabled
        if (!$user->account_status) {
            $this->errors[] = "This account has been disabled. Please contact support.";
            return false;
        }

        //create a session for the user
        global $session;
        $session->login($user);

        //redirect the user accordingly to their landing page
        if ($user->role === CLIENT_ROLE) {
            redirectTo(urlFor('/client/index.php'));
        } elseif ($user->role === ADMIN_ROLE || $user->role === SALESSTAFF_ROLE || $user->role === MANAGER_ROLE) {
            redirectTo(urlFor('/admin/index.php'));
        } else {
            $this->errors[] = "Login was unsuccessful";
        }

        return false;
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        //logout the user
        global $session;
        $session->logout();
        redirectTo(urlFor('/homepage.php'));
    }


    /**
     * @return bool
     */
    protected function create(): bool
    {
        $this->setHashedPassword();
        return parent::create();
    }

    /**
     * @return bool
     */
    protected function update(): bool
    {
        if ($this->password != '') {
            $this->setHashedPassword();
            // validate password
        } else {
            // password not being updated, skip hashing and validation
            $this->password_required = false;
        }
        return parent::update();
    }

    /**
     * @return array
     */
    protected function validateInput(): array
    {
        $this->errors = [];

        if (isBlank($this->first_name)) {
            $this->errors[] = "First name cannot be blank.";
        } elseif (!hasLength($this->first_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "First name must be between 1 and 255 characters.";
        }

        if (isBlank($this->last_name)) {
            $this->errors[] = "Last name cannot be blank.";
        } elseif (!hasLength($this->last_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Last name must be between 1 and 255 characters.";
        }

        if (isBlank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!hasLength($this->email, array('max' => 255))) {
            $this->errors[] = "Email must be less than 255 characters.";
        } elseif (!hasValidEmailFormat($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }

        if ($this->password_required) {
            if (isBlank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            } elseif (!hasLength($this->password, array('min' => 8, 'max' => 255))) {
                $this->errors[] = "Password must contain 8 or more characters";
            } elseif (!preg_match('/[A-Z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 uppercase letter";
            } elseif (!preg_match('/[a-z]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 lowercase letter";
            } elseif (!preg_match('/[0-9]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 number";
            } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
                $this->errors[] = "Password must contain at least 1 symbol";
            }

            if (isBlank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
        }

        return $this->errors;
    }

    static public function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM " . static::$tableName . " ";
        $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
        $obj_array = static::findBySql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

}