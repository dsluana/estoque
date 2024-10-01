<?php

$host = 'localhost';
$usuario = 'root';
$senha = 'root';
$banco = 'estoque';
$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("falha na conexão: " . $conn->connect_error);
}