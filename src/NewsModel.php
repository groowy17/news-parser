<?php
namespace News;

use PDO;

class NewsModel {
    protected $servername = 'localhost';
    protected $username = 'root';
    protected $password = 'root';
    protected $database = 'scotchbox';
    protected $table = 'rbk_data';

    private function getDB() {
        $db = null;
        if ($db === null) {
            $dsn = 'mysql:host=' . $this->servername . ';dbname=' . $this->database . ';charset=utf8';
            $db = new PDO($dsn, $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }

    public function getArticle($id) {
        $db = $this->getDB();
        $statement = "SELECT * FROM `" . $this->table ."` WHERE `id`=:id";
        $sth = $db->prepare($statement);
        $sth->execute([':id' => $id]);
        $result = $sth->fetchAll();

        return reset($result);
    }

    public function saveArticles($data) {
        $statement = "INSERT INTO `" . $this->table . "` (`title`, `description`, `fulltext`, `img`, `date`) VALUES (:title, :description, :fulltext, :img, :date)";
        $db = $this->getDB();
        $sth = $db->prepare($statement);

        foreach ($data as $item) {
            $sth->execute($item);
        }
    }

    public function dropArticles() {
        $db = $this->getDB();
        $statement = "DELETE FROM ".$this->table;
        $sth = $db->prepare($statement);
        $result = $sth->execute();

        return $result;
    }

    public function getAllArticles() {
        $db = $this->getDB();
        $statement = "SELECT `id`, `title`, `description`, `date` FROM ".$this->table;
        $sth = $db->prepare($statement);
        $sth->execute();
        $result = $sth->fetchAll();

        return $result;
    }
}
