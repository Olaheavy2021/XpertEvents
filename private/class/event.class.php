<?php

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

    public function getShortDescription(): string
    {
        return strlen($this->description) > 300 ? substr($this->description, 0, 300) . "..." : $this->description;
    }

}