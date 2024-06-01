<!DOCTYPE html>
<html>

<head>
    <title>Monthly Totals Chart</title>
    <!-- Thêm thư viện Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/chieu2/public/admin/css/styles.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</head>

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

                <div class="d-flex flex-wrap">
                    <div class="card m-2 p-2">
                        <div class="card-body">
                            Tổng doanh thu
                            <h3><?php echo $totalPriceOrder->fetchColumn() ?></h3>
                        </div>
                    </div>
                    <div class="card m-2 p-2">
                        <div class="card-body">
                            Tổng Số đơn hàng
                            <h3><?php echo $quantitiOrder->fetchColumn() ?></h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-8 d-flex align-items-strech">
                    <div class="card w-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Thống kê sản phẩm đã bán</h5>
                                </div>
                                <div>
                                    <select class="form-select" id="chartType">
                                        <option value="bar">Biểu đồ cột</option>
                                        <option value="line">Biểu đồ đường</option>
                                        <option value="pie">Biểu đồ Tròn</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="monthlyTotalsChart" style="min-height: 360px;"></canvas>
                        </div>

                    </div>
                </div>
                <div class="col-4 text-center">
                    <ul class="list-group" id="monthlyTotals">

                    </ul>
                </div>

            </div>

        </div>
    </div>
    <script src="/chieu2/public/admin/libs/jquery/dist/jquery.min.js"></script>
    <script src="/chieu2/public/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var myChart; // Đặt biến myChart ở đây

        // Function để vẽ biểu đồ
        function drawChart(data, chartType) {
            var ctx = document.getElementById('monthlyTotalsChart').getContext('2d');
            if (myChart) {
                myChart.destroy(); // Hủy biểu đồ hiện tại nếu tồn tại
            }
            myChart = new Chart(ctx, {
                type: chartType,
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Tổng'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tên'
                            }
                        }
                    },
                    responsive: true
                }
            });
        }
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();

        // Cập nhật trường 'year' trong dữ liệu
        var data = {
            year: currentYear
        };

        // Sử dụng Ajax để lấy dữ liệu từ controller
        $.ajax({
            url: '/chieu2//order/getReport', // Điều này phải trùng với URL đã định nghĩa trong controller
            type: 'GET',
            data: data,
            success: function (dataChart) {
                var chartType = 'bar';

                $('#chartType').on('change', function () {
                    chartType = $(this).val();
                    // Xóa biểu đồ cũ và vẽ lại biểu đồ với loại mới
                    drawChart(data, chartType);
                });
                var data = {
                    labels: [], // Danh sách các tháng
                    datasets: [{
                        label: 'Báo Cáo ',
                        data: [], // Tổng tiền cho từng tháng
                        backgroundColor: [],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                };

                // Đổ dữ liệu từ server vào biểu đồ
                dataChart.forEach(function (item) {
                    data.labels.push(item.name); // Thêm tên sản phẩm vào labels
                    data.datasets[0].data.push(item.soluong);
                    data.datasets[0].backgroundColor.push(getRandomColor());

                    var p = document.createElement("p");

                    //tạo phần tử text
                    var node = document.createTextNode(item.name + " " + '  Đã bán: ' + item.soluong);
                    p.appendChild(node);
                    p.classList.add('list-group-item');

                    var ul = document.getElementById("monthlyTotals");
                    //gắn p vào div
                    ul.appendChild(p);
                });

                // Gọi hàm vẽ biểu đồ
                drawChart(data, chartType);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

</body>

</html>