<?php


namespace App\Repositories;


use App\DB\DB;
use App\Song;

class StylesRepository
{
    private $db;
    private $table = 'styles';

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $stylesData = $stmt->fetchAll();
        return $stylesData;
    }

    public function create(array $styleInfo)
    {
        $sql = "INSERT INTO {$this->table} (name)
                VALUES (:name)";

        $data = [
            ':name' => $styleInfo['name']
        ];

        $this->db->query($sql, $data);
        $createdStyleId = $this->db->getLastInsertedId();
        return $createdStyleId;
    }

}