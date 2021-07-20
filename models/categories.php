<?php
require("base.php");


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

    public function update($id, $data) {
        $data = $this->sanitize($data);

        if(!$this->validator($data)) {
            return false;
        }

        $query = $this->db->prepare("
            UPDATE categories
            SET name = ?,
                photo = ?
            WHERE category_id = ?
        ");
        
        return $query->execute([
            $data["name"],
            $files["photo"],
            $id
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