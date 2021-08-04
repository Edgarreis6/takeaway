<?php
require_once("base.php");

class Orders extends Base
{
    public function get() {
        $query = $this->db->prepare("
            SELECT
                o.order_id, o.user_id, o.order_date,
                o.payment_date, 
                u.name AS customer, u.address AS address, u.city AS city, u.email AS email, u.phone AS phone,
                op.quantity AS quantity, 
                pd.name, pd.product_id
            FROM
                orders o
            INNER JOIN
                users u USING(user_id)
            INNER JOIN
                orderdetails op USING(order_id)
                INNER JOIN
                products pd USING(product_id)
            GROUP BY
                o.order_id, o.user_id, o.order_date,
                o.payment_date, u.name
        ");

        $query->execute();

        return $query->fetchAll( PDO::FETCH_ASSOC );
    }



    public function getItem($id) {
        $query = $this->db->prepare("
            SELECT
                o.order_id, o.user_id, u.name AS customer,
                o.order_date, o.payment_date
            FROM orders o
            INNER JOIN users u USING(user_id)
            WHERE o.order_id = ?
        ");

        $query->execute([ $id ]);

        $order = $query->fetch( PDO::FETCH_ASSOC );

        if(empty($order)) {
            return $order;
        }

        $query = $this->db->prepare("
            SELECT op.product_id, p.name, op.quantity, op.price
            FROM orderdetails op
            INNER JOIN products p USING(product_id)
            WHERE op.order_id = ?
        ");
        $query->execute([ $id ]);

        $order["products"] = $query->fetchAll( PDO::FETCH_ASSOC );

        return $order;
    }


    public function create( ) {
                        
        if( !empty($_SESSION["cart"])) {
            
            $query = $this->db->prepare("
                INSERT INTO orders
                (user_id )
                VALUES(? )
                    
                ");
                $query->execute([
                    $_SESSION["user_id"]
                ]);

            $order_id = $this->db->lastInsertId();

            return $order_id;
            
        }
    }      
    

    public function orderDetails($order_id, $item ) {
                        
        if( !empty($_SESSION["cart"])) {
            
            $query = $this->db->prepare("
            INSERT INTO orderdetails
            (order_id, product_id, quantity, price_each)
            VALUES(?,?,?,?)
           
                    
                ");
                $query->execute([
                    $order_id,
                    $item["product_id"],
                    $item["quantity"],
                    $item["price"]

                ]);
            
        }
    }      
    
    
    
    
}
