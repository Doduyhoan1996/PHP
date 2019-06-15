<?php
session_start();
if (isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] == true) ) {
    header("Location: index.php");
    exit;
}
/*
 * Nạp file kết nối CSDL
 */
include_once "config.php";
// Biến lưu trữ lỗi trong quá trình đăng nhập
$errors = array();
/**
 * Xử lý đăng nhập
 */
if (isset($_POST) && !empty($_POST)) {
    if (!isset($_POST["username"]) || empty($_POST["username"])) {
        $errors[] = "Chưa nhập username";
    }
    if (!isset($_POST["password"]) || empty($_POST["password"])) {
        $errors[] = "Chưa nhập password";
    }
    /**
     * Nếu mảng $errors bị rỗng tức là không có lỗi đăng nhập
     */
    if (is_array($errors) && empty($errors)) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $sqlLogin = "SELECT * FROM users WHERE username = ? AND password = ?";
        // Chuẩn bị cho phần SQL
        $stmt = $connection->prepare($sqlLogin);
        // Bind 2 biến vào trong câu SQL
        $stmt->bind_param("ss", $username, $password);
        // thực thi câu lệnh sql
        $stmt->execute();
        // lấy ra bản ghi
        $res = $stmt->get_result();
        $row = $res->fetch_array(MYSQLI_ASSOC);
        if (isset($row['id']) && ($row['id'] > 0)) {
            /**
             * Nếu tồn tại bản ghi
             * thì sẽ tạo ra session đăng nhập
             */
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $row['username'];
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "Dữ liệu đăng nhập không đúng";
        }
    }
}
if (is_array($errors) && !empty($errors)) {
    $errors_string = implode("<br>", $errors);
    echo "<div class='alert alert-danger'>";
    echo $errors_string;
    echo "</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 100px ">
    <form name="login" action="" method="post">
        <h1>Đăng Nhập</h1>
        <div class="form-group">
            <label>Email address</label>
            <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group form-check">
            <p><a href="register.php">Đăng ký</a></p>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
    </form>
</div>


</body>
</html>