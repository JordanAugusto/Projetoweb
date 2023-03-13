<?php

$server = "localhost";
$usuario = "";
$senha = "";
$banco = "";

try{
    $conexao = new PDO("mysql:host=$server;dbname=$banco", $usuario,$senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){
    echo "Erro de conexão: {$erro->getMessage()}";
    $conexao = null;
}

?>
