
<?php

class ReviewModel {
    private $conn;
    private $table_name = "reviews";

    public function __construct($db) {
        $this->conn = $db;
    }

   

    function add($name,$content,$product_id)
    {
        // Kiểm tra ràng buộc đầu vào
        $errors = [];
        if (empty($name)) {
            $errors['name'] = 'Tên không được để trống';
        }
        if (empty($name)) {
            $errors['content'] = 'nội dung không được để trống';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        // Truy vấn tạo danh mục mới

 
        $query = "INSERT INTO " . $this->table_name . " (name,content,product_id) VALUES (:name, :content, :product_id)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':product_id', $product_id);
        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

   
    function getReviewByProduct($idproduct) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = ".$idproduct;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function getallReview() {
        $query = "SELECT r.id,r.name  , r.content,r.time,p.name as namep FROM demo.reviews  r join demo.products p on r.product_id = p.id ; ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function deleteReviewsById($id) {
        // Chuẩn bị câu truy vấn xoá
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        
        // Chuẩn bị và thực thi câu truy vấn
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT); // Liên kết tham số với giá trị
        
        // Thực thi câu truy vấn
        $stmt->execute();
        
        // Kiểm tra và trả về kết quả
        if ($stmt->rowCount() > 0) {
            return true; // Nếu có sản phẩm bị xoá thành công
        } else {
            return false; // Nếu không có sản phẩm nào được xoá
        }
    }

    
    
}