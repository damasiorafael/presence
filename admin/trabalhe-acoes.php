<?php
    include("inc/config.php");

    header('Content-Type: text/html; charset=utf-8');

    $id = protecao($_REQUEST['id']);

    $sqlStatus = "UPDATE trabalhe SET status = 1 WHERE id = $id";
    $resultStatus = update_db($sqlStatus);

    echo "sucesso";
?>