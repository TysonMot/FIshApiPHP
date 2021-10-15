<?php

class Aquarium {

    private $aquariumTable = "AquarStore";
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
             $query = $this->conn->prepare("SELECT * FROM ".$this->$aquariumTable." WHERE id = ?");
             $query->bind_param("i", $this->id);
         }else {
             $query = $this->conn->prepare("SELECT * FROM ".$this->$aquariumTable);
         }      
         $query->excute();
         $res = $query->get_result();
    }


    function createDB()  {
        
        $query = $this->conn->prepare("INSERT INTO ".$this->$aquariumTable."('Glass_type','Size','Shape','Created_id','Created_at')
        VALUES(?,?,?,?,?)");

        $this->Glass_type = htmlspecialchars(strip_tags($this->Glass_type));
        $this->Size = htmlspecialchars(strip_tags($this->Size));
        $this->Shape = htmlspecialchars(strip_tags($this->Shape));
        $this->Created_id = htmlspecialchars(strip_tags($this->Created_id));
        $this->Created_at = htmlspecialchars(strip_tags($this->Created_at));


        $query->bind_param("ssiis",$this->Glass_type,$this->Size,$this->Shape,$this->Created_id,$this->Created_at);

        if($query->excute()){
            return true;
        }

        return false;
    }

    function updateDB() {

        $qurey = $this->conn->prepare("UPDATE ".$this->$aquariumTable." 
        SET Glass_type= ?, Size= ?, Shape= ?, Created_id= ?,Created_at= ? WHERE id ?");


        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->Glass_type = htmlspecialchars(strip_tags($this->Glass_type));
        $this->Size = htmlspecialchars(strip_tags($this->Size));
        $this->Shape = htmlspecialchars(strip_tags($this->Shape));
        $this->Created_id = htmlspecialchars(strip_tags($this->Created_id));
        $this->Created_at = htmlspecialchars(strip_tags($this->Created_at));


        $query->bind_param("ssiis",$this->Glass_type,$this->Size,$this->Shape,$this->Created_id,$this->Created_at,$this->id);


        if($query->excute()){
            return true;
        }

        return false;
    }


    function deleteDB() {
        $query = $this->conn->prepare("DELETE FROM ".$this->$aquariumTable." WHERE id = ?");
        $this->id = htmlspecialchars(strip_tags($this->id));

        $query->bind_param("i", $this->id);

        if($query->excute()){
            return true;
        }

        return false;
    }

}


?>