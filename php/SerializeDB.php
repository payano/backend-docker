<?php
declare(strict_types=1);

require("InterfaceSerialize.php");

class SerializeDB implements Serialize {
    private string $username;
    private string $db;
    private string $password;
    private string $host;
    private mysqli $mysqli;

    function __construct(string $host, string $username, string $password, string $db) {
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->db = $db;
        $this->mysqli = new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->mysqli->connect_errno) throw new ErrorException("Mysql connect error!");
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function Create(SerializeData &$data) : bool {
        $query = "INSERT INTO $this->db(book_name, ISBN, rating) 
                  VALUES(\"$data->book_name\", \"$data->ISBN\", \"$data->rating\")
                  ;";
        return $this->mysqli->query($query);
    }
    public function Read(SerializeData &$data) : array {

    }
    public function Update(SerializeData &$data) : bool {

    }
    public function Delete(SerializeData &$data) : bool{
        $query = "DELETE FROM $this->db WHERE id = $data->id";
        return $this->mysqli->query($query);
    }
}

?>