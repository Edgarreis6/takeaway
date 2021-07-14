
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

      public function createProduct($product, $file) {
        
        $query = $this->db->prepare("
             INSERT INTO products
             (name, description, price, photo, stock, category_id)
             VALUES (?,?,?,?,?)
         ");
         $query->execute([
             $product["name"],
             $product["description"],
             $product["price"],
             $file,
             $product["stock"],
             $product["category_id"]
           ]);
 
           return $query->fetch(PDO:: FETCH_ASSOC);
     }
    
     public function updateProducts($product){
        
      $query = $this->db->prepare("
          UPDATE products
          SET 
            stock = ".$product["stock"].", price = ".$product["price"].", 
            description = ".$product["description"].", 
            category_id = ".$product["category_id"]."
          WHERE product_id = ? AND name = ?
      ");

      $query->execute([
          $product["product_id"],
          $product["name"]
      ]);

      return $query->fetch(PDO:: FETCH_ASSOC);
  }

      public function deleteProduct($product){
        $query = $this->db->prepare("
            DELETE FROM products
            WHERE product_id = ? AND name = ?
        ");

        $query->execute([
            $data["product_id"],
            $data["name"]
          ]);

          return $query->fetch(PDO:: FETCH_ASSOC);
    }

   
}    


