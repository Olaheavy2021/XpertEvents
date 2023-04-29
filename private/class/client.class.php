<?php
require_once (PRIVATE_PATH . '/class/user.class.php');

class Client extends User
{

    /**
     * @return bool
     */
    public function register(): bool
    {
        //check if the user already exists
        $user = $this->getUserByEmail($this->email);

        if ($user) {
            $this->errors[] = "This user already exists. Please login";
            return false;
        }

        $this->role = CLIENT_ROLE;
        $this->account_status = true;
        return parent::create();
    }

    static public function getTotalNumberOfClients() :int
    {
        $sql = "SELECT * FROM users WHERE role = 'CLIENT'";
        $result = parent::findBySql($sql);
        return count($result);
    }

}