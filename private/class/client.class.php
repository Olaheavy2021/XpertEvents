<?php
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once (PRIVATE_PATH . '/class/user.class.php');
require_once (PRIVATE_PATH . '/class/enquiry.class.php');
require_once (PRIVATE_PATH . '/class/customevent.class.php');
class Client extends User
{

    /**
     * @return bool
     */
    public function register(): bool
    {
        //check if the user already exists
        $user = $this->getUserByEmail($this->email);


        if (hasPresence($user->email)) {
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

    static public function viewCustomEvents(int $per_page, int $offset)
    {
        return CustomEvent::getClientEvents($per_page, $offset);
    }

     static public function viewCustomEvent(string $id)
    {
        $event = CustomEvent::getEvent($id);
        if ($event) {
            $user = User::findById($event->getClientID());
            if ($user) {
                $event->setClientEmail($user->getEmail());
                $event->setClientName($user->getFullName());
                return $event;
            }
        }
    }

    static public function getTotalNumberOfClients() :int
    {
        $sql = "SELECT * FROM users WHERE role = 'CLIENT'";
        $result = parent::findBySql($sql);
        return count($result);
    }

}