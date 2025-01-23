<?php

$sql_servicios = "SELECT *, cat.nombre_categoria as categoria, u.user as user
                  FROM tb_almacen_servicios as a INNER JOIN tb_categorias as cat ON a.id_categoria = cat.id_categoria 
                  INNER JOIN tb_usuarios as u ON u.id_usuario = a.id_usuario";
$query_servicios = $pdo->prepare($sql_servicios);
$query_servicios->execute();
$servicios_datos = $query_servicios->fetchAll(PDO::FETCH_ASSOC);
