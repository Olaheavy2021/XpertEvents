<?php

class Session {

    private $user_id;
    public $email;

    public $first_name;

    public $last_name;

    public $role;

    public $phone_number;

    private $last_login;

    public const MAX_LOGIN_AGE = 60*60*24; // 1 day

    public function __construct() {
        session_start();
        $this->check_stored_login();
    }

    /**
     * @param $user
     * @return bool
     */
    public function login($user): bool
    {
        if($user) {

            // prevent session fixation attacks
            session_regenerate_id(true);
            $this->user_id = $_SESSION['user_id'] = $user->getId();
            $this->email = $_SESSION['email'] = $user->email;
            $this->role = $_SESSION['role'] = $user->role;
            $this->first_name = $_SESSION['first_name'] = $user->first_name;
            $this->last_name = $_SESSION['last_name'] = $user->last_name;
            $this->phone_number = $_SESSION['phone_number'] = $user->phone_number;
            $this->last_login = $_SESSION['last_login'] = time();

            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function is_logged_in(): bool
    {
        return isset($this->user_id) && $this->last_login_is_recent();
    }

    public function is_customer():bool
    {
    
        return $this->is_logged_in() && ($this->role == CLIENT_ROLE);
    }

    public function is_admin():bool
    {
    
        return $this->is_logged_in() && ($this->role == ADMIN_ROLE || $this->role == SALESSTAFF_ROLE || $this->role == MANAGER_ROLE );
    }

    /**
     * @return true
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['email']);
        unset($_SESSION['last_login']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        unset($_SESSION['role']);
        unset($_SESSION['phone_number']);
        unset($this->user_id);
        unset($this->email);
        unset($this->last_login);
        unset($this->last_name);
        unset($this->first_name);
        unset($this->role);
        unset($this->phone_number);
        return true;
    }

    /**
     * @return void
     */
    private function check_stored_login(): void
    {
        if(isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->email = $_SESSION['email'];
            $this->role = $_SESSION['role'];
            $this->first_name = $_SESSION['first_name'];
            $this->last_name = $_SESSION['last_name'];
            $this->phone_number = $_SESSION['phone_number'];
            $this->last_login = $_SESSION['last_login'];
        }
    }

    /**
     * @return bool
     */
    private function last_login_is_recent(): bool
    {
        if(!isset($this->last_login)) {
            return false;
        } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
            return false;
        } else {
            return true;
        }
    }

    public function message(string $msg="")
    {
        if(!empty($msg)) {
            // Then this is a "set" message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // Then this is a "get" message
            return $_SESSION['message'] ?? '';
        }
    }

    /**
     * @return void
     */
    public function clear_message(): void
    {
        unset($_SESSION['message']);
    }
}
