<?php include_once 'app/views/admin/header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                                        <th>id</th>
                                        <th>Tên</th>
                                        <th>SDT</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Ghi chú</th>
                                        <th>PT thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $order->fetch(PDO::FETCH_ASSOC)): ?>

                                        <tr class="orderrow">

                                            <td><?= $row['id'] ?></td>
                                            <td><?= $row['hoTen'] ?></td>
                                            <td><?= $row['dienThoai'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['diachi'] ?></td>
                                            <td><?= $row['ghiChu'] ?></td>
                                            <td><?= $row['phuongThucThanhToan'] ?></td>

                                        </tr>


                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="orderdetaildialog" tabindex="-1" role="dialog"
                aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel">Chi tiết order</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody id="tborderdetail">
                                    <!-- Các dòng dữ liệu sẽ được thêm vào đây bằng JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('.orderrow').click(function () {
                var orderId = $(this).find('td:first').text(); // Lấy giá trị của cột id
                $.ajax({
                    url: '/chieu2/order/getOrderDetailById/' + orderId,
                    type: 'GET',
                    success: function (response) {
                        console.log(response);
                        $('#orderdetaildialog').modal('show');
                        $('#tborderdetail').empty();
                        var tableHtml = '';
                        response.forEach(function (orderDetail) {
                            tableHtml += '<tr>'; // Bắt đầu một dòng mới
                            tableHtml += '<td>' + orderDetail.name + '</td>';
                            tableHtml += '<td>' + orderDetail.price + '</td>';
                            tableHtml += '<td>' + orderDetail.soluong + '</td>';
                            tableHtml += '<td>' + orderDetail.thanhtien + '</td>';
                            tableHtml += '</tr>'; // Kết thúc dòng
                        });
                        $('#tborderdetail').append(tableHtml);
                    },



                    error: function () {
                        alert('Đã có lỗi xảy ra trong quá trình xử lý yêu cầu.');
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

