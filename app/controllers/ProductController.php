<?php include_once 'app/models/CategoryModel.php'; ?>
<?php include_once 'app/models/ReviewModel.php'; ?>
<?php
class ProductController
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
        $categorys = $this->categoryModel->readAll();
        $bestseller = $this->productModel->getProducBestseller();
        include_once 'app/views/user/index.php';
    }
    public function searchProduct($name)
    {
        $products = $this->productModel->getProductsByName($name);
        $categorys = $this->categoryModel->readAll();
        $bestseller = $this->productModel->getProducBestseller();
        include_once 'app/views/user/index.php';
    }
    public function listProductsByCategory($id){
        $products = $this->productModel->getProductByCategory($id);
        $bestseller = $this->productModel->getProducBestseller();
        $categorys = $this->categoryModel->readAll();
        include_once 'app/views/user/index.php';
    }
    public function detailProduct($id){
        $bestseller1 = $this->productModel->getProducBestseller();
        $categories = $this->categoryModel->countCategory();
        $product = $this->productModel->getProductById($id);
        $review = $this->reviewModel->getReviewByProduct($id);
    // Nếu sản phẩm được tìm thấy
    if($product) {
        $bestseller = $this->productModel->getProductByCategory($product->category_id);

        include_once 'app/views/user/product-detail.php';
    }
    }
    public function add()
    {
        $categories = $this->categoryModel->readAll();
        include_once 'app/views/product/addproduct.php';
    }

    public function save()
    {
        //lưu sản phẩm vào CSDL, kèm upload hình ảnh lên thư mục uploads/ của server
        //cập nhật tên đường dẫn hình ảnh vào cột image của bảng Product
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['categoryid'] ?? 1;
            if (isset($_POST['id'])) {
                //update
                $id = $_POST['id'];
            }

            $uploadResult = false;
            //kiểm tra để lưu hình ảnh
            if (!empty($_FILES["image"]['size'])) {
                //luu hinh
                $uploadResult = $this->uploadImage($_FILES["image"]);
            }

            //lưu sản phẩm
            if (!isset($id))
            // thêm sản phẩm 
                $result = $this->productModel->createProduct($name, $description, $price, $uploadResult,$category_id);
            else
            // update sản phẩm 
                $result = $this->productModel->updateProduct($id, $name, $description, $price, $uploadResult,$category_id);

            if (is_array($result)) {
                // Có lỗi, hiển thị lại form với thông báo lỗi
                $errors = $result;
                include 'app/views/product/add.php';
            } else {
                // Không có lỗi, chuyển hướng ve trang chu hoac trang danh sach
                header('Location: /chieu2/admin/listProducts');
            }
        }
    }

    //hàm upload hình ảnh lên thư mục uploads của server
    public function uploadImage($file)
    {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra xem file có phải là hình ảnh thực sự hay không
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Kiểm tra kích thước file
        if ($file["size"] > 500000) { // Ví dụ: giới hạn 500KB
            $uploadOk = 0;
        }

        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        // Kiểm tra nếu $uploadOk bằng 0
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                //đường dẫn của file hình
                return $targetFile;
            } else {
                //không upload được hình
                return false;
            }
        }
    }
    public function delete($id){
        $product = $this->productModel->deleteProductById($id);
        header('Location: /chieu2/admin/listProducts');

    }

    public function edit($id)
    {
        $categories = $this->categoryModel->readAll();
        $product = $this->productModel->getProductById($id);

        if (empty($product)) {
            include_once 'app/views/share/not-found.php';
        } else {
            include_once 'app/views/product/editproduct.php';
        }
    }
}
