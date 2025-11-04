<?php
    require_once("../../conexao.php");
    
    $query_eventos = "SELECT * FROM eventos";
    $resultado_eventos = $pdo->prepare($query_eventos);
    $resultado_eventos->execute();

    $eventos = [];

    while($row_eventos = $resultado_eventos->fetch(PDO::FETCH_ASSOC)){
        $id = $row_eventos['id'];
        $title = $row_eventos['title'];
        $start = $row_eventos['start'];
        $end = $row_eventos['end'];

        $eventos[] = [
            'id' => $id,
            'title' => $title,
            'start' => $start,
            'end' => $end,
            // 'color' => 'green'
        ];
    }

    echo json_encode($eventos);
?>