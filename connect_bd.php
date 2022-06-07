<?php
// Informações do meu banco
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "job_project";

// Conexão com o banco de dados
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>