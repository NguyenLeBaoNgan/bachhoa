

<?php
// require 'app/models/OrderModel.php';
// require 'app/models/OrderDetailModel.php';

class OrderController
{

    private $orderModel;
    private $orderDetailModel;

    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->db);
        $this->orderDetailModel = new OrderDetailModel($this->db);
    }

    public function list()
    {
        $order = $this->orderModel->readAll();
        include_once 'app/views/order/index.php';
    }
    public function getOrderDetailById($id)
    {
      // Lấy dữ liệu đơn hàng chi tiết từ model
    $orderDetails = $this->orderDetailModel->getOrderDetailById($id);

    // Lấy tất cả các dòng kết quả từ câu truy vấn và chuyển đổi chúng thành một mảng kết hợp
    $orderDetailsArray = $orderDetails->fetchAll(PDO::FETCH_ASSOC);

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($orderDetailsArray);
    exit(); // Đảm bảo không có dữ liệu nào được xuất ra sau đó
    }
    public function getReport()
    {
      // Lấy dữ liệu đơn hàng chi tiết từ model
    $report = $this->orderDetailModel->getReport();

    // Lấy tất cả các dòng kết quả từ câu truy vấn và chuyển đổi chúng thành một mảng kết hợp
    $orderDetailsArray = $report->fetchAll(PDO::FETCH_ASSOC);

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($orderDetailsArray);
    exit(); 
    }
    public function showReport()
    {
       $quantitiOrder = $this->orderModel->countOrder();
       $totalPriceOrder = $this->orderModel->totalPriceOrder();
        include_once 'app/views/admin/report.php';
    }
   
}
