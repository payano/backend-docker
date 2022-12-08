<?php
declare(strict_types=1);

require("SerializeDB.php");

Class CrudHandler 
 {
    private Serialize $serialize;
    function __construct() {
        
        $this->serialize = new SerializeDB("db", "backend", "changeme", "backend");
        if($this->serialize == NULL) throw new ErrorException("Serializer failed...");
        //print "Creating " . __CLASS__ . "\n";
    }
    function __destruct() {
        //print "Destroying " . __CLASS__ . "\n";
    }

    private function OutputJSONStatus(bool $val) : void
    {
        $data["Status"] = $val;
        header('Content-Type: application/json; charset=utf-8');
        print(json_encode($data));

    }

    private function OutputJSONArray(array &$val) : void
    {
        header('Content-Type: application/json; charset=utf-8');
        print(json_encode($val));
    }

    private function Create(array &$json) : void
    {
        // Validate fields
        //if(!(isset($json["id"])        && gettype($json["id"]) == "integer"))       throw new ErrorException("id");
        if(!(isset($json["book_name"]) && gettype($json["book_name"]) == "string")) throw new ErrorException("book_name");
        if(!(isset($json["ISBN"])      && gettype($json["ISBN"]) == "string"))      throw new ErrorException("ISBN");
        if(!(isset($json["rating"])    && gettype($json["rating"]) == "double"))    throw new ErrorException("rating");


        $data = new SerializeData();
        $data->book_name = $json["book_name"];
        $data->ISBN = $json["ISBN"];
        $data->rating = $json["rating"];
        $ret = $this->serialize->Create($data);
        $this->OutputJSONStatus($ret);
        
    }
    private function Read(array &$json) : void
    {
        $data = new SerializeData();
        //$data->id = isset($json["id"]) ? $json["id"] : -1;
        $data->id = -1;
        $ret = $this->serialize->Read($data);
        $this->OutputJSONArray($ret);

    }
    private function Update(array &$json) : void
    {
        // Validate fields
        if(!(isset($json["id"])        && gettype($json["id"]) == "integer"))       throw new ErrorException("id");
        if(!(isset($json["book_name"]) && gettype($json["book_name"]) == "string")) throw new ErrorException("book_name");
        if(!(isset($json["ISBN"])      && gettype($json["ISBN"]) == "string"))      throw new ErrorException("ISBN");
        if(!(isset($json["rating"])    && gettype($json["rating"]) == "double"))    throw new ErrorException("rating");

        $data = new SerializeData();
        $data->id = $json["id"];
        $data->book_name = $json["book_name"];
        $data->ISBN = $json["ISBN"];
        $data->rating = $json["rating"];
        $ret = $this->serialize->Update($data);
        $this->OutputJSONStatus($ret);
    }
    private function Delete(array &$json) : void
    {
        // Validate fields
        if(!(isset($json["id"])        && gettype($json["id"]) == "integer"))       throw new ErrorException("id");

        $data = new SerializeData();
        $data->id = $json["id"];
        $ret = $this->serialize->Delete($data);
        $this->OutputJSONStatus($ret);
    }
    public function HandleRequest(string &$rawJson, string &$method) : void
    {
        //$json = json_decode($rawJson, true);
        $json = json_decode("{}", true);
        //if(gettype($json) != "array") {
        //    $this->OutputJSONStatus(false);
        //    return;
        //}
        switch($method) {
            case "POST":   $this->Create($json); break;
            case "GET":    $this->Read($json);   break;
            case "PUT":    $this->Update($json); break;
            case "DELETE": $this->Delete($json); break;
            default:       throw new ErrorException("method not supported!");
        }
    }
 }

 ?>