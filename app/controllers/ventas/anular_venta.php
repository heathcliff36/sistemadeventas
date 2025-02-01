<?php

include('../../config.php');

$id_venta = $_GET['id_venta'];
$nro_venta = $_GET['nro_venta'];

$pdo->beginTransaction();

$sentencia = $pdo->prepare("UPDATE tb_ventas SET estado = 0 WHERE id_venta=:id_venta");
//$sentencia = $pdo->prepare("DELETE FROM tb_ventas WHERE id_venta=:id_venta");
$sentencia->bindParam('id_venta', $id_venta);

if ($sentencia->execute()) {

    $sentencia2 = $pdo->prepare("UPDATE tb_carrito SET estatus = 0 WHERE nro_venta=:nro_venta");
    //$sentencia2 = $pdo->prepare("DELETE FROM tb_carrito WHERE nro_venta=:nro_venta");
    $sentencia2->bindParam('nro_venta', $nro_venta);
    $sentencia2->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Venta anulada correctamente";
    $_SESSION['icono'] = "success";
?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas";
    </script>
<?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error al intentar anular una venta";
    $_SESSION['icono'] = "error";
?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas";
    </script>
<?php
}
