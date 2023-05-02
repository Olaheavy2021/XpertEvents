<?php
require_once(PRIVATE_PATH . '/class/employee.class.php');
require_once(PRIVATE_PATH . '/class/prepackagedevent.class.php');
require_once(PRIVATE_PATH . '/class/enquiry.class.php');
require_once(PRIVATE_PATH . '/class/user.class.php');

class Admin extends Employee
{

    /**
     * @param string $id
     * @return int
     */
    public function disableUser(string $id): int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 0 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }

    /**
     * @param string $id
     * @return int
     */
    public function enableUser(string $id): int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 1 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function createAccount(User $user): bool
    {
        if (isBlank($user->role)) {
            $user->errors[] = "Role cannot be blank.";
        }

        if (empty($user->errors)) {
            //create the user
            $user->account_status = true;
            $user->password_required = false;
            $result = $user->create();
            if ($result) {
                global $session;
                $session->message("Employee created successfully");
                redirectTo(urlFor('admin/user/user_index.php'));
            }
        }
        return false;
    }

    static public function viewUsers(int $per_page, int $offset, string $user_id):array
    {
        return User::findAll($per_page,$offset, $user_id);
    }

    /**
     * @param PrepackagedEvent $event
     * @return bool
     */
    static public function createPrepackagedEvent(PrepackagedEvent $event): bool
    {
        return $event->createEvent();
    }

    /**
     * @param PrepackagedEvent $event
     * @param string $id
     * @return bool
     */
    static public function editPrepackagedEvent(PrepackagedEvent $event, string $id): bool
    {
        return $event->editEvent($id);
    }

    /**
     * @param int $per_page
     * @param int $offset
     * @return array
     */
    static public function viewEnquiries(int $per_page, int $offset):array
    {
        return Enquiry::getEnquiries($per_page, $offset);
    }

    static public function viewEnquiry($id)
    {
        return Enquiry::getEnquiry($id);
    }
}
