<?php
require_once("base.php");


class Categories extends Base
{
    public function get() {

        $query = $this->db->prepare("
            SELECT category_id, name, photo
            FROM categories
            
        ");

        $query->execute();
        return $query->fetchall(PDO:: FETCH_ASSOC);
    }


    public function getDetails($id) {

        $query = $this->db->prepare("
            SELECT category_id, name, photo
            FROM categories
            WHERE category_id = ?
            
        ");

        $query->execute([   
            $id

        ]);
        return $query->fetchall(PDO:: FETCH_ASSOC);
    }
    
    
    public function create($data, $file) {

        
        $query = $this->db->prepare("
            INSERT INTO categories 
            (name, photo)
            VALUES(?, ?)
        ");
        
        return $query->execute([
            $data["name"],
            $file
        ]);

    }

    public function update($data, $file) {

     
        $query = $this->db->prepare("
            UPDATE categories
            SET name = ?,
                photo = ?
            WHERE category_id = ?
        ");
        
        return $query->execute([
            $data["name"],
            $file,
            $data["id"]
        ]);
    }

    public function delete($id) {
        $query = $this->db->prepare("
            DELETE FROM categories
            WHERE category_id = ?
        ");

        return $query->execute([
            $id
        ]);
    }

}