<?php include_once 'app/models/CategoryModel.php'; ?>
<?php

class UserController
{
    private $productModel;
    private $categoryModel;
    private $orderModel;
    private $orderDetailModel;
    private $dbp;
    private $dbc;
    private $dbo;
    private $dbd;
    public function __construct()
    {
        $this->dbp = (new Database())->getConnection();
        $this->dbc = (new Database())->getConnection();
        $this->dbo = (new Database())->getConnection();
        $this->dbd = (new Database())->getConnection();
        $this->orderModel = new OrderModel($this->dbo);
        $this->productModel = new ProductModel($this->dbp);
        $this->categoryModel = new CategoryModel($this->dbc);
        $this->orderDetailModel = new OrderDetailModel($this->dbp);
    }
    public function showShop(){
        $bestseller1 = $this->productModel->getProducBestseller();
        $categories = $this->categoryModel->countCategory();
        $products = $this->productModel->readAll();
        include_once 'app/views/user/shop.php';
    }
    public function SearchProductShop($name){
        $bestseller1 = $this->productModel->getProducBestseller();
        $categories = $this->categoryModel->countCategory();
        $products = $this->productModel->getProductsByName($name);
        include_once 'app/views/user/shop.php';
    }

}
