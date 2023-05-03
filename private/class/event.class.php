<?php
require_once('/home/SHU/c2042523/public_html/xpertevents/private/initialize.php');
require_once(PRIVATE_PATH . '/class/databaseobject.class.php');
class Event extends DatabaseObject
{

    protected $description;

    protected $name;

    protected $location;

    protected $event_date;

    protected $price;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getEventDate(): string
    {
        return $this->event_date;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param int $per_page
     * @param int $offset
     * @return array
     */
    static public function getEvents(int $per_page, int $offset): array
    {
        return parent::findAll($per_page, $offset, null);
        
    }

    static public function getEvent(int $id)
    {
        return parent::findById($id);
    }

    public function getShortDescription(): string
    {
        return strlen($this->description) > 300 ? substr($this->description, 0, 300) . "..." : $this->description;
    }

}