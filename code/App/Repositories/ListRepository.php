<?php

namespace App\Repositories;

use App\Song;
use App\DB\DB;
use PDO;
include  $_SERVER['DOCUMENT_ROOT'] . '/App/Song.php';

class ListRepository{
    private $db;
    private $table = 'songs';
    private $singersTable = 'singers';
    private $stylesTable = 'styles';
    private $albomsTable = 'alboms';

    public function __construct(DB $db){
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $songsData = $stmt->fetchAll();
        $songsCollection = $this->mapSongs($songsData);
        return $songsCollection;

    }

    public function getRowsCount()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        $number_of_rows = $stmt->rowCount();
        return $number_of_rows;
    }

    public function find(int $singer)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE singer_id = ? ", [$singer]);
        $Songs = $stmt->fetchAll();
        $findSongs = $this->mapSongs($Songs);
        return $findSongs;
    }

    public function getByMaxDuration($singer)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE singer_id = ? ORDER BY duration", [$singer]);
        $Songs = $stmt->fetchAll();
        $findSongs = $this->mapSongs($Songs);
        return $findSongs;
    }

    public function update(array $newInfo)
    {
        $sql = "UPDATE {$this->table} SET name = :name, singer_id = :singer_id, albom_id = :albom_id,
                 year = :year, style_id = :style_id,
                 path =:path, duration =:duration,
                 codec =:codec
                WHERE id={$newInfo['id']}";

        $data = [
            ':name' => $newInfo['name'],
            ':singer_id' => $newInfo['singer_id'],
            ':albom_id' => $newInfo['albom_id'],
            ':year' => $newInfo['year'],
            ':style_id' => $newInfo['style_id'],
            ':path' => htmlentities($newInfo['path']),
            ':duration' => $newInfo['duration'],
            ':codec' => htmlentities($newInfo['codec'])

        ];
        $this->db->query($sql, $data);
        return $newInfo['id'];
    }

    public function findSingerLinks(int $id)
    {
        $stmt = $this->db->query("SELECT name FROM {$this->singersTable} WHERE id = ? LIMIT 1", [$id]);
        $infoArray=$stmt->fetch();
        return $infoArray['name'];
    }

    public function findStylesLinks(int $id)
    {
        $stmt = $this->db->query("SELECT name FROM {$this->stylesTable} WHERE id = ? LIMIT 1", [$id]);
        $infoArray=$stmt->fetch();
        return $infoArray['name'];
    }

    public function findAlbomsLinks(int $id)
    {
        $stmt = $this->db->query("SELECT name FROM {$this->albomsTable} WHERE id = ? LIMIT 1", [$id]);
        $infoArray=$stmt->fetch();
        return $infoArray['name'];
    }


    public function create(array $songInfo)
    {
        $sql = "INSERT INTO {$this->table} (name, singer_id, albom_id, year, style_id, path, duration, codec)
                VALUES (:name, :singer_id, :albom_id, :year, :style_id, :path, :duration, :codec)";

        $data = [
            ':name' => $songInfo['name'],
            ':singer_id' => $songInfo['singer_id'],
            ':albom_id' => $songInfo['albom_id'],
            ':year' => $songInfo['year'],
            ':style_id' => $songInfo['style_id'],
            ':path' => htmlentities($songInfo['path']),
            ':duration' => $songInfo['duration'],
            ':codec' => $songInfo['codec']
        ];

        $this->db->query($sql, $data);
        $createdTaskId = $this->db->getLastInsertedId();
        return $createdTaskId;
    }

    public function remove(int $id)
    {
        return $this->db->query("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    private function mapSongs(array $songs): array
    {
        $songsCollection = [];
        foreach ($songs as $song) {
            $song['name'] = html_entity_decode($song['name']);
            $song['path'] = html_entity_decode($song['path']);
            $song['codec'] = html_entity_decode($song['codec']);
            $songsCollection[] = new Song($song);
        }

        return $songsCollection;
    }
    private function mapOneSong( array $OneSong)
    {
        $song['name'] = html_entity_decode($OneSong[0]['name']);
        $song['singer_id'] = intval($OneSong[0]['singer_id']);
        $song['albom_id'] = intval($OneSong[0]['albom_id']);
        $song['year'] = intval($OneSong[0]['year']);
        $song['singer_id'] = intval($OneSong[0]['singer_id']);
        $song['path'] = html_entity_decode($OneSong[0]['path']);
        $song['duration'] =$OneSong[0]['duration'];
        $song['codec'] = $OneSong[0]['codec'];
        $findSong = new Song($song);
        return $findSong;
    }
}