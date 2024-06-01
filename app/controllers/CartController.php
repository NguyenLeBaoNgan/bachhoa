<?php
require('app/models/sendmail.php');
class CartController
{
    private $productModel;
    private $orderModel;
    private $orderDetailModel;
    private $dbp;
    private $dbo;
    private $dbd;
    public function __construct()
    {
        $this->dbp = (new Database())->getConnection();
        $this->dbo = (new Database())->getConnection();
        $this->dbd = (new Database())->getConnection();
        $this-> orderModel = new OrderModel($this->dbo);
        $this-> productModel = new ProductModel($this->dbp);
        $this-> orderDetailModel = new OrderDetailModel($this->dbp);
    }
    public function upQuality($id)
    {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item->id == $id ) {
                $item->quantity ++;
                break;
            }
        }
        header('Location: /chieu2/cart/show');
    }
    public function downQuality($id)
    {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item->id == $id &&  $item->quantity>1) {
                $item->quantity --;
                break;
            }
        }
        header('Location: /chieu2/cart/show');
    }


    public function delete($id)
    {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item->id == $id) {
                unset($_SESSION['cart'][$key]);
                break; 
            }
        }
        header('Location: /chieu2/cart/show');
    }

    public function Add($id)
    {
        // Khởi tạo một phiên cart nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $quantity = $_POST['quantity'] ?? 1 ;
        // Lấy sản phẩm từ ProductModel bằng $id
        $product = $this->productModel->getProductById($id);

        // Nếu sản phẩm tồn tại, thêm vào giỏ hàng
        if ($product) {
            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            $productExist = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item->id == $id) {
                    $item->quantity+=$quantity;
                    $productExist = true;
                    break;
                }
            }

            // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới vào
            if (!$productExist) {
                
                $product->quantity = $quantity;
                $_SESSION['cart'][] = $product;
            }

            header('Location: /chieu2/cart/show');
        } else {
            echo "Không tìm thấy sản phẩm với ID này!";
        }
    }
    

    public function process_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hoTen = $_POST['hoTen'] ?? '';
            $dienThoai = $_POST['dienThoai'] ?? '';
            $email = $_POST['email'] ?? '';
            $diachi = $_POST['diachi'] ?? '';
            $ghichu = $_POST['ghichu'] ?? '';
            $phuongThucThanhToan = $_POST['phuongThucThanhToan'] ?? '';
          
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống!";
            } else {
                $result = $this->orderModel->createOrder($hoTen, $dienThoai, $email, $diachi, $ghichu, $phuongThucThanhToan);
                foreach ($_SESSION['cart'] as $item) {
                    $orderID=$result;
                    $productID = $item->id;
                    $soLuong = $item->quantity;
                    $giaTien = $item->price;
                    $thanhTien = intval($soLuong) * floatval($giaTien);
                    $a = $this->orderDetailModel->createDetailOrder( $orderID,$productID, $soLuong, $giaTien, $thanhTien);   
                }
            }
            if ($result !== false) {
                $_SESSION['gmail']=$email;
                $_SESSION['order_details'] = $this->getOrderDetails($orderID);
                unset($_SESSION['cart']);
                header('Location: /chieu2/cart/confirm');
                exit(); 
            } else {
                $errors = $result;
                include 'app/views/cart/index.php'; 
                exit(); 
            }
        }
    }

    private function getOrderDetails($orderId)
    {
        $sql = "SELECT p.name, od.soLuong, p.price, od.thanhtien
        FROM orderdetails od
        JOIN products p ON od.productID = p.id
        WHERE od.orderID = ?;";
        $stmt = $this->dbp->prepare($sql); 
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    function show()
    {
        include_once 'app/views/user/cart.php';
        
    }
    public function confirm()
    {
        $total_price = 0;
        $tieude = "Bách hóa";
        $noidung = "<p>Cảm ơn quý khách đã đặt hàng.</p>";
        $noidung .= "<h4>Đơn hàng của bạn bao gồm: </h4>";
        foreach ($_SESSION['order_details'] as $item) {
            // Truy cập thuộc tính của đối tượng $item bằng cách sử dụng dấu mũi tên (->)
            $noidung .= "<ul style='border:1px solid pink; margin:10px;'>
                         <li>Tên sản phẩm: " . $item->name . "</li>
                         <li>Giá sản phẩm: " . number_format($item->price, 0, ',', '.') . "</li>
                         <li>Số lượng: " . $item->soLuong . "</li>
                         </ul>";
            $total_price += $item->thanhtien;
        }
        
        // Thêm dòng tổng số tiền vào nội dung email
        $noidung .= "<p><strong>Tổng số tiền: </strong>" . number_format($total_price, 0, ',', '.') . " VNĐ</p>";
        $mail = new Mailer();
        $mail->dathangmail($tieude,$noidung,$_SESSION['gmail']);
        include_once 'app/views/cart/confirm.php';
    }
    
    public function checkout()
    {
        if(!Auth::isLoggedIn()){
            echo "<script>alert('Xin lỗi, bạn chưa đăng nhập');</script>";
            header('Location: /chieu2/account/login');
            exit(); 
        } else {
            include_once 'app/views/user/chekout.php';
            exit(); 
        }
      
    }
    
}
