<?php


include('../../config.php');

$id_servicio = $_POST['id_servicio'];

$sentencia = $pdo->prepare("DELETE FROM tb_almacen_servicios WHERE id_servicio=:id_servicio");

$sentencia->bindParam('id_servicio', $id_servicio);
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el servicio de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/servicios/');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo eliminar el registro en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/servicios/delete.php?id=' . $id_servicio);
}
