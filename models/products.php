
<?php

require("base.php");

class Products extends Base {
    
    public function getProduct($products_id){
        
        $query = $this->db->prepare("
        SELECT
        products.name,
        products.product_id,
        categories.name AS category
    FROM
        products
    INNER JOIN
        categories USING(category_id)
    WHERE
        products.category_id = ?
        ");
    
        $query->execute([
          $products_id
                  ]);
    
        return $query->fetchAll( PDO::FETCH_ASSOC );
      }
      
   
}    


