<?php
require_once 'app/models/CategoryModel.php';
class CategoryController
{

    private $categoryModel; // sửa từ $categorytModel thành $categoryModel
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }


    public function listCategorys()
    {
        $categorys = $this->categoryModel->readAll();
        include_once 'app/views/category/index.php';
    }
   
    public function delete($id){
        $product = $this->categoryModel->deleteCategoryById($id);
        header('Location: /chieu2/category/listCategorys');

    }
    public function add($name){
        $this->categoryModel->createCategory($name);

    }
    public function save()
    {
        //lưu sản phẩm vào CSDL, kèm upload hình ảnh lên thư mục uploads/ của server
        //cập nhật tên đường dẫn hình ảnh vào cột image của bảng Product
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';

            if (isset($_POST['id'])) {
                //update
                $id = $_POST['id'];
            }


            //lưu sản phẩm
            if (!isset($id))
                // thêm sản phẩm 
                $result = $this->categoryModel->createCategory($name);
            else
                // update sản phẩm 
                $result = $this->categoryModel->updateCategory($id, $name);

            if (is_array($result)) {
                // Có lỗi, hiển thị lại form với thông báo lỗi
                $errors = $result;
                include 'app/views/product/add.php';
            } else {
                // Không có lỗi, chuyển hướng ve trang chu hoac trang danh sach
                header('Location: /chieu2/category/listCategorys');
            }
        }
    }

    //hàm upload hình ảnh lên thư mục uploads của server

    public function edit($id)
    {

        $product = $this->categoryModel->getCategoryById($id);

        if (empty($product)) {
            include_once 'app/views/share/not-found.php';
        } else {
            include_once 'app/views/category/edit.php';
        }
    }
}
