<?php

namespace App\Repositories;

use App\DB\DB;
use App\User;
use PDO;
include  $_SERVER['DOCUMENT_ROOT'] . '/App/User.php';

class UsersRepository
{
    private $db;
    private $table = 'singers';

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function all(){
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        var_dump($stmt);
        $UserData = $stmt->fetchAll();
        $UsersCollection = $this->mapUsers($UserData) ;
        return $UsersCollection;
    }

    public function find($name)
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE name = ? LIMIT 1", [$name]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create(array $UserInfo)
    {
        $sql = "INSERT INTO {$this->table} (login, password)
                VALUES (:login, :password)";

        $data = [
            ':login' => htmlentities($UserInfo['login']),
            ':password' => htmlentities($UserInfo['password'])

        ];

        $this->db->query($sql, $data);

        $createdUserId = $this->db->getLastInsertedId();

        return $createdUserId;
    }

    private function mapUsers(array $users): array
    {
        $UsersCollection = [];
        foreach ($users as $user) {
            $user['login'] = html_entity_decode($user['login']);
            $user['password'] = html_entity_decode($user['password']);
            $UsersCollection[] = new User($user);
        }

        return $UsersCollection;
    }

}