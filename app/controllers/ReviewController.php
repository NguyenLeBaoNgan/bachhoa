<?php
include_once 'app/models/ReviewModel.php';
class ReviewController
{

    private $reviewModel; // sửa từ $categorytModel thành $categoryModel
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->reviewModel = new ReviewModel($this->db);
    }
    public function add(){
        $name = $_POST['name'] ?? '';
        $content = $_POST['content'] ?? '';
        $product_id = $_POST['product_id'] ?? '';
        $this->reviewModel->add($name, $content, $product_id);
        header('Location: /chieu2/product/detailProduct/' . $product_id); // Sửa lại cú pháp để nối chuỗi
        exit(); // Đảm bảo không có mã HTML hoặc mã PHP nào được thêm vào sau lệnh header
    }
    public function get(){
        $reviews = $this->reviewModel->getReviewByProduct(2);
        $reviewsArray = $reviews->fetchAll(PDO::FETCH_ASSOC);
        $jsonData = json_encode($reviewsArray);
        header('Content-Type: application/json');
        echo $jsonData;
    }
    public function listReviews()
    {
        $reviews = $this->reviewModel->getallReview();
        include_once 'app/views/admin/reviews.php';
    }
    public function delete($id){
        $reviews=$this->reviewModel->deleteReviewsById($id);
        header('Location: /chieu2/review/listReviews');

    }
   
}
