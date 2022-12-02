<?php
declare(strict_types=1);

class SerializeData {
    public int $id;
    public string $book_name;
    public string $ISBN;
    public float $rating;
}

interface Serialize {
    public function Create(SerializeData &$data) : bool;
    public function Read(SerializeData &$data)   : array;
    public function Update(SerializeData &$data) : bool;
    public function Delete(SerializeData &$data) : bool;
}

?>