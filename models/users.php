<?php
require("base.php");

Class Users extends Base {

    public function getDetails($email) {
       
        $query = $this->db->prepare("
            SELECT user_id, email,user_type, password
            FROM users
            WHERE email = ?
        
        ");

        $query->execute([ $email ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }


    public function create($user) {

          $existingUser =  $this->getDetails($user["name"]);
            if(!empty($existingUser)){
                return 0;
            }

        $query = $this->db->prepare("
            INSERT INTO users
            (name, email, password, phone, birthdate, address, city, postal_code)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $query->execute([
            $user["name"],
            $user["email"],
            password_hash($user["password"], PASSWORD_DEFAULT),
            $user["phone"],
            $user["year"] . "-". $user["month"]. "-" . $user["day"],
            $user["address"],
            $user["city"],
            $user["postal_code"]

        ]);

        return $this->db->lastInsertId();

    }
}