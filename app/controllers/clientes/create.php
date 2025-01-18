<?php
include('../../config.php');
include('../../../layout/sesion.php');

$ruc = $_GET['ruc'];
$dv = $_GET['dv'];
$nombre_cliente = $_GET['nombre_cliente'];
$celular = $_GET['celular'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];
$descripcion_vehiculo = $_GET['descripcion_vehiculo'];

$usuario_id = $id_usuario_sesion;

$fechaHora = date('Y-m-d H:i:s');

$sentencia = $pdo->prepare("INSERT INTO tb_clientes
       ( ruc, dv, nombre_cliente, celular, email, direccion, descripcion_vehiculo, id_usuario, fyh_creacion) 
VALUES (:ruc,:dv,:nombre_cliente,:celular,:email,:direccion,:descripcion_vehiculo, :id_usuario,:fyh_creacion)");

$sentencia->bindParam('ruc', $ruc);
$sentencia->bindParam('dv', $dv);
$sentencia->bindParam('nombre_cliente', $nombre_cliente);
$sentencia->bindParam('celular', $celular);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('descripcion_vehiculo', $descripcion_vehiculo);
$sentencia->bindParam('id_usuario', $usuario_id);
$sentencia->bindParam('fyh_creacion', $fechaHora);


if ($sentencia->execute()) {
    session_start();
    // echo "se registro correctamente";
    $_SESSION['mensaje'] = "Se registro al cliente de la manera correcta";
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
