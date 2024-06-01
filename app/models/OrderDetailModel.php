<?php
class OrderDetailModel {
    private $conn;
    private $table_name = "orderdetails";
    private $table_nameP = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function readAll() {
        $query = "SELECT od.orderDetailID, p.name, p.price FROM " . $this->table_name . " od, " . $this->table_nameP . " p WHERE od.productID = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    function createDetailOrder($orderID, $productID, $soLuong, $donGia, $thanhTien)
    {
        $query = "INSERT INTO " . $this->table_name . " (orderID, productID, soLuong, donGia, thanhTien) VALUES (:orderID, :productID, :soLuong, :donGia, :thanhTien)";
        $stmt = $this->conn->prepare($query);

        $orderID = htmlspecialchars(strip_tags($orderID));
        $productID = htmlspecialchars(strip_tags($productID));
        $soLuong = htmlspecialchars(strip_tags($soLuong));
        $donGia = htmlspecialchars(strip_tags($donGia));
        $thanhTien = htmlspecialchars(strip_tags($thanhTien));
        $stmt->bindParam(':orderID', $orderID);
        $stmt->bindParam(':productID', $productID);
        $stmt->bindParam(':soLuong', $soLuong);
        $stmt->bindParam(':donGia', $donGia);
        $stmt->bindParam(':thanhTien', $thanhTien);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
    
        return false;
    }
    
    function getOrderDetailById($id) {
        $query = "SELECT p.name, p.price, od.soluong, od.thanhtien 
                  FROM " . $this->table_name . " od 
                  JOIN " . $this->table_nameP . " p ON od.productID = p.id 
                  WHERE od.orderID = :id"; // Sử dụng tham số định danh :id để tránh các vấn đề bảo mật
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id); // Ràng buộc tham số :id với giá trị thực tế của $id
        $stmt->execute();
        return $stmt;
    }
    function getReport() {
        $query = "SELECT p.name,sum(od.soluong) as soluong 
        FROM demo.orderdetails od join demo.products p on od.productID = p.id
        group by od.productID ;"; 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    

    
}