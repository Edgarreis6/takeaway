<?php
require("base.php");

class Categories extends Base
{
    public function get() {

        $query = $this->db->prepare("
            SELECT category_id, name
            FROM categories
                    ");

        $query->execute();

        return $query->fetchAll( PDO::FETCH_ASSOC );
    }
}