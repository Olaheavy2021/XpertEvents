<?php
require_once(PRIVATE_PATH . '/class/employee.class.php');
require_once(PRIVATE_PATH . '/class/customevent.class.php');

class SalesStaff extends Employee
{
    /**
     * @param CustomEvent $event
     * @return bool
     */
    static public function createCustomEvent(CustomEvent $event): bool
    {
        return $event->createEvent();
    }

    static public function editCustomEvent(CustomEvent $event, string $id):bool
    {
        return $event->updateEvent($id);
    }

}