<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th,
    table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    table th {
        background-color: #f4f4f4;
    }

    .chart-container {
        margin-top: 30px;
        text-align: center;
    }
</style>

<body>
    <canvas id="myChart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: ["2024-11-01", "2024-11-02", "2024-11-03", "2024-11-04", "2024-11-05", "2024-11-06"], // Thay bằng dữ liệu từ PHP
            datasets: [{
                label: 'Doanh thu',
                data: [20000000, 40000000, 50000000, 20000000, 1000000, 900000000], // Thay bằng dữ liệu từ PHP
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };
        const config = {
            type: 'line',
            data: data,
        };
        new Chart(document.getElementById('myChart'), config);
    </script>

</body>

</html>