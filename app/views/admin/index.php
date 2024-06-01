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
                                        <th>Mô Tả</th>
                                        <th>Hình Ảnh</th>
                                        <th>Giá</th>
                                        <th>Hành Động (Sửa/Xóa)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                        <tr>

                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td>
                                                <?php if (empty($row['image']) || !file_exists($row['image'])): ?>
                                                    No Image!
                                                <?php else: ?>
                                                    <img src="/chieu2/<?= $row['image'] ?>" alt="Hình ảnh" class="img-fluid" width="150px" height="150px" />
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $row['price'] ?></td>
                                            <td>
                                                <a href="/chieu2/product/edit/<?= $row['id'] ?>"
                                                    class="btn btn-sm btn-primary">Sửa</a>
                                                <a href="/chieu2/product/delete/<?= $row['id'] ?>"
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
        </div>
        </body>
        <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
        <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script src="/chieu2/public/admin/js/sidebarmenu.js"></script>
        <script src="/chieu2/public/admin/js/app.min.js"></script>
        <script src="/chieu2/public/admin/libs/simplebar/dist/simplebar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.2/sockjs.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
        <script>
