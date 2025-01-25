<?php

include('../../config.php');


$nro_servicio = $_GET['nro_servicio'];
$id_cliente = $_GET['id_cliente'];
$total_a_pagar = $_GET['total_a_pagar'];


$pdo->beginTransaction();

$sentencia = $pdo->prepare("INSERT INTO tb_ventas_servicios
       ( nro_servicio, id_cliente, total_pagado, fyh_creacion) 
VALUES (:nro_servicio,:id_cliente,:total_pagado,:fyh_creacion)");

$sentencia->bindParam('nro_servicio', $nro_servicio);
$sentencia->bindParam('id_cliente', $id_cliente);
$sentencia->bindParam('total_pagado', $total_a_pagar);
$sentencia->bindParam('fyh_creacion', $fechaHora);

if ($sentencia->execute()) {

    $pdo->commit();

    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro la venta de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
?>
    <script>
        location.href = "<?php echo $URL; ?>/servicios/ventser.php";
    </script>
<?php
} else {

    $pdo->rollBack();

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
