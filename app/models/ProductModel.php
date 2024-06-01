<?php
class ProductModel {
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }
    function readAll() {
        $query = "SELECT p.*, c.name as category FROM " . $this->table_name . " as p JOIN demo.categories c ON p.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    function getProductByCategory($idCategory) {
        $query = "SELECT p.*, c.name as category FROM " . $this->table_name . " as p JOIN demo.categories c ON p.category_id = c.id WHERE category_id = $idCategory";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
    function getProductsByName($name) {
        $query = "SELECT p.*, c.name as category FROM " . $this->table_name . " as p JOIN demo.categories c ON p.category_id = c.id WHERE p.name  LIKE N'%$name%'";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
    function getProducBestseller() {
        $query = "SELECT p.*, c.name AS category
                  FROM " . $this->table_name . " AS p
                  JOIN demo.orderdetails d ON p.id = d.productID 
                  JOIN demo.categories c ON p.category_id = c.id
                  GROUP BY p.id 
                  ORDER BY SUM(d.soLuong) DESC 
                  LIMIT 10;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function deleteProductById($productId) {
        // Chuẩn bị câu truy vấn xoá
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        // Chuẩn bị và thực thi câu truy vấn
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $productId, PDO::PARAM_INT); // Liên kết tham số với giá trị
        
        // Thực thi câu truy vấn
        $stmt->execute();
        
        // Kiểm tra và trả về kết quả
        if ($stmt->rowCount() > 0) {
            return true; // Nếu có sản phẩm bị xoá thành công
        } else {
            return false; // Nếu không có sản phẩm nào được xoá
        }
    }
    
    
    function createProduct($name, $description, $price, $uploadResult,$category_id)
    {
        // uploadResult: đường dẫn của file hình 
        // uploadResult = false: lỗi upload hình ảnh
        // Kiểm tra ràng buộc đầu vào
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }

        if ($uploadResult == false) {
            $errors['image'] = 'Vui lòng chọn hình ảnh hợp lệ!';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        // Truy vấn tạo sản phẩm mới

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, image,category_id) VALUES (:name, :description, :price, :image ,:category_id)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $uploadResult);
        $stmt->bindParam(':category_id', $category_id);
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function getProductById($id){

        $query = "SELECT * FROM " . $this->table_name . " where id = $id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
  
    
    
    
    function updateProduct($id, $name, $description, $price, $uploadResult,$category_id){

        if ($uploadResult) {
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, image=:image,category_id=:category_id WHERE id=:id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price,category_id=:category_id WHERE id=:id";
        }

        $stmt = $this->conn->prepare($query);
        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        if($uploadResult){
            $stmt->bindParam(':image', $uploadResult);
        }
        $stmt->bindParam(':category_id', $category_id);
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}