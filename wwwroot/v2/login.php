<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- 引入 Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- 引入您的自定义样式 -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container mt-5"> <!-- 使用 Bootstrap 的容器和边距类 -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <h2 class="card-header text-center">Login</h2> <!-- 使用 Bootstrap 卡片标题 -->
                <div class="card-body">
<?php
function authenticate($username, $password) {
    $credentials = getenv('CUSTOMCONNSTR_credentials');
    list($valid_username, $valid_password) = explode(';', $credentials);
    
    return $username === $valid_username && $password === $valid_password;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticate($username, $password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
        header("Location: index.php");
        exit;
    } else {
        echo '<div class="alert alert-danger" role="alert">Login failed. Please try again.</div>'; // 使用 Bootstrap 的警告组件
    }
}
?>

    <form method="post" action="login.php">
        <div class="mb-3"> <!-- 使用 Bootstrap 的表单组样式 -->
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="d-grid">
            <input type="submit" class="btn btn-primary" value="Login"> <!-- 使用 Bootstrap 的按钮样式 -->
        </div>
    </form>

                </div>
            </div>
            <div class="text-center mt-3">
                <a href="../index.php" class="link">Main index</a> <!-- 使用 Bootstrap 文本样式 -->
            </div>
            <div class="text-muted text-center mt-2">
                MIT Licence - no commercial interest
            </div>
        </div>
    </div>
</div>
</body>
</html>
