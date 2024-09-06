@extends('admin.index')
@section('title', 'Home Page')
@section('home')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exportReportModal"><i class="fas fa-download fa-sm text-white-50"></i> In báo cáo</button>
    </div>

    

    <!-- Modal -->
    <div class="modal fade" id="exportReportModal" tabindex="-1" role="dialog" aria-labelledby="exportReportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportReportModalLabel">Xuất Báo Cáo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('export.report') }}" method="GET">
                        @csrf
                        <div class="form-group">
                            <label for="startDate">Ngày Bắt Đầu</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">Ngày Kết Thúc</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Xuất Báo Cáo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Đơn hàng đã hoàn thành</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demdhht}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Đơn hàng đã bị hủy</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demdhhuy}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Đơn hàng khác <a href="/admin/qldonhang">(Chi tiết)</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demdhkhac}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tất cả đơn hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demdh}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng doanh thu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhthu)}} vnđ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doanh thu tháng này</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($doanhthuthangnay)}} vnđ</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Doanh thu
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Người dùng có trong hệ thống</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$demnd}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Đơn hàng đã hoàn thành trong tháng này</h6>
                    <div class="dropdown no-arrow">
                        <select id="donhang-month" class="form-control">
                            <option value="">Chọn tháng</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>Tháng {{ $i }}</option>
                                @endfor
                        </select>
                        <select id="donhang-year" class="form-control">
                            <option value="">Chọn năm</option>
                            @for ($i = 2022; $i <= 2050; $i++) <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>Năm {{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="card-body-donhang">
                    <div id="donhang-list"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sản phẩm được bán trong tháng này -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm được bán trong tháng này</h6>
                    <div class="dropdown no-arrow">
                        <select id="sanphamdaban-month" class="form-control">
                            <option value="">Chọn tháng</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}" {{ $i == now()->month ? 'selected' : '' }}>Tháng {{ $i }}</option>
                                @endfor
                        </select>
                        <select id="sanphamdaban-year" class="form-control">
                            <option value="">Chọn năm</option>
                            @for ($i = 2022; $i <= 2050; $i++) <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>Năm {{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="card-body-spdaban">
                    <div id="sanphamdaban-list">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo năm</h6>
                    <div class="dropdown no-arrow">
                        <select id="year-select" class="form-control">
                            <option value="">Chọn năm</option>
                            @for ($i = 2018; $i <= 2050; $i++) <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>Năm {{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartdoanhthu"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm đã bán</h6>
                    <div class="dropdown no-arrow">
                        <select id="year-sanpham-select" class="form-control">
                            <option value="">Chọn năm</option>
                            @for ($i = 2018; $i <= 2050; $i++) <option value="{{ $i }}" {{ $i == now()->year ? 'selected' : '' }}>Năm {{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="dropdown no-arrow" style="max-width: 500px;">
                        <select id="sanpham-select" class="form-control">
                            <option value="">Chọn sản phẩm</option>
                            @foreach($sp as $i)
                            <option value="{{$i->id}}" {{ $i == $i->first() ? 'selected' : '' }}>ID: {{$i->id}}, {{$i->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartsp"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('js.admin.home')
<script>
    $(document).ready(function() {
        function loadDonHang() {
            var month = $('#donhang-month').val();
            var year = $('#donhang-year').val();
            if (month && year) {
                $.ajax({
                    url: "{{ route('donhangtheothang') }}",
                    method: "GET",
                    data: {
                        month: month,
                        year: year
                    },
                    success: function(response) {
                        var html = '<table class="table table-bordered">';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th>Mã đơn hàng</th>';
                        html += '<th>Ngày hoàn thành</th>';
                        html += '<th>Người dùng</th>';
                        html += '<th>Tổng tiền</th>';
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        response.forEach(function(donhang) {
                            var formattedTotal = Number(donhang.tongtien).toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            var date = new Date(donhang.updated_at);
                            var formattedDate = date.toLocaleDateString('vi-VN', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });
                            html += '<tr>';
                            html += '<td>' + donhang.id + '</td>';
                            html += '<td>' + formattedDate + '</td>';
                            html += '<td>' + donhang.nguoidung.ten + '</td>';
                            html += '<td>' + formattedTotal + '</td>';
                            html += '</tr>';
                        });
                        html += '</tbody>';
                        html += '</table>';
                        $('.card-body-donhang').html(html);
                    }
                });
            }
        }

        $('#donhang-month, #donhang-year').change(function() {
            loadDonHang();
        });
        loadDonHang();
    });
</script>
<script>
    $(document).ready(function() {
        function loadSanPhamDaBan() {
            var month = $('#sanphamdaban-month').val();
            var year = $('#sanphamdaban-year').val();
            if (month && year) {
                $.ajax({
                    url: "{{ route('sanphamdaban') }}",
                    method: "GET",
                    data: {
                        month: month,
                        year: year
                    },

                    success: function(response) {
                        var html = '<table class="table table-bordered">';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th>Tên sản phẩm</th>';
                        html += '<th>Số lượng</th>';
                        html += '<th>Giá</th>';
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        response.forEach(function(sanpham) {
                            var formattedPrice = Number(sanpham.total_price).toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            });
                            html += '<tr>';
                            html += '<td>' + sanpham.sanpham_id +', '+sanpham.ten_sanpham + '</td>';
                            html += '<td>' + sanpham.total_quantity + '</td>';
                            html += '<td>' + formattedPrice + '</td>';
                            html += '</tr>';
                        });
                        html += '</tbody>';
                        html += '</table>';
                        $('.card-body-spdaban').html(html);
                    }
                });
            }
        }

        $('#sanphamdaban-month, #sanphamdaban-year').change(function() {
            loadSanPhamDaBan();
        });
        loadSanPhamDaBan();
    });
</script>
<script>
    $(document).ready(function() {
        function loadSalesData(year) {
            if (year) {
                $.ajax({
                    url: '{{ route("admin.getYearlySales") }}',
                    type: 'GET',
                    data: {
                        year: year
                    },
                    success: function(response) {
                        var labels = Object.keys(response.monthlySales).map(function(key) {
                            return 'Tháng ' + key;
                        });
                        var data = Object.values(response.monthlySales);
                        var trendlineData = Object.values(response.trendlineData);

                        myLineChart.data.labels = labels;
                        myLineChart.data.datasets[0].data = data;
                        myLineChart.data.datasets[1].data = trendlineData;
                        myLineChart.update();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        var currentYear = new Date().getFullYear();
        loadSalesData(currentYear);

        $('#year-select').on('change', function() {
            var year = $(this).val();
            loadSalesData(year);
        });
    });
</script>
<script>
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    var ctx = document.getElementById("chartdoanhthu");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // Sẽ được cập nhật sau từ AJAX
            datasets: [{
                label: "Tổng thu năm hiện tại",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [],
            }, {
                label: "Đường xu hướng từ các năm trước",
                lineTension: 0.3,
                borderColor: "rgba(255, 99, 132, 1)",
                backgroundColor: "transparent",
                pointRadius: 3,
                pointBackgroundColor: "rgba(255, 99, 132, 1)",
                borderWidth: 2,
                data: [],
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + 'đ';
                    }
                }
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        function loadProductSalesData(year, sanphamId) {
            if (year && sanphamId) {
                $.ajax({
                    url: '{{ route("admin.getSanPhamDaBan") }}',
                    type: 'GET',
                    data: {
                        year: year,
                        sanphamId: sanphamId
                    },
                    success: function(response) {
                        var labels = ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"];
                        var data = response.monthlySales;
                        var trendlineData = response.trendlineData;

                        var data = [];
                        var trendlineData = [];

                        for (var i = 1; i <= 12; i++) {
                            data.push(response.monthlySales[i] || 0);
                            trendlineData.push(response.trendlineData[i] || 0);
                        }

                        myLineChartSp.data.labels = labels;
                        myLineChartSp.data.datasets[0].data = data;
                        myLineChartSp.data.datasets[1].data = trendlineData;
                        myLineChartSp.update();
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        var ctx = document.getElementById("chartsp");
        var myLineChartSp = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [], // Sẽ được cập nhật sau từ AJAX
                datasets: [{
                    label: "Tổng thu năm hiện tại",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [],
                }, {
                    label: "Đường xu hướng từ các năm trước",
                    lineTension: 0.3,
                    borderColor: "rgba(255, 99, 132, 1)",
                    backgroundColor: "transparent",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 2,
                    data: [],
                }]
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return number_format(value) + ' cái';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: true
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' cái';
                        }
                    }
                }
            }
        });

        var currentYear = new Date().getFullYear();
        var selectedProduct = $('#sanpham-select').val();

        loadProductSalesData(currentYear, selectedProduct);

        $('#year-sanpham-select, #sanpham-select').on('change', function() {
            var year = $('#year-sanpham-select').val();
            var sanphamId = $('#sanpham-select').val();
            loadProductSalesData(year, sanphamId);
        });
    });
</script>
@endsection
