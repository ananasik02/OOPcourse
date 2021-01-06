<?php


namespace App\Repositories;


use App\DB\DB;

class SingersRepository
{
    private $db;
    private $table = 'singers';

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $singersData = $stmt->fetchAll();
        return $singersData;
    }

    public function create(array $singersInfo)
    {
        $sql = "INSERT INTO {$this->table} (name)
                VALUES (:name)";

        $data = [
            ':name' => $singersInfo['name']
        ];

        $this->db->query($sql, $data);
        $createdSingerId = $this->db->getLastInsertedId();
        return $createdSingerId;
    }
}