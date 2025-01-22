<?php
include('../../config.php');
include('../../../layout/sesion.php');

$ruc = $_POST['ruc'];
$dv = $_POST['dv'];
$nombre_cliente = $_POST['nombre_cliente'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$descripcion_vehiculo = $_POST['descripcion_vehiculo'];

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
?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
<?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    //  header('Location: '.$URL.'/categorias');
?>
    <script>
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
<?php
}
