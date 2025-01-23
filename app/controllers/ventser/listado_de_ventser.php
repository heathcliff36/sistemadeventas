<?php

$sql_ventser = "SELECT * FROM tb_ventas_servicios";
$query_ventser = $pdo->prepare($sql_ventser);
$query_ventser->execute();
$ventser_datos = $query_ventser->fetchAll(PDO::FETCH_ASSOC);
