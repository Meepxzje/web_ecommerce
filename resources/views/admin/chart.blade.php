<!DOCTYPE html>
<html>

<head>
    <title>Biểu đồ Doanh thu</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
</head>

<body>
    <canvas id="chartdoanhthu"></canvas>
    <script>
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;

        var ctx = document.getElementById('chartdoanhthu').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Tổng thu",
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
                    data: data,
                }],
            }
        });

        // Lưu biểu đồ thành hình ảnh
        var chartImage = myLineChart.toBase64Image();
        document.getElementById('chartImage').src = chartImage; // Đặt hình ảnh vào một thẻ img
    </script>
    <img id="chartImage" src="" alt="Biểu đồ Doanh thu" />
</body>

</html>
