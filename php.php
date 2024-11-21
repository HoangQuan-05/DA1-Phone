<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Nhắn Tin</title>
    <!-- Link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Màu nền sáng */
        }
        .chat-box {
            height: 500px;
            overflow-y: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            margin-bottom: 10px;
        }
        .message.sent {
            background-color: #007bff;
            color: white;
            margin-left: auto;
            text-align: right;
        }
        .message.received {
            background-color: #e9ecef;
            color: #212529;
        }
        .input-box {
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Khung chat -->
        <div class="chat-box p-3 mb-4">
            <!-- Tin nhắn từ bạn -->
            <div class="message sent">Xin chào! Đây là tin nhắn từ bạn.</div>
            <!-- Tin nhắn nhận được -->
            <div class="message received">Chào bạn! Đây là tin nhắn trả lời.</div>
            <div class="message sent">Cần giúp gì không?</div>
            <div class="message received">Tôi đang tìm hiểu Bootstrap!</div>
        </div>

        <!-- Ô nhập liệu -->
        <div class="input-box bg-white p-3 rounded shadow-sm d-flex">
            <input type="text" class="form-control me-2" placeholder="Nhập tin nhắn..." style="border-radius: 25px;">
            <button type="submit" class="btn btn-primary px-4" style="border-radius: 25px;">Gửi</button>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
