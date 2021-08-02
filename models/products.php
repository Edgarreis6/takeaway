
<?php

require_once("base.php");

class Products extends Base {
    
  public function get(){
        
    $query = $this->db->prepare("
    SELECT product_id, name, description, price, 
   photo, stock, category_id
    
    FROM 
        products
   
    ");

    $query->execute([
              ]);

    return $query->fetchAll( PDO::FETCH_ASSOC );
  }
  


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
      
      public function getProductsDetails($product_id){
        
        $query = $this->db->prepare("
        SELECT product_id, name, description, price, photo, stock, category_id
        FROM products
        WHERE product_id = ?
        ");
    
        $query->execute([
          $product_id
        
          ]);
    
        return $query->fetch( PDO::FETCH_ASSOC );
      }

      public function getProductsDetailsUp($product_id){
        
        $query = $this->db->prepare("
        SELECT product_id, name, description, price, photo, stock, category_id
        FROM products
        WHERE product_id = ?
        ");
    
        $query->execute([
          $product_id
        
          ]);
    
        return $query->fetchall( PDO::FETCH_ASSOC );
      }


      public function createProduct($data, $file) {
        
        $query = $this->db->prepare("
             INSERT INTO products
             (name, description, price, photo, stock, category_id)
             VALUES (?,?,?,?,?,?)
         ");
         $query->execute([
             $data["name"],
             $data["description"],
             $data["price"],
             $file,
             $data["stock"],
             $data["category_id"]
           ]);
 
     }
    
     public function updateProducts($data, $file){
        
      $query = $this->db->prepare("
          UPDATE products
          SET 
            stock = ?, price = ?, description = ?, 
            category_id = ?, photo = ?, name = ?
          WHERE product_id = ? 
      ");

      $query->execute([
          $data["stock"],
          $data["price"],
          $data["description"],
          $data["category_id"],
          $file,
          $data["name"],
          $data["id"]

      ]);

  }

      public function deleteProduct($id){
        $query = $this->db->prepare("
            DELETE FROM products
            WHERE product_id = ? 
        ");

        $query->execute([
            $id
           
          ]);

          return $query->fetch(PDO:: FETCH_ASSOC);
    }

    public function updateStock($data) {
        
      if( !empty($_SESSION["cart"])) {
          
      
      $query = $this->db->prepare(" 
                  UPDATE products
                  SET stock = stock - ?
                  WHERE product_id = ?
                  
                  ");
                     
                  $query->execute([
          
                      $data,
                      $data
                  ]);
       
          
      }
     
  }
   
}    


