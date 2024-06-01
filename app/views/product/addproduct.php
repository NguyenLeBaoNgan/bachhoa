<?php include_once 'app/views/admin/header.php'; ?>
<script>
    function previewFile() {
        var preview = document.getElementById('previewImage');
        var fileInput = document.querySelector('input[type=file]');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = ""; // Xóa hình ảnh nếu người dùng chọn không có tệp
        }
    }
</script>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include_once 'app/views/admin/sidebar.php'; ?>
        <div class="body-wrapper">
            <?php if (isset($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?= $err ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="/chieu2/product/save" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <img src="" alt="Product Image">
                                    <img id="previewImage" alt="" height="340px" width="340px">

                                    <input type="file" class="form-control" id="image" name="image" accept="image/*"
                                        onchange="previewFile()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="price">Giá</label>
                                    <input type="text" class="form-control" id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="price">Danh mục</label>
                                <select class="form-control" id="categoryid" name="categoryid">
                                <?php while ($row = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option  value="<?= $row['id'] ?>"  ?><?= $row['name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm </button>
                    </div>
                </div>
            </form>
        </div>
        </body >
        <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
        <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="/chieu2/public/admin/js/sidebarmenu.js"></script>
        <script src="/chieu2/public/admin/js/app.min.js"></script>
        <script src="/chieu2/public/admin/libs/simplebar/dist/simplebar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.2/sockjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
        <script>

