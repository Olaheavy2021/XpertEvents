<?php
require_once (PRIVATE_PATH . '/class/user.class.php');

class Employee extends User{
    static public function getTotalNumberOfEmployee() :int
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