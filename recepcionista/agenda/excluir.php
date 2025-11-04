<?php
    require_once("../../conexao.php");

    $id = $_GET['id'];

    $pdo->query("DELETE FROM eventos WHERE id = '$id'");

    header("location: ../index.php?pag=agenda");
?>