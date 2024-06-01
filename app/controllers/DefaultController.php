<?php
class DefaultController{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }
    public function Index() {
        
            //header('Location: /chieu2/account/login');
            //$products = $this->productModel->readAll();
            header('Location: /chieu2/product/listProducts');
      
           // header('Location: /chieu2/product/listProducts');

        
        
    }
  
}