<?php


include('../../config.php');

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre_servicio = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];

$precio = $_POST['precio_venta'];
$id_servicio = $_POST['id_servicio'];



$sentencia = $pdo->prepare("UPDATE tb_almacen_servicios
    SET nombre=:nombre,
        descripcion=:descripcion,
        precio_venta=:precio_venta,
        id_usuario=:id_usuario,
        id_categoria=:id_categoria,
        fyh_update=:fyh_update 
    WHERE id_servicio = :id_servicio");

$sentencia->bindParam('nombre', $nombre_servicio);
$sentencia->bindParam('descripcion', $descripcion);

$sentencia->bindParam('precio_venta', $precio);

$sentencia->bindParam('id_usuario', $id_usuario);
$sentencia->bindParam('id_categoria', $id_categoria);
$sentencia->bindParam('fyh_update', $fechaHora);
$sentencia->bindParam('id_servicio', $id_servicio);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizo el servicio de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/servicios/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo actualizar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/servicios/update.php?id=' . $id_servicio);
}
