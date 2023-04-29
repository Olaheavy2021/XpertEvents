<?php
class Admin extends Employee{
    public function deactivateUser($id) :int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 0 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }

    public function activateUser($id):int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 1 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }
}