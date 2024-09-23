<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 显示信息并提供指向登录页面的链接
    echo 'Please go back to the main page and <a href="http://gressling.net/v2/login.php">login</a>.';
    exit; // 停止进一步执行页面代码
}
?>
