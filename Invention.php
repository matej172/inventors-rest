<?php
require_once "MyPdo.php";

class Invention
{
    /* @var MyPDO */
    protected $db;

    protected int $id;
    protected string $inventor_id;
    protected DateTime $invention_date;
    protected string $description;

    public function __construct()
    {
        $this->db = MyPDO::instance();
    }

    /**
     * @return string
     */
    public function getInventorId(): string
    {
        return $this->inventor_id;
    }

    /**
     * @param string $inventor_id
     */
    public function setInventorId(string $inventor_id): void
    {
        $this->inventor_id = $inventor_id;
    }

    /**
     * @return DateTime
     */
    public function getInventionDate(): DateTime
    {
        return $this->invention_date;
    }

    /**
     * @param DateTime $invention_date
     */
    public function setInventionDate(string $invention_date): void
    {
        if($invention_date) {
            $this->invention_date = DateTime::createFromFormat('Y', $invention_date);
        }
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    public function save()
    {
        $this->db->run("INSERT into inventions 
            (`inventor_id`, `invention_date`, `description`) values (?, ?, ?)",
            [$this->inventor_id, isset($this->invention_date) ? $this->invention_date->format('Y-m-d') : null, $this->description]);
        $this->id = $this->db->lastInsertId();
    }
}