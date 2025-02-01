<?php

$sql_ventser = "SELECT *, DATE_FORMAT(vs.fyh_creacion, '%d/%m/%Y') as fecha, u.nombres as n_user, c.nombre_cliente as cliente
                FROM tb_ventas_servicios vs 
                INNER JOIN tb_usuarios u ON vs.id_usuario = u.id_usuario
                INNER JOIN tb_clientes c ON vs.id_cliente = c.id_cliente";
$query_ventser = $pdo->prepare($sql_ventser);
$query_ventser->execute();
$ventser_datos = $query_ventser->fetchAll(PDO::FETCH_ASSOC);
