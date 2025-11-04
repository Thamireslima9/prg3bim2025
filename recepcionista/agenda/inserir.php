<?php
    require_once("../../conexao.php");

    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $data_start = str_replace('/', '-', $start);
    $data_start_conv = date("Y-m-d H:i:s" , strtotime(($data_start)));
    
    $data_end = str_replace('/', '-', $end);
    $data_end_conv = date("Y-m-d H:i:s" , strtotime(($data_end)));

    if($title == ""){
        echo "O Título do evento é obrigatório";
        exit();
    }

    $res = $pdo->prepare("INSERT INTO eventos (title, start, end) VALUES (:title , :start, :end)");

    $res->bindValue(":title", $title);
    $res->bindValue(":start", $data_start_conv);
    $res->bindValue(":end", $data_end_conv);

    $res->execute();

    echo "Salvo com Sucesso!";
?>