<?php
require_once (PRIVATE_PATH . '/class/user.class.php');
require_once (PRIVATE_PATH . '/class/enquiry.class.php');
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
        }

        if(empty($this->errors)){
            $this->role = CLIENT_ROLE;
            $this->account_status = true;
        
            $result = parent::create();
            if($result){
                return true;
            }
            echo alertErrorMessage($this->errors);
            return false;
        }

        echo alertErrorMessage($this->errors);
        return false;
    }

    /**
     * @param Enquiry $enquiry
     * @return bool
     */
    static public function makeEnquiry(Enquiry $enquiry):bool
    {
        return $enquiry->createEnquiry();
    }

    static public function getTotalNumberOfClients() :int
    {
        $sql = "SELECT * FROM users WHERE role = 'CLIENT'";
        $result = parent::findBySql($sql);
        return count($result);
    }

}