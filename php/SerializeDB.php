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
        $ret = array();
        $query;
    
        if($data->id > 0) 
            $query = "SELECT id, book_name, ISBN, rating FROM backend WHERE id = \"$data->id\" ORDER BY id";
        else
            $query = "SELECT id, book_name, ISBN, rating FROM backend ORDER BY id";
            
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            $item = new SerializeData();
            $item->id = (int)$row["id"];
            $item->book_name = (string)$row["book_name"];
            $item->ISBN = (string)$row["ISBN"];
            $item->rating = (float)$row["rating"];
            array_push($ret, $item);
        }
        return $ret;
    }
    public function Update(SerializeData &$data) : bool {
        $query = "UPDATE $this->db SET 
                  book_name = \"$data->book_name\",
                  ISBN = \"$data->ISBN\",
                  rating = \"$data->rating\"                
                  WHERE id = $data->id";
        $this->mysqli->query($query);
        return $this->mysqli->affected_rows >= 1 ? true : false;
    }
    public function Delete(SerializeData &$data) : bool {
        $query = "DELETE FROM $this->db WHERE id = $data->id";
        $this->mysqli->query($query);
        return $this->mysqli->affected_rows >= 1 ? true : false;
    }
}

?>