<?php

	function getDBConection() {
		$db = new mysqli("localhost", "root", "password", "database");
		if(!$db) {
			die("Could not connect to the database.");
		}
		return $db;
	}

	function validarSesion() {
		session_start();
		if(!isset($_SESSION["login"]) && !$_SESSION["login"]) {
			header("Location: /login.php");
		}
	}
?>
