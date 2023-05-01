<?php

class Admin extends Employee
{
    public function disableUser($id): int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 0 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }

    public function enableUser($id): int
    {
        $sql = "UPDATE users SET ";
        $sql .= "account_status = 1 ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $sql .= " LIMIT 1";
        return parent::updateColumn($sql);
    }

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
}
