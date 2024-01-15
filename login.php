<?php
session_start();

$logout = $_GET["logout"] ?? null;

if ($logout) {
    session_destroy();
    header("Location: /login.php");
    exit; // 确保不会执行其他代码
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require __DIR__ . "/config.php";
    require __DIR__ . "/crypt.php";

    $db = getDBConection();
    $username = $db->escape_string($_POST['username']) ?? null;
    $password = $db->escape_string($_POST['password']) ?? null;

    // 使用预处理语句防止SQL注入
    $query = $db->prepare("SELECT * FROM accounts WHERE Username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result()->fetch_assoc();

    if ($result) {
        $success = check_password($password, $result["Password"], $result["Salt"]);

        if ($success) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $result["Id"];
            $_SESSION["name"] = $result["Username"];
            $_SESSION["nickname"] = $result["Nickname"];
            $_SESSION["lastlogin"] = $result["LastLogin"];
            header("Location: /account.php");
            exit; // 确保不会执行其他代码
        } else {
            $error = "密码不正确。";
        }
    } else {
        $error = "用户名不存在。";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-tw">
    <head>
        <meta charset="utf-8"/>
        <title>FURY S4 LEAGUE </title>
        <!-- 主要CSS文件 -->
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <?php if (isset($_SESSION["create"]) && $_SESSION["create"]): ?>
            <input type="hidden" value="success" id="register">
            <?php $_SESSION["create"] = null; ?>
        <?php endif; ?>
        <form id="box" method="post">
            <h1>登陸</h1>
            <input type="text" placeholder="用户名" name="username" minlength="6" autofocus />
            <input type="password" placeholder="密码" name="password" minlength="6" />

            <?php if (isset($error) && !empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="submit" value="login">登陸</button>
        </form>
		    <form action="register.php" method="post"> <!-- 將 method 改為 post -->
        <button type="submit" name="register">註冊</button>
    </form>

        <script src="/assets/js/app.js"></script>
    </body>
</html>
