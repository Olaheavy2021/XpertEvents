<?php

class DatabaseObject
{
    static protected $database;
    static protected $tableName = "";

    static protected $dbColumns = [];

    public $errors = [];

    protected $id;


    public function getId()
    {
        return $this->id;
    }

    public function delete()
    {
        $sql = "DELETE FROM " . static::$tableName . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
        return self::$database->query($sql);
    }

    public function updateColumn(string $sql)
    {
        return self::$database->query($sql);
    }

    /**
     * @param $database
     * @return void
     */
    static public function setDatabase($database): void
    {
        self::$database = $database;
    }

    /**
     * @param string $sql
     * @return array|void
     */
    static public function findBySql(string $sql)
    {
        $result = self::$database->query($sql);
        if (!$result) {
            exit("Database query failed");
        }

        //convert result into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();

        return $object_array;
    }

    /**
     * @param int $per_page
     * @param int $offset
     * @param int|null $user_id
     * @return array|null
     */
    static public function findAll(int $per_page, int $offset, ?int $user_id): ?array
    {
        try {

            $sql = "SELECT * FROM " . static::$tableName;
        if (!empty($user_id)) {
            $sql .= " WHERE id !='" . self::$database->escape_string($user_id) . "'";
        }
        if (static::$tableName == "prepackaged_events" || static::$tableName == "custom_events") {
            $sql .= " ORDER BY id";
        }
        $sql .= " LIMIT {$per_page} ";
        $sql .= " OFFSET {$offset}";
        return static::findBySql($sql);

        var_dump($sql);
            
        } catch (Exception $e) {
           echo alertErrorMessage($this->errors);
            return false;
        }
        
    }

    static public function countAll(?int $user_id)
    {
        $sql = "SELECT COUNT(*) FROM " . static::$tableName;
        if (!empty($user_id)) {
            $sql .= " WHERE id !='" . self::$database->escape_string($user_id) . "'";
        }
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }

    static public function findById($id)
    {
        $sql = "SELECT * FROM " . static::$tableName . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        $obj_array = static::findBySql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static protected function instantiate($record)
    {
        $object = new static;
        // Could manually assign values to properties
        // but automatically assignment is easier and re-usable
        foreach ($record as $property => $value) {
            if (property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    /**
     * @return array
     */
    protected function validateInput(): array
    {
        $this->errors = [];

        // Add custom validations

        return $this->errors;
    }

    protected function create()
    {
        try {
            $this->validateInput();
            if (!empty($this->errors)) {
                return false;
            }
        
            $attributes = $this->sanitizedAttributes();
            $sql = "INSERT INTO " . static::$tableName . " (";
            $sql .= join(', ', array_keys($attributes));
            $sql .= ") VALUES ('";
            $sql .= join("', '", array_values($attributes));
            $sql .= "')";

            $result = self::$database->query($sql);
           
            if ($result) {
                $this->id = self::$database->insert_id;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $exceptionCode = $ex->getCode();
            if ($exceptionCode == '1062') {
                $this->errors[] = "Account already exists. Please sign in";
                echo alertErrorMessage($this->errors);
                return false;
            }
            $this->errors[] = $ex->getMessage();
            echo alertErrorMessage($this->errors);
            return false;
        }
    }

    /**
     * @return bool
     */
    protected function update(): bool
    {
        //$this->validateInput();
        if (!empty($this->errors)) {
            return false;
        }

        $attributes = $this->sanitizedAttributes();
        $attribute_pairs = [];
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$tableName . " SET ";
        $sql .= join(', ', $attribute_pairs);
        $sql .= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql .= "LIMIT 1";
       
        return self::$database->query($sql);
    }

    /**
     * @param array $args
     * @return void
     */
    public function mergeAttributes(array $args = []): void
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Properties which have database columns, excluding ID

    /**
     * @return array
     */
    public function attributes(): array
    {
        $attributes = [];
        foreach (static::$dbColumns as $column) {
            if ($column == 'id') {
                continue;
            }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    /**
     * @return array
     */
    protected function sanitizedAttributes(): array
    {
        $sanitized = [];
        foreach ($this->attributes() as $key => $value) {
            $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

}
