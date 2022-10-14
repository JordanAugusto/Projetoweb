<?php

$server = "localhost";
$usuario = "u994259512_cedt";
$senha = "4+eNKG8ON";
$banco = "u994259512_crudemail";

try{
    $conexao = new PDO("mysql:host=$server;dbname=$banco", $usuario,$senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){
    echo "Erro de conexão: {$erro->getMessage()}";
    $conexao = null;
}

?>