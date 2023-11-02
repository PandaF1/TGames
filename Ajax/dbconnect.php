<?php
	// название  сервера БД
	define ("HOST", "localhost");
	// название базы данных
	define ("DATABASE", "TGames");
	// пользователь MySQL
	define ("MYSQL_USER", "root");
	// пароль к MYSQL
	define ("MYSQL_PASS", "");
	
	
	// создаем базу данных и таблицу  gb
	$link1=mysql_connect(HOST, MYSQL_USER, MYSQL_PASS) or die("Нет соединения с MySQL сервером!");
	mysql_set_charset("utf8"); 
	mysql_query ("CREATE DATABASE IF NOT EXISTS ".DATABASE) or die ("Не могу создать базу данных gb.");
	mysql_select_db(DATABASE) or die("Нет содениения с требуемой базой данных!");
?>