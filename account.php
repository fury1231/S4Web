<?php
    require __DIR__ . "/config.php";
    require __DIR__ . "/crypt.php";
    validarSesion();

    $change = $_SESSION["change"] ?? null;  
    $id = $_SESSION["id"];
    
    $db = getDBConection();
    $query = "SELECT * FROM players WHERE id = $id";
    $result = $db -> query($query) -> fetch_assoc();
    $query2 = "SELECT * FROM club_players WHERE PlayerId = $id";
    $clubId = $db -> query($query2) -> fetch_assoc();
    $clubId = $clubId["ClubId"] ?? null;
    if($clubId) {
        $query3 = "SELECT * FROM clubs WHERE Id = $clubId";
        $club = $db -> query($query3) -> fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="es">
<link rel="icon" href="assets/img/favicon.png" type="image/png" />
    <head>
        <meta charset="utf-8"/>
		<title>FURY S4 LEAGUE</title>
        <script src="https://kit.fontawesome.com/4a44549445.js" crossorigin="anonymous"></script>
		<!-- The main CSS file -->
		<link href="assets/css/style.css" rel="stylesheet" />
	</head>
	<body>
        <?php if($change): ?>
            <input type="hidden" name="change" value="true" id="change">
            <?php $_SESSION["change"] = null; ?>
        <?php endif;?>
        <div class="registrar-usuario" id="box" method="post" action="register.php">
            <h1>帳號管理中心 - <?php echo $_SESSION["name"]; ?></h1>
            <?php if($result): ?>
                <div class="items-container">
                    <div class="image">
                        <img src="/assets/img/levels/<?php echo $result["Level"]; ?>.png" alt="玩家等級圖像">
                    </div>
                    <div class="item">
                        <p><em class="fas fa-user"></em><span>遊戲名稱: </span><?php echo $_SESSION["nickname"] ? $_SESSION["nickname"] : "您還沒有註冊您的暱稱"; ?></p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-stopwatch"></em><span>遊玩時間: </span><?php echo substr($result["PlayTime"],0,8); ?> 小時</p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-skiing-nordic"></em><span>等級: </span><?php echo $result["Level"]; ?></p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-vial"></em><span>總經驗: </span><?php echo $result["TotalExperience"]; ?> 點</p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-coins"></em><span>PEN: </span><?php echo $result["PEN"]; ?></p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-coins"></em><span>AP: </span><?php echo $result["AP"]; ?></p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-equals"></em><span>總遊玩場數: </span><?php echo $result["TotalMatches"]; ?> 場</p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-trophy"></em><span>勝場: </span><?php echo $result["TotalWins"]; ?> 場</p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-window-close"></em><span>敗場: </span><?php echo $result["TotalLosses"]; ?> 場</p>
                    </div>
                    <div class="item">
                        <p><em class="fas fa-laptop-house"></em><span>公會: </span><?php echo isset($club) ? $club["Name"] : "還沒加入公會"; ?></p>
                    </div>
                </div>
            <?php else: ?>
            <div class="empty-player">
                <em class="fas fa-file-excel"></em>
                <h3>由於您從未進入遊戲，因此無法顯示。</h3>
            </div>
            <?php endif; ?>
            <div class="options-links">
                <a href="/login.php?logout=true" class="logout">登出</a>
                <a href="/change-password.php" class="change-password">更改密碼</a>
				<a href="/index.php" class="change-password">回主頁</a>	
		   </div>
        </div>
		<script src="/assets/js/app.js"></script>
	</body>

</html>