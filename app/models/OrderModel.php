<?php
class OrderModel {
    private $conn;
    private $table_name = "orders";

    public function __construct($db) {
        $this->conn = $db;
    }
    function readAll() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    function createOrder($hoTen, $dienThoai, $email, $diachi, $ghichu, $phuongThucThanhToan)
    {
   
        $errors = [];
        if (empty($hoTen)) {
            $errors['hoTen'] = 'Tên không được để trống';
        }
        if (empty($dienThoai)) {
            $errors['dienThoai'] = 'Dien thoai khong dc de trong';
        }
        if (empty($email)) {
            $errors['email'] = 'Email khọng duoc de trong';
        }

        $query = "INSERT INTO " . $this->table_name . " (hoTen, dienThoai, email, diachi, ghiChu, phuongThucThanhToan) VALUES (:hoTen, :dienThoai, :email, :diachi, :ghichu, :phuongThucThanhToan)";
        $stmt = $this->conn->prepare($query);
        $hoTen = htmlspecialchars(strip_tags($hoTen));
        $dienThoai = htmlspecialchars(strip_tags($dienThoai));
        $email = htmlspecialchars(strip_tags($email));
        $diachi = htmlspecialchars(strip_tags($diachi));
        $ghichu = htmlspecialchars(strip_tags($ghichu));
        $phuongThucThanhToan = htmlspecialchars(strip_tags($phuongThucThanhToan));
        $stmt->bindParam(':hoTen', $hoTen);
        $stmt->bindParam(':dienThoai', $dienThoai);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':diachi', $diachi);
        $stmt->bindParam(':ghichu', $ghichu);
        $stmt->bindParam(':phuongThucThanhToan', $phuongThucThanhToan);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    function countOrder() {
        $query = "SELECT count(id) as soluong FROM demo.orders;"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function totalPriceOrder() {
        $query = "SELECT sum(thanhtien) as tongtien from demo.orderdetails"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    
}