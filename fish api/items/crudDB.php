<?php

class Fish {

    private $fishTable = "fish";
    public $id;
    public $GlassType;
    public $Size;
    public $Shape;
    private $conn;


    public function __construct($id) {
        $this->conn = $db;
}

   function readDB() {
         if($this->id) {
             $query = $this->conn->prepare("SELECT * FROM ".$this->$fishTable." WHERE id = ?");
             $query->bind_param("i", $this->id);
         }else {
             $query = $this->conn->prepare("SELECT * FROM ".$this->$fishTable);
         }      
         $query->excute();
         $res = $query->get_result();
    }


    function createDB()  {

        $query = $this->conn->prepare("INSERT INTO ".$this->$fishTable."('Species','Color','No_Fins','Created_id','Created_at')
        VALUES(?,?,?,?,?)");

        $this->Species = htmlspecialchars(strip_tags($this->Species));
        $this->Color = htmlspecialchars(strip_tags($this->Color));
        $this->No_Fins = htmlspecialchars(strip_tags($this->No_Fins));
        $this->Created_id = htmlspecialchars(strip_tags($this->Created_id));
        $this->Created_at = htmlspecialchars(strip_tags($this->Created_at));


        $query->bind_param("ssiis",$this->Species,$this->Color,$this->No_Fins,$this->Created_id,$this->Created_at);

        if($query->excute()){
            return true;
        }

        return false;
    }

    function updateDB() {

        $qurey = $this->conn->prepare("UPDATE ".$this->$fishTable." 
        SET Species= ?, Color= ?, No_Fins= ?, Created_id= ?,Created_at= ? WHERE id ?");


        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->Species = htmlspecialchars(strip_tags($this->Species));
        $this->Color = htmlspecialchars(strip_tags($this->Color));
        $this->No_Fins = htmlspecialchars(strip_tags($this->No_Fins));
        $this->Created_id = htmlspecialchars(strip_tags($this->Created_id));
        $this->Created_at = htmlspecialchars(strip_tags($this->Created_at));


        $query->bind_param("ssiis",$this->Species,$this->Color,$this->No_Fins,$this->Created_id,$this->Created_at,$this->id);


        if($query->excute()){
            return true;
        }

        return false;
    }


    function deleteDB() {
        $query = $this->conn->prepare("DELETE FROM ".$this->$fishTable." WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));

        $query->bind_param("i", $this->id);

        if($query->excute()){
            return true;
        }

        return false;
    }

}


?>