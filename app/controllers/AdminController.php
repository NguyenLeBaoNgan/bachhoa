<?php include_once 'app/models/CategoryModel.php'; ?>
<?php include_once 'app/models/ReviewModel.php'; ?>
<?php
class AdminController
{

    private $productModel;
    private $categoryModel;
    private $reviewModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
        $this->reviewModel = new ReviewModel($this->db);
    }

    public function listProducts()
    {
        $products = $this->productModel->readAll();
        include_once 'app/views/admin/index.php';
    }
   

}
