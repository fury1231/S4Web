<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require __DIR__ . "/config.php";
        require __DIR__ . "/crypt.php";

        $tag = "User created successfully.";
        $db = getDBConection();

        $username = $db -> escape_string($_POST['username']) ?? null;
        $password = $db -> escape_string($_POST['password']) ?? null;

        $salt = openssl_random_pseudo_bytes(24); //create random salt
        $hash = openssl_pbkdf2($password, $salt, 24, 24000, 'sha1'); //pbkf2 with sha1
        $p = base64_encode ($hash); //encode hash to base 64
        $s = base64_encode ($salt); //encode salt to base 64

        $query = "INSERT INTO accounts(Username, Password, Salt, SecurityLevel, AuthToken, newToken) VALUES ('$username', '$p', '$s', '0', '', '')";
        
        if($db -> query($query)){
            session_start();
            $_SESSION["create"] = true;
            header("Location: login.php");
        }else{
            header("Location: index.php?new=false");
        }
        
        $db -> close();
    } else {
        header("Location: index.php");
    }
?>

