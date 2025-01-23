<?php

include('../../config.php');


$id_producto = $_GET['id_producto'];
$stock_final = $_GET['stock_final'];

$sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock WHERE id_producto=:id_producto");

$sentencia->bindParam('id_producto', $id_producto);
$sentencia->bindParam('stock', $stock_final);

if ($sentencia->execute()) {
    echo "stock actualizado correctamente";
} else {
    echo "error al actualizar el stock";
}
