<?php


namespace App\Repositories;


use App\DB\DB;

class AlbomsRepository
{
    private $db;
    private $table = 'alboms';
    private $linkerdTable = 'songs';

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $albomsData = $stmt->fetchAll();
        return $albomsData;
    }

    public function getAllSongsInAlbom($id)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->linkerdTable} WHERE albom_id = $id");
        $SongsData = $stmt->fetchAll();
        return $SongsData;
    }

    public function create(array $albomsInfo)
    {
        $sql = "INSERT INTO {$this->table} (singer_id, name)
                VALUES (:singer_id, :name)";

        $data = [
            ':singer_id' => $albomsInfo['singer_id'],
            ':name' => $albomsInfo['name']
        ];

        $this->db->query($sql, $data);
        $createdAlbomId = $this->db->getLastInsertedId();
        return $createdAlbomId;
    }
}