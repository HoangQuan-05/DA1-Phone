<?php
    require_once "env.php";
// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
        
        
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
        
    }
}


function view ($view,$data=[],$id=null){
    extract($data);
    require_once "views/$view.php";
}

function views($view, $data = [], $subfolder = 'admin/views') {
    extract($data);
    include_once PATH_ROOT . "{$subfolder}/$view.php";
}