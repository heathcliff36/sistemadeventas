<?php

include('../../config.php');

$id_cliente = $_GET['id_cliente'];
$ruc = $_GET['ruc'];
$dv = $_GET['dv'];
$nombre_cliente = $_GET['nombre_cliente'];
$celular = $_GET['celular'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];
$descripcion_vehiculo = $_GET['descripcion_vehiculo'];


$sentencia = $pdo->prepare("UPDATE tb_clientes
    SET ruc=:ruc,
        dv=:dv,
        nombre_cliente=:nombre_cliente,
        celular=:celular,
        email=:email,
        direccion=:direccion,
        descripcion_vehiculo=:descripcion_vehiculo,
        fyh_update=:fyh_update 
    WHERE id_cliente = :id_cliente ");

$sentencia->bindParam('ruc', $ruc);
$sentencia->bindParam('dv', $dv);
$sentencia->bindParam('nombre_cliente', $nombre_cliente);
$sentencia->bindParam('celular', $celular);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('descripcion_vehiculo', $descripcion_vehiculo);
$sentencia->bindParam('fyh_update', $fechaHora);
$sentencia->bindParam('id_cliente', $id_cliente);


if ($sentencia->execute()) {
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se actualizo al cliente de la manera correcta";
    $_SESSION['icono'] = "success";
    // header('Location: '.$URL.'/categorias/');
?>
    <script>
        location.href = "<?php echo $URL; ?>/clientes";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
?>
    <script>
        location.href = "<?php echo $URL; ?>/clientes";
    </script>
<?php
}
