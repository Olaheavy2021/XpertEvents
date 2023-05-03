<?php
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/user.class.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');

class Employee extends User
{

    /**
     * @param int $per_page
     * @param int $offset
     * @return array
     */
    static public function viewCustomEvents(int $per_page, int $offset): array
    {
        return CustomEvent::getEvents($per_page, $offset);
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

    static public function getTotalNumberOfEmployee(): int
    {
        $sql = "SELECT * FROM `users` WHERE role = 'ADMIN' OR role = 'MANAGER' OR role = 'SALESSTAFF'";
        $result = parent::findBySql($sql);
        return count($result);
    }

    /**
     * @return array
     */
    static public function getAllEmployee(): array
    {
        $sql = "SELECT * FROM `users` ";
        $sql .= "WHERE role = 'ADMIN' ";
        $sql .= "OR role = 'MANAGER' ";
        $sql .= "OR role = 'SALESSTAFF' ";
        $sql .= "LIMIT 5";
        return parent::findBySql($sql);

    }
}