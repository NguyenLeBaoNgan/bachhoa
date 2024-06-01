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
                                       
                                        <th>Tên Khách</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                        <th>Tên Sp</th>
                                        <th>Hành động</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $reviews->fetch(PDO::FETCH_ASSOC)): ?>
                                        <tr>

                                            <td><?= $row['name'] ?></td>
                                            <td><?= $row['content'] ?></td>
                                            <td><?= $row['time'] ?></td>
                                            <td><?= $row['namep'] ?></td>
                                            <td>
                                                <a href="/chieu2/review/delete/<?= $row['id'] ?>"
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
    </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   
    <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
    <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/chieu2/public/admin/js/sidebarmenu.js"></script>
    <script src="/chieu2/public/admin/js/app.min.js"></script>
    <script src="/chieu2/public/admin/libs/simplebar/dist/simplebar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sockjs-client/1.5.2/sockjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
    <script>


