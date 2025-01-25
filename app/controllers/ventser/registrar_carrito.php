<?php

include('../../config.php');


$nro_servicio = $_GET['nro_servicio'];
$id_servicio = $_GET['id_servicio'];
$cantidad = $_GET['cantidad'];

$sentencia = $pdo->prepare("INSERT INTO tb_carrito_servicios
       ( nro_servicio, id_servicio, cantidad, fyh_creacion) 
VALUES (:nro_servicio,:id_servicio,:cantidad,:fyh_creacion)");

$sentencia->bindParam('nro_servicio', $nro_servicio);
$sentencia->bindParam('id_servicio', $id_servicio);
$sentencia->bindParam('cantidad', $cantidad);
$sentencia->bindParam('fyh_creacion', $fechaHora);

if ($sentencia->execute()) {
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/ventser.php";
    </script>
<?php
} else {



    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/ventser.php";
    </script>
<?php
}
