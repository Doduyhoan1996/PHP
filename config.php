<?php
/**
 * Khai báo hằng số dùng để kết nối đến CSDL
 */
define("DB_SERVER", "localhost");
define("DB_SERVER_USERNAME", "root");
define("DB_SERVER_PASSWORD", "");
define("DB_SERVER_NAME", "shopping");
/**
 * mysqli_connect() kết nối đến CSDL
 */
$connection = mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_SERVER_NAME);
/**
 * Kiểm tra xem kết nối đến CSDL có thành công không
 * nếu không thành công thì ngắt chương trình bằng câu lệnh die()
 */
if ($connection == false) {
    die("ERROR Không thể kết nối đến CSDL " . mysqli_connect_error());
}