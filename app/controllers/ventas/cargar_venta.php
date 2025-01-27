<?php

$sql_ventas = "SELECT *, DATE_FORMAT(v.fyh_creacion, '%d/%m/%Y') as fecha, u.nombres as n_user, c.nombre_cliente as cliente
                FROM tb_ventas v 
                INNER JOIN tb_clientes c ON v.id_cliente = c.id_cliente
                INNER JOIN tb_usuarios u ON v.id_usuario = u.id_usuario
                WHERE v.id_venta = $id_venta_get";
$query_ventas = $pdo->prepare($sql_ventas);
$query_ventas->execute();
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

foreach ($ventas_datos as $ventas_dato) {
    $nro_venta = $ventas_dato['nro_venta'];
    $id_cliente = $ventas_dato['id_cliente'];
    $fecha = $ventas_dato['fecha'];
}
