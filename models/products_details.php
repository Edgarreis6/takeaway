
<?php

require("base.php");
class Products extends Base {
    public function getProductsDetails($product){
        
        $query = $this->db->prepare("
        SELECT product_id, name, description, price, photo, stock, category_id
        FROM products
        WHERE product_id = ?
        ");
    
        $query->execute([
          $product
        
          ]);
    
        return $query->fetch( PDO::FETCH_ASSOC );
      }
    



}



