<?php
include ('../../config.php');


$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre_servicio = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];

$precio = $_POST['precio_venta'];


$sentencia = $pdo->prepare("INSERT INTO tb_almacen_servicios
       ( codigo, nombre, descripcion, precio_venta, id_usuario, id_categoria, fyh_creacion) 
VALUES (:codigo,:nombre,:descripcion,:precio_venta,:id_usuario,:id_categoria,:fyh_creacion)");

$sentencia->bindParam('codigo',$codigo);
$sentencia->bindParam('nombre',$nombre_servicio);
$sentencia->bindParam('descripcion',$descripcion);

$sentencia->bindParam('precio_venta',$precio);

$sentencia->bindParam('id_usuario',$id_usuario);
$sentencia->bindParam('id_categoria',$id_categoria);
$sentencia->bindParam('fyh_creacion',$fechaHora);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se registro el servicio de la manera correcta";
    $_SESSION['icono'] = "success";
    header('Location: '.$URL.'/servicios/');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/servicios/create.php');
}



