<?php

include('../../config.php');

$id_vs = $_GET['id_vs'];
$nro_servicio = $_GET['nro_servicio'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("DELETE FROM tb_ventas_servicios WHERE id_vs=:id_vs");
$sentencia->bindParam('id_vs', $id_vs);

if ($sentencia->execute()) {

    $sentencia2 = $pdo->prepare("DELETE FROM tb_carrito_servicios WHERE nro_servicio=:nro_servicio");
    $sentencia2->bindParam('nro_servicio', $nro_servicio);
    $sentencia2->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "El servicio realizado fue anulado correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/listado_ventser.php";
    </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error al intentar anular un servicio realizado";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/listado_ventser.php";
    </script>
<?php
}
