<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>玩家排行榜</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            /* 為實際背景圖片的路徑 */
            background-image: url('https://i.imgur.com/CSHTZM4.png');
        }

        h1 {
            text-align: center;
            color: #4d4d4d;
        }

        .leaderboard {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
		td {
			padding: 10px; /* 調整 padding */
			text-align: center;
			cursor: pointer;
			border: none; /* 移除框線 */
			vertical-align: middle; /* 垂直居中 */
		}

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2e6ea;
        }

        .rank-icon {
            font-size: 20px;
            margin-right: 5px;
        }

        .first-place td:nth-child(2) {
            color: #ffd700;
            text-shadow: 2px 2px 4px rgba(255, 215, 0, 0.8);
            font-weight: bold;
        }

        .second-place td:nth-child(2) {
            color: #e74c3c;
            text-shadow: 2px 2px 4px rgba(231, 76, 60, 0.8);
            font-weight: bold;
        }

        .third-place td:nth-child(2) {
            color: #8e44ad;
            text-shadow: 2px 2px 4px rgba(142, 68, 173, 0.8);
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .leaderboard {
                width: 90%;
            }
        }

        .level-icon {
            width: 30px;
            /* 设置图标宽度 */
            height: auto;
            /* 设置图标高度自适应 */
        }
		td:nth-child(2) {
			width: 400px; /* 設置你想要的寬度值 */
}

    </style>
<script>
    // JavaScript 函數，用於排序表格
 function sortTable(columnIndex) {
    var table, rows, switching, i, x, y, shouldSwitch, dir;
    table = document.getElementById("leaderboard");
    switching = true;
    dir = table.getAttribute("data-sort-dir") || "desc"; // 获取当前排序方向，默认为降序

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            // 跳過暱稱列
            if (columnIndex !== 1) {
                x = rows[i].getElementsByTagName("td")[columnIndex];
                y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                // 使用 parseInt 解析數字，過濾非數字字符
                var numX = parseInt(x.innerText.replace(/\D/g, '') || x.textContent.replace(/\D/g, ''));
                var numY = parseInt(y.innerText.replace(/\D/g, '') || y.textContent.replace(/\D/g, ''));

                // 添加 console.log 語句
                console.log("x:", numX, "y:", numY);

                if (dir === "desc") {
                    if (numX < numY) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "asc") {
                    if (numX > numY) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }

        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }

    // 切換排序方向
    dir = (dir === "desc") ? "asc" : "desc";
    table.setAttribute("data-sort-dir", dir);
}
</script>


</head>

<body>
    <!-- 遊戲網站導航欄 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">FURY S4 LEAGUE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#leaderboard">排行榜 <span class="sr-only">(current)</span></a>
                </li>

<li class="nav-item">
    <a href="https://drive.google.com/file/d/1gzwKdpqdaC8cqqEvDL2HuMw0hm8N2Wf_/view?usp=drive_link"
        class="nav-link" target="_blank">遊戲下載</a>
</li>
                <li class="nav-item">
                    <a class="nav-link" href="./account.php">個人中心</a>
                </li>

            </ul>
        </div>
    </nav>


    <div class="container">
        <!-- 你的現有排行榜表格 -->
        <table id="leaderboard" class="table table-bordered leaderboard">
            <thead class="thead-dark">
                <tr>
                    <th onclick="sortTable(0)" scope="col">排名</th>
                    <th onclick="" scope="col">暱稱</th>
                    <th onclick="" scope="col">等級</th>
					<th onclick="sortTable(7)" scope="col">總擊殺</th> <!-- 添加總擊殺列 -->
                    <th onclick="sortTable(3)" scope="col">總經驗</th>
                    <th onclick="sortTable(4)" scope="col">總場次</th>
                    <th onclick="sortTable(5)" scope="col">總勝場</th>
                    <th onclick="sortTable(6)" scope="col">總敗場</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "kenhuang1234";
                $dbname = "netsphere";

                // 创建连接
                $conn = new mysqli($servername, $username, $password, $dbname);

                // 检查连接
                if ($conn->connect_error) {
                    die("連接失敗: " . $conn->connect_error);
                }

                // 查询 accounts 表中的 Nicknames，并按照等级降序排列
                $sql_accounts = "
				SELECT 
					accounts.*, 
					players.Level AS player_level, 
					players.TotalExperience, 
					players.TotalMatches, 
					players.TotalWins, 
					players.TotalLosses, 
					(COALESCE(player_info_battleroyal.kills, 0) + COALESCE(player_info_deathmatch.kills, 0) + COALESCE(player_info_touchdown.Kill, 0)) AS TotalKills
					FROM accounts 
					JOIN players ON accounts.Id = players.Id
					LEFT JOIN player_info_battleroyal ON accounts.Id = player_info_battleroyal.playerId
					LEFT JOIN player_info_deathmatch ON accounts.Id = player_info_deathmatch.playerId
					LEFT JOIN player_info_touchdown ON accounts.Id = player_info_touchdown.playerId
					ORDER BY player_level DESC;";
                $result_accounts = $conn->query($sql_accounts);

                // 检查是否有结果
                if ($result_accounts->num_rows > 0) {
                    $rank = 1;
                    // 遍历每一行结果
                    while ($row_accounts = $result_accounts->fetch_assoc()) {
                        // 在這裡處理每一行的數據
                        $nickname = $row_accounts["Nickname"];
                        $player_level = $row_accounts["player_level"];
                        $total_experience = $row_accounts["TotalExperience"];
                        $total_matches = $row_accounts["TotalMatches"];
                        $total_wins = $row_accounts["TotalWins"];
                        $total_losses = $row_accounts["TotalLosses"];
						$total_kills = $row_accounts["TotalKills"];
                        // 新增類別以突出前三名
                        $class = '';
                        if ($rank == 1) {
                            $class = 'first-place';
                        } elseif ($rank == 2) {
                            $class = 'second-place';
                        } elseif ($rank == 3) {
                            $class = 'third-place';
                        }
                        // 获取等级图片路径
                        $level_img_path = "assets/img/levels/{$player_level}.png";
                        
						
						
						$background_image = 'https://i.imgur.com/TZRYkv3.png';
						if ($rank == 1) {
							$background_image = 'https://i.imgur.com/6xdb2pI.png';
						} elseif ($rank == 2) {
							$background_image = 'https://i.imgur.com/H1j2sqg.png';
						} elseif ($rank == 3) {
							$background_image = 'https://i.imgur.com/2xv4i6e.png';
						}
						
						
						
						
						// 如果等级超过80，使用80.png
						
                        if ($player_level > 80) {
                            $level_img_path = "assets/img/levels/80.png";
                        }
                        // 顯示相應的數據
						echo "<tr class='{$class}'>
								<td>{$rank}</td>
								<td style='background-image: url(\"{$background_image}\"); background-size: cover; color: #fff;'>{$nickname}</td>
								<td><img src='{$level_img_path}' alt='Level {$player_level}' class='level-icon'></td>
								<td>{$total_kills}</td> <!-- 显示总擊殺数 -->
								<td>{$total_experience}</td>
								<td>{$total_matches}</td>
								<td>{$total_wins}</td>
								<td>{$total_losses}</td>
							  </tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='7'>沒有結果</td></tr>";
                }

                // 關閉數據庫連接
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- 新增的 jQuery 代碼 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            // 當點擊導航連結時的平滑滾動效果
            $('a.nav-link').on('click', function (event) {
                if (this.hash !== '') {
                    event.preventDefault();

                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {
                        window.location.hash = hash;
                    });
                }
            });
        });
    </script>
</body>

</html>
