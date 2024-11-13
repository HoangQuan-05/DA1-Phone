<html>

<head>
    <title>
        Chi tiết đơn hàng
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .header .time {
            font-size: 16px;
        }

        .header .icons {
            display: flex;
            align-items: center;
        }

        .header .icons i {
            font-size: 20px;
            margin-left: 15px;
        }

        .store-info {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .store-info img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .product {
            display: flex;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .product img {
            width: 80px;
            height: 80px;
            margin-right: 10px;
        }

        .product-details {
            flex-grow: 1;
        }

        .product-details .price {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        .product-details .quantity {
            text-align: right;
        }

        .product-details .cancel {
            text-align: right;
            margin-top: 10px;
        }

        .order-summary {
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .order-summary .total {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }

        .order-summary .payment-method {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="product">
            <img alt="Product image of a rice cooker and a knife" height="80" src="https://storage.googleapis.com/a1aa/image/r9qhhiTlwNpBC98Q6N0BrgiBqJ8De7jdY9eBcGAeus5wX6gnA.jpg" width="80" />
            <div class="product-details">
                <p>
                    Sam sung
                </p>
                <div class="price mt-2">
                    Ram: <span>16/128</span> -
                    Màu sắc: <span>Đỏ</span>
                </div>
                <div class="price mt-2">
                    1.099.000 ₫
                </div>
                <div class="quantity">
                    Số lượng: 1
                </div>

            </div>
        </div>

        <div class="order-summary">
            <h4>
                Thông tin tài khoản đặt hàng
            </h4>
            <div class="d-flex justify-content-between">
                <span>
                    ID khách hàng
                </span>
                <span class="text-danger">
                    132
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span>
                    Tên khách hàng
                </span>
                <span >
                    Quân
                </span>
            </div>

        </div>
        <div class="order-summary">
            <h4>
                Thông tin người nhận
            </h4>
            <div class="d-flex justify-content-between">
                <span>
                    Tên người nhận
                </span>
                <span>
                   Quân
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span>
                    Số điện thoại
                </span>
                <span class="text-danger">
                    0395648137
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span>
                    Địa chỉ nhận hàng
                </span>
                <span class="text-danger">
                    Hà Nội
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span>
                    Ghi chú
                </span>
                <span >
                    Nhanh
                </span>
            </div>


        </div>


        <div class="order-summary">
            <h4>
                Thông tin Đơn hàng
            </h4>
            <div class="d-flex justify-content-between">
                <span>
                    Thành tiền
                </span>
                <span>
                    Số lượng * Đơn giá
                </span>
            </div>

            <div class="d-flex justify-content-between">
                <span>
                    Voucher
                </span>
                <span class="text-danger">
                    -186.830 ₫
                </span>
            </div>

            <div class="d-flex justify-content-between total mt-2">
                <span>
                    Tổng cộng
                </span>
                <span>
                    725.340 ₫
                </span>
            </div>

        </div>
    </div>
</body>

</html>