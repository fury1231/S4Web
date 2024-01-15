<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8"/>
    <title>FURY S4 LEAGUE</title>
    <link rel="icon" href="assets/img/favicon.png" type="image/png" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-pingfang">

    <style>
        /* Your custom styles here */
        body {
            background-color: #f8f9fa;
            font-family: 'PingFang TC', sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .text-center a {
            color: #007bff;
        }

        .text-center a:hover {
            text-decoration: none;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>登入</h3>
            </div>
            <div class="card-body">
                <form id="box" method="post" action="login.php">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="使用者名稱" name="username" minlength="6" autofocus />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="密碼" name="password" minlength="6" />
                    </div>
                    <?php if (isset($error) && !empty($error)): ?>
                        <p class="error"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary" name="submit" value="login">登入</button>
                </form>
                <p class="text-center">還沒有帳戶？ <a href="register.php" class="text-primary">註冊</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-IMFW8piIryI6Kd1pzVe3tCm8V1oII1W8lPHOoXlHmE2gFCXTonv4MOh1wkLxoyeC" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy9eGoKEC/AgtZM2fd6N2ca1HL8Ht2tSZ4" crossorigin="anonymous"></script>
</body>
</html>