<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ trợ khách hàng</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    /* Reset cơ bản */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Roboto', sans-serif;
    }

    /* Giao diện container */
    .chat-container {
        display: flex;
        flex-direction: column;
        max-width: 600px;
        height: 90vh;
        margin: 20px auto;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    /* Header */
    .chat-header {
        background-color: #007BFF;
        color: #fff;
        text-align: center;
        padding: 15px;
        font-size: 1.2rem;
        font-weight: bold;
    }

    /* Body (vùng chat) */
    .chat-body {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
    }

    .message {
        display: flex;
        align-items: flex-end;
        margin-bottom: 15px;
    }

    .message.customer .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .message.admin .text {
        margin-left: auto;
        background-color: #007BFF;
        color: white;
    }

    .message.customer .text {
        background-color: #e0e0e0;
        color: black;
    }

    .text {
        max-width: 60%;
        padding: 10px 15px;
        border-radius: 10px;
        position: relative;
    }

    .text .timestamp {
        font-size: 0.75rem;
        color: #999;
        text-align: right;
        margin-top: 5px;
    }

    /* Footer */
    .chat-footer {
        display: flex;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #e0e0e0;
        background-color: #fff;
    }

    .chat-input {
        flex: 1;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-right: 10px;
    }

    .send-button,
    .end-button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
    }

    .send-button {
        background-color: #007BFF;
        color: #fff;
        margin-right: 10px;
    }

    .end-button {
        background-color: #ff4d4d;
        color: #fff;
    }
</style>

<body>
    <div class="chat-container">
        <header class="chat-header">
            <h1>Hỗ trợ khách hàng</h1>
        </header>
        <div class="chat-body">
            <!-- Tin nhắn khách hàng -->
            <div class="message customer">
                <img src="user-avatar.png" alt="Customer Avatar" class="avatar">
                <div class="text">
                    <p>Hello</p>
                    <span class="timestamp">19:40:26</span>
                </div>
            </div>
            <!-- Tin nhắn admin -->
            <div class="message admin">
                <div class="text">
                    <p>Xin chào, tôi có thể giúp gì cho bạn?</p>
                    <span class="timestamp">19:41:10</span>
                </div>
            </div>
        </div>
        <footer class="chat-footer">
            <input type="text" placeholder="Nhập tin nhắn của bạn..." class="chat-input">
            <button class="send-button">Gửi</button>
            <button class="end-button">Kết thúc</button>
        </footer>
    </div>
</body>

</html>





<div class="list">



<!-- khach hang hoi -->
<?php foreach ($du_lieu as $value) : ?>
    <?php //id sau nay lay bang SESSION
    if ($value['id_nguoi_gui'] == $id) : ?>
        <div class="khach_hang">
            <img src="../admin/assets/images/about.jpg" alt="">
            <div class="noi_dung">
                <div style=" width: 735px;">
                    <h5><?= $value['tens'] ?></h5>
                    <p><?= $value['noi_dung'] ?></p>
                </div>
                <span><?= $value['thoi_gian'] ?></span>
            </div>
        </div>
    <?php endif ?>
    <!-- admin tra loi -->

    <?php if ($value['id_nguoi_gui'] == 4) : ?>
        <div class="khach_hang item_admin">

            <div class="admin">
                <div>
                    <h5><?= $value['tens'] ?></h5>
                    <p style="margin-right: 30px;"><?= $value['noi_dung'] ?>
                    </p>
                </div>

            </div>
            <img src="../admin/assets/images/about.jpg" alt="">
        </div>
    <?php endif ?>
<?php endforeach ?>
</div>
<div class="form">
<form action="" method="POST">
    <textarea name="noi_dung" id="tin_nhan" rows="2" placeholder="Nhập tin nhắn"></textarea>

    <!-- <button type="submit"><i class="fa-regular fa-paper-plane"></i></button> -->
    <button type="submit" class="btn btn-success"><i class="fa-regular fa-paper-plane"></i></button>
</form>

<form action="" method="POST">
    <input type="text" name="trang_thai" value="Đã hỗ trợ" style="display:none">
    <button type="submit" class="btn btn-warning">Kết thúc</button>
</form>

</div>
