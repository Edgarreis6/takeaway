<?php


class Base {
    public $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=takeaway;charset=utf8mb4", "root", "");
    }

    public function sanitize( $array ) {
        if(!is_array($array)) {
            return [];
        }
        
        foreach($array as $key => $value) {
            $array[ $key ] = trim(strip_tags($value));
        }
        return $array;
    }

    public function isValidUser($api_key) {
        $query = $this->db->prepare("
            SELECT user_id
            FROM users
            WHERE api_key = ?
        ");
        
        $query->execute([ $api_key ]);

        return $query->fetch( PDO::FETCH_ASSOC );
    }
}
