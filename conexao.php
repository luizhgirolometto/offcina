<?php

    $BDSERVIDOR = 'localhost';
    $BDUSUARIO = 'root';
    $BDSENHA = 'asd123';
    $BDBANCO = 'offcina';

    $conexao = mysqli_connect($BDSERVIDOR, $BDUSUARIO, $BDSENHA, $BDBANCO);

    if (mysqli_connect_errno($conexao)) {
        echo "Problemas para conectar no banco de dados. Se o problema persistir, pedimos desculpas e, por favor, envie um e-mail para nós - marlon.pilonetto@gmail.com";
        die();
    }

    $resultado=mysqli_query($conexao,"SET NAMES 'utf8'");
    $resultado=mysqli_query($conexao,'SET character_set_connection=utf8');
    $resultado=mysqli_query($conexao,'SET character_set_client=utf8');
    $resultado=mysqli_query($conexao,'SET character_set_results=utf8');

?>
