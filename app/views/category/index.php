<?php include_once 'app/views/admin/header.php'; ?>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include_once 'app/views/admin/sidebar.php'; ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->


            <!--  Header End -->
            <div class="container-fluid">

                <button id="btnthem" class="btn btn-sm btn-danger">thêm</button>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>

                                        <th>Hành Động (Sửa/Xóa)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $categorys->fetch(PDO::FETCH_ASSOC)): ?>
                                        <tr>

                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['name'] ?></td>

                                            <td>
                                                <a href="#" class="btn btn-sm btn-primary editCategory"
                                                    data-id="<?= $row['id'] ?>" data-name="<?= $row['name'] ?>">Sửa</a>
                                                <a href="/chieu2/category/delete/<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-danger">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Sửa Tên Danh Mục</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form để chỉnh sửa tên danh mục -->
                            <form id="editCategoryForm">
                                <div class="form-group">
                                    <label for="editCategoryName">Tên Danh Mục:</label>
                                    <input type="text" class="form-control" id="editCategoryName" name="name">
                                </div>
                                <input type="hidden" id="editCategoryId" name="id">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="saveEditCategory">Lưu Thay Đổi</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Sửa Tên Danh Mục</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form để chỉnh sửa tên danh mục -->
                            <form id="editCategoryForm">
                                <div class="form-group">
                                    <label for="editCategoryName">Tên Danh Mục:</label>
                                    <input type="text" class="form-control" id="addCategoryName" name="name">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="saveAddCategory">Lưu Thay Đổi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.editCategory').click(function () {
                var categoryId = $(this).data('id');
                var categoryName = $(this).data('name');
                $('#editCategoryId').val(categoryId);
                $('#editCategoryName').val(categoryName);
                $('#editCategoryModal').modal('show');
            });
            $('#saveEditCategory').click(function (e) {
                var categoryId = $('#editCategoryId').val();
                var categoryName = $('#editCategoryName').val();
                $.ajax({
                    type: "post",
                    url: "/chieu2/category/save",
                    data: {
                        id: categoryId,
                        name: categoryName
                    },
                    success: function (response) {
                        window.location.href = '/chieu2/category/listCategorys';
                    }
                });

            });
            $('#btnthem').click(function () {
                $('#addCategoryModal').modal('show');
            });
             $('#saveAddCategory').click(function (e) {
                var categoryName = $('#addCategoryName').val();
                $.ajax({
                    type: "post",
                    url: "/chieu2/category/save",
                    data: {
                        name: categoryName
                    },
                    success: function (response) {
                        window.location.href = '/chieu2/category/listCategorys';
                    }
                });

            });
           
        });
    </script>
</body >
    <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
    <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/chieu2/public/admin/js/sidebarmenu.js"></script>
    <script src="/chieu2/public/admin/js/app.min.js"></script>
    <script src="/chieu2/public/admin/libs/simplebar/dist/simplebar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.2/sockjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
    <script>


